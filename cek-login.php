<?php
require_once "app/Controllers/Login.php";
require_once "app/Controllers/Koneksi.php";
$cekuser = new Login;
$cekuser->DoLogin();
