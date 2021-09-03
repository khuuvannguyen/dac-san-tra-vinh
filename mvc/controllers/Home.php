<?php
class Home extends Controller
{
    // function SayHi($text)
    // {
    //     $model = $this->callModel("SinhVienModel");
    //     $A = $model->getA();
    //     $this->callView("two", [
    //         "Name" => $A,
    //         "Page" => "contact",
    //         "Text" => $text
    //     ]);
    // }

    // function Show()
    // {
    //     $model = $this->callModel("SinhVienModel");
    //     $json = $model->getSinhVien();
    //     $this->callView("one", [
    //         "sinhvien" => $json,
    //         "Page" => "news"
    //     ]);
    // }

    public $taikhoanModel;
    public $loaisanphamModel;
    public $sanphamModel;
    public $trongluongModel;
    public $baivietModel;

    function __construct()
    {
        $this->loaisanphamModel = $this->callModel("LoaiSanPhamModel");
        $this->sanphamModel = $this->callModel("SanPhamModel");
        $this->trongluongModel = $this->callModel("TrongLuongModel");
        $this->baivietModel = $this->callModel("BaiVietModel");
    }

    function DashBoard()
    {
        $this->callView("indexMaster", [
            "Pages" => ["sanpham_home", "sanpham-ngaunhien", "baiviet_home"],
            "LoaiSP" => $this->loaisanphamModel->getAll(),
            "SanPhamMoi" => $this->sanphamModel->getSanPhamMoi(),
            "SanPhamBanChay" => $this->sanphamModel->getSanPhamBanChay(),
            "SanPhamHot" => $this->sanphamModel->getSanPhamHot(),
            "SanPhamXemNhieu" => $this->sanphamModel->getXemNhieu(),
            "BaiVietMoi" => $this->baivietModel->getNews()
        ]);
    }

    function huongdan()
    {
        $this->callView("sanphamMaster", [
            "LoaiSP" => $this->loaisanphamModel->getAll(),
            "Pages" => ["huong-dan"]
        ]);
    }

    function doitra(){
        $this->callView("sanphamMaster", [
            "LoaiSP" => $this->loaisanphamModel->getAll(),
            "Pages" => ["doi-tra"]
        ]);
    }

    function tim_kiem()
    {
        $searchKey = $_POST["q"];
        echo $searchKey;
    }
}
