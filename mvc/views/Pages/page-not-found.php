<?php
require_once "./mvc/host.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Không tìm thấy trang</title>
</head>

<body>
    <h1>404</h1>
    <h3>Không tìm thấy trang. <a href="<?= $host ?>/index.php?page=Home&action=DashBoard">Quay về trang chủ</a></h3>
</body>
<style>
    h1 {
        font-size: 150px;
        padding-left: 30%;
        padding-bottom: 0;
        margin-bottom: 0;
    }
    h3{
        font-size: 50px;
        padding-left: 30%;
        padding-bottom: 0;
        margin-bottom: 0;
        padding-top: 0;
        margin-top: 0;
    }
    h5{
        font-size: 15px;
        padding-left: 30%;
        padding-top: 0;
        margin-top: 0;
    }
    a, a:hover{
        text-decoration: none;
    }
    a:hover{
        color: red;
    }
</style>

</html>