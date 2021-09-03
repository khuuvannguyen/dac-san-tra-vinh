<?php
class BaiVietModel extends DB
{

    function findById($id){
        $qr = "SELECT * FROM BAIVIET WHERE MABAIVIET = '$id'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function updateView($ten)
    {
        $qr = "SELECT * FROM BAIVIET WHERE TENBAIVIET = '$ten'";
        $baiviet = mysqli_fetch_array(mysqli_query($this->con, $qr));
        $luotxem = (int)$baiviet["LUOTXEM"] + 1;
        $qr = "UPDATE BAIVIET SET LUOTXEM = $luotxem WHERE MABAIVIET = '" . $baiviet["MABAIVIET"] . "'";
        $this->con->begin_transaction();
        if (mysqli_query($this->con, $qr)) {
            $this->con->commit();
            return true;
        }
        return false;
    }

    function getAll()
    {
        $qr = "SELECT * FROM BAIVIET";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function findByName($name)
    {
        $qr = "SELECT * FROM BAIVIET WHERE TENBAIVIET = '$name'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getNews()
    {
        $qr = "SELECT * FROM BAIVIET ORDER BY MABAIVIET DESC LIMIT 5";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    // function getOne($)

    function addNew($ten, $noidung)
    {
        // $result = false;
        // try {
            // $this->con->begin_transaction();
            $qr = "INSERT INTO BAIVIET VALUES ('','$ten','$noidung','')";
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            // $this->con->commit();
        // } catch (Exception $e) {
            // $this->con->rollback();
        // }

        // return $result;
    }

    function edit($ma, $tenMoi, $noidungMoi)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "UPDATE BAIVIET SET TENBAIVIET = '$tenMoi', NOIDUNG = '$noidungMoi' WHERE MABAIVIET = '$ma'";
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }

        return $result;
    }

    function delete($ma)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "DELETE FROM BAIVIET WHERE MABAIVIET = '$ma'";
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }

        return $result;
    }
}
