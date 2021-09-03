<?php
$baiviet = json_decode($data["BaiViet"], true);
$i = 1;
?>
<table class="table table-light table-striped">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: center;">STT</th>
            <th>Tên bài viết</th>
            <th style="text-align: center;">Lượt xem</th>
            <th style="text-align: center;">Chỉnh sửa</th>
            <th style="text-align: center;">Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($baiviet as $bai) : ?>
            <tr>
                <td style="text-align: center;"><?= $i ?></td>
                <td>
                    <a href="?page=BaiViet&action=view&name=<?= $bai["TENBAIVIET"] ?>" target="_blank"><?= $bai["TENBAIVIET"] ?></a>
                </td>
                <td style="text-align: center;"><?= $bai["LUOTXEM"] ?></td>
                <td style="text-align: center;">
                    <a href="?page=a&action=editBaiViet&id=<?= $bai["MABAIVIET"] ?>" class="btn btn-success">Sửa</a>
                </td>
                <td style="text-align: center;">
                    <button id="<?= $bai["MABAIVIET"] ?>" name="btnDelete" class="btnDelete btn btn-danger">Xóa</button>
                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Tổng cộng: <?= $i - 1 ?> bài viết.</th>
        </tr>
    </tfoot>
</table>
<script>
    $(".btnDelete").click(function() {
        if (confirm("Bạn có chắc muốn xóa?")) {
            $.ajax({
                type: "post",
                url: "?page=a&action=deleteBaiViet",
                data: {
                    btnDelete: $(this).attr("name"),
                    MABAIVIET: $(this).attr("id")
                },
                success: function(html) {
                    location.reload();
                }
            });
        }
    });
</script>