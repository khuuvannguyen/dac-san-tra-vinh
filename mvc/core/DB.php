<?php
class DB
{
    public $con;
    protected $host = "localhost";
    protected $user = "root";
    protected $password = "";
    protected $database = "dacsan_travinh";

    function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        mysqli_query($this->con, "SET NAMES 'utf8'");
    }
}
