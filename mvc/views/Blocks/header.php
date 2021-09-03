<?php
require_once "./mvc/host.php";
?>

<div class="row up-top">
    <!-- logo | search bar | working time | phone | cart | login -->
    <div id="logo" class="col-md-2">
        <a href="<?php echo $host; ?>">
            <img src="<?= $host ?>/public/images/dacsantravinh.png" alt="" srcset="" id="logo_">
        </a>
    </div>
    <div id="search" class="col-md-3">
        <form action="<?= $host ?>/index.php" method="get" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm.." id="search-bar" name="tim-kiem">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" value="Search" id="btnSearch" onclick="return checkSearch();">
                        <span class="fa fa-search" id="search-icon"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <div id="working-time">
                    <p class="up-top-font border-right"><i class="fa fa-clock-o"></i>&nbsp;8:00&nbsp;-&nbsp;19:00
                    </p>
                </div>
            </div>
            <div class="col">
                <div id="phone">
                    <p class="up-top-font border-right"><span class="fa fa-phone"></span>&nbsp;0938xxxxxx
                    </p>
                </div>
            </div>
            <div class="col">
                <div id="cart">
                    <a href="<?= $host ?>/index.php?page=GioHang&action=DashBoard" class="up-top-font" style="text-decoration: none;">
                        <p class="border-right"><span class="fa fa-shopping-cart"></span>&nbsp;Giỏ hàng</p>
                    </a>
                </div>
            </div>
            <div class="col">
                <div id="cart">
                    <a href="<?= $host ?>/index.php?page=HoaDon&action=DashBoard" class="up-top-font" style="text-decoration: none;">
                        <p class="border-right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z" />
                                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                            </svg>
                            &nbsp;Đơn hàng
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="border: 1px solid black;">
<div class="row mb-2">
    <div class="container">
        <nav class="navbar navbar-expand navbar-light bg-transparent nav-bar pb-0 pt-3" style="width: 100%;">
            <ul class="navbar-nav">
                <li class="nav-item pl-4">
                    <a class="nav-link" href="<?php echo $host; ?>">
                        <p class="up-top-font">Trang Chủ</p>
                    </a>
                </li>
                <?php
                if (isset($data["LoaiSP"])) :
                    $loaiSP = json_decode($data["LoaiSP"], true);
                    for ($i = 0; $i < count($loaiSP); $i++) :
                ?>
                        <li class="nav-item pl-4">
                            <a class="nav-link" href="<?= $_SERVER["PHP_SELF"] ?>?page=SanPham&action=Loai&tenloai=<?= $loaiSP[$i]["TENLOAI"] ?>">
                                <p class="up-top-font"><?= $loaiSP[$i]["TENLOAI"] ?></p>
                            </a>
                        </li>
                <?php
                    endfor;
                endif
                ?>
            </ul>
        </nav>
    </div>
</div>
