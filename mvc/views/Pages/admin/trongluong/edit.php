<?php if (!isset($data["TrongLuong"])) : ?>
    <h4>Vui lòng <a href="?page=a&action=allTrongLuong">chọn loại trọng lượng</a> để chỉnh sửa.</h4>
<?php else : ?>
    <?php $trongluong = json_decode($data["TrongLuong"], true); ?>
    <form action="?page=a&action=editTrongLuong&id=<?= $trongluong[0]["MATRONGLUONG"] ?>" method="post">
        <div class="row mt-3">
            <div class="col">
                <label for="trongluong">Trọng lượng</label>
                <input type="text" name="trongluong" id="trongluong" required class="form-control" value="<?= $trongluong[0]["TRONGLUONG"] ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="soluong">Số lượng</label>
                <input type="number" name="soluong" id="soluong" required class="form-control" value="<?= $trongluong[0]["SOLUONG"] ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="gianhap">Giá nhập</label>
                <input type="number" name="gianhap" id="gianhap" required class="form-control" min="0" value="<?= $trongluong[0]["GIANHAP"] ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="giaban">Giá bán</label>
                <input type="number" name="giaban" id="giaban" required class="form-control" min="0" value="<?= $trongluong[0]["GIABAN"] ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="ghichu">Ghi chú</label>
                <input type="text" name="ghichu" id="ghichu" class="form-control" value="<?= $trongluong[0]["GHICHU"] ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" name="submit" class="btn btn-success">Lưu</button>
            </div>
        </div>
    </form>
<?php endif; ?>