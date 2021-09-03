<?php
require_once "./mvc/host.php";
$trongluong = json_decode($data["TrongLuong"], true);
$soluong = json_decode($data["SoLuong"], true);
$sanpham = json_decode($data["SanPham"], true);
$tong = 0;
?>
<style>
    .buy-title {
        font-size: 28px;
    }

    .go-center {
        text-align: center;
    }

    .tong {
        color: red;
    }
</style>
<div class="col card">
    <div class="card-header">
        <p class="buy-title">Thông tin mua hàng</p>
    </div>
    <div class="card-body">
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th style="text-align: center;">STT</th>
                    <th>Tên sản phẩm</th>
                    <th style="text-align: center;">Trọng lượng</th>
                    <th style="text-align: center;">Số lượng</th>
                    <th style="text-align: right;">Giá/sản phẩm</th>
                    <th style="text-align: right;">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($data["BuyNow"])) : ?>
                    <?php for ($i = 0; $i < count($trongluong); $i++) : ?>
                        <tr>
                            <?php $tong += (int)$soluong * (int)$trongluong[$i]["GIABAN"]; ?>
                            <td style="text-align: center;"><?= $i + 1 ?></td>
                            <td><?= $sanpham[$i]["TENSANPHAM"] ?></td>
                            <td style="text-align: center;"><?= $trongluong[$i]["TRONGLUONG"] ?></td>
                            <td style="text-align: center;"><?= $soluong ?></td>
                            <td style="text-align: right;">
                                <?= number_format($trongluong[$i]["GIABAN"], '0', ',', '.') ?>&nbsp;₫
                            </td>
                            <th style="text-align: right;">
                                <?= number_format((int)$soluong * (int)$trongluong[$i]["GIABAN"], '0', ',', '.') ?>&nbsp;₫
                            </th>
                        </tr>
                    <?php endfor; ?>
                <?php else : ?>
                    <?php for ($i = 0; $i < count($trongluong); $i++) : ?>
                        <tr>
                            <?php $tong += $soluong[$i] * $trongluong[$i]["GIABAN"]; ?>
                            <td style="text-align: center;"><?= $i + 1 ?></td>
                            <td><?= $sanpham[$i]["TENSANPHAM"] ?></td>
                            <td style="text-align: center;"><?= $trongluong[$i]["TRONGLUONG"] ?></td>
                            <td style="text-align: center;"><?= $soluong[$i] ?></td>
                            <td style="text-align: right;">
                                <?= number_format($trongluong[$i]["GIABAN"], '0', ',', '.') ?>&nbsp;₫
                            </td>
                            <th style="text-align: right;">
                                <?= number_format($soluong[$i] * $trongluong[$i]["GIABAN"], '0', ',', '.') ?>&nbsp;₫
                            </th>
                        </tr>
                    <?php endfor; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align: left;" colspan="4">Tổng hóa đơn</th>
                    <th style="text-align: right; font-size: 24px;" class="tong" colspan="2">
                        <p><?= number_format($tong, '0', ',', '.') ?>&nbsp;₫</p>
                    </th>
                </tr>
            </tfoot>
        </table>
        <div class="container">
            <div class="row">
                <form action="<?= $host ?>/index.php?page=ThanhToan&action=thanh_toan" method="post">
                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group" style="font-weight: bold;">
                                <label for="order_id">Mã hóa đơn</label>
                                <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>" readonly="" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <h4>Thông tin giao hàng</h4>
                    </div>
                    <input type="hidden" name="amount" value="<?= $tong ?>">
                    <table>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="hoten">Họ tên</label>
                                <input type="text" name="hoten" id="hoten" required class="form-control" value="<?= @$_SESSION["THONGTIN"]["HOTEN"] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="sdt">Số điện thoại</label>
                                <input type="text" name="sdt" id="sdt" required class="form-control" value="<?= @$_SESSION["THONGTIN"]["SDT"] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="diachi">Địa chỉ</label>
                                <textarea name="diachi" id="diachi" cols="30" rows="1" class="form-control"><?= @$_SESSION["THONGTIN"]["DIACHI"] ?></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <p>Phương thức thanh toán:</p>
                                <input type="radio" name="thanhtoan" id="chuyenkhoan" value="chuyenkhoan" checked>
                                <label for="chuyenkhoan">Chuyển khoản ngân hàng</label><br>
                                <!-- <input type="radio" name="thanhtoan" id="momo" value="momo">
                                <label for="momo">Chuyển khoản MOMO</label> -->
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input type="submit" value="Đến trang thanh toán" class="btn btn-primary">
                            </div>
                        </div>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>