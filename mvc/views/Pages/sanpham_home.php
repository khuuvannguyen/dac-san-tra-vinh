<?php
require_once "./mvc/host.php";
?>
<style>
    span#ten-san-pham {
        color: #000;
        font-weight: bold;
    }
</style>
<div class="row mt-xl-5">
    <div id="san-pham" class="col pl-3">
        <span id="ten-danh-sach">sản phẩm nổi bật</span>
        <ul id="danh-sach">
            <?php
            if (isset($data["SanPhamHot"])) :
                $hot = json_decode($data["SanPhamHot"], true);
                for ($i = 0; $i < count($hot); $i++) :
            ?>
                    <li>
                        <a href="<?= $host ?>/index.php?page=SanPham&action=thong_tin&tensanpham=<?= $hot[$i]["TENSANPHAMKHONGDAU"] ?>">
                            <img src="<?= $host ?>/public/sanpham/<?= $hot[$i]["HINHSANPHAM"] ?>" alt="<?= $hot[$i]["TENSANPHAM"] ?> id=" img-san-pham">
                            <span id="ten-san-pham"><?= $hot[$i]["TENSANPHAM"] ?></span>
                        </a>
                        <span id="gia-tien">
                            <?= $hot[$i]["GIABAN"] ?>
                            <span>₫</span>
                        </span>
                    </li>
            <?php
                endfor;
            endif;
            ?>
        </ul>
    </div>
    <!--/////////////////////////////////////////////////-->
    <div id="san-pham" class="col pl-3">
        <span id="ten-danh-sach">sản phẩm mới</span>
        <a href="<?= $host ?>/index.php?page=SanPham&action=san_pham_moi" class="san-pham-xem-them"><i class="float-right">Xem thêm</i></a>
        <ul id="danh-sach">
            <?php
            if (isset($data["SanPhamMoi"])) :
                $SanPhamMoi = json_decode($data["SanPhamMoi"], true);
                for ($i = 0; $i < count($SanPhamMoi); $i++) :
            ?>
                    <li>
                        <a href="<?= $host ?>/index.php?page=SanPham&action=thong_tin&tensanpham=<?= $SanPhamMoi[$i]["TENSANPHAMKHONGDAU"] ?>">
                            <img src="<?= $host ?>/public/sanpham/<?= $SanPhamMoi[$i]["HINHSANPHAM"]; ?>" alt="<?= $SanPhamMoi[$i]["TENSANPHAM"] ?>" id="img-san-pham">
                            <span id="ten-san-pham"><?= $SanPhamMoi[$i]["TENSANPHAM"] ?></span>
                        </a>
                        <span id="gia-tien">
                            <?= $SanPhamMoi[$i]["GIABAN"] ?>
                            <span>₫</span>
                        </span>
                    </li>
            <?php
                endfor;
            endif;
            ?>
        </ul>
    </div>
    <div id="san-pham" class="col pl-3">
        <span id="ten-danh-sach">sản phẩm bán chạy</span>
        <a href="<?= $host ?>/index.php?page=SanPham&action=san_pham_ban_chay" class="san-pham-xem-them"><i class="float-right">Xem thêm</i></a>
        <ul id="danh-sach">
            <?php
            if (isset($data["SanPhamBanChay"])) :
                $banchay = json_decode($data["SanPhamBanChay"], true);
                for ($i = 0; $i < count($banchay); $i++) :
            ?>
                    <li>
                        <a href="<?= $host ?>/index.php?page=SanPham&action=thong_tin&tensanpham=<?= $banchay[$i]["TENSANPHAMKHONGDAU"] ?>">
                            <img src="<?= $host ?>/public/sanpham/<?= $banchay[$i]["HINHSANPHAM"] ?>" alt="<?= $banchay[$i]["TENSANPHAM"] ?>" id="img-san-pham">
                            <span id="ten-san-pham"><?= $banchay[$i]["TENSANPHAM"] ?></span>
                        </a>
                        <span id="gia-tien">
                            <?= $banchay[$i]["GIABAN"] ?>
                            <span>₫</span>
                        </span>
                    </li>
            <?php
                endfor;
            endif;
            ?>
        </ul>
    </div>
</div>