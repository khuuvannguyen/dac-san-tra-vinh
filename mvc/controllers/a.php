<?php
class a extends Controller
{

    public $baivietModel;
    public $chitiethoadonModel;
    public $hoadonModel;
    public $loaisanphamModel;
    public $motaModel;
    public $sanphamModel;
    public $taikhoanModel;
    public $trongluongModel;
    public $restModel;

    function __construct()
    {
        $this->baivietModel = $this->callModel("BaiVietModel");
        $this->chitiethoadonModel = $this->callModel("ChiTietHoaDonModel");
        $this->hoadonModel = $this->callModel("HoaDonModel");
        $this->loaisanphamModel = $this->callModel("LoaiSanPhamModel");
        $this->motaModel = $this->callModel("MoTaModel");
        $this->sanphamModel = $this->callModel("SanPhamModel");
        $this->taikhoanModel = $this->callModel("TaiKhoanModel");
        $this->trongluongModel = $this->callModel("TrongLuongModel");
        $this->restModel = $this->callModel("Rest");
        // --------
        if (!isset($_SESSION["role"])) {
            $this->login();
            exit();
        }
    }

    function DashBoard()
    {
        $hoadon = $this->hoadonModel->getGhiChu("Chưa duyệt");
        if (isset($_POST['btnDuyet'])) {
            foreach ($_POST['inputCheck'] as $value) {
                if ($this->hoadonModel->duyetHoaDon($value)) {
                    $this->hoadonModel->duyetHoaDon($value);
                }
            }
            header("Location: ?page=a&action=DashBoard");
        } else if (isset($_POST["btnHuy"])) {
            foreach ($_POST["inputCheck"] as $value) {
                if ($this->hoadonModel->huyHoaDon($value)) {
                    $this->hoadonModel->huyHoaDon($value);
                }
            }
            header("Location: ?page=a&action=DashBoard");
        } else 
        if (isset($_POST["btnSearchDonHang"])) {
            $hoadon = $this->hoadonModel->timBangIdVaGhiChu($_POST["searchDonHang"], 'Chưa duyệt');
        }
        $this->callView("adminMaster", [
            "Page" => "admin/donhang",
            "HoaDon" => $hoadon,
            "SoLuongAll" => $this->hoadonModel->getCountOfGhiChu("Chưa duyệt", '', ''),
            "Title" => "Đơn hàng chưa duyệt",
            "LoaiHoaDon" => "chưa duyệt",
            "Action" => "DashBoard"
        ]);
    }

    function donhangAll()
    {
        $start = "";
        $end = "";
        $hoadon = $this->hoadonModel->getAll("", "");
        $soluongAll = $this->hoadonModel->getCountOfAll("", "");
        $chuaduyet = $this->hoadonModel->getCountOfGhiChu("Chưa duyệt", '', '');
        $daduyet = $this->hoadonModel->getCountOfGhiChu("Đã duyệt", '', '');
        $dahuy = $this->hoadonModel->getCountOfGhiChu("Đã hủy", '', '');
        $doanhthu = json_decode($this->hoadonModel->getLoiNhuan('', ''), true);
        $soluongDaBan = $this->chitiethoadonModel->getCountOfSoLuong('', '');
        if (isset($_POST["btnSearchDay"])) {
            $start = $_POST["dateStart"];
            $end = $_POST["dateEnd"];
            $hoadon = $this->hoadonModel->getAll($start, $end);
            $soluongAll = $this->hoadonModel->getCountOfAll($start, $end);
            $chuaduyet = $this->hoadonModel->getCountOfGhiChu("Chưa duyệt", $start, $end);
            $daduyet = $this->hoadonModel->getCountOfGhiChu("Đã duyệt", $start, $end);
            $dahuy = $this->hoadonModel->getCountOfGhiChu("Đã hủy", $start, $end);
            $doanhthu = json_decode($this->hoadonModel->getLoiNhuan($start, $end), true);
            $soluongDaBan = $this->chitiethoadonModel->getCountOfSoLuong($start, $end);
        }

        $tongdoanhthu = 0;
        $tongloinhuan = 0;
        foreach ($doanhthu as $value) {
            $tongdoanhthu += $value["TONGTHANHTOAN"];
            $tongloinhuan += $value["LOINHUAN"];
        }
        $this->callView("adminMaster", [
            "Page" => "admin/donhang",
            "HoaDon" => $hoadon,
            "TongDoanhThu" => $tongdoanhthu,
            "TongLoiNhuan" => $tongloinhuan,
            "SoLuongAll" => $soluongAll,
            "SoLuongChuaDuyet" => $chuaduyet,
            "SoLuongDaDuyet" => $daduyet,
            "SoLuongDaHuy" => $dahuy,
            "SoLuongDaBan" => $soluongDaBan,
            "Title" => "Tất cả đơn hàng",
            "LoaiHoaDon" => "tất cả",
            "Action" => "getAll",
            "Start" => $start,
            "End" => $end
        ]);
    }

