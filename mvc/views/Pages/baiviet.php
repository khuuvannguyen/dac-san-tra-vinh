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
        .baiviet {
            margin-right: 5px;
        }

        .baiviet-title {
            font-size: 28px;
            font-weight: bold;
        }

        .baiviet-content {
            margin: 0;
            padding: 0;
            left: 0;
            top: 0;
        }
    </style>

    <div class="col card baiviet">
        <?php
        $baiviet = json_decode($data["BaiViet"], true);
        ?>
        <div class="card-header">
            <p class="baiviet-title"><?= $baiviet[0]["TENBAIVIET"] ?></p>
        </div>
        <div class="card-body baiviet-content">
            <div class="container">
                <div><i>Lượt xem: <?= $baiviet[0]["LUOTXEM"] ?></i></div>
                <div class="mt-3"><?= $baiviet[0]["NOIDUNG"] ?></div>
            </div>
        </div>
    </div>
</body>

</html>