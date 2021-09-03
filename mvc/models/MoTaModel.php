<?php
class MoTaModel extends DB
{
    function getMoTa($maSP)
    {
        $qr = "SELECT * FROM MOTASANPHAM WHERE MASANPHAM='$maSP'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function addMoTa($moTa, $maSP)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "INSERT INTO MOTASANPHAM VALUES (null,'$maSP','$moTa')";
            if (mysqli_query($this->con, $qr)) {
                $result = true;
            }
            $this->con->commit();
        } catch (Exception $e) {
            $this->con->rollback();
        }
        
        return $result;
    }

    function editMoTa($moTaMoi, $maSP)
    {
        $result = false;
        try {
            $this->con->begin_transaction();
            $qr = "UPDATE MOTASANPHAM SET MOTA = '$moTaMoi' WHERE MASANPHAM = '$maSP'";
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
