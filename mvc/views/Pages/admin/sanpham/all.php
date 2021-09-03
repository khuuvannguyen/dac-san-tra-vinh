<?php
$sanpham = json_decode($data["SanPham"], true);
$hot = json_decode($data["Hot"], true);
$daban = json_decode($data["DaBan"], true);
$countSL = 0;
$i = 1;
?>
<form action="?page=a&action=tatcaSanPham" method="post">
    <div class="row mb-3">
        <div class="col">
            Tìm sản phẩm: <input type="text" name="tenSP" id="tenSP" placeholder="Tên sản phẩm">
            <button type="submit" name="btnSearch" class="btn btn-primary">Tìm</button>
        </div>
    </div>
</form>
<table class="table table-light table-striped">
    <thead class="thead-dark">
        <tr style="text-align: center;">
            <th>STT</th>
            <th>Mã SP</th>
            <th>Tên SP</th>
            <th>Kho</th>
            <th>Đã bán</th>
            <th>Ghi chú</th>
            <th>Thông tin</th>
            <th>Trọng lượng</th>
            <th>HOT</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sanpham as $sp) : ?>
            <tr>
                <td style="text-align: center;"><?= $i ?></td>
                <td style="text-align: center;" id="maSP"><?= $sp["MASANPHAM"] ?></td>
                <td>
                    <a href="?page=SanPham&action=thong_tin&tensanpham=<?= $sp["TENSANPHAMKHONGDAU"] ?>" target="_blank"><?= $sp["TENSANPHAM"] ?></a>
                </td>
                <td style="text-align: center; font-weight: bold;"><?= $sp["SOLUONG"] ?></td>
                <td style="text-align: center;">
                    <?php
                    $ban = false;
                    $sl = 0;
                    ?>
                    <?php
                    foreach ($daban as $dban) {
                        if ($dban["MASANPHAM"] == $sp["MASANPHAM"]) {
                            $ban = true;
                            $sl = $dban["DABAN"];
                        }
                    }
                    ?>
                    <?php if ($ban) : ?>
                        <?= $sl ?>
                    <?php else : ?>
                        0
                    <?php endif; ?>
                </td>
                <td><?= $sp["GHICHU"] ?></td>
                <td style="text-align: center;">
                    <a href="?page=a&action=editSanPham&id=<?= $sp["MASANPHAM"] ?>" class="btn btn-success">Sửa</a>
                </td>
                <td style="text-align: center;">
                    <a href="?page=a&action=allTrongLuong&id=<?= $sp["MASANPHAM"] ?>" class="btn btn-info">Xem</a>
                </td>
                <td style="text-align: center;">
                    <?php $isHot = false; ?>
                    <?php foreach ($hot as $h) : ?>
                        <?php
                        if ($sp["MASANPHAM"] == $h["MASANPHAM"])
                            $isHot = true;
                        ?>
                    <?php endforeach; ?>
                    <?php if (!$isHot) : ?>
                        <a id="addHot" name="<?= $sp["MASANPHAM"] ?>" href="javascript:void(0);" class="btnHot btn btn-primary">Đặt</a>
                    <?php else : ?>
                        <a id="deleteHot" name="<?= $sp["MASANPHAM"] ?>" href="javascript:void(0);" class="btnHot btn btn-danger">Hủy</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
            $i++;
            $countSL += $sp["SOLUONG"];
            ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot class="tfoot-dark">
        <tr>
            <th colspan="2" style="text-align: center;">Tổng</th>
            <th><?= $i - 1 ?> loại sản phẩm</th>
            <th colspan="6"><?= $countSL ?> sản phẩm tồn kho</th>
        </tr>
    </tfoot>
</table>
<script>
    $(".btnHot").click(function() {
        $.ajax({
            type: "post",
            url: "?page=a&action=" + $(this).attr("id"),
            data: {
                id: $(this).attr("name")
            },
            success: function(html) {
                location.reload();
            }
        });
    });
</script>