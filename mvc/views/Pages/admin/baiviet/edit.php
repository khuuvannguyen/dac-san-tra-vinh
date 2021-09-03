<?php if (!isset($data["BaiViet"])) : ?>
    <h4>Vui lòng <a href="?page=a&action=allBaiViet">chọn bài viết</a> để chỉnh sửa thông tin.</h4>
<?php else : ?>
    <?php $baiviet = json_decode($data["BaiViet"], true) ?>
    <form action="?page=a&action=editBaiViet&id=<?= $baiviet[0]["MABAIVIET"] ?>" method="post">
        <div class="row mt-3">
            <div class="col">
                <label for="tenBaiViet">Tên bài viết</label>
                <input type="text" name="tenBaiViet" id="tenBaiViet" required class="form-control" value="<?= $baiviet[0]["TENBAIVIET"] ?>">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="noidung">Nội dung bài viết</label>
                <textarea name="noidung" id="noidung" cols="30" rows="10" required><?= $baiviet[0]["NOIDUNG"] ?></textarea>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
            </div>
        </div>
    </form>
<?php endif; ?>
<script src="./public/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace("noidung");
</script>