<form action="?page=a&action=addBaiViet" method="post">
    <div class="row mt-3">
        <div class="col">
            <label for="tenbaiviet">Tên bài viết</label>
            <input type="text" name="tenbaiviet" id="tenbaiviet" required class="form-control">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <label for="noidung">Nội dung bài viết</label>
            <textarea name="noidung" id="noidung" cols="30" rows="10"></textarea>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
        </div>
    </div>
</form>
<script src="./public/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace("noidung");
</script>