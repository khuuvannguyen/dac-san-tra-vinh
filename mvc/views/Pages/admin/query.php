<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    #result {
        width: 100%;
        margin-top: 1em;
    }

    .error {
        color: red;
    }

    .success {
        color: blue;
    }
</style>

<div class="form-group">
    <label for="query">Nhập mã SQL cần truy vấn</label><br>
    <textarea id="query" class="form-control" name="query" rows="15"></textarea>
</div>
<div class="row mb-2">
    <div class="col">
        <button class="btn btn-success" id="btnSelect">SELECT</button>
        <button class="btn btn-success" id="btnInsert">INSERT</button>
        <button class="btn btn-success" id="btnUpdate">UPDATE</button>
        <button class="btn btn-success" id="btnDelete">DELETE</button>
        <button class="btn btn-primary float-right ml-3" id="btnSubmit">Truy vấn</button>
    </div>
</div>
<b class="error"></b><b class="success"></b>
<div id="result"></div>

<script>
    $(document).ready(function() {
        $("#query").val("SELECT \n\t*\nFROM\n\ttable_name\nWHERE\n\t1").html();
        $(".btn-success").click(function() {
            $("#query").html("");
            switch ($(this).attr("id")) {
                case "btnSelect":
                    $("#query").val("SELECT \n\t*\nFROM\n\ttable_name\nWHERE\n\t1").html();
                    break;
                case "btnInsert":
                    $("#query").val("INSERT INTO table_name (\n\tcolumn_1,\n\tcolumn_2,\n\tcolumn_3,\n\tcolumn_4,\n\tcolumn_5\n)\nVALUES (\n\t'value_1',\n\t'value_2',\n\t'value_3',\n\t'value_4',\n\t'value_5'\n)")
                    break;
                case "btnUpdate":
                    $("#query").val("UPDATE \n\ttable_name\nSET\n\tcolumn_1 = 'value_1',\n\tcolumn_2 = 'value_2',\n\tcolumn_3 = 'value_3',\n\tcolumn_4 = 'value_4',\n\tcolumn_5 = 'value_5'\nWHERE\n\t1");
                    break;
                default:
                    $("#query").val("DELETE \nFROM\n\ttable_name\nWHERE\n\t0");
                    break;
            }
        });
        $("#btnSubmit").click(function() {
            var value = document.getElementById("query").value;
            $.ajax({
                type: "post",
                url: "http://localhost/php_mvc/index.php?page=a&action=query",
                // dataType: "html",
                data: {
                    query: value,
                },
                success: function(data) {
                    $(".error").html("");
                    $(".success").html("");
                    $("#result").html("");
                    switch ($.trim(data)) {
                        case "TRUE":
                            $(".success").html("Truy vấn thành công!");
                            break;
                        case "FALSE":
                            $(".error").html("Truy vấn thất bại!");
                            break;
                        default:
                            $("#result").html(data);
                            $(".success").html("Truy vấn thành công!");
                            break;
                    }
                }
            });
        });
    });
</script>