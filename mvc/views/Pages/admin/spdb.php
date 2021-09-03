<?php
if (isset($data["spdb"])) :
    $sp = json_decode($data["spdb"], true);
    if (!empty($sp)) :
        $i = 1;
?>
        <table border="1" style="border-collapse: collapse; border: 1px solid black;" align="center">
            <tr style="text-align: center;">
                <th>STT</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng đã bán</th>
                <th>Đơn giá/sản phẩm</th>
                <th>Tổng doanh thu của sản phẩm</th>
            </tr>
            <?php foreach ($sp as $value) : ?>
                <tr>
                    <td style="text-align: center;"><?= $i ?></td>
                    <td style="text-align: center;"><?= $value["MASANPHAM"] ?></td>
                    <td><?= $value["TENSANPHAM"] ?></td>
                    <td style="text-align: center;"><?= $value["SOLUONG"] ?></td>
                    <td style="text-align: right;"><?= number_format($value["DONGIA"], '0', ',', '.') ?></td>
                    <td style="text-align: right;"><?= number_format($value["TONGDONGIA"], '0', ',', '.') ?></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <h4>Không tìm thấy sản phẩm nào</h4>
    <?php endif; ?>
<?php endif; ?>