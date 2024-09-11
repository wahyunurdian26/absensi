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
    <a href="../dashboard/admin" class="brand-link">
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
                <a href="../dashboard/admin" class="d-block"><?= $hak_akses; ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="../dashboard/admin" class="nav-link <?php if ($activePage == "Administrator") {
                                                                        echo "active";
                                                                    } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">MASTER DATA</li>
                <li class="nav-item <?php if ($master == "Master") {
                                        echo "menu-open";
                                    } ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Management Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../pelajaran/mata-pelajaran" class="nav-link <?php if ($activePage == "MataPelajaran") {
                                                                                        echo "active";
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mata Pelajaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../jurusan/data-jurusan" class="nav-link <?php if ($activePage == "Jurusan") {
                                                                                    echo "active";
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jurusan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../jabatan/data-jabatan" class="nav-link <?php if ($activePage == "Jabatan") {
                                                                                    echo "active";
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jabatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../jadwal/data-jadwal" class="nav-link <?php if ($activePage == "DataJadwal") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item <?php if ($master == "Master1") {
                                        echo "menu-open";
                                    } ?>">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Pengguna
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../admin/data-admin" class="nav-link <?php if ($activePage == "DataAdmin") {
                                                                                echo "active";
                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../guru/data-guru" class="nav-link <?php if ($activePage == "DataGuru") {
                                                                            echo "active";
                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../karyawan/data-karyawan" class="nav-link <?php if ($activePage == "DataKaryawan") {
                                                                                    echo "active";
                                                                                } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Karyawan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">SECURITY</li>
                <li class="nav-item <?php if ($master == "Master2") {
                                        echo "menu-open";
                                    } ?>">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>
                            Absensi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="../absensi/data-absensi-guru" class="nav-link <?php if ($activePage == "DataAbsensiGuru") {
                                                                                        echo "active";
                                                                                    } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../absensi/data-absensi-karyawan" class="nav-link <?php if ($activePage == "DataAbsensiKaryawan") {
                                                                                            echo "active";
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Karyawan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../public/absensi/reset-absensi.php" class="nav-link" id="btn-confirm-reset-data">
                                <i class="nav-icon fa fa-refresh fa-spin"></i>
                                <p>
                                    Reset Data Absensi
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>