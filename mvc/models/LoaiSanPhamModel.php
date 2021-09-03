<?php
class LoaiSanPhamModel extends DB
{
    function getAll()
    {
        $qr = "SELECT * FROM LOAISANPHAM";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSomes($tenLoai)
    {
        $qr = "SELECT * FROM LOAISANPHAM WHERE TENLOAI LIKE '%$tenLoai%'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function addLoai($tenLoai)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "INSERT INTO LOAISANPHAM VALUES (null,'$tenLoai')";
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }

        return $result;
    }

    function editLoai($maloai, $tenMoi)
    {
        $result = false;
        // try {
            // $this->con->begin_transaction();
            $qr = "UPDATE loaisanpham SET TENLOAI = '$tenMoi' WHERE MALOAI = '$maloai'";
            mysqli_query($this->con, $qr);
            // if (mysqli_query($this->con, $qr)) {
            //     $result = true;
            // }
            // $this->con->commit();
        // } catch (Exception $e) {
            // $this->con->rollback();
        // }

        return $result;
    }

    function deleteLoai($maloai)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "DELETE FROM LOAISANPHAM WHERE MALOAI = '$maloai'";
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }

        return $result;
    }

    function adminGetAll()
    {
        $qr =
            "SELECT
            loaisanpham.*,
            SUM(trongluong.SOLUONG) AS 'SOLUONG'
        FROM
            loaisanpham
        LEFT JOIN sanpham ON sanpham.MALOAI = loaisanpham.MALOAI
        LEFT JOIN trongluong ON trongluong.MASANPHAM = sanpham.MASANPHAM
        GROUP BY
            loaisanpham.MALOAI";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }
}
