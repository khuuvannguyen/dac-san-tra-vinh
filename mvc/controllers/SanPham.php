<?php
class SanPham extends Controller
{

    public $taikhoanModel;
    public $loaisanphamModel;
    public $sanphamModel;
    public $trongluongModel;
    public $motaModel;
    public $hoadonModel;

    function __construct()
    {
        $this->loaisanphamModel = $this->callModel("LoaiSanPhamModel");
        $this->sanphamModel = $this->callModel("SanPhamModel");
        $this->trongluongModel = $this->callModel("TrongLuongModel");
        $this->motaModel = $this->callModel("MoTaModel");
        $this->hoadonModel = $this->callModel("HoaDonModel");
        // echo "page = sanpham";
    }

    function DashBoard()
    {
        $this->pageNotFound();
        // echo "action = dashboard";
    }

    //xử lý hiện thông tin sản phẩm
    function thong_tin($tenKD)
    {
        if (isset($_SESSION["THANHTOAN"])) {
            unset($_SESSION["THANHTOAN"]);
        }
        if (isset($_SESSION["MUANGAY"])) {
            unset($_SESSION["MUANGAY"]);
        }
        try {
            if (empty($tenKD)) {
                $this->pageNotFound();
            } else {
                $sanpham = $this->sanphamModel->getOne($tenKD);
                $temp = json_decode($sanpham, true);
                $this->sanphamModel->updateClick(@$temp[0]["MASANPHAM"]);
                if (!empty($temp)) {
                    $this->callView("sanphamMaster", [
                        "Pages" => ["sanpham-detail", "sanpham-cungloai", "sanpham-ngaunhien"],
                        "LoaiSP" => $this->loaisanphamModel->getAll(),
                        "CungLoai" => $this->sanphamModel->getSanPhamCungLoai($temp[0]["MALOAI"], $temp[0]["MASANPHAM"]),
                        "TrongLuongSimple" => $this->trongluongModel->getSimple($temp[0]["MASANPHAM"]),
                        "TrongLuongFull" => $this->trongluongModel->getFull($temp[0]["MASANPHAM"]),
                        "MoTa" => $this->motaModel->getMoTa($temp[0]["MASANPHAM"]),
                        "SanPham" => $sanpham,
                        "SanPhamNgauNhien" => $this->sanphamModel->getSanPhamNgauNhien(),
                        "SanPhamHot" => $this->sanphamModel->getSanPhamHot()
                    ]);
                } else {
                    $this->pageNotFound();
                }
            }
        } catch (Exception $e) {
            $this->pageNotFound();
        }
    }

    function loai($tenLoai)
    {
        try {
            if (is_null($tenLoai)) {
                $this->pageNotFound();
            } else {
                $loaiSP = $this->loaisanphamModel->getSomes($tenLoai);
                $temp = json_decode($loaiSP, true);
                if (!empty($temp)) {
                    $sanpham = $this->sanphamModel->getSanPhamThuocLoai($temp[0]["MALOAI"]);
                    $this->callView("sanphamMaster", [
                        "Pages" => ["sanpham-theoloai"],
                        "Loai" => $loaiSP,
                        "SanPham" => $sanpham,
                        "LoaiSP" => $this->loaisanphamModel->getAll(),
                    ]);
                } else {
                    $this->pageNotFound();
                }
            }
        } catch (Exception $e) {
            $this->pageNotFound();
        }
    }

    function tim_kiem($q)
    {
        try {
            if (isset($q)) {
                $searchKey = trim($q);
                $sanpham = $this->sanphamModel->getSomes($searchKey);
                $this->callView("sanphamMaster", [
                    "Pages" => ["sanpham-timkiem"],
                    "SanPham" => $sanpham,
                    "SearchKey" => $searchKey,
                    "SoLuong" => $this->sanphamModel->getSomes_soluong($searchKey),
                    "LoaiSP" => $this->loaisanphamModel->getAll()
                ]);
            } else {
                $this->pageNotFound();
            }
        } catch (Exception $e) {
            $this->pageNotFound();
        }
    }

