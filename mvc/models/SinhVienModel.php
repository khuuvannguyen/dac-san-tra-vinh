<?php
class SinhVienModel extends DB
{
    function getSinhVien()
    {
        $query = "SELECT * FROM SINHVIEN";
        $result = mysqli_query($this->con, $query);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }
        
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getA()
    {
        return "Tên là A";
    }
}
