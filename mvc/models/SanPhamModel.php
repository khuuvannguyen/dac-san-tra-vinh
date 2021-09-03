<?php
class SanPhamModel extends DB
{

    function getXemNhieu()
    {
        $qr = "SELECT * FROM SANPHAM
        ORDER BY SANPHAM.CLICK DESC
        LIMIT 5";
        $json = array();
        $result = mysqli_query($this->con, $qr);
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function updateClick($maSP)
    {
        $qr = "SELECT * FROM SANPHAM WHERE MASANPHAM = '$maSP'";
        $result = mysqli_query($this->con, $qr);
        $sanpham = mysqli_fetch_array($result);
        $click = @$sanpham["CLICK"] + 1;
        $this->con->begin_transaction();
        $qr = "UPDATE SANPHAM SET CLICK = $click WHERE MASANPHAM = '$maSP'";
        if (mysqli_query($this->con, $qr)) {
            $this->con->commit();
            return true;
        }
        return false;
    }

    function getAll()
    {
        $qr = "SELECT * FROM SANPHAM";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSomes($searchKey)
    {
        $qr = "SELECT * FROM SANPHAM WHERE TENSANPHAM LIKE '%$searchKey%' ORDER BY TENSANPHAM ASC";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSomes_soluong($searchKey)
    {
        $qr = "SELECT COUNT(*) AS SOLUONG FROM SANPHAM WHERE TENSANPHAM LIKE '%$searchKey%'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function findById($maSP)
    {
        $qr = "SELECT * FROM SANPHAM WHERE MASANPHAM = '$maSP'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getOne($tenKD)
    {
        $qr = "SELECT * FROM SANPHAM WHERE TENSANPHAMKHONGDAU = '$tenKD'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSanPhamMoi()
    {
        $qr = "SELECT sanpham.*, t.*, GROUP_CONCAT(format(t.GIABAN, 'c', 'vi-VI') ORDER BY t.GIABAN ASC SEPARATOR ' - ') AS GIABAN
        FROM trongluong t
        JOIN sanpham ON sanpham.MASANPHAM = t.MASANPHAM
        WHERE
            t.GIABAN = (SELECT MIN(t2.GIABAN) FROM trongluong t2 WHERE t2.MASANPHAM = t.MASANPHAM) OR
            t.GIABAN = (SELECT MAX(t2.GIABAN) FROM trongluong t2 WHERE t2.MASANPHAM = t.MASANPHAM)
        GROUP BY t.MASANPHAM
        ORDER BY t.MASANPHAM DESC, t.GIABAN ASC
        LIMIT 5";
        $result = mysqli_query($this->con, $qr) or die(mysqli_error($this->con));
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getAllMoi()
    {
        $qr = "SELECT sanpham.*, t.*, GROUP_CONCAT(format(t.GIABAN, 'c', 'vi-VI') ORDER BY t.GIABAN ASC SEPARATOR ' - ') AS GIABAN
        FROM trongluong t
        JOIN sanpham ON sanpham.MASANPHAM = t.MASANPHAM
        WHERE
            t.GIABAN = (SELECT MIN(t2.GIABAN) FROM trongluong t2 WHERE t2.MASANPHAM = t.MASANPHAM) OR
            t.GIABAN = (SELECT MAX(t2.GIABAN) FROM trongluong t2 WHERE t2.MASANPHAM = t.MASANPHAM)
        GROUP BY t.MASANPHAM
        ORDER BY t.MASANPHAM DESC, t.GIABAN ASC";
        $result = mysqli_query($this->con, $qr) or die(mysqli_error($this->con));
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSanPhamBanChay()
    {
        $qr = "SELECT sanpham.*, t.*, GROUP_CONCAT(format(t.GIABAN, 'c', 'vi-VI') ORDER BY t.`GIABAN` ASC SEPARATOR ' - ') AS `GIABAN`
        FROM trongluong t
        JOIN sanpham ON sanpham.MASANPHAM = t.MASANPHAM
        WHERE
            t.`GIABAN` = (SELECT MIN(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`) OR
            t.`GIABAN` = (SELECT MAX(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`)
        GROUP BY t.`MASANPHAM`
        ORDER BY t.`DABAN` DESC
        LIMIT 5";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getAllBanChay()
    {
        $qr = "SELECT sanpham.*, t.*, GROUP_CONCAT(format(t.GIABAN, 'c', 'vi-VI') ORDER BY t.`GIABAN` ASC SEPARATOR ' - ') AS `GIABAN`
        FROM trongluong t
        JOIN sanpham ON sanpham.MASANPHAM = t.MASANPHAM
        WHERE
            t.`GIABAN` = (SELECT MIN(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`) OR
            t.`GIABAN` = (SELECT MAX(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`)
        GROUP BY t.`MASANPHAM`
        ORDER BY t.`DABAN` DESC";
        $result = mysqli_query($this->con, $qr) or die(mysqli_error($this->con));
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSanPhamCungLoai($maLoai, $maSP)
    {
        //select tất cả sản phẩm cùng loại ngoại trừ sản phẩm có mã đang được mở
        $qr = "SELECT * FROM SANPHAM WHERE MALOAI = '$maLoai' EXCEPT SELECT * FROM SANPHAM WHERE MASANPHAM = '$maSP'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSanPhamThuocLoai($maLoai)
    {
        $qr = "SELECT * FROM SANPHAM WHERE MALOAI = '$maLoai'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSanPhamNgauNhien()
    {
        $qr = "SELECT sanpham.*, t.*, GROUP_CONCAT(format(t.GIABAN, 'c', 'vi-VI') ORDER BY t.`GIABAN` ASC SEPARATOR ' - ') AS `GIABAN`
        FROM trongluong t
        JOIN sanpham ON sanpham.MASANPHAM = t.MASANPHAM
        WHERE
            t.`GIABAN` = (SELECT MIN(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`) OR
            t.`GIABAN` = (SELECT MAX(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`)
        GROUP BY t.`MASANPHAM`
        ORDER BY RAND()
        LIMIT 5";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSanPhamHot()
    {
        $qr = "SELECT sanpham.*, t.*, GROUP_CONCAT(format(t.GIABAN, 'c', 'vi-VI') ORDER BY t.`GIABAN` ASC SEPARATOR ' - ') AS `GIABAN`
        FROM trongluong t
        JOIN sanpham ON sanpham.MASANPHAM = t.MASANPHAM
        JOIN sanphamhot ON sanphamhot.MASANPHAM = t.MASANPHAM
        WHERE
            t.`GIABAN` = (SELECT MIN(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`) OR
            t.`GIABAN` = (SELECT MAX(t2.`GIABAN`) FROM trongluong t2 WHERE t2.`MASANPHAM` = t.`MASANPHAM`)
        GROUP BY t.`MASANPHAM`
        LIMIT 5";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function addSanPhamHot($maSP)
    {
        $qr = "INSERT INTO SANPHAMHOT VALUES ('$maSP')";
        $this->con->begin_transaction();
        if (mysqli_query($this->con, $qr)) {
            $this->con->commit();
            return true;
        }
        return false;
    }

    function deleteSanPhamHot($maSP)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "DELETE FROM SANPHAMHOT WHERE MASANPHAM = '$maSP'";
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return $result;
    }

    function adminGetSanPhamHot($tenSP)
    {
        $qr = "SELECT * FROM sanphamhot";
        if ($tenSP != "") {
            $qr .= " JOIN sanpham ON sanpham.MASANPHAM = sanphamhot.MASANPHAM AND sanpham.TENSANPHAM LIKE '%$tenSP%'";
        }
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function editSanPham($maSP, $maLoai, $tenSP, $tenKD, $hinhSP, $ghichu)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "UPDATE SANPHAM SET ";
            if (!empty($hinhSP)) {
                $qr .= " HINHSANPHAM = '$hinhSP', ";
            }
            $qr .= " MALOAI = '$maLoai', TENSANPHAM = '$tenSP', TENSANPHAMKHONGDAU = '$tenKD', GHICHU = '$ghichu'
            WHERE MASANPHAM = '$maSP'";
            if (mysqli_query($this->con, $qr)) {
                // $result = true;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return $result;
    }

    function addSanPham($maLoai, $tenSP, $tenKD, $hinhSP, $ghichu)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "INSERT INTO SANPHAM VALUES ('','$maLoai','$tenSP','$tenKD','$hinhSP','$ghichu',0)";
            if (mysqli_query($this->con, $qr)) {
                $result = false;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return $result;
    }

    function getSanPhamTheoSoLuong($tenSP)
    {
        $qr =
            "SELECT
            sanpham.*,
            SUM(trongluong.SOLUONG) AS 'SOLUONG'
        FROM
            `sanpham`,
            trongluong
        WHERE
            sanpham.MASANPHAM = trongluong.MASANPHAM";
        if ($tenSP != "") {
            $qr .= " AND SANPHAM.TENSANPHAM LIKE '%$tenSP%'";
        }
        $qr .= " GROUP BY
                    sanpham.MASANPHAM
                ORDER BY
                    SUM(trongluong.SOLUONG) ASC";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function adminGetSoLuongDaBan($tenSP)
    {
        $qr =
            "SELECT
                sanpham.*,
                SUM(chitiethoadon.SOLUONG) AS 'DABAN'
            FROM
                hoadon
            LEFT JOIN chitiethoadon ON hoadon.MAHOADON = chitiethoadon.MAHOADON AND hoadon.GHICHU = 'Đã duyệt'
            JOIN trongluong ON trongluong.MATRONGLUONG = chitiethoadon.MATRONGLUONG
            JOIN sanpham ON sanpham.MASANPHAM = trongluong.MASANPHAM";
        if ($tenSP != "") {
            $qr .= " WHERE SANPHAM.TENSANPHAM LIKE '%$tenSP%'";
        }
        $qr .= " GROUP BY
                sanpham.MASANPHAM";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function adminSPDB($start, $end)
    {
        $qr = "SELECT
                sanpham.MASANPHAM,
                sanpham.TENSANPHAM,
                SUM(chitiethoadon.SOLUONG) AS 'SOLUONG',
                chitiethoadon.DONGIA,
                SUM(chitiethoadon.TONGDONGIA) AS 'TONGDONGIA'
            FROM
                hoadon
            JOIN chitiethoadon ON chitiethoadon.MAHOADON = hoadon.MAHOADON
            JOIN trongluong ON trongluong.MATRONGLUONG = chitiethoadon.MATRONGLUONG
            JOIN sanpham ON sanpham.MASANPHAM = trongluong.MASANPHAM
            WHERE
                hoadon.GHICHU = 'Đã duyệt' AND hoadon.NGAYMUA BETWEEN '$start' AND '$end'
            GROUP BY
                sanpham.MASANPHAM";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }
}
