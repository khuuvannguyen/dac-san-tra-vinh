<?php
$loaiSP = json_decode($data["LoaiSP"], true);
$i = 1;
$sl = 0;
?>
<div class="row mt-3 mb-3">
    <div class="col">
        <label for="tenloai">Thêm loại sản phẩm mới:</label>
        <input type="text" name="tenloai" id="tenloai" placeholder="Tên loại sản phẩm">
        <button class="btnAdd btn btn-primary" name="btnAdd">Thêm</button>
    </div>
</div>
<table class="table table-light table-striped">
    <thead class="thead-dark">
        <tr>
            <th style="text-align: center;">STT</th>
            <th style="text-align: center;">Mã loại</th>
            <th>Tên loại</th>
            <th style="text-align: center;">Lượng tồn kho</th>
            <th style="text-align: center;">Sửa</th>
            <th style="text-align: center;">Xóa</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($loaiSP as $loai) : ?>
            <tr>
                <td style="text-align: center;"><?= $i ?></td>
                <td style="text-align: center;" id="maloai_<?= $i ?>" name="<?= $loai["MALOAI"] ?>"><?= $loai["MALOAI"] ?></td>
                <form action="?page=a&action=editLoaiSanPham" method="post">
                    <td>
                        <span id="<?= $i ?>"><?= $loai["TENLOAI"] ?></span>
                        <input type="text" name="tenmoi" id="<?= $i ?>" value="<?= $loai["TENLOAI"] ?>" style="display: none;">
                    </td>
                    <td style="text-align: center;">
                        <?php if (is_null($loai["SOLUONG"])) : ?>
                            0
                        <?php else : ?>
                            <?= $loai["SOLUONG"] ?>
                            <?php $sl += $loai["SOLUONG"] ?>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: center;">
                        <span class="btn btn-success btnEdit" value="<?= $i ?>">Sửa</span>
                        <button class="btn btn-primary" type="submit" name="btnSave" id="btnSave_<?= $i ?>" value="<?= $loai["MALOAI"] ?>" style="display:none;">Lưu</button>
                    </td>
                </form>
                <td style="text-align: center;">
                    <button class="btnDelete btn btn-danger" id="<?= $loai["MALOAI"] ?>" name="btnDelete">Xóa</button>
                </td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="2">Tổng cộng: <?= $i - 1 ?> loại sản phẩm.</th>
            <th colspan="3"><?= $sl ?> số sản phẩm tồn kho.</th>
        </tr>
    </tfoot>
</table>
<script>
    $(".btnEdit").click(function() {
        $("span[id='" + $(this).attr("value") + "']").css("display", "none");
        $("input[id='" + $(this).attr("value") + "']").removeAttr("style");
        $("button[id='btnSave_" + $(this).attr("value") + "']").removeAttr("style");
        $(this).css("display", "none");
        // $("button[id='btnSave_" + $(this).attr("value") + "']").click(function() {
        //     $.ajax({
        //         type: "post",
        //         urll: "?page=a&action=editLoaiSanPham",
        //         data: {
        //             btnSave: $("#btnSave_" + $(this).attr("value")).attr("name"),
        //             maloai: $("#maloai_" + $(this).attr("value")).attr("name"),
        //             tenmoi: $("inpyt[id='" + $(this).attr("value") + "']").attr("value")
        //         },
        //         sucess: function(data) {
        //             location.reload();
        //         }
        //     });
        // });
    });
    $(".btnDelete").click(function() {
        $.ajax({
            type: "post",
            url: "?page=a&action=deleteLoaiSanPham",
            data: {
                btnDelete: $(this).attr("name"),
                MALOAI: $(this).attr("id")
            },
            success: function(html) {
                location.reload();
            }
        });
    });
    $(".btnAdd").click(function() {
        var tenloai = document.getElementById("tenloai").value;
        if (tenloai == "" || tenloai == " ") {
            alert("Vui lòng nhập tên của loại cần thêm");
        } else {
            $.ajax({
                type: "post",
                url: "?page=a&action=addLoaiSanPham",
                data: {
                    btnAdd: $(this).attr("name"),
                    TENLOAI: document.getElementById("tenloai").value
                },
                success: function(html) {
                    window.location = "?page=a&action=allLoaiSanPham";
                }
            });
        }
    });
</script>