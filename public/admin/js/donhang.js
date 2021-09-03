$(document).ready(function () {
	$(".btnView").click(function (e) {
		$(".content").removeClass("watching");
		$(this).parent().parent().addClass("watching");
	});
	// var temp = "";
	// $("input[type='checkbox']").change(function () {
	// 	temp = "";
	// 	if (this.checked) {
	// 		temp = $(this).attr("value");
	// 		console.log(temp);
	// 	}
	// });
	// $('input[type="submit"]').click(function () {
	// 	if (temp === "") {
	// 		alert("Vui lòng chọn đơn hàng");
	// 		return false;
	// 	}
	// });
	$('#dateStart').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy/mm/dd'
	});
	$('#dateEnd').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy/mm/dd'
	});
});