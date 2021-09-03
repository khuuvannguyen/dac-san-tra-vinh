<?php
class TaiKhoanModel extends DB
{

    function doiMatKhau($ID, $matKhauCu, $matKhauMoi)
    {
        try {
            $qr = "SELECT MATKHAU FROM TAIKHOAN WHERE IDTAIKHOAN = '$ID'";
            $result = mysqli_query($this->con, $qr);
            if (mysqli_num_rows($result)) {
                $row = mysqli_fetch_array($result);
                $hash = $row["MATKHAU"];
                //kiểm tra mật khẩu
                if (password_verify($matKhauCu, $hash)) {
                    $matKhauMoi = password_hash($matKhauMoi, PASSWORD_DEFAULT);
                    $this->con->begin_transaction();
                    $qr = "UPDATE TAIKHOAN SET MATKHAU = '$matKhauMoi'";
                    if (mysqli_query($this->con, $qr)) {
                        $this->con->commit();

                        return true;
                    }
                }
            }
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }

    function dangXuat()
    {
        try {
            unset($_SESSION["IDTAIKHOAN"]);
            unset($_SESSION["CHUCVU"]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function dangNhap($tenTaiKhoan, $matKhau)
    {
        //lấy mật khẩu từ db lên để kiểm tra
        $qr = "SELECT * FROM TAIKHOAN WHERE TENDANGNHAP = '$tenTaiKhoan'";
        $result = mysqli_query($this->con, $qr);

        //xác nhận tài khoản nhập vào
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_array($result);

            //lấy mật khẩu
            $hash = $row["MATKHAU"];

            //Kiểm tra mật khẩu
            if (password_verify($matKhau, $hash)) {
                //đúng
                $qr = "SELECT * FROM TAIKHOAN WHERE TENDANGNHAP = '$tenTaiKhoan'";
                $row = mysqli_fetch_array(mysqli_query($this->con, $qr));
                $_SESSION["role"] = $row["CHUCVU"];
                $_SESSION["id"] = $row["IDTAIKHOAN"];
                return true;
            }
        }
        return false;
    }

    function getAll()
    {
        $qr = "SELECT IDTAIKHOAN, TENDANGNHAP, CHUCVU FROM TAIKHOAN";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {

            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function getSomes($tenDN)
    {
        $qr = "SELECT * FROM TAIKHOAN WHERE TENDANGNHAP LIKE %$tenDN%";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {

            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    function addTaiKhoan($tenDN, $matkhau, $chucVu, $ghichu)
    {
        try {
            $this->con->begin_transaction();
            $matkhau = password_hash($matkhau, PASSWORD_DEFAULT);
            $qr = "INSERT INTO TAIKHOAN VALUES (null,'$tenDN','$matkhau','$chucVu','$ghichu')";
            if (mysqli_query($this->con, $qr)) {
                $this->con->commit();

                return true;
            }
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }

    function editMatKhau($tenDN, $matKhau)
    {
        try {
            $this->con->begin_transaction();
            $matKhau = password_hash($matKhau, PASSWORD_DEFAULT);
            $qr = "UPDATE TAIKHOAN SET MATKHAU = '$matKhau' WHERE TENDANGNHAP = '$tenDN'";
            if (mysqli_query($this->con, $qr)) {
                $this->con->commit();

                return true;
            }
        } catch (Exception $e) {
            $this->con->rollback();
        }
        return false;
    }

    function getIdByName($name)
    {
        $qr = "SELECT * FROM TAIKHOAN WHERE TENDANGNHAP = '$name'";
        $result = mysqli_query($this->con, $qr);
        $json = array();
        while ($row = mysqli_fetch_array($result)) {

            $json[] = $row;
        }
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }
}
