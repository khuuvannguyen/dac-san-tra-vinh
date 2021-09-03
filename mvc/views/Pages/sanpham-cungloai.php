<?php
require_once "./mvc/host.php";
?>
<div class="row mb-3 mt-3">
    <div class="col-12 card sanpham-ngaunhien pb-3">
        <p class="ngaunhien-title">Sản phẩm cùng loại</p>
        <div class="container">
            <div class="row justify-content-center">
                <?php
                if (isset($data["CungLoai"])) :
                    $cungloai = json_decode($data["CungLoai"], true);
                    if (!empty($cungloai)) :
                        for ($i = 0; $i < count($cungloai); $i++) :
                ?>
                            <div class="block_ card m-2">
                                <a href="<?= $host ?>/index.php?page=SanPham&action=thong_tin&tensanpham=<?= $cungloai[$i]["TENSANPHAMKHONGDAU"] ?>" style="text-decoration: none;">
                                    <div class="img_">
                                        <img src="<?= $host ?>/public/sanpham/<?= $cungloai[$i]["HINHSANPHAM"] ?>" alt="<?= $cungloai[$i]["TENSANPHAM"] ?>" class="imgg_">
                                    </div>
                                    <div class="name_">
                                        <?= $cungloai[$i]["TENSANPHAM"] ?>
                                    </div>
                                </a>
                            </div>
                <?php
                        endfor;
                    else :
                        echo "<h4>Không có sản phẩm nào</h4>";
                    endif;
                endif;
                ?>
            </div>
        </div>
    </div>
</div>