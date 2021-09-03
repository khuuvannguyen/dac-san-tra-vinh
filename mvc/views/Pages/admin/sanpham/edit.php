<?php
if (!isset($data["SanPham"])) : ?>
    <h4>Vui lòng <a href="?page=a&action=tatcaSanPham">chọn sản phẩm</a> để chỉnh sửa thông tin.</h4>
<?php else : ?>
    <?php $sanpham = json_decode($data["SanPham"], true); ?>
    <div>
        <form action="?page=a&action=editSanPham&id=<?= $data["MaSP"] ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
            <div class="row mt-3">
                <div class="col">
                    <label for="tenSP">Tên sản phẩm</label>
                    <input type="text" name="tenSP" id="tenSP" required class="form-control" value="<?= $sanpham[0]["TENSANPHAM"] ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="tenSPKD">Tên sản phẩm không đấu</label>
                    <input type="text" name="tenSPKD" id="tenSPKD" required class="form-control" value="<?= str_replace('-', ' ', $sanpham[0]["TENSANPHAMKHONGDAU"]) ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="hinhHienTai">Hình ảnh sản phẩm hiện tại</label><br>
                    <img src="./public/sanpham/<?= $sanpham[0]["HINHSANPHAM"] ?>" alt="" id="hinhHienTai" width="300px" height="250px">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="hinhSP">Hình ảnh sản phẩm mới</label>
                    <input type="file" name="hinhSP" id="hinhSP">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="ghichuSP">Ghi chú sản phẩm</label>
                    <input type="text" name="ghichuSP" id="ghichuSP" class="form-control" value="<?= $sanpham[0]["GHICHU"] ?>">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="loaiSP">Loại sản phẩm</label>
                    <select id="loaiSP" class="form-control" name="loaiSP">
                        <?php
                        $loaiSP = json_decode($data["LoaiSP"], true);
                        foreach ($loaiSP as $value) : ?>
                            <option value="<?= $value["MALOAI"] ?>" <?php if ($sanpham[0]["MALOAI"] == $value["MALOAI"]) echo "selected"; ?>><?= $value["TENLOAI"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="motaSP">Mô tả sản phẩm</label>
                    <?php
                    $temp = json_decode($data["MoTaSP"], true);
                    $mota = "";
                    if (!empty($temp)) {
                        $mota = $temp[0]["MOTA"];
                    }
                    ?>
                    <textarea name="motaSP" id="motaSP" cols="30" rows="10" class="form-control" required><?= $mota ?></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <input type="submit" value="Lưu" name="submit" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>
<script src="./public/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace("motaSP");
</script>