    function donhangDaDuyet()
    {
        $hoadon = $this->hoadonModel->getGhichu("Đã duyệt");
        if (isset($_POST["btnHuy"])) {
            foreach ($_POST["inputCheck"] as $value) {
                if ($this->hoadonModel->huyHoaDon($value)) {
                    $this->hoadonModel->huyHoaDon($value);
                }
            }
        } else if (isset($_POST["btnSearchDonHang"])) {
            $hoadon = $this->hoadonModel->timBangIdVaGhiChu($_POST["searchDonHang"], 'Đã duyệt');
        }
        $this->callView("adminMaster", [
            "Page" => "admin/donhang",
            "HoaDon" => $hoadon,
            "SoLuongAll" => $this->hoadonModel->getCountOfGhiChu("Đã duyệt", '', ''),
            "Title" => "Đơn hàng đã duyệt",
            "LoaiHoaDon" => "đã duyệt",
            "Action" => "donhangDaDuyet"
        ]);
    }

    function donhangDaHuy()
    {
        $hoadon = $this->hoadonModel->getGhichu("Đã hủy");
        if (isset($_POST["btnSearchDonHang"])) {
            $hoadon = $this->hoadonModel->timBangIdVaGhiChu($_POST["searchDonHang"], 'Đã hủy');
        }
        $this->callView("adminMaster", [
            "Page" => "admin/donhang",
            "HoaDon" => $hoadon,
            "SoLuongAll" => $this->hoadonModel->getCountOfGhiChu("Đã hủy", '', ''),
            "Title" => "Đơn hàng đã hủy",
            "LoaiHoaDon" => "đã hủy",
            "Action" => "donhangDaHuy"
        ]);
    }

    function login()
    {
        if (isset($_POST['btnLogin'])) {
            if ($this->taikhoanModel->dangNhap($_POST['username'], $_POST['password'])) {
                $this->taikhoanModel->dangNhap($_POST['username'], $_POST['password']);
                echo "true";
            } else {
                echo "false";
            }
        } else {
            $this->callView("blankPage", [
                "Pages" => ["admin/login"]
            ]);
        }
    }

    function signout()
    {
        unset($_SESSION['role']);
    }

    //////////////////////////////////////////////////// SANPHAM
    function themSanPham()
    {
        if (isset($_POST["submit"])) {
            $tenSP = $_POST["tenSP"];
            $tenSPKD = str_replace(" ", "-", ucwords(trim($_POST["tenSPKD"])));
            $ghichuSP = $_POST["ghichuSP"];
            $loaiSP = $_POST["loaiSP"];
            $motaSP = $_POST["motaSP"];
            $loaiTL = $_POST["loaiTL"];
            $soluongTL = $_POST["soluongTL"];
            $gianhap = $_POST["gianhap"];
            $giaban = $_POST["giaban"];
            $ghichuTL = $_POST["ghichuTL"];
            //
            $hinhSP = "./public/sanpham/";
            $hinhSP = $hinhSP . basename($_FILES["hinhSP"]["name"]);
            $file = $_FILES["hinhSP"]["tmp_name"];

            //add table sanpham
            $this->sanphamModel->addSanPham($loaiSP, $tenSP, $tenSPKD, $_FILES["hinhSP"]["name"], $ghichuSP);
            move_uploaded_file($file, $hinhSP);

            //add table motasanpham
            $sanpham = json_decode($this->sanphamModel->getOne($tenSPKD), true);
            $maSP = $sanpham[0]["MASANPHAM"];
            $this->motaModel->addMoTa($motaSP, $maSP);

            //add table trongluong
            $this->trongluongModel->addTrongLuong($maSP, $loaiTL, $soluongTL, $gianhap, $giaban, $ghichuTL);

            header("Location: ?page=a&action=tatcaSanPham");
        }
        $this->callView("adminMaster", [
            "Page" => "admin/sanpham/addNew",
            "Title" => "Thêm sản phẩm mới",
            "LoaiSP" => $this->loaisanphamModel->getAll()
        ]);
    }

