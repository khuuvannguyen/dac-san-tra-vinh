<div class="row mt-3">
    <div class="col">
        <label for="hientai">Mật khẩu hiện tại</label>
        <input type="password" name="hientai" id="hientai" required class="form-control">
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <label for="moi">Mật khẩu mới</label>
        <input type="password" name="moi" id="moi" required class="form-control">
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <label for="lai">Nhập lại mật khẩu</label>
        <input type="password" name="lai" id="lai" required class="form-control">
    </div>
</div>
<div class="row mt-3">
    <div class="col">
        <button type="submit" id="btnSubmit" name="submit" class="btn btn-primary">Đổi mật khẩu</button>
    </div>
</div>
<script>
    function myFunction() {
        var myButton = document.getElementsByClassName("myButtonName");
        for (var i = 0; i < myButton.length; i++) {
            if (myButton[i].clicked) {
                alert("Button " + myButton[i].value + " is clicked !");
            }
        }
    }

    $(".MyButtonName").click(function() {
        alert("Button " + $(this).attr("value") + " is clicked !");
    });

    $("#btnSubmit").click(function() {
        var MKmoi = document.getElementById("moi").value;
        var MKlai = document.getElementById("lai").value;
        if (MKmoi !== MKlai) {
            alert("Nhập lại mật khẩu không trùng nhau");
            return false;
        } else {
            $.ajax({
                type: "post",
                url: "?page=a&action=doimatkhau",
                data: {
                    submit: $(this).attr("name"),
                    hientai: document.getElementById("hientai").value,
                    moi: MKmoi
                },
                success: function(data) {
                    alert(data);
                    // console.log(data);
                    location.reload();
                }
            });
        }
    });
</script>
