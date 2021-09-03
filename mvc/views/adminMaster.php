<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Quản trị</title>
    <script src="./public/admin/js/left-menu.js"></script>
    <link rel="stylesheet" href="./public/admin/css/main.css">
    <script type="text/javascript" src="./public/admin/js/header.js"></script>
    <script src="./public/admin/js/left-menu.js"></script>
</head>

<body>
    <div class="container-fluid main">
        <?php require_once "Blocks/admin/header.php" ?>
        <div class="row">
            <div class="col-2 left-menu">
                <?php require_once "Blocks/admin/left.php" ?>
            </div>
            <div class="col-10">
                <div class="card dashboard">
                    <div class="card-header">
                        <h3><?= $data["Title"] ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <?php
                            require_once "Pages/" . $data["Page"] . ".php";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
