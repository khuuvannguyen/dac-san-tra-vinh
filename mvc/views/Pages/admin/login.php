<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Đăng nhập</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="./public/admin/js/login.js"></script>
</head>

<body>
	<div>
		<table align="center" style="border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; margin-top: 5%">
			<tr>
				<td>Tên đăng nhập:</td>
				<td><input type="text" name="username" id="username"></td>
			</tr>
			<tr>
				<td style="text-align: right;">Mật khẩu:</td>
				<td><input type="password" name="password" id="password"></td>
			</tr>
			<tr>
				<td></td>
				<td><button type="submit" id="btnLogin" name="btnLogin" value="login">Đăng nhập</button></td>
			</tr>
		</table>
		<div style="color:red;text-align: center;">
			<p id="error"></p>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$("button").click(function() {
				$.ajax({
					type: "post",
					url: "?page=a&action=login",
					data: {
						btnLogin: document.getElementById("btnLogin").value,
						username: document.getElementById("username").value,
						password: document.getElementById("password").value
					},
					success: function(data) {
						if (data == "true") {
							location.reload();
						} else {
							$("#error").html("Tên đăng nhập hoặc mật khẩu không chính xác");
						}
					}
				});
			});
		});
	</script>
</body>

</html>