    function editSanPham($id)
    {
        if (isset($id)) {
            $maSP = $id;
            if (isset($_POST["submit"])) {
                $tenSP = $_POST["tenSP"];
                $tenSPKD = str_replace(' ', '-', trim($_POST["tenSPKD"]));
                $hinhSP = $_FILES["hinhSP"]["name"];
                $ghichu = $_POST["ghichuSP"];
                $loaiSP = $_POST["loaiSP"];
                $mota = $_POST["motaSP"];
                // if(empty($hinhSP)){
                //     echo "null--------";
                // }
                //
                $url = "./public/sanpham/";
                $url = $url . basename($_FILES["hinhSP"]["name"]);
                $file = $_FILES["hinhSP"]["tmp_name"];

                $this->sanphamModel->editSanPham($maSP, $loaiSP, $tenSP, $tenSPKD, $hinhSP, $ghichu);
                $this->motaModel->editMoTa($mota, $maSP);

                move_uploaded_file($file, $url);
            }
            $check = $this->sanphamModel->findById($id);
            if (empty($check)) {
                $this->callView("adminMaster", [
                    "Page" => "admin/sanpham/edit",
                    "Title" => "Chỉnh sửa thông tin sản phẩm"
                ]);
            } else {
                $this->callView("adminMaster", [
                    "Page" => "admin/sanpham/edit",
                    "Title" => "Chỉnh sửa thông tin sản phẩm",
                    "SanPham" => $this->sanphamModel->findById($id),
                    "LoaiSP" => $this->loaisanphamModel->getAll(),
                    "MoTaSP" => $this->motaModel->getMoTa($id),
                    "MaSP" => $id
                ]);
            }
        } else {
            $this->callView("adminMaster", [
                "Page" => "admin/sanpham/edit",
                "Title" => "Chỉnh sửa thông tin sản phẩm"
            ]);
        }
    }

    function tatcaSanPham()
    {
        $sanpham = $this->sanphamModel->getSanPhamTheoSoLuong('');
        $hot = $this->sanphamModel->adminGetSanPhamHot('');
        $daban = $this->sanphamModel->adminGetSoLuongDaBan('');
        if (isset($_POST["btnSearch"])) {
            $sanpham = $this->sanphamModel->getSanPhamTheoSoLuong($_POST["tenSP"]);
            $hot = $this->sanphamModel->adminGetSanPhamHot($_POST["tenSP"]);
            $daban = $this->sanphamModel->adminGetSoLuongDaBan($_POST["tenSP"]);
        }
        $this->callView("adminMaster", [
            "Page" => "admin/sanpham/all",
            "Title" => "Danh sách sản phẩm",
            "SanPham" => $sanpham,
            "Hot" => $hot,
            "DaBan" => $daban
        ]);
    }

    function addHot()
    {
        $this->sanphamModel->addSanPhamHot($_POST["id"]);
    }

    function deleteHot()
    {
        $this->sanphamModel->deleteSanPhamHot($_POST["id"]);
    }

    //////////////////////////////////// trongluong
    function allTrongLuong($id)
    {
        if (isset($id)) {
            $this->callView("adminMaster", [
                "Page" => "admin/trongluong/all",
                "Title" => 'Danh sách trọng lượng của "' . json_decode($this->sanphamModel->findById($id), true)[0]["TENSANPHAM"] . '"',
                "TrongLuong" => $this->trongluongModel->getFull($id),
            ]);
        }
        $this->callView("adminMaster", [
            "Page" => "admin/trongluong/all",
            "Title" => 'Danh sách trọng lượng'
        ]);
    }

    function addTrongLuong()
    {
        if (isset($_POST["submit"])) {
            $maSP = $_POST["maSP"];
            $trongluong = $_POST["trongluong"];
            $soluong = $_POST["soluong"];
            $gianhap = $_POST["gianhap"];
            $giaban = $_POST["giaban"];
            $ghichu = $_POST["ghichu"];

            $this->trongluongModel->addTrongLuong($maSP, $trongluong, $soluong, $gianhap, $giaban, $ghichu);

            header("Location: ?page=a&action=allTrongLuong&id=" . $maSP);
        }
        $this->callView("adminMaster", [
            "Page" => "admin/trongluong/add",
            "Title" => "Thêm mới trọng lượng cho sản phẩm",
            "SanPham" => $this->sanphamModel->getAll()
        ]);
    }

