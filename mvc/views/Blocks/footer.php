<?php
require_once "./mvc/host.php";
?>

<div class="container-fluid" style="background-color: rgba(0, 0, 0, 0.726);">
    <div class="row">
        <div class="container container-footer">
            <div class="row">
                <div class="col-4 block-footer">
                    <ul class="danh-sach-footer">
                        <li class="title-footer">Chăm sóc khách hàng</li>
                        <li><a href="<?= $host ?>/index.php?page=Home&action=huongdan">Hướng dẫn mua hàng</a></li>
                        <li><a href="<?= $host ?>/index.php?page=Home&action=doitra">Quy định đổi trả</a></li>
                    </ul>
                </div>
                <div class="col-4 block-footer">
                    <ul class="danh-sach-footer">
                        <li class="title-footer">Thông tin liên hệ</li>
                        <li>Điện thoại: 0938xxxxxx</li>
                        <li>Địa chỉ: Châu Thành, Trà Vinh.</li>
                    </ul>
                </div>
                <div class="col-4 social-icon">
                    <ul>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fa fa-google"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="width: 100%;">
        <div class="block-footer">
            <p id="time" style="text-align: right;">...</p>
        </div>
        <script>
            var timeDisplay = document.getElementById("time");

            function refreshTime() {
                var dateString = new Date().toLocaleString("vi-VI", {
                    timeZone: "Asia/Ho_Chi_Minh"
                });
                var formattedString = dateString.replace(", ", " - ");
                timeDisplay.innerHTML = formattedString;
            }
            setInterval(refreshTime, 1000);
        </script>
    </div>
    <div class="row copy-right">
        <div class="block-copy-right">
            <p style="color: #000;">© 2021, <a href="<?= $host ?>/" class="copy-right">Đặc Sản Trà Vinh</a></p>
        </div>
    </div>
</div>