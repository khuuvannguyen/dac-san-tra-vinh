<?php
require_once "./mvc/host.php";
$sanpham = json_decode($data["SanPham"], true);
?>
<div class="col card" style="margin: 5px;">
    <div class="card-header">
        <p class="ten-loai"><?= $data["Title"] ?></p>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <?php for ($i = 0; $i < count($sanpham); $i++) : ?>
                <div class="block_ card">
                    <a href="<?= $host ?>/SanPham/thong_tin/<?= $sanpham[$i]["TENSANPHAMKHONGDAU"] ?>" style="text-decoration: none;">
                        <div class="img_">
                            <img src="<?= $host ?>/public/sanpham/<?= $sanpham[$i]["HINHSANPHAM"] ?>" alt="<?= $sanpham[$i]["TENSANPHAM"] ?>" class="imgg_">
                        </div>
                        <div class="name_">
                            <?= $sanpham[$i]["TENSANPHAM"] ?>
                        </div>
                    </a>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>