    function editTrongLuong()
    {
        if (isset($_POST["btnSave"])) {
            $maTL = $_POST["btnSave"];
            $trongluong = $_POST["trongluong"];
            $soluong = $_POST["soluong"];
            $gianhap = $_POST["gianhap"];
            $giaban = $_POST["giaban"];
            $ghichu = $_POST["ghichu"];

            $trongluongArray = json_decode($this->trongluongModel->getOne($maTL), true);

            $this->trongluongModel->editTrongLuong($maTL, $trongluong, $soluong, $gianhap, $giaban, $ghichu);

            header("Location: ?page=a&action=allTrongLuong&id=" . $trongluongArray[0]["MASANPHAM"]);
        }
    }

    function deleteTrongLuong()
    {
        if (isset($_POST["deleteTrongLuong"])) {
            $this->trongluongModel->deleteTrongLuong($_POST["MATRONGLUONG"]);
        }
    }

    ////////////////////////////////////////// loaisanpham
    function allLoaiSanPham()
    {
        $this->callView("adminMaster", [
            "Page" => "admin/loaisanpham/all",
            "Title" => "Tất cả loại sản phẩm",
            "LoaiSP" => $this->loaisanphamModel->adminGetAll()
        ]);
    }

    function deleteLoaiSanPham()
    {
        if (isset($_POST["btnDelete"])) {
            $this->loaisanphamModel->deleteLoai($_POST["MALOAI"]);
        }
    }

    function addLoaiSanPham()
    {
        if (isset($_POST["btnAdd"])) {
            $this->loaisanphamModel->addLoai($_POST["TENLOAI"]);
        }
    }

    function editLoaiSanPham()
    {
        if (isset($_POST["btnSave"])) {
            $this->loaisanphamModel->editLoai($_POST["btnSave"], $_POST["tenmoi"]);
            header("Location: ?page=a&action=allLoaiSanPham");
        }
    }

    ////////////////////// baiviet
    function allBaiViet()
    {
        $this->callView("adminMaster", [
            "Page" => "admin/baiviet/all",
            "Title" => "Danh sách các bài viết",
            "BaiViet" => $this->baivietModel->getAll(),
        ]);
    }

    function deleteBaiViet()
    {
        if (isset($_POST["btnDelete"])) {
            $this->baivietModel->delete($_POST["MABAIVIET"]);
        }
    }

    function editBaiViet($id)
    {
        if (isset($id)) {
            $maBaiViet = $id;
            if (isset($_POST["submit"])) {
                $ten = $_POST["tenBaiViet"];
                $noidung = $_POST["noidung"];;
                $this->baivietModel->edit($maBaiViet, $ten, $noidung);
            }
            $this->callView("adminMaster", [
                "Page" => "admin/baiviet/edit",
                "Title" => "Chỉnh sửa thông tin bài viết",
                "BaiViet" => $this->baivietModel->findById($maBaiViet)
            ]);
        }
        $this->callView("adminMaster", [
            "Page" => "admin/baiviet/edit",
            "Title" => "Chỉnh sửa thông tin bài viết"
        ]);
    }

    function addBaiViet()
    {
        if (isset($_POST["submit"])) {
            $ten = $_POST["tenbaiviet"];
            $noidung = $_POST["noidung"];

            $this->baivietModel->addNew($ten, $noidung);

            header("Location: ?page=a&action=allBaiViet");
        }
        $this->callView("adminMaster", [
            "Page" => "admin/baiviet/add",
            "Title" => "Thêm bài viết mới"
        ]);
    }

    ///////////////////////////// matkhau
    function doimatkhau()
    {
        if (isset($_POST["submit"])) {
            $hientai = $_POST["hientai"];
            $moi = $_POST["moi"];
            $string = "";
            if ($this->taikhoanModel->doiMatKhau($_SESSION["id"], $hientai, $moi)) {
                $string = "Đổi mật khẩu thành công";
            } else {
                $string = "Đổi mật khẩu thất bại";
            }
            $this->callView("emptyPage", [
                "string" => $string
            ]);
        } else {
            $this->callView("adminMaster", [
                "Page" => "admin/doimatkhau",
                "Title" => "Đổi mật khẩu"
            ]);
        }
    }

    //////////query
    function query()
    {
        if (isset($_POST["query"])) {
            $this->callView("emptyPage", [
                "json" => $this->restModel->query($_POST["query"])
            ]);
        } else {
            $this->callView("adminMaster", [
                "Page" => "admin/query",
                "Title" => "Truy vấn"
            ]);
        }
    }
    ///////////////////// san pham da ban cua <a> trong tat ca hoa don
    function spdb()
    {
        if (isset($_GET["s"]) && isset($_GET["e"])) {
            $this->callView("blankPage", [
                "Pages" => ["admin/spdb"],
                "spdb" => $this->sanphamModel->adminSPDB($_GET["s"], $_GET["e"])
            ]);
        }
    }
}
