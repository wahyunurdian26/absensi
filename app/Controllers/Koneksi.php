<?php
require_once "Login.php";
class Koneksi
{
    var $username, $password, $host, $namaDB, $link;

    function __construct()
    {
        $this->username = 'root';
        $this->password = '';
        $this->host = 'localhost';
        $this->namaDB = 'db_absensi';
        $this->link = mysqli_connect("$this->host", "$this->username", "$this->password", "$this->namaDB");
    }

    function BukaDB()
    {
        if (!$this->link) {
            echo "Error: Unable to connect to MySQL" . PHP_EOL;
            exit;
        }
    }

    function TutupDB()
    {
        mysqli_close($this->link);
        if (!$this->link) {
            echo "Error: Unable to close connection MySQL" . PHP_EOL;
        }
    }

    function CekSesi()
    {
        error_reporting(0);
        if ($_SESSION['role'] == '') {
            echo "<script>window.open('../.././','_top');</script>";
            exit();
        }
    }
}
