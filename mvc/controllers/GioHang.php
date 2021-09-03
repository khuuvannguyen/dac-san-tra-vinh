<?php
class GioHang extends Controller
{

    public $sanphamModel;
    public $loaiSanPhamModel;
    public $trongLuongModel;

    function __construct()
    {
        $this->sanphamModel = $this->callModel("SanPhamModel");
        $this->loaiSanPhamModel = $this->callModel("LoaiSanPhamModel");
        $this->trongLuongModel = $this->callModel("TrongLuongModel");
    }

    function DashBoard()
    {
        if (isset($_SESSION["THANHTOAN"])) {
            unset($_SESSION["THANHTOAN"]);
        }
        if (isset($_SESSION["MUANGAY"])) {
            unset($_SESSION["MUANGAY"]);
        }
        if (isset($_POST["update"]) && $_POST["soluong"] > 0) {
            (int)$_SESSION["GIOHANG"][$_POST["code"]]["SOLUONG"] = $_POST["soluong"];
        }
        $json = array();
        $jSoLuong = array();
        $jSanPham = array();
        $jTrongLuong = array();
        if (isset($_SESSION["GIOHANG"])) {
            $json = $_SESSION["GIOHANG"];
            $tempSoLuong = "";
            foreach ($_SESSION["GIOHANG"] as $value) {
                $jSoLuong = array_merge($jSoLuong, json_decode($this->trongLuongModel->getOne($value["MATRONGLUONG"]), true));
                $jSanPham = array_merge($jSanPham, json_decode($this->sanphamModel->findById($value["MASANPHAM"]), true));

                $tempSoLuong .= $value["TRONGLUONG"] . " ";
            }
            $jTrongLuong = explode(' ', $tempSoLuong);
        }
        // print_r($jSanPham);

        $this->callView("sanphamMaster", [
            "Pages" => ["gio_hang"],
            "LoaiSP" => $this->loaiSanPhamModel->getAll(),
            "GioHang" => json_encode($json, JSON_UNESCAPED_UNICODE),
            "MAX" => $this->trongLuongModel->getCount(),
            "SoLuongSP" => json_encode($jSoLuong, JSON_UNESCAPED_UNICODE),
            "SanPham" => json_encode($jSanPham, JSON_UNESCAPED_UNICODE),
            "TrongLuong" => json_encode($jTrongLuong, JSON_UNESCAPED_UNICODE)
        ]);
        // print_r($json);
        // echo '<a href="?page=GioHang&action=remove&code=1">xoa</a>';
    }

    function updateSL()
    {
        (int)$_SESSION["GIOHANG"][$_POST["code"]]["SOLUONG"] = $_POST["soluong"];
    }

    function sub()
    {
        (int)$_SESSION["GIOHANG"][$_POST["code"]]["SOLUONG"] -= 1;
        // echo $_SESSION["GIOHANG"][$_POST["code"]]["SOLUONG"];
    }

    function plus()
    {
        (int)$_SESSION["GIOHANG"][$_POST["code"]]["SOLUONG"] += 1;
        // echo $_SESSION["GIOHANG"][$_POST["code"]]["SOLUONG"];
    }

    function remove($code)
    {
        if (is_null($code)) {
            $this->pageNotFound();
        } else {
            unset($_SESSION["GIOHANG"][$code]);
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }

    function addCart()
    {
        try {
            if (isset($_POST["a"])) {
                $maTL = $_POST["m"];
                $temp = json_decode($this->trongLuongModel->getOne($maTL), true);
                $trongluong = $temp[0]["TRONGLUONG"];
                $sanpham = json_decode($this->sanphamModel->findById($temp[0]["MASANPHAM"]), true);
                $maSP = $sanpham[0]["MASANPHAM"];
                $tenSP = $sanpham[0]["TENSANPHAM"];
                $soluong = $_POST["n"];
                $gia = $temp[0]["GIABAN"];
                if (!isset($_SESSION["GIOHANG"][$maTL])) {
                    $_SESSION["GIOHANG"][$maTL] = array(
                        "MATRONGLUONG" => $maTL,
                        "MASANPHAM" => $maSP,
                        "TENSANPHAM" => $tenSP,
                        "TRONGLUONG" => $trongluong,
                        "SOLUONG" => $soluong,
                        "GIABAN" => $gia,
                    );
                } else {
                    $_SESSION["GIOHANG"][$maTL]["SOLUONG"] += $soluong;
                }
                // header("Location: ".$_SERVER['HTTP_REFERER']);
                echo "Sản phẩm đã được thêm vào giỏ hàng";
            } else {
                $this->pageNotFound();
            }
        } catch (Exception $e) {
            echo "Đã xảy ra lỗi!";
        }
        ///
        // echo "------";
        // $tongtien = 0;
        // foreach ($_SESSION["GIOHANG"] as $giohang) {
        //     $thanhtien = $giohang["GIABAN"] * $giohang["SOLUONG"];
        //     $tongtien += $thanhtien;
        //     echo "tensp = " . $giohang["TENSANPHAM"];
        //     echo "so luong = " . $giohang["SOLUONG"];
        //     echo "giaban = " . $giohang["GIABAN"];
        //     echo "tong tien = $tongtien";
        // }
        // unset($_SESSION["GIOHANG"]);
    }
}
