<?php
require_once "../../app/Views/Main.php";
require_once "../../app/Controllers/Koneksi.php";
$halaman = new Main;
$halaman->HalamanAdmin();
$akses = new Koneksi;
$akses->CekSesi();
