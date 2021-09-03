<?php if (!isset($data["TrongLuong"])) : ?>
    <h4>Vui lòng <a href="?page=a&action=tatcaSanPham">chọn sản phẩm</a> để xem trọng lượng.</h4>
<?php else : ?>
    <?php $trongluong = json_decode($data["TrongLuong"], true); ?>
    <div class="container mb-3">
        <div class="row">
            <div class="col"></div>
            <div class="col-3">
                <button id="btnShow" class="btn btn-primary float-right">Thêm trọng lượng mới</button>
            </div>
        </div>
        <div id="form" style="display:none;">
            <div class="row">
                <label for="trongluong">Trọng lượng</label>
                <input type="text" name="trongluong" id="trongluong" required="" class="form-control">
            </div>
            <div class="row">
                <label for="soluong">Số lượng</label>
                <input type="number" name="soluong" id="soluong" required="" class="form-control" min="0" value="0">
            </div>
            <div class="row">
                <label for="gianhap">Giá nhập</label>
                <input type="number" name="gianhap" id="gianhap" required="" class="form-control" min="0" value="0">
            </div>
            <div class="row">
                <label for="giaban">Giá bán</label>
                <input type="number" name="giaban" id="giaban" required="" class="form-control" min="0" value="0">
            </div>
            <div class="row">
                <label for="ghichu">Ghi chú</label>
                <input type="text" name="ghichu" id="ghichu" class="form-control">
            </div>
            <div class="row mt-3">
                <button id="btnAdd" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
    </div>
    <table class="table table-light table-striped">
        <thead class="thead-dark">
            <tr style="text-align: center;">
                <th>STT</th>
                <th>Trọng lượng</th>
                <th>Kho</th>
                <th>Đã bán</th>
                <th>Giá nhập</th>
                <th>Giá bán</th>
                <th>Ghi chú</th>
                <th>Chỉnh sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($trongluong as $value) :
            ?>
                <form action="?page=a&action=editTrongLuong" method="post">
                    <tr>
                        <td style="text-align: center;"><?= $i ?></td>
                        <td style="text-align: center;">
                            <span id="span_TL_<?= $i ?>"><?= $value["TRONGLUONG"] ?></span>
                            <input class="small" type="text" name="trongluong" id="trongluong_<?= $i ?>" required value="<?= $value["TRONGLUONG"] ?>" style="display: none;">
                        </td>
                        <td style="text-align: center;">
                            <span id="span_SL_<?= $i ?>"><?= $value["SOLUONG"] ?></span>
                            <input class="small" type="number" name="soluong" id="soluong_<?= $i ?>" required min="0" value="<?= $value["SOLUONG"] ?>" style="display: none;">
                        </td>
                        <td style="text-align: center;"><?= $value["DABAN"] ?></td>
                        <td style="text-align: center;">
                            <span id="span_nhap_<?= $i ?>"><?= number_format($value["GIANHAP"], '0', ',', '.') ?>₫</span>
                            <input class="small" type="number" name="gianhap" id="gianhap_<?= $i ?>" value="<?= $value["GIANHAP"] ?>" style="display: none;">
                        </td>
                        <td style="text-align: center;">
                            <span id="span_ban_<?= $i ?>"><?= number_format($value["GIABAN"], '0', ',', '.') ?>₫</span>
                            <input class="small" type="number" name="giaban" id="giaban_<?= $i ?>" required value="<?= $value["GIABAN"] ?>" style="display: none;">
                        </td>
                        <td>
                            <span id="span_ghichu_<?= $i ?>"><?= $value["GHICHU"] ?></span>
                            <input class="small" type="text" name="ghichu" id="ghichu_<?= $i ?>" value="<?= $value["GHICHU"] ?>" style="display:none;">
                        </td>
                        <td style="text-align: center;">
                            <button class="btn btn-success" type="button" name="btnEdit" value="<?= $i ?>">Sửa</button>
                            <button class="btn btn-primary" type="submit" value="<?= $value["MATRONGLUONG"] ?>" id="btnSave_<?= $i ?>" name="btnSave" style="display: none;">Lưu</button>
                        </td>
                        <td style="text-align: center;">
                            <button id="<?= $value["MATRONGLUONG"] ?>" name="deleteTrongLuong" class="btn btn-danger">Xóa</button>
                        </td>
                    </tr>
                </form>
                <?php $i++ ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $("button[name='btnEdit']").click(function() {
                var i = $(this).attr("value");
                $("#trongluong_" + i).removeAttr("style");
                $("#span_TL_" + i).css("display", "none");
                $("#soluong_" + i).removeAttr("style");
                $("#span_SL_" + i).css("display", "none");
                $("#gianhap_" + i).removeAttr("style");
                $("#span_nhap_" + i).css("display", "none");
                $("#giaban_" + i).removeAttr("style");
                $("#span_ban_" + i).css("display", "none");
                $("#ghicchu_" + i).removeAttr("style");
                $("#span_ghichu_" + i).css("display", "none");
                $("#btnSave_" + i).removeAttr("style");
                $(this).css("display", "none");
            });
            $(".btn-danger").click(function() {
                $.ajax({
                    type: "post",
                    url: "?page=a&action=deleteTrongLuong",
                    data: {
                        deleteTrongLuong: $(this).attr("name"),
                        MATRONGLUONG: $(this).attr("id")
                    },
                    success: function(html) {
                        location.reload();
                    }
                });
            });
            $("#btnShow").click(function() {
                $("#form").removeAttr("style");
            });
            $("#btnAdd").click(function() {
                var maSP = <?php echo $_GET["id"]; ?>;
                $.ajax({
                    type: "post",
                    url: "?page=a&action=addTrongLuong",
                    data: {
                        submit: $(this).attr("id"),
                        maSP: maSP,
                        trongluong: document.getElementById("trongluong").value,
                        soluong: document.getElementById("soluong").value,
                        gianhap: document.getElementById("gianhap").value,
                        giaban: document.getElementById("giaban").value,
                        ghichu: document.getElementById("ghichu").value
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            });
        });
    </script>
<?php endif; ?>