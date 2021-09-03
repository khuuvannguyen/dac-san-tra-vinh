<?php
require_once "./mvc/host.php";
?>
<div class="col card" style="margin: 5px;">
    <?php
    if (isset($data["SanPham"])) :
        $loai = json_decode($data["Loai"], true);
        $sanpham = json_decode($data["SanPham"], true);
    ?>
        <div class="card-header">
            <p class="ten-loai"><?= $loai[0]["TENLOAI"] ?></p>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <?php if (!empty($sanpham)) : ?>
                    <?php for ($i = 0; $i < count($sanpham); $i++) : ?>
                        <div class="block_ card">
                            <a href="<?= $host ?>/index.php?page=SanPham&action=thong_tin&tensanpham=<?= $sanpham[$i]["TENSANPHAMKHONGDAU"] ?>" style="text-decoration: none;">
                                <div class="img_">
                                    <img src="<?= $host ?>/public/sanpham/<?= $sanpham[$i]["HINHSANPHAM"] ?>" alt="<?= $sanpham[$i]["TENSANPHAM"] ?>" class="imgg_">
                                </div>
                                <div class="name_">
                                    <?= $sanpham[$i]["TENSANPHAM"] ?>
                                </div>
                            </a>
                        </div>
                <?php
                    endfor;
                else :
                    echo "<h4>Không có sản phẩm nào</h4>";
                endif;
                ?>
            </div>
        </div>
    <?php
    endif;
    ?>
</div>