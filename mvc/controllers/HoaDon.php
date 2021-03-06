<?php
class HoaDon extends Controller
{
    public $hoadonModel;
    public $chitiethoadonModel;
    public $loaisanphamModel;
    public $trongluongModel;
    public $sanphamModel;

    function __construct()
    {
        $this->hoadonModel = $this->callModel("HoaDonModel");
        $this->chitiethoadonModel = $this->callModel("ChiTietHoaDonModel");
        $this->loaisanphamModel = $this->callModel("LoaiSanPhamModel");
        $this->trongluongModel = $this->callModel("TrongLuongModel");
        $this->sanphamModel = $this->callModel("SanPhamModel");
    }

    function DashBoard()
    {
        if (!isset($_POST["btnSearchHoaDon"])) {
            $json = !empty($_SESSION["HOADON"]) ? $_SESSION["HOADON"] : array();
            $this->callView("sanphamMaster", [
                "LoaiSP" => $this->loaisanphamModel->getAll(),
                "Pages" => ["hoa-don"],
                "HOADON" => json_encode($json)
            ]);
        } else {
            $func = $_POST["searchType"];
            $searchValue = $_POST["searchValue"];
            $this->callView("sanphamMaster", [
                "LoaiSP" => $this->loaisanphamModel->getAll(),
                "Pages" => ["hoa-don"],
                "HOADON" => $this->hoadonModel->$func($searchValue)
            ]);
        }
        // if (isset($_SESSION["HOADON"])) {
        //     foreach ($_SESSION["HOADON"] as $value) {
        //         echo $value["MAHOADON"]."<br>";
        //     }
        // } else {
        //     echo "hoa don trong";
        // }
    }

    function detail($id)
    {
        if (is_null($id)) {
            $this->pageNotFound();
        } else {
            $chitiet = $this->chitiethoadonModel->findById($id);
            $temp = json_decode($chitiet, true);
            $maSP = array();
            $trongluong = array();
            foreach ($temp as $value) {
                $maSP = array_merge($maSP, json_decode($this->trongluongModel->getOne($value["MATRONGLUONG"]), true));
                $trongluong = array_merge($trongluong, json_decode($this->trongluongModel->getOne($value["MATRONGLUONG"]), true));
            }

            $sanpham = array();
            foreach ($maSP as $value) {
                $sanpham = array_merge($sanpham, json_decode($this->sanphamModel->findById($value["MASANPHAM"]), true));
            }

            $this->callView("blankPage", [
                "Pages" => ["thongtin-hoadon"],
                "HoaDon" => $this->hoadonModel->findById($id),
                "ChiTiet" => $chitiet,
                "BangChu" => json_encode($this->convert_number_to_words(json_decode($this->hoadonModel->findById($id), true)[0]["TONGTHANHTOAN"])),
                "SanPham" => json_encode($sanpham, JSON_UNESCAPED_UNICODE),
                "TrongLuong" => json_encode($trongluong, JSON_UNESCAPED_UNICODE)
            ]);
        }
    }

    function convert_number_to_words($number)
    {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = '??m ';
        $decimal     = ' ph???y ';
        $dictionary  = array(
            0                   => 'kh??ng',
            1                   => 'm???t',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'b???n',
            5                   => 'n??m',
            6                   => 's??u',
            7                   => 'b???y',
            8                   => 't??m',
            9                   => 'ch??n',
            10                  => 'm?????i',
            11                  => 'm?????i m???t',
            12                  => 'm?????i hai',
            13                  => 'm?????i ba',
            14                  => 'm?????i b???n',
            15                  => 'm?????i n??m',
            16                  => 'm?????i s??u',
            17                  => 'm?????i b???y',
            18                  => 'm?????i t??m',
            19                  => 'm?????i ch??n',
            20                  => 'hai m????i',
            30                  => 'ba m????i',
            40                  => 'b???n m????i',
            50                  => 'n??m m????i',
            60                  => 's??u m????i',
            70                  => 'b???y m????i',
            80                  => 't??m m????i',
            90                  => 'ch??n m????i',
            100                 => 'tr??m',
            1000                => 'ngh??n',
            1000000             => 'tri???u',
            1000000000          => 't???',
            1000000000000       => 'ngh??n t???',
            1000000000000000    => 'ngh??n tri????u tri????u',
            1000000000000000000 => 't??? t???'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . $this->convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->convert_number_to_words($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }
}
