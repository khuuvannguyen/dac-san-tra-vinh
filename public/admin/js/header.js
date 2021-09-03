$(document).ready(function () {
	$("#btnSignOut").click(function () {
		$.ajax({
			type: "post",
			url: "?page=a&action=signout",
			data: {},
			success: function (html) {
				location.reload();
			}
		});
	});
});