<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông kê sản phẩm từ ngày: <?= $_GET["s"] ?> đến: <?= $_GET["e"] ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
</head>

<body>
    <?php
    if (isset($data["spdb"])) :
        $sp = json_decode($data["spdb"], true);
        if (!empty($sp)) :
            $i = 1;
            $tong = 0;
    ?>
            <style>
                table {
                    width: 100%;
                    background-color: rgba(255, 0, 0, 0.178);
                    color: blue;
                }

                table,
                tr,
                td {
                    border: 1px solid black;
                    padding: 5px;
                    border-collapse: collapse;
                }
            </style>
            <table border="1" style="border-collapse: collapse; border: 1px solid black;" align="center" id="pdf">
                <tr>
                    <th style="text-align: left;" colspan="6">
                        <div>Đặc sản Trà Vinh</div>
                        <div>Địa chỉ: Châu Thành, Trà Vinh</div>
                        <div>Hotline: 0938xxxxxx</div>
                    </th>
                </tr>
                <tr>
                    <td colspan="6">
                        <h2 style="text-align: center;">THỐNG KÊ DOANH THU</h2>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: right;">Từ ngày:</th>
                    <th colspan="2" style="text-align: left;"><?= $_GET["s"] ?></th>
                    <th style="text-align: right;">Đến ngày:</th>
                    <th style="text-align: left;"><?= $_GET["e"] ?></th>
                </tr>
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
                    <?php
                    $i++;
                    $tong += $value["TONGDONGIA"];
                    ?>
                <?php endforeach; ?>
                <tr>
                    <th colspan="5" style="text-align: left;">Tổng doanh thu:</th>
                    <th style="text-align: right;"><?= number_format($tong, '0', ',', '.') ?></th>
                </tr>
                <tr>
                    <th colspan="6" style="text-align: left;">Bằng chữ: <?php echo convert_number_to_words($tong) ?> đồng.</th>
                </tr>
            </table>
            <div style="text-align: center; margin-top: 30px;">
                <button onclick="savePDF();">Tải bảng thống kê</button>
            </div>
        <?php else : ?>
            <h4>Không tìm thấy sản phẩm nào</h4>
        <?php endif; ?>
    <?php endif; ?>
    <script>
        function savePDF() {
            const invoice = this.document.getElementById("pdf");
            console.log(invoice);
            console.log(window);
            var opt = {
                margin: 0.1,
                filename: "thong ke <?= $_GET['s'] ?> - <?= $_GET['e'] ?>" + '.pdf',
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
    <?php
    function convert_number_to_words($number)
    {
        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'không',
            1                   => 'một',
            2                   => 'hai',
            3                   => 'ba',
            4                   => 'bốn',
            5                   => 'năm',
            6                   => 'sáu',
            7                   => 'bảy',
            8                   => 'tám',
            9                   => 'chín',
            10                  => 'mười',
            11                  => 'mười một',
            12                  => 'mười hai',
            13                  => 'mười ba',
            14                  => 'mười bốn',
            15                  => 'mười năm',
            16                  => 'mười sáu',
            17                  => 'mười bảy',
            18                  => 'mười tám',
            19                  => 'mười chín',
            20                  => 'hai mươi',
            30                  => 'ba mươi',
            40                  => 'bốn mươi',
            50                  => 'năm mươi',
            60                  => 'sáu mươi',
            70                  => 'bảy mươi',
            80                  => 'tám mươi',
            90                  => 'chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );
        if (!is_numeric($number)) {
            return false;
        }
        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }
        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }
        $string = $fraction = null;
        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }
        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convert_number_to_words($remainder);
                }
                break;
        }
        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }
        return $string;
    }
    ?>
</body>