    function san_pham_moi()
    {
        $this->callView("sanphamMaster", [
            "Pages" => ["sanpham-click-xemthem"],
            "SanPham" => $this->sanphamModel->getAllMoi(),
            "LoaiSP" => $this->loaisanphamModel->getAll(),
            "Title" => "Danh sách sản phẩm mới"
        ]);
    }

    function san_pham_ban_chay()
    {
        $this->callView("sanphamMaster", [
            "Pages" => ["sanpham-click-xemthem"],
            "SanPham" => $this->sanphamModel->getAllBanChay(),
            "LoaiSP" => $this->loaisanphamModel->getAll(),
            "Title" => "Danh sách sản phẩm bán chạy"
        ]);
    }

    function mua_ngay()
    {
        try {
            if (isset($_POST["buy-now"])) {
                $maTL = $_POST["maTL-buy"];
                $soluong = $_POST["SL-buy"];
                $trongluong = $this->trongluongModel->getOne($maTL);
                $temp = json_decode($trongluong, true);
                $maSP = $temp[0]["MASANPHAM"];
                $sanpham = $this->sanphamModel->findById($maSP);
                $this->callView("sanphamMaster", [
                    "Pages" => ["mua-ngay"],
                    "LoaiSP" => $this->loaisanphamModel->getAll(),
                    "SoLuong" => json_encode($soluong),
                    "SanPham" => $sanpham,
                    "TrongLuong" => $trongluong,
                    "BuyNow" => 1
                ]);
                $_SESSION["MUANGAY"][$maTL] = array(
                    "MATRONGLUONG" => $maTL,
                    "MASANPHAM" => $maSP,
                    "GIABAN" => $temp[0]["GIABAN"],
                    "TENSANPHAM" => json_decode($sanpham, true)[0]["TENSANPHAM"],
                    "SOLUONG" => $soluong,
                    "TRONGLUONG" => $temp[0]["TRONGLUONG"]
                );
            } elseif (isset($_POST["mua"])) {
                $gia = $_POST["giaban"];
                // $soluong = $_POST["soluong-temp"];

                $soluong = array();
                foreach ($_POST["soluong-temp"] as $value) {
                    if ($value != -1) {
                        array_push($soluong, $value);
                    }
                }

                $trongluong = array();
                foreach ($_POST["maTL"] as $value) {
                    $trongluong = array_merge($trongluong, json_decode($this->trongluongModel->getOne($value), true));
                }

                $sanpham = array();
                foreach ($trongluong as $value) {
                    $sanpham = array_merge($sanpham, json_decode($this->sanphamModel->findById($value["MASANPHAM"]), true));
                }

                for ($i = 0; $i < count($trongluong); $i++) {
                    $_SESSION["MUANGAY"][$trongluong[$i]["MATRONGLUONG"]] = array(
                        "MATRONGLUONG" => $trongluong[$i]["MATRONGLUONG"],
                        "TRONGLUONG" => $trongluong[$i]["TRONGLUONG"],
                        "SOLUONG" => $soluong[$i],
                        "GIABAN" => $trongluong[$i]["GIABAN"],
                        "MASANPHAM" => $sanpham[$i]["MASANPHAM"],
                        "TENSANPHAM" => $sanpham[$i]["TENSANPHAM"]
                    );
                }
                $this->callView("sanphamMaster", [
                    "Pages" => ["mua-ngay"],
                    "LoaiSP" => $this->loaisanphamModel->getAll(),
                    "SoLuong" => json_encode($soluong),
                    "SanPham" => json_encode($sanpham),
                    "TrongLuong" => json_encode($trongluong)
                ]);
            } else {
                $this->pageNotFound();
            }
        } catch (Exception $e) {
            $this->pageNotFound();
        }
    }


    //Làm giỏ hàng -> giỏ hàng có thể thay đổi số lượng sản phẩm --> DONE
    //xử lý khi bấm "mua ngay" --> DONE
}
