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
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'không',
            1                   => 'một',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'bốn',
            5                   => 'năm',
            6                   => 'sáu',
            7                   => 'bảy',
            8                   => 'tám',
            9                   => 'chín',
            10                  => 'mười',
            11                  => 'mười một',
            12                  => 'mười hai',
            13                  => 'mười ba',
            14                  => 'mười bốn',
            15                  => 'mười năm',
            16                  => 'mười sáu',
            17                  => 'mười bảy',
            18                  => 'mười tám',
            19                  => 'mười chín',
            20                  => 'hai mươi',
            30                  => 'ba mươi',
            40                  => 'bốn mươi',
            50                  => 'năm mươi',
            60                  => 'sáu mươi',
            70                  => 'bảy mươi',
            80                  => 'tám mươi',
            90                  => 'chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
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
