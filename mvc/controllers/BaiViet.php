<?php
class BaiViet extends Controller
{
    public $baivietModel;
    public $loaisanphamModel;

    function __construct()
    {
        $this->baivietModel = $this->callModel("BaiVietModel");
        $this->loaisanphamModel = $this->callModel("LoaiSanPhamModel");
    }

    function DashBoard()
    {
        $this->pageNotFound();
    }

    function view($name)
    {
        $this->baivietModel->updateView($name);
        $this->callView("sanphamMaster", [
            "LoaiSP" => $this->loaisanphamModel->getAll(),
            "Pages" => ["baiviet"],
            "BaiViet" => $this->baivietModel->findByName($name)
        ]);
    }
}
