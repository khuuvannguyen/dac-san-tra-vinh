<?php
require_once "./mvc/host.php";
?>
<hr>
<div class="row pb-4" id="ten-danh-sach">
    <div class="col">Bài Viết Mới</div>
</div>
<style>
    .luotxem {
        color: #000;
        opacity: 0.5;
    }
</style>
<div class="row">
    <!-- bài viết mới -->
    <?php
    if (isset($data["BaiVietMoi"])) :
        $baiviet = json_decode($data["BaiVietMoi"], true);
        for ($i = 0; $i < count($baiviet); $i++) :
    ?>
            <div class="col-10 m-1 ml-5" style="background-color: lightblue;">
                <div class="block-bai-viet">
                    <a href="<?= $host ?>/index.php?page=BaiViet&action=view&name=<?= $baiviet[$i]["TENBAIVIET"] ?>" class="bai-viet">
                        <p class="ten-bai-viet"><?= $baiviet[$i]["TENBAIVIET"] ?></p>
                        <div class="noi-dung"><?= $baiviet[$i]["NOIDUNG"] ?></div>
                        <i class="luotxem" style="margin-left: 2em;">Lượt xem: <?= $baiviet[$i]["LUOTXEM"] ?></i>
                        <i class="xem-them float-right">>>Xem thêm</i>
                    </a>
                </div>
            </div>
    <?php
        endfor;
    endif;
    ?>
</div>
</div>