<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</head>

<body>
    <?php
    $hoadon = json_decode($data["HoaDon"], true);
    $chitiet = json_decode($data["ChiTiet"], true);
    $bangchu = json_decode($data["BangChu"], true);
    $sanpham = json_decode($data["SanPham"], true);
    $trongluong = json_decode($data["TrongLuong"], true);
    ?>
    <style>
        table {
            height: 100%;
            width: 100%;
            background-color: rgba(255, 0, 0, 0.178);
            color: blue;
        }
    </style>
    <table border="1" align="center" id="pdf">
        <tr>
            <td colspan="7" width="1000">
                <div>
                    <div>
                        <b>Đặc Sản Trà Vinh</b>
                    </div>
                    <div>
                        <b>Địa chỉ: Châu Thành, Trà Vinh.</b>
                    </div>
                    <div>
                        <b>Hotline: 0938xxxxxx</b>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="7">
                <h2 style="text-align: center;">HÓA ĐƠN BÁN HÀNG</h2>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Khách hàng:
            </td>
            <td colspan="3">
                <?= $hoadon[0]["TENKHACHHANG"] ?>
            </td>
            <td>
                Số điện thoại:
            </td>
            <td>
                <?= $hoadon[0]["SODIENTHOAI"] ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                Địa chỉ:
            </td>
            <td colspan="5">
                <?= $hoadon[0]["DIACHI"] ?>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <b>Mã đơn hàng: <?= $hoadon[0]["MAHOADON"] ?></b>
            <td colspan="3">
                Ngày mua: <?= $hoadon[0]["NGAYMUA"] ?>
            </td>
        </tr>
        <tr>
            <td colspan="7">
                <pre></pre>
            </td>
        </tr>
        <tr>
            <th width="40">STT</th>
            <th width="100">Mã sản phẩm</th>
            <th width="300">Tên sản phẩm</th>
            <th>Trọng lượng</th>
            <th width="70">Số lượng</th>
            <th width="205">Đơn giá</th>
            <th width="205">Thành tiền</th>
        </tr>
        <tr>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7 = 5 x 6</th>
        </tr>
        <?php for ($i = 0; $i < count($chitiet); $i++) : ?>
            <tr style="text-align: center;">
                <td><?= $i + 1 ?></td>
                <td><?= $sanpham[$i]["MASANPHAM"] ?></td>
                <td><?= $sanpham[$i]["TENSANPHAM"] ?></td>
                <td><?= $trongluong[$i]["TRONGLUONG"] ?></td>
                <td><?= $chitiet[$i]["SOLUONG"] ?></td>
                <td><?= number_format($chitiet[$i]["DONGIA"], '0', ',', '.') ?></td>
                <td><?= number_format($chitiet[$i]["TONGDONGIA"], '0', ',', '.') ?></td>
            </tr>
        <?php endfor; ?>
        <tr>
            <td colspan="6">
                <b>Tổng thanh toán:</b>
            </td>
            <td style="text-align: center">
                <b><?= number_format($hoadon[0]["TONGTHANHTOAN"], '0', ',', '.') ?></b>
            </td>
        </tr>
        <tr height="50">
            <td colspan="7" valign="top">
                <b>Bằng chữ: <?= $bangchu ?> đồng.
                </b>
            </td>
        </tr>
    </table>
    <div style="text-align: center; margin-top: 30px;">
        <button onclick="savePDF();">Tải hóa đơn</button>
    </div>
    <style>
        table,
        tr,
        td {
            border: 1px solid black;
            padding: 5px;
            border-collapse: collapse;
        }
    </style>
    <script>
        function savePDF() {
            const invoice = this.document.getElementById("pdf");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 0.1,
                filename: "hoa don ban hang: <?= $hoadon[0]["MAHOADON"] ?>" + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            html2pdf().from(invoice).set(opt).save();
        }
    </script>
</body>

</html>
