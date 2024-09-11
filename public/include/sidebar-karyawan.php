<?php
if ($_SESSION['role'] == 'ROL001') {
    $hak_akses = 'Administrator';
    $cek1 = mysqli_query($this->koneksi->link, "SELECT *FROM admin where nik_admin = '" . $_SESSION['nik'] . "'");
    $data1 = mysqli_fetch_array($cek1);
    $img = $data1['img'];
} elseif ($_SESSION['role'] == 'ROL002') {
    $hak_akses = 'Guru';
    $cek2 = mysqli_query($this->koneksi->link, "SELECT *FROM guru where nik_guru = '" . $_SESSION['nik'] . "'");
    $data2 = mysqli_fetch_array($cek2);
    $img = $data2['img'];
} elseif ($_SESSION['role'] == 'ROL003') {
    $hak_akses = 'Karyawan';
    $cek3 = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan where nik_karyawan = '" . $_SESSION['nik'] . "'");
    $data3 = mysqli_fetch_array($cek3);
    $img = $data3['img'];
}

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../dashboard/karyawan" class="brand-link">
        <img src="../assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-Absensi Online</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../profile/<?= $img ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="../dashboard/karyawan" class="d-block"><?= $hak_akses; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="../dashboard/karyawan" class="nav-link <?php if ($activePage == "Karyawan") {
                                                                        echo "active";
                                                                    } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-header">SECURITY</li>
                <li class="nav-item">
                    <a href="../absensi/absen-karyawan" class="nav-link <?php if ($activePage == "AbsensiKaryawan") {
                                                                            echo "active";
                                                                        } ?>">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>
                            Absensi
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>