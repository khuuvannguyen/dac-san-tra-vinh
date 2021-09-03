<?php
require_once "./mvc/host.php";
?>
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Tạo mới đơn hàng</title>
<!-- Bootstrap core CSS -->
<!-- <link href="/public/assets/bootstrap.min.css" rel="stylesheet" /> -->
<!-- Custom styles for this template -->
<!-- <link href="/public/assets/jumbotron-narrow.css" rel="stylesheet"> -->
<!-- <script src="/public/assets/jquery-1.11.3.min.js"></script> -->
<div class="col card">
    <h3>Tạo mới đơn hàng</h3>
    <div>
        <form action="<?= $host ?>/index.php?page=ThanhToan&action=thanh_toan" id="create_form" method="post">
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="language">Loại hàng hóa </label>
                        <select name="order_type" id="order_type" class="form-control">
                            <option value="billpayment" selected>Thanh toán hóa đơn</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="order_id">Mã hóa đơn</label>
                        <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" readonly="" />
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="amount">Số tiền</label>
                        <input class="form-control" id="amount" name="amount" type="number" value="<?php echo $_POST["gia"]; ?>" readOnly="" />
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="order_desc">Nội dung thanh toán</label>
                        <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="5" readonly="">Thanh toán hóa đơn: <?php echo date("YmdHis") ?>.
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="form-group">
                        <label for="language">Ngôn ngữ</label>
                        <select name="language" id="language" class="form-control">
                            <option value="vn">Tiếng Việt</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-3 mb-3">
                <div class="col">
                    <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán</button>
                </div>
            </div>

        </form>
    </div>
</div>
<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet" />
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>