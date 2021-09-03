<?php
require_once "./mvc/host.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <link type="text/css" rel="stylesheet" href="./public/css/memberMaster.css">
    <link type="text/css" rel="stylesheet" href="./public/css/upTop.css">
    <link type="text/css" rel="stylesheet" href="./public/css/bai-viet-home.css">
    <link type="text/css" rel="stylesheet" href="./public/css/footer.css">
    <link type="text/css" rel="stylesheet" href="./public/css/sanpham-ngaunhien.css">
    <link type="text/css" rel="stylesheet" href="./public/css/sanpham-theoloai.css">
    <title>Đặc Sản Trà Vinh</title>
</head>

<body>

    <div id="main" class="container-fluid">
        <?php require_once "Blocks/header.php" ?>
        <?php require_once "Blocks/slider.php" ?>
        <?php require_once "Blocks/gioithieu.php" ?>
        <?php
        foreach ($data["Pages"] as $page) {
            require_once "Pages/$page.php";
        }
        ?>
    </div>
    <?php require_once "Blocks/footer.php" ?>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="<?= $host ?>/public/js/header.js"></script>
    <script src="<?= $host ?>/public/js/footer.js"></script>
</body>

</html>