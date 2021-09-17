<script src="./public/admin/js/left-menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
$url = "?page=a&action=";
?>
<ul class="list-group">
    <li class="list-group-item active-orange">Đơn hàng</li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>donhangAll" class="list-item-tag">Tất cả đơn hàng</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>DashBoard" class="list-item-tag">Đơn hàng chưa duyệt</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>donhangDaDuyet" class="list-item-tag">Đơn hàng đã duyệt</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>donhangDaHuy" class="list-item-tag">Đơn hàng đã hủy</a>
    </li>
</ul>
<ul class="list-group mt-3">
    <li class="list-group-item active-orange">Sản phẩm</li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>tatcaSanPham" class="list-item-tag">Tất cả sản phẩm</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>themSanPham" class="list-item-tag">Thêm sản phẩm mới</a>
    </li>
</ul>
<ul class="list-group mt-3">
    <li class="list-group-item active-orange">Trọng lượng</li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>allTrongLuong" class="list-item-tag">Tất cả trọng lượng</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>addTrongLuong" class="list-item-tag">Thêm trọng lượng</a>
    </li>
</ul>
<ul class="list-group mt-3">
    <li class="list-group-item active-orange">Loại sản phẩm</li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>allLoaiSanPham" class="list-item-tag">Danh sách loại sản phẩm</a>
    </li>
</ul>
<ul class="list-group mt-3">
    <li class="list-group-item active-orange">Bài viết</li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>allBaiViet" class="list-item-tag">Tất cả bài viết</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>addBaiviet" class="list-item-tag">Thêm bài viết mới</a>
    </li>

</ul>
<ul class="list-group mt-3">
    <li class="list-group-item active-orange">Nâng cao</li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>doimatkhau" class="list-item-tag">Đổi mật khẩu</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="<?= $url ?>query" class="list-item-tag">Truy vấn</a>
    </li>
    <li class="list-group-item list-container" name="list-item">
        <a href="javascript:void(0)" class="list-item-tag">Sao lưu</a>
    </li>
</ul>

<script>
    $("a[href='javascript:void(0)']").click(function() {
        $.ajax({
            type: "post",
            url: "?page=a&action=backup",
            success: function() {
                window.location = "?page=a&action=backup"
            }
        });
    });
</script>
