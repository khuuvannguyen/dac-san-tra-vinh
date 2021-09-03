<?php
require_once "./mvc/host.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
    <link type="text/css" rel="stylesheet" href="<?= $host ?>/public/css/memberMaster.css">
    <link type="text/css" rel="stylesheet" href="<?= $host ?>/public/css/upTop.css">
    <link type="text/css" rel="stylesheet" href="<?= $host ?>/public/css/footer.css">
    <link type="text/css" rel="stylesheet" href="<?= $host ?>/public/css/sanpham-ngaunhien.css">
    <link type="text/css" rel="stylesheet" href="<?= $host ?>/public/css/sanpham-detail.css">
    <link type="text/css" rel="stylesheet" href="<?= $host ?>/public/css/sanpham-left.css">
    <link type="text/css" rel="stylesheet" href="<?= $host ?>/public/css/sanpham-theoloai.css">
    
    <title>Đặc Sản Trà Vinh</title>
</head>

<body>

    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="P24BqkCc"></script>

    <div id="main" class="container-fluid">
        <?php require_once "Blocks/header.php" ?>
    </div>
    <div class="container-fluid mb-3 thong-tin">
        <div class="row">
            <?php require "Blocks/sanphamLeft.php" ?>
            <?php
            foreach ($data["Pages"] as $page) {
                require_once "Pages/$page.php";
            }
            ?>
        </div>
    </div>
    <?php require_once "Blocks/footer.php" ?>
    <style>
        div.container-footer{
            padding-left: 15%;
        }
        div.sanpham-ngaunhien {
            margin-left: 17.4%;
            width: 84%;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


    <!-- Latest compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="<?= $host ?>/public/js/add-to-cart.js"></script>

    <script src="<?= $host ?>/public/js/header.js"></script>
    <script src="<?= $host ?>/public/js/footer.js"></script>
</body>

</html>