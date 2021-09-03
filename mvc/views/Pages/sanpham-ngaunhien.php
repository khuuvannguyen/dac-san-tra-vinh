<?php
require_once "./mvc/host.php";
?>
<div class="row mb-3 mt-3">
    <div class="col-12 card sanpham-ngaunhien pb-3">
        <?php if (isset($data["SanPhamNgauNhien"])) : ?>
            <p class="ngaunhien-title">Sản phẩm ngẫu nhiên</p>
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                    $ngaunhien = json_decode($data["SanPhamNgauNhien"], true);
                    for ($i = 0; $i < count($ngaunhien); $i++) :
                    ?>
                        <div class="card block_ col m-2">
                            <a href="<?= $host ?>/index.php?page=SanPham&action=thong_tin&tensanpham=<?= $ngaunhien[$i]["TENSANPHAMKHONGDAU"] ?>" style="text-decoration: none;">
                                <div class="img_">
                                    <img src="<?= $host ?>/public/sanpham/<?= $ngaunhien[$i]["HINHSANPHAM"] ?>" alt="<?= $ngaunhien[$i]["TENSANPHAM"] ?>" class="imgg_">
                                </div>
                                <div class="name_">
                                    <?= $ngaunhien[$i]["TENSANPHAM"] ?>
                                </div>
                            </a>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php elseif (isset($data["SanPhamXemNhieu"])) : ?>
            <p class="ngaunhien-title">Sản phẩm xem nhiều</p>
            <div class="container">
                <div class="row justify-content-center">
                    <?php
                    $xemnhieu = json_decode($data["SanPhamXemNhieu"], true);
                    for ($i = 0; $i < count($xemnhieu); $i++) :
                    ?>
                        <div class="card block_ col m-2">
                            <a href="<?= $host ?>/index.php?page=SanPham&action=thong_tin&tensanpham=<?= $xemnhieu[$i]["TENSANPHAMKHONGDAU"] ?>" style="text-decoration: none;">
                                <div class="img_">
                                    <img src="<?= $host ?>/public/sanpham/<?= $xemnhieu[$i]["HINHSANPHAM"] ?>" alt="<?= $xemnhieu[$i]["TENSANPHAM"] ?>" class="imgg_">
                                </div>
                                <div class="name_">
                                    <?= $xemnhieu[$i]["TENSANPHAM"] ?>
                                </div>
                            </a>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>