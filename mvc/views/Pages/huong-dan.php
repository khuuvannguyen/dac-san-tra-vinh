<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <style>
        .huongdan {
            margin-right: 5px;
        }

        .content {
            margin: 0;
            padding: 0;
            left: 0;
            top: 0;
        }
    </style>

    <div class="col card huongdam">
        <div class="card-body baiviet-content">
            <div class="container">
                <div>
                    <b>Có hai cách để bạn có thể mua hàng tại Đặc Sản Trà Vinh:</b>
                </div>
                <div>
                    <i>Cách 1: mua trực tiếp.</i>
                </div>
                <div>
                    <ul>
                        <li><b>Bước 1:</b> chọn một sản phẩm từ website.</li>
                        <li><b>Bước 2:</b> chọn loại trọng lượng của sản phẩm muốn mua.</li>
                        <li><b>Bước 3:</b> chọn số lượng của loại trọng lượng muốn mua.</li>
                        <li><b>Bước 4:</b> bấm <b>"Mua ngay".</b></li>
                        <li><b>Bước 5:</b> điền thông tin của bạn để chúng tôi có thể giao hàng.</li>
                        <li><b>Bước 6:</b> thanh toán bằng chuyển khoản ngân hàng.</li>
                    </ul>
                </div>
                <div>
                    <i>Cách 2: mua những sản phẩm đã có trong giỏ hàng.</i>
                </div>
                <div>
                    <ul>
                        <li><b>Bước 1:</b> chọn một sản phẩm từ website.</li>
                        <li><b>Bước 2:</b> chọn loại trọng lượng của sản phẩm muốn mua.</li>
                        <li><b>Bước 3:</b> chọn số lượng của loại trọng lượng muốn mua.</li>
                        <li><b>Bước 4:</b> bấm <b>"Thêm vào giỏ hàng".</b></li>
                        <li><b>Bước 5:</b> thực hiện lại <b>bước 1 của cách 2</b> để chọn tất cả các sản phẩm bạn muốn mua.</li>
                        <li><b>Bước 6:</b> truy cập vào <b><a href="<?= $host ?>/index.php?page=GioHang&action=DashBoard">"Giỏ hàng".</a></b></li>
                        <li><b>Bước 7:</b> chọn các sản phẩm bạn muốn mua.</li>
                        <li><b>Bước 8:</b> thực hiện như <b>Bước 5, bước 6 của cách 1.</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>