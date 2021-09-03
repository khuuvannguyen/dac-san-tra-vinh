<div>
    <form action="?page=a&action=themSanPham" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        <div class="row mt-3">
            <div class="col">
                <label for="tenSP">Tên sản phẩm</label>
                <input type="text" name="tenSP" id="tenSP" required class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="tenSPKD">Tên sản phẩm không đấu</label>
                <input type="text" name="tenSPKD" id="tenSPKD" required class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="hinhSP">Hình ảnh sản phẩm</label>
                <input type="file" name="hinhSP" id="hinhSP" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="ghichuSP">Ghi chú sản phẩm</label>
                <input type="text" name="ghichuSP" id="ghichuSP" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="loaiSP">Loại sản phẩm</label>
                <select id="loaiSP" class="form-control" name="loaiSP">
                    <?php
                    $loaiSP = json_decode($data["LoaiSP"], true);
                    foreach ($loaiSP as $value) : ?>
                        <option value="<?= $value["MALOAI"] ?>"><?= $value["TENLOAI"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="motaSP">Mô tả sản phẩm</label>
                <textarea name="motaSP" id="motaSP" cols="30" rows="10" class="form-control" required></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="loaiTL">Loại trọng lượng</label>
                <input type="text" name="loaiTL" id="loaiTL" class="form-control" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="soluongTL">Số lượng của loại trọng lượng</label>
                <input type="number" name="soluongTL" id="soluongTL" required min="0" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="gianhap">Giá nhập</label>
                <input type="number" name="gianhap" id="gianhap" required min="0" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="giaban">Giá bán</label>
                <input type="number" name="giaban" id="giaban" required min="0" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="ghichuTL">Ghi chú loại trọng lượng</label>
                <input type="text" name="ghichuTL" id="ghichuTL" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <input type="submit" value="Thêm mới" name="submit" class="btn btn-success">
            </div>
        </div>
    </form>
</div>
<script src="./public/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace("motaSP");
</script>