<?php
class TrongLuongModel extends DB
{

    function getCount()
    {
        $qr = "SELECT COUNT(*) AS MAX FROM TRONGLUONG";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSimple($maSP)
    {
        $qr = "SELECT MASANPHAM, SUM(SOLUONG) AS SOLUONG, SUM(DABAN) AS DABAN from TRONGLUONG WHERE MASANPHAM = '$maSP' GROUP BY MASANPHAM";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getFull($maSP)
    {
        $qr = "SELECT * FROM TRONGLUONG WHERE MASANPHAM = '$maSP' ORDER BY CAST(TRONGLUONG.TRONGLUONG AS SIGNED) ASC";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getOne($maTL)
    {
        $qr = "SELECT * FROM TRONGLUONG WHERE MATRONGLUONG = '$maTL'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function addTrongLuong($maSP, $trongluong, $soluong, $gianhap, $giaban,$ghichu)
    {
        try {
            $this->con->begin_transaction();
            $qr = "INSERT INTO TRONGLUONG VALUES (null,'$maSP','$trongluong','$soluong','$gianhap','$giaban','0','$ghichu')";
            if (mysqli_query($this->con, $qr)) {
                $this->con->commit();

                return true;
            }
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }

    function editTrongLuong($maTL, $TL, $SL, $GN, $GB, $ghichu)
    {
        try {
            $this->con->begin_transaction();
            $qr = "UPDATE TRONGLUONG SET TRONGLUONG = '$TL', SOLUONG = '$SL', GIANHAP = '$GN', GIABAN = '$GB', GHICHU = '$ghichu' WHERE MATRONGLUONG = '$maTL'";
            if (mysqli_query($this->con, $qr)) {
                $this->con->commit();

                return true;
            }
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }

    function deleteTrongLuong($maTL)
    {
        try {
            $this->con->begin_transaction();
            $qr = "DELETE FROM TRONGLUONG WHERE MATRONGLUONG = '$maTL'";
            if (mysqli_query($this->con, $qr)) {
                $this->con->commit();
                return true;
            }
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }
}
