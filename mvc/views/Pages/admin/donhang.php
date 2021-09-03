<?php
$hoadon = json_decode($data["HoaDon"], true);
?>
<link rel="stylesheet" href="./public/admin/css/donhang/donhang.css">

<div id="pageContent">
	<?php if ($data["Action"] == "getAll") : ?>
		<div class="container mb-3">
			<div class="row">
				<b>Tìm hóa đơn</b>
			</div>
			<form action="?page=a&action=donhangAll" method="post">
				<div class="row mt-3">
					<label for="dateStart" class="pt-1">Từ ngày</label>
					<input name="dateStart" id="dateStart" readonly value="" width="180px" class="ml-3">
					<label for="dateEnd" class="ml-5 pt-1">Đến ngày</label>
					<input name="dateEnd" id="dateEnd" readonly value="" width="180px" class="ml-3">
					<button type="submit" value="searchDay" id="btnSearchDay" name="btnSearchDay" class="ml-5 btn btn-primary">Tìm</button>
				</div>
			</form>
		</div>
	<?php endif; ?>
	<?php if ($data["Action"] != "getAll") : ?>
		<div class="container pb-3">
			<div class="row">
				<form action="?page=a&action=<?= $data["Action"] ?>" method="post">
					Tìm đơn hàng: <input type="text" name="searchDonHang" id="searchDonHang" class="ml-2" placeholder="Mã đơn hàng">
					<button class="btn btn-primary ml-2" name="btnSearchDonHang" onclick="return checkSearchDonHang();">Tìm</button>
				</form>
			</div>
		</div>
		<script>
			function checkSearchDonHang() {
				var value = document.getElementById("searchDonHang").value;
				if (value === "" || value === " ") {
					alert("Không có gì để tìm");
					return false;
				}
			}
		</script>
	<?php endif; ?>
	<?php if (isset($data["Start"]) && $data["Start"] != "") : ?>
		<div class="container mb-3">
			<b><i>Từ ngày <?= $data["Start"] ?> đến ngày <?= $data["End"] ?>.</i></b>
		</div>
	<?php endif; ?>
	<form action="?page=a&action=<?= $data["Action"] ?>" method="post">
		<div class="row mb-3">
			<div class="col">
				<h4>
					Tìm thấy <?= json_decode($data["SoLuongAll"], true)[0]["SOLUONG"] ?> đơn hàng <?= $data["LoaiHoaDon"] ?>
				</h4>
				<?php if ($data["Action"] == "getAll") : ?>
					<h6>Trong đó:</h6>
					<ul>
						<li><?= json_decode($data["SoLuongChuaDuyet"], true)[0]["SOLUONG"] ?> đơn hàng chưa duyệt.</li>
						<li><?= json_decode($data["SoLuongDaDuyet"], true)[0]["SOLUONG"] ?> đơn hàng đã duyệt.</li>
						<li><?= json_decode($data["SoLuongDaHuy"], true)[0]["SOLUONG"] ?> đơn hàng đã hủy.</li>
					</ul>
				<?php endif; ?>
			</div>
			<div class="col-5 float-right">
				<?php if ($data["LoaiHoaDon"] == "đã duyệt") : ?>
					<button type="submit" class="btnCheck btn btn-danger ml-5 float-right" name="btnHuy" onclick="return check();">Đặt thành "Đã hủy"</button>
				<?php elseif ($data["LoaiHoaDon"] == "chưa duyệt") :  ?>
					<button type="submit" class="btnCheck btn btn-danger ml-5" name="btnHuy" onclick="return check();">Đặt thành "Đã hủy"</button>
					<button type="submit" class="btnCheck btn btn-primary float-right" name="btnDuyet" onclick="return check();">Đặt thành "Đã duyệt"</button>
				<?php endif; ?>
			</div>
		</div>
		<?php if ($data["Action"] == "getAll") : ?>
			<div class="row mb-2">
				<div class="container">
					<h4>
						Tổng danh thu:
						<?= number_format($data["TongDoanhThu"], '0', ',', '.') ?>
						&nbsp;₫. Lợi nhuận:
						<?= number_format($data["TongLoiNhuan"], '0', ',', '.') ?>&nbsp;
						₫ trong
						<?php $soluongdaban = json_decode($data["SoLuongDaBan"], true)[0]["SOLUONG"];
						if (is_null($soluongdaban)) : ?>
							0
						<?php else : ?>
							<?= $soluongdaban ?>
						<?php endif; ?>
						sản phẩm.
						<a href="?page=a&action=spdb&s=<?= $data["Start"] ?>&e=<?= $data["End"] ?>" class="btn btn-info <?php
														if (!isset($data["Start"]) || $data["Start"] == "") {
															echo "disabled";
														}
														?>" target="_blank">Các sản phẩm đã bán</a>
					</h4>
				</div>
			</div>
		<?php endif; ?>
		<div class="row">
			<table class="table">
				<thead class="thead-dark content">
					<tr>
						<th>Chọn</th>
						<th>Mã đơn hàng</th>
						<th>Ngày mua</th>
						<th>Đơn giá</th>
						<?php if ($data["Action"] == "getAll") : ?>
							<th>Tình trạng</th>
						<?php endif; ?>
						<th>Xem đơn hàng</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 0; ?>
					<?php foreach ($hoadon as $value) : ?>
						<tr class="content <?php if ($value["GHICHU"] == "Đã hủy")
												echo "table-danger";
											else if ($value["GHICHU"] == "Đã duyệt")
												echo "table-success"; ?>">
							<td>
								<input type="checkbox" name="inputCheck[]" id="btnCheckBox_<?= $i ?>" class="form-control" value="<?= $value["MAHOADON"] ?>" <?php if ($data["Action"] == "donhangDaHuy" || $data["Action"] == "getAll") echo "Disabled"; ?>>
							</td>
							<td><?= $value["MAHOADON"] ?></td>
							<td><?= $value["NGAYMUA"] ?></td>
							<td><?= number_format($value["TONGTHANHTOAN"], '0', ',', '.') ?>&nbsp;₫</td>
							<?php if ($data["Action"] == "getAll") : ?>
								<td>
									<?php if ($value["GHICHU"] == "Chưa duyệt") : ?>
										&#x2754;
									<?php elseif ($value["GHICHU"] == "Đã duyệt") : ?>
										✔
									<?php else : ?>
										&#x274C;
									<?php endif; ?>
									<?= $value["GHICHU"] ?>
								</td>
							<?php endif; ?>
							<td>
								<a href="?page=HoaDon&action=detail&id=<?= $value["MAHOADON"] ?>" target="_blank" class="btn btn-info btnView" id="<?= $i ?>">Xem</a>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
</div>
</form>
</div>
<script type="text/javascript" src="./public/admin/js/donhang.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
	// $("#btnSearchDay").click(function() {
	// 	var start = document.getElementById("dateStart").value;
	// 	var end = document.getElementById("dateEnd").value;
	// 	if (start === "" || end === "") {
	// 		alert("Vui lòng chọn mốc thời gian để tìm kiếm");
	// 		return false;
	// 	}
	// });

	var temp = "";
	$("input[type='checkbox']").change(function() {
		temp = "";
		if (this.checked) {
			temp = $(this).attr("value");
			console.log(temp);
		}
	});

	function check() {
		if (temp == "") {
			alert("Vui lòng chọn đơn hàng");
			return false;
		} else if (!confirm("Bạn có chắc thực hiện hành động này?")) {
			return false;
		}
	}
</script>