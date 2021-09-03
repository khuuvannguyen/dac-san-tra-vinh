function checkSearch() {
    var key = document.getElementById("search-bar").value;
    if (key.trim() === "" || key.trim() === " ") {
        alert("Không có gì để tìm");
        return false;
    }
}