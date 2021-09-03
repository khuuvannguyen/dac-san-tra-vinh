<?php
// $con = mysqli_connect("localhost", "root", "", "dacsan_travinh");
// mysqli_query($con, "SET NAMES 'utf8'");

// $matkhau = "admin";
// $matkhau = password_hash($matkhau, PASSWORD_DEFAULT);
// $qr = "UPDATE TAIKHOAN SET MATKHAU = '$matkhau' WHERE TENDANGNHAP = 'admin'";
// mysqli_query($con, $qr);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentvvvvvvv</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <textarea id="content" rows="10" cols="30"></textarea>
    <button id="btnSubmit">submit</button>

    <div id="result">...</div>
    <script>
        $("#btnSubmit").click(function() {
            var value = document.getElementById("content").value;
            $.ajax({
                type: "post",
                url: "http://localhost/php_mvc/index.php?page=a&action=query",
                // dataType: "html",
                data: {
                    query: value
                },
                success: function(data) {
                    $("#result").html(data);
                }
            });
        });
    </script>
</body>

</html>