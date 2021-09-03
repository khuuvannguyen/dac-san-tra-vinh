<?php
require_once "./mvc/host.php";
$detail = json_decode($data["SanPham"], true);
$simple = json_decode($data["TrongLuongSimple"], true);
$full = json_decode($data["TrongLuongFull"], true);
$mota = json_decode($data["MoTa"], true);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var jArray = <?php echo json_encode($data["TrongLuongFull"], true); ?>;
    var json = JSON.parse(jArray);

    // console.log(json);

    var jArray_S = <?php echo json_encode($data["SanPham"], true) ?>;
    var json_S = JSON.parse(jArray_S);

    // console.log(json_S);

    // console.log(json[0]["MASANPHAM"]); 
    var soluongCon = json[0]["SOLUONG"];
    var maTL = json[0]["MATRONGLUONG"];
    var giaban = json[0]["GIABAN"];
    var trongluongSP = json[0]["TRONGLUONG"];

    var tenSP = json_S[0]["TENSANPHAM"];
    var ghichu = json[0]["GHICHU"];
    document.getElementById("input-soluong").value = 1;

    function radioCheck() {
        var radios = document.getElementsByName("m");
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                // do whatever you want with the checked radio
                // alert(radios[i].value);
                for (let index = 0; index < json.length; index++) {
                    if (json[index]["MATRONGLUONG"] == radios[i].value) {

                        trongluongSP = json[index]["TRONGLUONG"];
                        document.getElementById("trongLuong-buy").value = trongluongSP;

                        maTL = json[index]["MATRONGLUONG"];
                        document.getElementById("maTL-buy").value = maTL;
                        soluongCon = json[index]["SOLUONG"];
                        document.getElementById("so-luong").innerHTML = soluongCon;
                        document.getElementById("da-ban").innerHTML = json[index]["DABAN"];
                        giaban = parseInt(json[index]["GIABAN"]);
                        document.getElementById("giaban-buy").value = giaban;
                        document.getElementById("gia-ban").innerHTML = giaban.toLocaleString('vi-VN') + " ₫";
                        ghichu = json[index]["GHICHU"];
                        if (ghichu.trim() !== "") {
                            document.getElementById("ghichu-content").innerHTML = ghichu;
                            document.getElementById("ghichu-title").innerHTML = "Lưu ý";
                        }else{
                            document.getElementById("ghichu-content").innerHTML = "";
                            document.getElementById("ghichu-title").innerHTML = "";
                        }
                        break;
                    }
                }

                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
    }
</script>

