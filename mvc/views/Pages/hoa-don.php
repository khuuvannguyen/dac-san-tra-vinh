<?php
require_once "./mvc/host.php";
$hoadon = json_decode($data["HOADON"], true);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
    .hoadon {
        margin-right: .5em;
    }

    .hoadon-title {
        font-size: 24px;
    }

    .search-title .search-box {
        margin-top: 100px;
    }
</style>
<div class="col card">
    <div class="card-header">
        <p class="hoadon-title">Các đơn hàng của bạn</p>
    </div>
    <div>
        <form action="?page=HoaDon&action=DashBoard" method="post">
            <div class="row mt-4">
                <div class="col">
                    <span class="search-title">Tìm đơn hàng: </span>
                    <input type="text" name="searchValue" id="searchValue" class="search-box">
                    <button type="submit" name="btnSearchHoaDon" class="btn btn-success" onclick="return check();">Tìm</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="radio" name="searchType" id="findById" value="findById" checked onclick="radiocheck();">
                    <label for="findById">Mã hóa đơn</label>
                    <input type="radio" name="searchType" id="findByPhone" value="findByPhone" onclick="radiocheck();">
                    <label for="findByPhone">Số điện thoại</label>
                </div>
            </div>
        </form>
    </div>
    <script>
        var action = document.getElementById("findById").id;
        console.log(action);

        function check() {
            var id = document.getElementById("searchValue").value;
            if (id === "" || id === " ") {
                alert("Không có gì để tìm");
                return false;
            }
        }
    </script>
    <div class="card-body">
        <?php if (!empty($hoadon)) : ?>
            <table class="table table-light">
                <thead class="thead-light">
                    <tr style="text-align: center;">
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày mua</th>
                        <th>Thanh toán</th>
                        <th>Tỉnh trạng</th>
                        <th>Xem đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($hoadon as $value) : ?>
                        <tr style="text-align: center;" class="<?php if ($value["GHICHU"] == "Đã hủy")
                                                                    echo "table-danger";
                                                                else if ($value["GHICHU"] == "Đã duyệt")
                                                                    echo "table-success"; ?>">
                            <td><?= $i ?></td>
                            <td><?= $value["MAHOADON"] ?></td>
                            <td><?= $value["NGAYMUA"] ?></td>
                            <td><?= number_format($value["TONGTHANHTOAN"], '0', ',', '.') ?>&nbsp;₫</td>
                            <td>
                                <?php if ($value["GHICHU"] == "Chưa duyệt") : ?>
                                    &#x2754;
                                <?php elseif ($value["GHICHU"] == "Đã duyệt") : ?>
                                    ✔
                                <?php else : ?>
                                    &#x274C;
                                <?php endif; ?>
                                <?= $value["GHICHU"] ?>
                            </td>
                            <td>
                                <a href="<?= $host ?>/index.php?page=HoaDon&action=detail&id=<?= $value["MAHOADON"] ?>" class="btn btn-info" target="_blank">Xem</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <h4>Bạn không có đơn hàng nào</h4>
        <?php endif; ?>
    </div>
</div>