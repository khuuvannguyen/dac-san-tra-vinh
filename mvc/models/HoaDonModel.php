<?php
class HoaDonModel extends DB
{

    function getLoiNhuan($start, $end)
    {
        $qr = "SELECT
            hoadon.*,
            sum(chitiethoadon.SOLUONG * trongluong.GIANHAP) AS 'VON',
            sum((chitiethoadon.SOLUONG * trongluong.GIABAN) - (chitiethoadon.SOLUONG * trongluong.GIANHAP)) AS 'LOINHUAN'
        FROM
            hoadon,
            chitiethoadon,
            trongluong
        WHERE
            hoadon.GHICHU = 'Đã duyệt' AND
            hoadon.MAHOADON = chitiethoadon.MAHOADON AND
            chitiethoadon.MATRONGLUONG = trongluong.MATRONGLUONG";
        if ($start != "" && $end != "") {
            $qr .= " AND
                hoadon.NGAYMUA >= '$start' AND
                hoadon.NGAYMUA <= '$end'";
        }
        $qr .= " GROUP BY hoadon.MAHOADON";
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function timBangIdVaGhiChu($id, $ghichu)
    {
        $qr = "SELECT * FROM HOADON
            WHERE HOADON.MAHOADON = '$id'
            AND HOADON.GHICHU <= '$ghichu'";
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getCountOfAll($start, $end)
    {
        if ($start == "" && $end == "") {
            $qr = "SELECT COUNT(*) AS SOLUONG FROM HOADON";
        } else {
            $qr = "SELECT COUNT(*) AS SOLUONG FROM HOADON
            WHERE HOADON.NGAYMUA >= '$start'
            AND HOADON.NGAYMUA <= '$end'";
        }
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getAll($start, $end)
    {
        if ($start == "" && $end == "") {
            $qr = "SELECT * FROM HOADON
            ORDER BY HOADON.NGAYMUA DESC";
        } else {
            $qr = "SELECT * FROM HOADON
            WHERE HOADON.NGAYMUA >= '$start'
            AND HOADON.NGAYMUA <= '$end'
            ORDER BY HOADON.NGAYMUA DESC";
        }
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getGhiChu($ghichu)
    {
        $qr = "SELECT *  FROM HOADON
        WHERE GHICHU = '$ghichu'
        ORDER BY HOADON.NGAYMUA DESC";
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getCountOfGhiChu($ghichu, $start, $end)
    {
        $qr = "SELECT COUNT(*) AS SOLUONG FROM HOADON
        WHERE GHICHU = '$ghichu'";
        if ($start != "" || $end != "") {
            $qr .= " AND HOADON.NGAYMUA >= '$start'
            AND HOADON.NGAYMUA <= '$end'";
        }

        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function duyetHoaDon($maHD)
    {
        $this->con->begin_transaction();
        $qr = "UPDATE HOADON SET GHICHU = 'Đã duyệt' WHERE MAHOADON = '$maHD'";
        if (mysqli_query($this->con, $qr)) {
            $this->con->commit();
            return true;
        }
        return false;
    }

    function huyHoaDon($maHD)
    {
        $this->con->begin_transaction();
        $qr = "UPDATE HOADON SET GHICHU = 'Đã hủy' WHERE MAHOADON = '$maHD'";
        if (mysqli_query($this->con, $qr)) {
            $this->con->commit();
            return true;
        }
        return false;
    }

    function findById($maHD)
    {
        $qr = "SELECT * FROM HOADON
        WHERE MAHOADON = '$maHD'";
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function findByPhone($sdt)
    {
        $qr = "SELECT * FROM HOADON
        WHERE SODIENTHOAI = '$sdt'";
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function createHoaDon($tenKH, $SDT, $diachi)
    {
        $maHD = date("YmdHis");
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngaymua = date('Y-m-d H:i:s');
        $this->con->begin_transaction();
        $qr = "INSERT INTO HOADON VALUES ('$maHD','$tenKH','$SDT','$diachi','$ngaymua','0','')";
        if (mysqli_query($this->con, $qr)) {
            $this->con->commit();
            $_SESSION["HOADON"][$maHD] = array(
                "HOTEN" => strtoupper($tenKH),
                "SDT" => $SDT,
                "DIACHI" => strtoupper($diachi),
                "NGAYMUA" => $ngaymua,
                "TONGTHANHTOAN" => 0,
                "GHICHU" => ""
            );
        } else {
            $this->con->rollback();
        }
        return json_decode($maHD);
    }

    function updateThanhToan($maHD, $tongThanhToan)
    {
        try {
            $this->con->begin_transaction();
            $qr = "UPDATE HOADON SET TONGTHANHTOAN = '$tongThanhToan' WHERE MAHOADON = '$maHD'";
            if (mysqli_query($this->con, $qr)) {
                $this->con->commit();
                $_SESSION["HOADON"][$maHD]["TONGTHANHTOAN"] = $tongThanhToan;
                return true;
            }
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }
}
