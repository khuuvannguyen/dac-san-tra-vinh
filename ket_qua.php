<!-- Bootstrap core CSS -->
<link href="/vnpay_php/assets/bootstrap.min.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="/vnpay_php/assets/jumbotron-narrow.css" rel="stylesheet">
<script src="/vnpay_php/assets/jquery-1.11.3.min.js"></script>
<?php
session_start();
if (isset($_GET["vnp_SecureHash"])) :
    $vnp_SecureHash = $_GET['vnp_SecureHash'];
    require_once("./mvc/core/VNPAY_config.php");
    require_once "./mvc/host.php";
    $inputData = array();
    foreach ($_GET as $key => $value) {
        if (substr($key, 0, 4) == "vnp_") {
            $inputData[$key] = $value;
        }
    }
    unset($inputData['vnp_SecureHashType']);
    unset($inputData['vnp_SecureHash']);
    ksort($inputData);
    $i = 0;
    $hashData = "";
    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashData = $hashData . '&' . $key . "=" . $value;
        } else {
            $hashData = $hashData . $key . "=" . $value;
            $i = 1;
        }
    }

    //$secureHash = md5($vnp_HashSecret . $hashData);
    $secureHash = hash('sha256', $vnp_HashSecret . $hashData);
?>
    <!--Begin display -->
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>
                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">
                <label>Số tiền:</label>
                <label><?php echo $_GET['vnp_Amount'] ?></label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label><?php echo $_GET['vnp_PayDate'] ?></label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                    <?php
                    if ($secureHash == $vnp_SecureHash) {
                        if ($_GET['vnp_ResponseCode'] == '00') {
                            echo "GD Thanh cong";

                            $con = mysqli_connect("localhost", "root", "", "dacsan_travinh");
                            mysqli_query($con, "SET NAMES 'utf8'");

                            //tao hoa don
                            $maHD = $_GET['vnp_TxnRef'];
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $ngaymua = date('Y-m-d H:i:s');

                            $tenKH = $_SESSION["THONGTIN"]["HOTEN"];
                            $sdt = $_SESSION["THONGTIN"]["SDT"];
                            $diachi = $_SESSION["THONGTIN"]["DIACHI"];

                            $qr = "INSERT INTO HOADON VALUES ('$maHD','$tenKH','$sdt','$diachi','$ngaymua','0','Chưa duyệt')";
                            mysqli_query($con, $qr);

                            $qr = "SELECT COUNT(*) AS MAX FROM TRONGLUONG";
                            $result = mysqli_query($con, $qr);
                            $row = mysqli_fetch_array($result);

                            //them chi tiet hoa don
                            $tongHoaDon = 0;
                            foreach ($_SESSION["MUANGAY"] as $value) {
                                $maTL = $value["MATRONGLUONG"];
                                $soluong = $value["SOLUONG"];
                                $gia = $value["GIABAN"];
                                $tongChitiet = $soluong * $gia;
                                $tongHoaDon += $tongChitiet;
                                $qr = "INSERT INTO CHITIETHOADON VALUES ('$maHD','$maTL','$soluong','$gia','$tongChitiet')";
                                mysqli_query($con, $qr);

                                //update daban trong table trongluong
                                $qr = "SELECT * FROM TRONGLUONG WHERE MATRONGLUONG = '$maTL'";
                                $result = mysqli_query($con, $qr);
                                $row = mysqli_fetch_array($result);
                                $daban = $soluong + $row["DABAN"];
                                $qr = "UPDATE TRONGLUONG SET DABAN = '$daban' WHERE MATRONGLUONG = '$maTL'";
                                mysqli_query($con, $qr);;

                                //tru san pham xuong trong table trongluong
                                $qr = "SELECT * FROM TRONGLUONG WHERE MATRONGLUONG = '$maTL'";
                                $result = mysqli_query($con, $qr);
                                $row = mysqli_fetch_array($result);
                                $soluongSP = $row["SOLUONG"];
                                $qr = "UPDATE TRONGLUONG SET SOLUONG='" . $row["SOLUONG"] - $soluong . "' WHERE MATRONGLUONG = '$maTL'";
                                mysqli_query($con, $qr);

                                //bo san pham da mua khoi gia hang
                                unset($_SESSION["GIOHANG"][$maTL]);
                            }

                            $qr = "UPDATE HOADON SET TONGTHANHTOAN = '$tongHoaDon' WHERE MAHOADON = '$maHD'";
                            mysqli_query($con, $qr);

                            $_SESSION["HOADON"][$maHD] = array(
                                "MAHOADON" => $maHD,
                                "NGAYMUA" => $ngaymua,
                                "TONGTHANHTOAN" => $tongHoaDon
                            );
                        } else {
                            echo "GD Khong thanh cong";
                        }
                    } else {
                        echo "Chu ky khong hop le";
                    }
                    ?>
                </label>
            </div>
        </div>
        <?php if ($_GET['vnp_ResponseCode'] == '00') : ?>
            <a href="<?= $host ?>/index.php?page=HoaDon&action=detail&id=<?= $maHD ?>" target="_blank">Xem hóa đơn</a>
            <br>
            <br>
        <?php endif; ?>
        <a href="<?= $host ?>/index.php?page=Home&action=DashBoard">Quay về trang chủ</a>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY 2015</p>
        </footer>
    </div>
<?php endif; ?>