<?php
class ChiTietHoaDonModel extends DB
{

    function getCountOfSoLuong($start, $end)
    {
        $qr = "SELECT SUM(chitiethoadon.SOLUONG) AS 'SOLUONG' FROM chitiethoadon
        JOIN hoadon ON hoadon.MAHOADON = chitiethoadon.MAHOADON
        WHERE hoadon.GHICHU = 'Đã duyệt'";
        if ($start != "") {
            $qr .= " AND hoadon.NGAYMUA >= '$start'
            AND hoadon.NGAYMUA <= '$end'";
        }
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function findById($maHD)
    {
        $qr = "SELECT * FROM CHITIETHOADON
        WHERE MAHOADON = '$maHD'";
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function addChiTiet($maHD, $maTL, $soluong, $dongia)
    {
        $tong = $soluong * $dongia;
        $this->con->begin_transaction();
        $qr = "INSERT INTO CHITIETHOADON VALUES ('$maHD','$maTL','$soluong','$dongia','$tong')";
        if (mysqli_query($this->con, $qr)) {
            $this->con->commit();
        }
    }
}