<div class="col card sanpham-detail">
    <div class="card-header">
        <p class="ten-san-pham"><?= $detail[0]["TENSANPHAM"] ?></b></p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="hinh-sanpham">
                    <img src="<?= $host ?>/public/sanpham/<?= $detail[0]["HINHSANPHAM"] ?>" alt="Hình ảnh sản phẩm" class="hinh">
                </div>
            </div>
            <div class="col-6">
                <div class="thong-tin-co-ban">
                    <div class="card">
                        <div class="row mt-3">
                            <div class="col tag">
                                <p><b>Mã sản phẩm:</b></p>
                            </div>
                            <div class="col">
                                <p><b><?= $detail[0]["MASANPHAM"] ?></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col tag">
                                <p><b>Tên sản phẩm:</b></p>
                            </div>
                            <div class="col">
                                <p><b><?= $detail[0]["TENSANPHAM"] ?></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col tag">
                                <p><b>Tổng số lượng:</b></p>
                            </div>
                            <div class="col">
                                <p><b><?= $simple[0]["SOLUONG"] ?></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col tag">
                                <p><b>Tổng sản phẩm đã bán:</b></p>
                            </div>
                            <div class="col">
                                <p><b><?= $simple[0]["DABAN"] ?></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col tag">
                                <p><b>Trọng lượng:</b></p>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="container mt-2">
                                    <div class="row">
                                        <div class="col text-center">
                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                <form>
                                                    <?php for ($i = 0; $i < count($full); $i++) : ?>
                                                        <input type="radio" class="btn-check" name="m" id="trongluong<?= $i ?>" autocomplete="off" onclick="radioCheck();" value="<?= $full[$i]["MATRONGLUONG"] ?>" <?php
                                                                                                                                                                                                                    if ($i == 0) {
                                                                                                                                                                                                                        echo "checked";
                                                                                                                                                                                                                    } ?>>
                                                        <label class="btn btn-outline-primary" for="trongluong<?= $i ?>" style="margin-right: 10px;"><?= $full[$i]["TRONGLUONG"] ?></label>
                                                    <?php endfor; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3" style="color: red;">
                            <div class="col tag">
                                <p><b>Số lượng:</b></p>
                            </div>
                            <div class="col">
                                <b>
                                    <p id="so-luong"><?= $full[0]["SOLUONG"] ?></p>
                                </b>
                            </div>
                        </div>
                        <div class="row" style="color: red;">
                            <div class="col tag">
                                <p><b>Đã bán:</b></p>
                            </div>
                            <div class="col">
                                <b>
                                    <p id="da-ban"><?= $full[0]["DABAN"] ?></p>
                                </b>
                            </div>
                        </div>
                        <div class="row" style="color: red;">
                            <div class="col tag">
                                <p><b>Giá bán:</b></p>
                            </div>
                            <div class="col">
                                <b>
                                    <p id="gia-ban"><?php echo number_format($full[0]["GIABAN"], '0', ',', '.'); ?>&nbsp;<span>₫</span></p>
                                </b>
                            </div>
                        </div>
                        <div class="row" style="color: blue;">
                            <div class="col tag">
                                <b>
                                    <p id="ghichu-title"></p>
                                </b>
                            </div>
                            <div class="col">
                                <strong>
                                    <p id="ghichu-content" style="text-transform: uppercase;"></p>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 soluong mt-3">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <!-- <div class="input-group-text">@</div> -->
                                <button type="button" class="btn-soluong" onclick="sub();">-</button>
                            </div>
                            <input type="number" class="input-soluong" id="input-soluong" name="n" min="1" value="1">
                            <div class="input-group-prepend">
                                <!-- <div class="input-group-text">@</div> -->
                                <button type="button" class="btn-soluong" onclick="plus();">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-block add-to-cart col-12" id="add-to-cart" name="add-to-cart" type="submit" onclick="add_cart();">Thêm vào giỏ hàng</button>
                    </div>
                    </form>
                    <div class="mt-3">
                        <form action="<?= $host ?>/index.php?page=SanPham&action=mua_ngay" method="post">
                            <input type="hidden" name="maTL-buy" id="maTL-buy">
                            <input type="hidden" name="SL-buy" id="SL-buy">
                            <input type="hidden" name="giaban-buy" id="giaban-buy">
                            <input type="hidden" name="tenSP-buy" id="tenSP-buy">
                            <input type="hidden" name="trongLuong-buy" id="trongLuong-buy">
                            <button type="submit" class="btn btn-block buy-now col-12" id="buy-now" name="buy-now" onclick="return buy_now();" value="buy-now">Mua ngay</a>
                        </form>
                    </div>
                    <script>
                        if (ghichu.trim() !== "") {
                            document.getElementById("ghichu-content").innerHTML = ghichu;
                            document.getElementById("ghichu-title").innerHTML = "Lưu ý";
                        }

                        document.getElementById("trongLuong-buy").value = trongluongSP;
                        document.getElementById("tenSP-buy").value = tenSP;

                        document.getElementById("maTL-buy").value = maTL;
                        document.getElementById("giaban-buy").value = giaban;

                        setSoLuong();

                        $("#input-soluong").keyup(function() {
                            document.getElementById("SL-buy").value = document.getElementById("input-soluong").value;
                            console.log(document.getElementById("SL-buy").value);
                        });

                        // $('.btn-soluong').click(function() {
                        //     // reference clicked button via: $(this)
                        //     var code = $(this).attr('value');
                        //     var action = $(this).attr("name");
                        //     var urlString = "/index.php?page=GioHang&action=" + action;
                        //     $.ajax({
                        //         type: "POST",
                        //         url: urlString,
                        //         data: {
                        //             code: code
                        //         },
                        //         success: function(html) {
                        //             location.reload();
                        //         }
                        //     });
                        //     return false;
                        // });

                        function setSoLuong() {
                            document.getElementById("SL-buy").value = document.getElementById("input-soluong").value;
                        }

                        function sub() {
                            var soluong = document.getElementById("input-soluong").value;
                            if (soluong > 1) {
                                soluong--;
                                document.getElementById("input-soluong").value = soluong;
                            }
                            setSoLuong();
                        }

                        function plus() {
                            var soluong = document.getElementById("input-soluong").value;
                            soluong++;
                            document.getElementById("input-soluong").value = soluong;
                            setSoLuong();
                        }

                        function add_cart() {
                            var soluong = document.getElementById("input-soluong").value;
                            if (soluong === "" || parseInt(soluong) < 1) {
                                alert("Số lượng sản phẩm không hợp lệ");
                            } else {
                                var urlString = "<?= $host ?>/index.php?page=GioHang&action=addCart";
                                var addToCart = "yes";
                                $.ajax({
                                    type: "POST",
                                    url: urlString,
                                    data: {
                                        a: addToCart,
                                        m: maTL,
                                        n: soluong
                                    },
                                    success: function(html) {
                                        alert(html);
                                    }
                                });
                            }
                            return false;
                        }

                        function buy_now() {
                            var soluong = document.getElementById("input-soluong").value;
                            if (parseInt(soluong) < 1 || parseInt(soluong) > parseInt(soluongCon) || soluong === "") {
                                alert("Số lượng sản phẩm không hợp lệ");
                                return false;
                            }
                        }
                    </script>
                    <style>
                        .thong-tin-co-ban .thong-tin {
                            background-color: transparent;
                        }

                        .tag {
                            text-align: right;
                        }

                        .soluong {
                            width: 100%;
                            height: auto;
                        }

                        .btn-soluong {
                            color: white;
                            width: 100px;
                            background-color: orange;
                            font-size: 14px;
                            font-weight: bold;
                            padding-bottom: .2em;
                            border: 2px solid orange;
                        }

                        /* Chrome, Safari, Edge, Opera */
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }

                        /* Firefox */
                        input[type=number] {
                            -moz-appearance: textfield;
                        }

                        .input-soluong {
                            border: 1px solid orange;
                            width: 60%;
                            text-align: center;
                            font-size: 14px;
                        }

                        .input-soluong:checked {
                            border: none;
                        }

                        .add-to-cart .buy-now {
                            width: 50%;
                            margin-left: 25%;
                        }
                    </style>

                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="mo-ta">
            <div class="row">
                <p class="mo-ta-title">Mô tả sản phẩm</b></p>
            </div>
            <div class="mo-ta-noi-dung">
                <?php
                if (!empty($mota[0]["MOTA"])) :
                    echo $mota[0]["MOTA"];
                else :
                    echo "Sản phẩm chưa được mô tả !";
                endif;
                ?>
            </div>
        </div>
        <hr>
        <div class="mo-ta">
            <p class="mo-ta-title">Bình luận</b></p>
            <div id="facebook" class="container tab-pane active"><br>
                <!-- đổi host, uri truy cập -->
                <div class="fb-comments" data-href="<?= $host ?>/index.php?page=&SanPham&action=thong_tin&tensanpham=<?= $detail[0]["TENSANPHAMKHONGDAU"] ?>" data-width="100%" data-numposts="10"></div>
            </div>
        </div>
    </div>
</div>