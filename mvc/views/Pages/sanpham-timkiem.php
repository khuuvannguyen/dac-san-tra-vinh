<?php
require_once "./mvc/host.php";
$searchKey = $data["SearchKey"];
$sanpham = json_decode($data["SanPham"], true);
$soluong = json_decode($data["SoLuong"], true);
?>
<div class="col card" style="margin: 5px;">
    <?php
    if (empty(json_decode($data["SanPham"], true))) :
    ?>
        <div class="card-header">
            <p class="ten-loai"><?= "Không tìm thấy kết quả nào cho: &quot;$searchKey&quot;" ?></p>
        </div>
    <?php
    else :
    ?>
        <div class="card-header">
            <p class="ten-loai"><?php echo "Tìm thấy " . $soluong[0]["SOLUONG"] . " kết quả cho: &quot;$searchKey&quot;" ?></p>
        </div>
        <div class="card-body">
            <div class="row mb-3">
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
                <?php endfor; ?>
            </div>
        </div>
    <?php
    endif;
    ?>
</div>