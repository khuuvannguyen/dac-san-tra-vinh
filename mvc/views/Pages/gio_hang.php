<?php
require_once "./mvc/host.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <style>
        .giohang {
            margin-right: .5em;
        }

        .giohang-title {
            font-size: 24px;
        }

        .go-center {
            text-align: center;
            align-self: center;
            align-content: center;
            align-items: center;
        }

        .giohang-tong {
            text-align: right;
            color: red;
            padding-right: 2em;
            font-size: 20px;
        }

        input.sanpham-check {
            width: 20px;
            height: 20px;
            margin-top: 3px;
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

        .sanpham-soluong {
            width: 50px;
            text-align: center;
            padding: 0;
            margin: 0;
            border: 1px solid orange;
            border-style: none;
        }

        .btn-soluong {
            width: 30px;
            text-align: center;
            border: none;
            background-color: orange;
        }

        .btn-delete {
            border: none;
        }
    </style>
    <?php
    $giohang = json_decode($data["GioHang"], true);
    $sanpham = json_decode($data["SanPham"], true);
    $trongluong = json_decode($data["TrongLuong"], true);
    $max = json_decode($data["MAX"], true)[0]["MAX"];
    ?>
    <div class="col card giohang">
        <div class="card-header">
            <p class="giohang-title">Giỏ hàng của bạn</p>
        </div>
        <?php if (isset($_SESSION["GIOHANG"])) : ?>
            <div class="card-body">
                <form action="<?= $host ?>/index.php?page=SanPham&action=mua_ngay" method="post">
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th class="go-center">Chọn</th>
                                <th>Tên sản phẩm</th>
                                <th class="go-center">Trọng lượng</th>
                                <th class="go-center">Số lượng muốn mua</th>
                                <th class="go-center">Giá/sản phẩm</th>
                                <th class="go-center">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($giohang as $value) : ?>
                                <?php if (isset($value)) : ?>
                                    <tr>
                                        <td class="go-center">
                                            <input type="checkbox" name="maTL[]" id="sanpham-check_<?= $value["MATRONGLUONG"] ?>" class="sanpham-check" value="<?= $value["MATRONGLUONG"] ?>" onchange="check()">
                                        </td>
                                        <td>
                                            <label for="sanpham-check_<?= $value["MATRONGLUONG"] ?>"><?= $value["TENSANPHAM"] ?></label>
                                        </td>
                                        <td class="go-center"><?= $value["TRONGLUONG"] ?></td>
                                        <td class="go-center">
                                            <div class="input-group justify-content-center align-items-center">
                                                <div class="input-group-prepend">
                                                    <button name="sub" class="btn-soluong" id="btn-sub_<?= $i ?>" value="<?= $value["MATRONGLUONG"] ?>">-</button>
                                                </div>
                                                <input style="border:1px solid orange;" type="number" name="soluong[]" id="sanpham-soluong" class="sanpham-soluong" value="<?= $value["SOLUONG"] ?>" min="0" readonly="">
                                                <input type="hidden" name="soluong-temp[]" id="soluong-temp" class="soluong-temp" value="-1">
                                                <div class="input-group-prepend">
                                                    <button name="plus" class="btn-soluong" id="btn-plus_<?= $i ?>" value="<?= $value["MATRONGLUONG"] ?>" onclick="plus()">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <th class="go-center">
                                            <?= number_format($value["GIABAN"], '0', ',', '.') . "&nbsp;₫" ?>
                                            <p name="giaP" style="display:none;"><?= $value["GIABAN"] ?></p>
                                            <input type="hidden" name="giaban[]" id="giaban" class="giaban">
                                        </th>
                                        <td class="go-center">
                                            <!-- -------------------------------------------------- -->
                                            <a href="<?= $host ?>/index.php?page=GioHang&action=remove&code=<?= $value["MATRONGLUONG"] ?>" class="btn-delete btn btn-danger">
                                                <span class="fa fa-trash-o"></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Tổng đơn hàng:</th>
                                <th colspan="3" style="text-align: right;">
                                    <p id="tong-tien" class="giohang-tong"><?= number_format(0, '0', ',', '.') ?>&nbsp;₫</p>
                                    <input type="hidden" name="input-tong" id="input-tong">
                                </th>
                            </tr>
                            <tr>
                                <th colspan="5" id="error" style="text-align: right;"></th>
                                <th style="text-align: right;">
                                    <button id="btn-thanhtoan" type="submit" class="btn btn-success" onclick="return checkgia();" name="mua">Mua</button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        <?php else : ?>
            <h4>Giỏ hàng trống</h4>
        <?php endif; ?>
    </div>
    <script>
        var btn = document.getElementsByClassName('sanpham-check');
        var giaP = document.getElementsByName("giaP");
        var gia = document.getElementsByClassName("giaban");
        var soluong = document.getElementsByClassName("sanpham-soluong");
        var SLin = document.getElementsByClassName("soluong-temp");
        var btnSub = document.getElementsByName("btn-sub");
        var btnPlus = document.getElementsByName("btn-plus");

        var arrBtn = new Array();
        var arrGia = new Array();
        var arrSL = new Array();
        var arrSLSP = new Array();
        var arrSP = new Array();
        var arrTL = new Array();

        var array_SLSP = <?php echo json_encode($data["SoLuongSP"], true) ?>;
        var array_SP = <?php echo json_encode($data["SanPham"], true) ?>;
        var array_TL = <?php echo json_encode($data["TrongLuong"], true) ?>;

        var json_SLSP = JSON.parse(array_SLSP);
        var json_SP = JSON.parse(array_SP);
        var json_TL = JSON.parse(array_TL);

        function check() {
            arrBtn = [];
            arrGia = [];
            arrSL = [];
            arrSLSP = [];
            arrSP = [];
            arrTL = [];
            for (var i = 0; i < btn.length; i++) {
                if (btn[i].checked) {
                    var isExists = false;
                    for (var j = 0; j < arrBtn.length; j++) {
                        if (btn[i] == arrBtn[j]) {
                            isExists = true;
                        }
                    }
                    if (!isExists) {
                        arrBtn.push(btn[i]);
                        arrGia.push(giaP[i].innerHTML);
                        arrSL.push(soluong[i]);
                        arrSP.push(json_SP[i]["TENSANPHAM"]);
                        arrSLSP.push(json_SLSP[i]["SOLUONG"]);
                        arrTL.push(json_TL[i]);
                        gia[i].value = giaP[i].innerHTML;
                        SLin[i].value = soluong[i].value;

                        console.log(SLin[i].value);
                        console.log(json_SLSP[i]["SOLUONG"]);

                        // temp = parseInt(arrSLSP[i]) - parseInt(arrSL[i].value);
                        // console.log(temp);
                    }
                } else {
                    arrBtn.splice(i, 1);
                    arrGia.splice(i, 1);
                    arrSL.splice(i, 1);
                    arrSLSP.splice(i, 1);
                    arrSP.splice(i, 1);
                    arrTL.splice(i, 1);
                    gia[i].value = "";
                    SLin[i].value = "-1";
                }
            }
            var thanhtoan = 0;
            for (var i = 0; i < arrGia.length; i++) {
                thanhtoan += parseInt(arrGia[i]) * parseInt(arrSL[i].value);
            }
            document.getElementById("tong-tien").innerHTML = thanhtoan.toLocaleString('vi-VN') + " ₫";
            document.getElementById("input-tong").value = thanhtoan;
        }

        function updateGioHang() {

        }

        $('.btn-soluong').click(function() {
            // reference clicked button via: $(this)
            var code = $(this).attr('value');
            var action = $(this).attr("name");
            var urlString = "<?= $host ?>/index.php?page=GioHang&action=" + action;
            $.ajax({
                type: "POST",
                url: urlString,
                data: {
                    code: code
                },
                success: function(html) {
                    location.reload();
                }
            });
            return false;
        });
    </script>
    <script>
        var arrOk = new Array();

        function checkgia() {
            var gia = document.getElementById("tong-tien").innerHTML;
            if (gia === "0&nbsp;₫" || gia === "0 ₫") {
                alert("Vui lòng chọn sản phẩm");
                return false;
            } else {
                var result = true;
                arrOK = [];
                for (let i = 0; i < arrSP.length; i++) {
                    temp = parseInt(arrSLSP[i]) - parseInt(arrSL[i].value);
                    console.log("temp = " + temp);
                    arrOK.push(temp);
                }
                console.log("---");
                for (let i = 0; i < arrOK.length; i++) {
                    console.log(arrOK[i] + "\n");
                }
                console.log("---");
                console.log("length = " + arrOK.length);
                for (let i = 0; i < arrOK.length; i++) {
                    console.log("arrOK");
                    console.log(arrOK[i]);
                    if (arrOK[i] < 0) {
                        alert('Sản phẩm "' + arrSP[i] + ' ' + arrTL[i] + '" có số lượng không hợp lệ.\nVui lòng kiểm tra lại số lượng sản phẩm muốn mua!');
                        console.log(arrSL[i].value);
                        console.log(arrSLSP[i]);
                        result = false;
                    }
                }
                return result ? true : false;
            }
        }
    </script>
    <!-- jQuery library -->


    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>



<!-- làm cái click chọn sản phẩm trong giỏ hàng rồi bấm mua ==> gửi qua page thanh_toan.php -->
<!-- xem lại coi bấm vô "mua ngay" trong page sanpham_detail.php coi có gửi được qua page thanh_toan.php không -->