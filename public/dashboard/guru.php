<?php
require_once "../../app/Views/Main.php";
require_once "../../app/Controllers/Koneksi.php";
$halaman = new Main;
$halaman->HalamanGuru();
$akses = new Koneksi;
$akses->CekSesi();
