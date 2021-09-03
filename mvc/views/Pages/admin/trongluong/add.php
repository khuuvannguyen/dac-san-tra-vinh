<?php
$sanpham = json_decode($data["SanPham"], true);
?>
<form action="?page=a&action=addTrongLuong" method="post">
    <div class="row mt-3">
        <div class="col">
            <label for="maSP">Thêm cho sản phẩm</label>
            <select id="maSP" class="form-control" name="maSP">
                <?php foreach ($sanpham as $sp) : ?>
                    <option value="<?= $sp["MASANPHAM"] ?>"><?= $sp["TENSANPHAM"] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <label for="trongluong">Trọng lượng</label>
            <input type="text" name="trongluong" id="trongluong" required class="form-control">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <label for="soluong">Số lượng</label>
            <input type="number" name="soluong" id="soluong" required class="form-control">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <label for="gianhap">Giá nhập</label>
            <input type="number" name="gianhap" id="gianhap" required class="form-control" min="0" value="0">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <label for="giaban">Giá bán</label>
            <input type="number" name="giaban" id="giaban" required class="form-control" min="0" value="0">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <label for="ghichu">Ghi chú</label>
            <input type="text" name="ghichu" id="ghichu" class="form-control">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
        </div>
    </div>
</form>