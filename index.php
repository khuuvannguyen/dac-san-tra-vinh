<?php
session_start();
require_once "./mvc/Bridge.php";
$myApp = new App();
?>

<?php

// $con = mysqli_connect("localhost", "root", "", "dacsan_travinh");

// mysqli_query($con, "SET NAMES 'utf8'");

// $qr = "SELECT MATRONGLUONG, MASANPHAM, TRONGLUONG, format(GIANHAP, 'c', 'vi-VI') as GIANHAP, format(GIABAN, 'c', 'vi-VI') AS GIABAN, DABAN FROM TRONGLUONG
// ORDER BY MASANPHAM, GIABAN ASC";

// $result = mysqli_query($con, $qr);

// while ($row = mysqli_fetch_array($result)) {
//     echo $row["MATRONGLUONG"] . " - ";
//     echo $row["MASANPHAM"] . " - ";
//     echo $row["TRONGLUONG"] . " - ";
//     echo $row["GIANHAP"] . " - ";
//     echo $row["GIABAN"] . " - ";
//     echo $row["DABAN"] . "<br>";
// }

// $jsonFromBD = array();

// while ($row = mysqli_fetch_array($result)) {
//     $jsonFromBD[] = $row;
// }

// $json = json_encode($jsonFromBD, JSON_UNESCAPED_UNICODE);

// $JSON = json_decode($json, true);

// print_r($JSON);
// echo "<br/>";

// for ($i = 0; $i < count($JSON); $i++) {
//     echo "Ma sinh vien : " . $JSON[$i]["masinhvien"] . "<br/>";
//     echo "Ho ten : " . $JSON[$i]["hoten"] . "<br/>";
//     echo "Nam sinh : " . $JSON[$i]["namsinh"] . "<br/>";
//     echo "<br/>";
// }
?>