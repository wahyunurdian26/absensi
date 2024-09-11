<?php
require_once "../../public/include/index.php";
require_once "../../app/Controllers/Login.php";
error_reporting(0);
class Main extends Login
{
    public function HalamanAdmin()
    { ?>
        <?php
        $activePage = 'Administrator';
        if ($_SESSION['role'] == 'ROL001') {
            $hak_akses = 'Administrator';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $hak_akses = 'Guru';
        } elseif ($_SESSION['role'] == 'ROL003') {
            $hak_akses = 'Karyawan';
        }
        require_once "../../app/Controllers/Login.php";
        $success = new Login;
        $success->getSuccess();
        if (@$_SESSION['berhasil']) {
            echo " <script>
                        Swal.fire({icon: 'success', title: 'Success', text: '$_SESSION[berhasil]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['berhasil']);
        }

        if (@$_SESSION['gagal']) {
            echo " <script>
                        Swal.fire({icon: 'error', title: 'Gagal', text: '$_SESSION[gagal]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['gagal']);
        }
        $cek_mata_palajaran = mysqli_query($this->koneksi->link, "SELECT *FROM pelajaran");
        $jml_pelajaran = mysqli_num_rows($cek_mata_palajaran);
        ?>
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once "../../public/include/navbar.php"; ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once "../../public/include/sidebar-admin.php"; ?>
            <!-- End-Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 fw-bold">Selamat Datang di Aplikasi <b>E-Absensi </b></h1>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <?php
                $cek_kehadiran_guru = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN guru ON absensi.nik = guru.nik_guru INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal");
                $jml_kehadiran_guru = mysqli_num_rows($cek_kehadiran_guru);
                $cek_kehadiran_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN karyawan ON absensi.nik = karyawan.nik_karyawan INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal");
                $jml_kehadiran_karyawan = mysqli_num_rows($cek_kehadiran_karyawan);
                ?>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-graduation-cap"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Absen Guru</span>
                                        <span class="info-box-number"> <?= $jml_kehadiran_guru; ?> </span>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Absen Karyawan</span>
                                        <span class="info-box-number"><?= $jml_kehadiran_karyawan; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>

                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="../../public/pelajaran/mata-pelajaran" style="color: #212529;">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-clipboard-list"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Mata Pelajaran</span>
                                            <span class="info-box-number"><?= $jml_pelajaran; ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </a>
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-key"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Login Sebagai</span>
                                        <span class="info-box-number"><?= $hak_akses; ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>


                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card card-primary card-outline">
                                    <div class="card-header border-0">
                                        <div class="d-flex justify-content-between">
                                            <h3 class="card-title">Absensi Guru dan Karyawan Tahun <?php echo date('Y') ?></h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="position-relative mb-4">
                                            <canvas id="sales-chart" height="125"></canvas>
                                        </div>
                                        <script>
                                            <?php
                                            $nama_bulan = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
                                            for ($bulan = 1; $bulan < 13; $bulan++) {
                                                $absensi_1 = mysqli_query($this->koneksi->link, "select * from absensi where MONTH(tgl_absen)='$bulan' and status = 'Hadir'");
                                                $jumlah_absensi_hadir[] = mysqli_num_rows($absensi_1);
                                                $absensi_2 = mysqli_query($this->koneksi->link, "select * from absensi where MONTH(tgl_absen)='$bulan' and status = 'Tidak Hadir'");
                                                $jumlah_absensi_tidak_hadir[] = mysqli_num_rows($absensi_2);
                                                $absensi_3 = mysqli_query($this->koneksi->link, "select * from absensi where MONTH(tgl_absen)='$bulan' and status = 'Izin'");
                                                $jumlah_absensi_izin[] = mysqli_num_rows($absensi_3);
                                            }
                                            ?>
                                            $(function() {
                                                'use strict'

                                                var ticksStyle = {
                                                    fontColor: '#495057',
                                                    fontStyle: 'bold'
                                                }

                                                var mode = 'index'
                                                var intersect = true
                                                var $salesChart = $('#sales-chart')
                                                var salesChart = new Chart($salesChart, {
                                                    type: 'bar',
                                                    data: {
                                                        labels: <?php echo json_encode($nama_bulan); ?>,
                                                        datasets: [{
                                                                backgroundColor: '#007bff',
                                                                borderColor: '#007bff',
                                                                data: <?php echo json_encode($jumlah_absensi_hadir); ?>
                                                            },
                                                            {
                                                                backgroundColor: '#FF8C00',
                                                                borderColor: '#FF8C00',
                                                                data: <?php echo json_encode($jumlah_absensi_izin); ?>
                                                            },
                                                            {
                                                                backgroundColor: '#8B0000',
                                                                borderColor: '#8B0000',
                                                                data: <?php echo json_encode($jumlah_absensi_tidak_hadir); ?>
                                                            }
                                                        ]
                                                    },
                                                    options: {
                                                        maintainAspectRatio: false,
                                                        tooltips: {
                                                            mode: mode,
                                                            intersect: intersect
                                                        },
                                                        hover: {
                                                            mode: mode,
                                                            intersect: intersect
                                                        },
                                                        legend: {
                                                            display: false
                                                        },
                                                        scales: {
                                                            yAxes: [{
                                                                // display: false,
                                                                gridLines: {
                                                                    display: true,
                                                                    lineWidth: '4px',
                                                                    color: 'rgba(0, 0, 0, .2)',
                                                                    zeroLineColor: 'transparent'
                                                                },

                                                            }],
                                                            xAxes: [{
                                                                display: true,
                                                                gridLines: {
                                                                    display: false
                                                                },
                                                                ticks: ticksStyle
                                                            }],

                                                        }
                                                    }
                                                })
                                            })
                                        </script>

                                        <div class="d-flex flex-row justify-content-end">
                                            <span class="mr-2">
                                                <i class="fas fa-square text-primary"></i> Hadir
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-square" style="color: #FF8C00;"></i> Izin
                                            </span>
                                            <span>
                                                <i class="fas fa-square" style="color: #8B0000;"></i> Tidak Hadir
                                            </span>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <?php
                            $cek_data_admin = mysqli_query($this->koneksi->link, "SELECT *FROM admin INNER JOIN jabatan ON admin.id_jabatan = jabatan.id_jabatan where admin.nik_admin = '" . $_SESSION['nik'] . "'");
                            $row = mysqli_fetch_array($cek_data_admin); ?>
                            <div class="col-lg-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="../../public/profile/<?= $row['img'] ?>" alt="User profile picture">
                                        </div>
                                        <h3 class="profile-username text-center"><?= $row['nama_admin']; ?></h3>
                                        <p class="text-muted text-center"><?= $row['nik_admin']; ?></p>
                                        <p class="text-muted text-center"><b><?= $row['nama_jabatan']; ?></b></p>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row mb-4">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Kegiatan</h3>
                                    </div>

                                    <form action="../../public/kegiatan/simpan.php" method="POST">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-label">Keterangan Kegiatan</div>
                                                <textarea name="kegiatan" class="form-control" cols="30" rows="2" placeholder="Kegiatan" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-label">Tanggal Kegiatan</div>
                                                <input type="date" class="form-control" name="mulai" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                                <a href="../../public/kegiatan/kegiatan">
                                                    <button type="button" class="btn btn-primary btn-sm float-right">Detail</button>
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="container">
                                        <div class="mb-2" id="calendar"></div>
                                    </div>
                                </div>


                            </div>

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-transparent">
                                        <h3 class="card-title">Absensi Guru Hari Ini Tanggal <?php echo tgl_indo(date('Y-m-d')); ?></h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example2" class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Guru</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Pulang</th>
                                                        <th>Absen Masuk</th>
                                                        <th>Absen Pulang</th>
                                                        <th>Terlambat</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $date_sekarang = date('Y-m-d');
                                                    $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN guru ON absensi.nik = guru.nik_guru INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal where absensi.tgl_absen = '" . $date_sekarang . "'");
                                                    while ($row_absen_guru = mysqli_fetch_array($cek_absensi)) {
                                                        $jam_masuk = date("H:i", strtotime($row_absen_guru['jam_masuk']));
                                                        $jam_pulang = date("H:i", strtotime($row_absen_guru['jam_pulang']));
                                                        if ($row_absen_guru['status'] == 'Hadir') {
                                                            $izin = '<small class="badge badge-success">Hadir</small>';
                                                        } elseif ($row_absen_guru['status'] == 'Izin') {
                                                            $izin = '<small class="badge badge-warning">Izin</small>';
                                                        }
                                                        $tgl_absensi = tgl_indo(date("Y-m-d", strtotime($row_absen_guru['tgl_absen'])));
                                                    ?>
                                                        <tr>
                                                            <td><?= $row_absen_guru['nama_guru']; ?></td>
                                                            <td><?= $jam_masuk; ?></td>
                                                            <td><?= $jam_pulang; ?></td>
                                                            <td style="color: green;"><?= $row_absen_guru['absen_masuk']; ?></td>
                                                            <td style="color: red;"><?= $row_absen_guru['absen_pulang']; ?></td>
                                                            <td><?= $row_absen_guru['terlambat']; ?></td>
                                                            <td><?= $tgl_absensi; ?></td>
                                                            <td><?= $izin; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-transparent">
                                        <h3 class="card-title">Absensi Karyawan Hari Ini Tanggal <?php echo tgl_indo(date('Y-m-d')); ?></h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Karyawan</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Pulang</th>
                                                        <th>Absen Masuk</th>
                                                        <th>Absen Pulang</th>
                                                        <th>Terlambat</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $date_sekarang1 = date('Y-m-d');
                                                    $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN karyawan ON absensi.nik = karyawan.nik_karyawan INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal where absensi.tgl_absen = '" . $date_sekarang1 . "'");
                                                    while ($row_absen_karyawan = mysqli_fetch_array($cek_absensi)) {
                                                        $jam_masuk = date("H:i", strtotime($row_absen_karyawan['jam_masuk']));
                                                        $jam_pulang = date("H:i", strtotime($row_absen_karyawan['jam_pulang']));
                                                        if ($row_absen_karyawan['status'] == 'Hadir') {
                                                            $izin = '<small class="badge badge-success">Hadir</small>';
                                                        } elseif ($row_absen_karyawan['status'] == 'Izin') {
                                                            $izin = '<small class="badge badge-warning">Izin</small>';
                                                        }
                                                        $tgl_absensi = tgl_indo(date("Y-m-d", strtotime($row_absen_karyawan['tgl_absen'])));
                                                    ?>
                                                        <tr>
                                                            <td><?= $row_absen_karyawan['nama_karyawan']; ?></td>
                                                            <td><?= $jam_masuk; ?></td>
                                                            <td><?= $jam_pulang; ?></td>
                                                            <td style="color: green;"><?= $row_absen_karyawan['absen_masuk']; ?></td>
                                                            <td style="color: red;"><?= $row_absen_karyawan['absen_pulang']; ?></td>
                                                            <td><?= $row_absen_karyawan['terlambat']; ?></td>
                                                            <td><?= $tgl_absensi; ?></td>
                                                            <td><?= $izin; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once "../../public/include/footer.php"; ?>
            <!-- End-Main Footer -->
        </div>
        <!-- ./wrapper -->

    <?php }

    public function HalamanGuru()
    { ?>
        <?php
        $activePage = 'Guru';
        if ($_SESSION['role'] == 'ROL001') {
            $hak_akses = 'Administrator';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $hak_akses = 'Guru';
        } elseif ($_SESSION['role'] == 'ROL003') {
            $hak_akses = 'Karyawan';
        }
        require_once "../../app/Controllers/Login.php";
        $success = new Login;
        $success->getSuccess();
        if (@$_SESSION['berhasil']) {
            echo " <script>
                        Swal.fire({icon: 'success', title: 'Success', text: '$_SESSION[berhasil]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['berhasil']);
        }

        if (@$_SESSION['gagal']) {
            echo " <script>
                        Swal.fire({icon: 'error', title: 'Gagal', text: '$_SESSION[gagal]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['gagal']);
        }
        ?>
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once "../../public/include/navbar.php"; ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once "../../public/include/sidebar-guru.php"; ?>
            <!-- End-Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 fw-bold">Selamat Datang di Aplikasi <b>E-Absensi </b></h1>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">
                            <?php
                            $cek_profile_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru where nik_guru = '" . $_SESSION['nik'] . "'");
                            $profile = mysqli_fetch_array($cek_profile_guru);
                            $cek_kehadiran = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and status = 'Hadir'");
                            $jml_kehadiran = mysqli_num_rows($cek_kehadiran);
                            $cek_izin = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and status = 'Izin'");
                            $jml_izin = mysqli_num_rows($cek_izin);
                            ?>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="../../public/profile/<?= $profile['img'] ?>" alt="User profile picture">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <p>Kehadiran</p>
                                        <h3><?= $jml_kehadiran; ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <a href="../../public/absensi/absen-guru" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>

                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <p>Izin</p>
                                        <h3><?= $jml_izin; ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <a href="../../public/absensi/absen-guru" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <p>Login Sebagai</p>
                                        <h3>Guru</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <a href="../../public/user/profile" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Data Guru</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nama Lengkap</th>
                                                    <th>L/P</th>
                                                    <th>NIK</th>
                                                    <th>NUPTK</th>
                                                    <th>Jabatan</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Jurusan</th>
                                                    <th>Induk</th>
                                                    <th>TMT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN jabatan ON guru.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON guru.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON guru.nik_guru = user_login.nik where guru.nik_guru = '" . $_SESSION['nik'] . "'");
                                                while ($row = mysqli_fetch_array($data_guru)) {
                                                ?>
                                                    <tr>
                                                        <td><?= $row['nama_guru']; ?></td>
                                                        <td><?= $row['jk']; ?></td>
                                                        <td><?= $row['nik_guru']; ?></td>
                                                        <td><?= $row['nuptk']; ?></td>
                                                        <td><?= $row['nama_jabatan']; ?></td>
                                                        <td><?= $row['mata_pelajaran']; ?></td>
                                                        <td><?= $row['nama_jurusan']; ?></td>
                                                        <td><?= $row['induk']; ?></td>
                                                        <td><?= $row['tmt']; ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Jadwal Hari dan Jam Kerja</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Jam Masuk</th>
                                                    <th>Jam Istirahat</th>
                                                    <th>Jam Pulang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cek_data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal");
                                                while ($row = mysqli_fetch_array($cek_data_karyawan)) {
                                                    $jam1 = date("H:i", strtotime($row['jam_masuk']));
                                                    $jam2 = date("H:i", strtotime($row['jam_istirahat']));
                                                    $jam3 = date("H:i", strtotime($row['jam_pulang']));
                                                ?>
                                                    <tr>
                                                        <td><?= $row['hari']; ?></td>
                                                        <td>
                                                            <small class="text-success mr-1">
                                                                <i class="fas fa-arrow-down mr-1"></i>
                                                                <i class="fas fa-clock-o"></i>
                                                            </small>
                                                            <?= $jam1; ?> AM
                                                        </td>
                                                        <td>
                                                            <small class="text-success mr-1">
                                                                <i class="fas fa-clock-o"></i>
                                                            </small>
                                                            <?= $jam2; ?> AM
                                                        </td>
                                                        <td>
                                                            <small class="text-danger mr-1">
                                                                <i class="fas fa-arrow-up mr-1"></i>
                                                                <i class="fas fa-clock-o"></i>
                                                            </small>
                                                            <?= $jam3; ?> AM
                                                        </td>
                                                        <td><?= $row['nama_jabatan']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="container">
                                        <div class="mb-2" id="calendar" style="text-align: center;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once "../../public/include/footer.php"; ?>
            <!-- End-Main Footer -->
        </div>
        <!-- ./wrapper -->

    <?php }

    public function HalamanKaryawan()
    { ?>
        <?php
        $activePage = 'Karyawan';
        if ($_SESSION['role'] == 'ROL001') {
            $hak_akses = 'Administrator';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $hak_akses = 'Guru';
        } elseif ($_SESSION['role'] == 'ROL003') {
            $hak_akses = 'Karyawan';
        }
        require_once "../../app/Controllers/Login.php";
        $success = new Login;
        $success->getSuccess();
        if (@$_SESSION['berhasil']) {
            echo " <script>
                        Swal.fire({icon: 'success', title: 'Success', text: '$_SESSION[berhasil]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['berhasil']);
        }

        if (@$_SESSION['gagal']) {
            echo " <script>
                        Swal.fire({icon: 'error', title: 'Gagal', text: '$_SESSION[gagal]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['gagal']);
        }
        ?>
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once "../../public/include/navbar.php"; ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once "../../public/include/sidebar-karyawan.php"; ?>
            <!-- End-Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 fw-bold">Selamat Datang di Aplikasi <b>E-Absensi </b></h1>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Info boxes -->
                        <div class="row">
                            <?php
                            $cek_profile_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan where nik_karyawan = '" . $_SESSION['nik'] . "'");
                            $profile = mysqli_fetch_array($cek_profile_karyawan);
                            $cek_kehadiran = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and status = 'Hadir'");
                            $jml_kehadiran = mysqli_num_rows($cek_kehadiran);
                            $cek_izin = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and status = 'Izin'");
                            $jml_izin = mysqli_num_rows($cek_izin);
                            ?>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="card card-primary card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="profile-user-img img-fluid img-circle" src="../../public/profile/<?= $profile['img'] ?>" alt="User profile picture">
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <p>Kehadiran</p>
                                        <h3><?= $jml_kehadiran; ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <a href="../../public/absensi/absen-karyawan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>

                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <p>Izin</p>
                                        <h3><?= $jml_izin; ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <a href="../../public/absensi/absen-karyawan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <p>Login Sebagai</p>
                                        <h3>Karyawan</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <a href="../../public/user/profile" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Data Karyawan</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Nama Lengkap</th>
                                                    <th>L/P</th>
                                                    <th>NIK</th>
                                                    <th>NUPTK</th>
                                                    <th>Jabatan</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Jurusan</th>
                                                    <th>Induk</th>
                                                    <th>TMT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON karyawan.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON karyawan.nik_karyawan = user_login.nik where karyawan.nik_karyawan = '" . $_SESSION['nik'] . "'");
                                                while ($row = mysqli_fetch_array($data_karyawan)) {
                                                    $date = tgl_indo(date("Y-m-d", strtotime($row['tmt'])));
                                                ?>
                                                    <tr>
                                                        <td><?= $row['nama_karyawan']; ?></td>
                                                        <td><?= $row['jk']; ?></td>
                                                        <td><?= $row['nik_karyawan']; ?></td>
                                                        <td><?= $row['nuptk']; ?></td>
                                                        <td><?= $row['nama_jabatan']; ?></td>
                                                        <td><?= $row['mata_pelajaran']; ?></td>
                                                        <td><?= $row['nama_jurusan']; ?></td>
                                                        <td><?= $row['induk']; ?></td>
                                                        <td><?= $date; ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Jadwal Hari dan Jam Kerja</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-striped table-valign-middle">
                                            <thead>
                                                <tr>
                                                    <th>Hari</th>
                                                    <th>Jam Masuk</th>
                                                    <th>Jam Istirahat</th>
                                                    <th>Jam Pulang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cek_data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal");
                                                while ($row = mysqli_fetch_array($cek_data_karyawan)) {
                                                    $jam1 = date("H:i", strtotime($row['jam_masuk']));
                                                    $jam2 = date("H:i", strtotime($row['jam_istirahat']));
                                                    $jam3 = date("H:i", strtotime($row['jam_pulang']));
                                                ?>
                                                    <tr>
                                                        <td><?= $row['hari']; ?></td>
                                                        <td>
                                                            <small class="text-success mr-1">
                                                                <i class="fas fa-arrow-down mr-1"></i>
                                                                <i class="fas fa-clock-o"></i>
                                                            </small>
                                                            <?= $jam1; ?> AM
                                                        </td>
                                                        <td>
                                                            <small class="text-success mr-1">
                                                                <i class="fas fa-clock-o"></i>
                                                            </small>
                                                            <?= $jam2; ?> AM
                                                        </td>
                                                        <td>
                                                            <small class="text-danger mr-1">
                                                                <i class="fas fa-arrow-up mr-1"></i>
                                                                <i class="fas fa-clock-o"></i>
                                                            </small>
                                                            <?= $jam3; ?> AM
                                                        </td>
                                                        <td><?= $row['nama_jabatan']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="container">
                                        <div class="mb-2" id="calendar" style="text-align: center;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once "../../public/include/footer.php"; ?>
            <!-- End-Main Footer -->
        </div>
        <!-- ./wrapper -->

    <?php }

    public function DataAbsensiGuru()
    { ?>
        <?php
        $master = 'Master2';
        $activePage = 'DataAbsensiGuru';
        require_once "../../app/Controllers/Login.php";
        $success = new Login;
        $success->getSuccess();
        if (@$_SESSION['berhasil']) {
            echo " <script>
                        Swal.fire({icon: 'success', title: 'Success', text: '$_SESSION[berhasil]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['berhasil']);
        }

        if (@$_SESSION['gagal']) {
            echo " <script>
                        Swal.fire({icon: 'error', title: 'Gagal', text: '$_SESSION[gagal]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['gagal']);
        }

        ?>
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once "../../public/include/navbar.php"; ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once "../../public/include/sidebar-admin.php"; ?>
            <!-- End-Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 fw-bold">Data Absensi Guru</h1>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-transparent">
                                        <h3 class="card-title">Absensi Guru</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="d-sm-flex d-block align-items-center justify-content-between" style="margin-top: -10px; margin-left:-5px">
                                            <div class="col-12 mb-4">
                                                <form method="get">
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-auto">
                                                            <label class="col-form-label">Filter Tanggal</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="input-group">
                                                                <input type="date" class="form-control" name="tanggal_awal" value="">
                                                                <span class="input-group-text">s/d</span>
                                                                <input type="date" class="form-control" name="tanggal_akhir" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="btn-group">
                                                                <button type="submit" name="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                                <a href="../../public/absensi/data-absensi-guru" class="btn btn-default"><i class="fa fa-refresh"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah-tidak-hadir">Tambah Tidak Hadir</button>
                                                        </div>

                                                    </div>
                                                </form>
                                                <div class="modal fade" id="tambah-tidak-hadir">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Tambah Data Tidak Hadir</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../public/absensi/simpan-ketidakhadiran.php" method="post">
                                                                    <div class="form-group">
                                                                        <label>Nama Guru</label>
                                                                        <select class="select2" name="nik" required>
                                                                            <option value="">Pilih</option>
                                                                            <?php
                                                                            $cek_data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru ORDER BY nama_guru ASC");
                                                                            while ($row_data_guru = mysqli_fetch_array($cek_data_guru)) {
                                                                            ?>
                                                                                <option value="<?= $row_data_guru['nik_guru'] ?>"><?= $row_data_guru['nik_guru']; ?> | <?= $row_data_guru['nama_guru']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                    <div class="modal-footer" style="height: 50px;">
                                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <?php
                                            $tgl_awal = $_GET['tanggal_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
                                            $tgl_akhir = $_GET['tanggal_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
                                            if (empty($tgl_awal) or empty($tgl_akhir)) {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN guru ON absensi.nik = guru.nik_guru INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal ORDER BY absensi.tgl_absen ASC");
                                            } else {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN guru ON absensi.nik = guru.nik_guru INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal where absensi.tgl_absen BETWEEN '" . $tgl_awal . "' and '" . $tgl_akhir . "' ORDER BY absensi.tgl_absen ASC");
                                                $url_cetak = "../../public/absensi/cetak-absensi-guru-pdf.php?key1=" . $tgl_awal . " & key2=" . $tgl_akhir . " & filter=true";
                                                $url_cetak1 = "../../public/absensi/cetak-absensi-guru-excel.php?key1=" . $tgl_awal . " & key2=" . $tgl_akhir . " & filter=true";
                                                $show = '<a href="' . $url_cetak1 . '" target="_blank"> <button class="btn btn-secondary btn-sm mb-3"><i class="fa fa-file-excel-o mr-2"></i>Excel</button></a> 
                                                         <a href="' . $url_cetak . '" target="_blank"> <button class="btn btn-secondary btn-sm mb-3"><i class="fa fa-file-pdf-o mr-2"></i>PDF</button></a>';
                                            }
                                            ?>

                                            <?= $show; ?>


                                            <table id="example2" class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Guru</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Pulang</th>
                                                        <th>Absen Masuk</th>
                                                        <th>Absen Pulang</th>
                                                        <th>Terlambat</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN guru ON absensi.nik = guru.nik_guru INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal");
                                                    while ($row_absen_guru = mysqli_fetch_array($data)) {
                                                        $jam_masuk = date("H:i", strtotime($row_absen_guru['jam_masuk']));
                                                        $jam_pulang = date("H:i", strtotime($row_absen_guru['jam_pulang']));
                                                        if ($row_absen_guru['status'] == 'Hadir') {
                                                            $izin = '<small class="badge badge-success">Hadir</small>';
                                                        } elseif ($row_absen_guru['status'] == 'Izin') {
                                                            $izin = '<small class="badge badge-warning">Izin</small>';
                                                        } elseif ($row_absen_guru['status'] == 'Tidak Hadir') {
                                                            $izin = '<small class="badge badge-danger">Tidak Hadir</small>';
                                                        }
                                                        $tgl_absensi = tgl_indo(date("Y-m-d", strtotime($row_absen_guru['tgl_absen'])));
                                                    ?>
                                                        <tr>
                                                            <td><?= $row_absen_guru['nama_guru']; ?></td>
                                                            <td><?= $jam_masuk; ?></td>
                                                            <td><?= $jam_pulang; ?></td>
                                                            <td style="color: green;"><?= $row_absen_guru['absen_masuk']; ?></td>
                                                            <td style="color: red;"><?= $row_absen_guru['absen_pulang']; ?></td>
                                                            <td><?= $row_absen_guru['terlambat']; ?></td>
                                                            <td><?= $tgl_absensi; ?></td>
                                                            <td>
                                                                <form action="../../public/absensi/update-absensi-guru.php?key=<?= $row_absen_guru['id_absensi'] ?>" method="post">
                                                                    <?php $kehadiran = $row_absen_guru['status']; ?>
                                                                    <select name="kehadiran" style="width: 105px; border:none; outline:none;" onchange='this.form.submit()'>
                                                                        <option <?php echo ($kehadiran == 'Hadir') ? "selected" : "" ?> value="Hadir">Hadir</option>
                                                                        <option <?php echo ($kehadiran == 'Tidak Hadir') ? "selected" : "" ?> value="Tidak Hadir">Tidak Hadir</option>
                                                                        <option <?php echo ($kehadiran == 'Izin') ? "selected" : "" ?> value="Izin">Izin</option>
                                                                    </select>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <!-- <script src="../../public/include/data-table-absensi-guru.js"></script> -->
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div><!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once "../../public/include/footer.php"; ?>
            <!-- End-Main Footer -->
        </div>
        <!-- ./wrapper -->

    <?php }

    public function DataAbsensiKaryawan()
    { ?>
        <?php
        $master = 'Master2';
        $activePage = 'DataAbsensiKaryawan';
        require_once "../../app/Controllers/Login.php";
        $success = new Login;
        $success->getSuccess();
        if (@$_SESSION['berhasil']) {
            echo " <script>
                        Swal.fire({icon: 'success', title: 'Success', text: '$_SESSION[berhasil]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['berhasil']);
        }

        if (@$_SESSION['gagal']) {
            echo " <script>
                        Swal.fire({icon: 'error', title: 'Gagal', text: '$_SESSION[gagal]',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    </script>";
            unset($_SESSION['gagal']);
        }

        ?>
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once "../../public/include/navbar.php"; ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php require_once "../../public/include/sidebar-admin.php"; ?>
            <!-- End-Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 fw-bold">Data Absensi Karyawan</h1>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header border-transparent">
                                        <h3 class="card-title">Absensi Karyawan</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-sm-flex d-block align-items-center justify-content-between" style="margin-top: -10px; margin-left:-5px">
                                            <div class="col-12 mb-4">
                                                <form method="get">
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-auto">
                                                            <label class="col-form-label">Filter Tanggal</label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="input-group">
                                                                <input type="date" class="form-control" name="tanggal_awal" value="">
                                                                <span class="input-group-text">s/d</span>
                                                                <input type="date" class="form-control" name="tanggal_akhir" value="">
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="btn-group">
                                                                <button type="submit" name="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                                <a href="../../public/absensi/data-absensi-karyawan" class="btn btn-default"><i class="fa fa-refresh"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambah-tidak-hadir">Tambah Tidak Hadir</button>
                                                        </div>

                                                    </div>
                                                </form>
                                                <div class="modal fade" id="tambah-tidak-hadir">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Tambah Data Tidak Hadir</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../public/absensi/simpan-ketidakhadiran-karyawan.php" method="post">
                                                                    <div class="form-group">
                                                                        <label>Nama Karyawan</label>
                                                                        <select class="select2" name="nik" required>
                                                                            <option value="">Pilih</option>
                                                                            <?php
                                                                            $cek_data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan ORDER BY nama_karyawan ASC");
                                                                            while ($row_data_karyawan = mysqli_fetch_array($cek_data_karyawan)) {
                                                                            ?>
                                                                                <option value="<?= $row_data_karyawan['nik_karyawan'] ?>"><?= $row_data_karyawan['nik_karyawan']; ?> | <?= $row_data_karyawan['nama_karyawan']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                    <div class="modal-footer" style="height: 50px;">
                                                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <?php
                                            $tgl_awal = $_GET['tanggal_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
                                            $tgl_akhir = $_GET['tanggal_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
                                            if (empty($tgl_awal) or empty($tgl_akhir)) {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN karyawan ON absensi.nik = karyawan.nik_karyawan INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal ORDER BY absensi.tgl_absen ASC");
                                            } else {
                                                $data = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN karyawan ON absensi.nik = karyawan.nik_karyawan INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal where absensi.tgl_absen BETWEEN '" . $tgl_awal . "' and '" . $tgl_akhir . "' ORDER BY absensi.tgl_absen ASC");
                                                $url_cetak = "../../public/absensi/cetak-absensi-karyawan-pdf.php?key1=" . $tgl_awal . " & key2=" . $tgl_akhir . " & filter=true";
                                                $url_cetak1 = "../../public/absensi/cetak-absensi-karyawan-excel.php?key1=" . $tgl_awal . " & key2=" . $tgl_akhir . " & filter=true";
                                                $show = '<a href="' . $url_cetak1 . '" target="_blank"> <button class="btn btn-secondary btn-sm mb-3"><i class="fa fa-file-excel-o mr-2"></i>Excel</button></a> 
                                                         <a href="' . $url_cetak . '" target="_blank"> <button class="btn btn-secondary btn-sm mb-3"><i class="fa fa-file-pdf-o mr-2"></i>PDF</button></a>';
                                            }
                                            ?>

                                            <?= $show; ?>
                                            <!-- <button class="btn btn-success btn-sm mb-3"><i class="fa fa-file-excel-o mr-2"></i>Excel</button>
                                            <button class="btn btn-danger btn-sm mb-3"><i class="fa fa-file-pdf-o mr-2"></i>PDF</button> -->
                                            <table id="example2" class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Karyawan</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Pulang</th>
                                                        <th>Absen Masuk</th>
                                                        <th>Absen Pulang</th>
                                                        <th>Terlambat</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($row_absen_karyawan = mysqli_fetch_array($data)) {
                                                        $jam_masuk = date("H:i", strtotime($row_absen_karyawan['jam_masuk']));
                                                        $jam_pulang = date("H:i", strtotime($row_absen_karyawan['jam_pulang']));
                                                        if ($row_absen_karyawan['status'] == 'Hadir') {
                                                            $izin = '<small class="badge badge-success">Hadir</small>';
                                                        } elseif ($row_absen_karyawan['status'] == 'Izin') {
                                                            $izin = '<small class="badge badge-warning">Izin</small>';
                                                        } elseif ($row_absen_karyawan['status'] == 'Tidak Hadir') {
                                                            $izin = '<small class="badge badge-danger">Tidak Hadir</small>';
                                                        }
                                                        $tgl_absensi = tgl_indo(date("Y-m-d", strtotime($row_absen_karyawan['tgl_absen'])));
                                                    ?>
                                                        <tr>
                                                            <td><?= $row_absen_karyawan['nama_karyawan']; ?></td>
                                                            <td><?= $jam_masuk; ?></td>
                                                            <td><?= $jam_pulang; ?></td>
                                                            <td style="color: green;"><?= $row_absen_karyawan['absen_masuk']; ?></td>
                                                            <td style="color: red;"><?= $row_absen_karyawan['absen_pulang']; ?></td>
                                                            <td><?= $row_absen_karyawan['terlambat']; ?></td>
                                                            <td><?= $tgl_absensi; ?></td>
                                                            <td>
                                                                <form action="../../public/absensi/update-absensi-karyawan.php?key=<?= $row_absen_karyawan['id_absensi'] ?>" method="post">
                                                                    <?php $kehadiran = $row_absen_karyawan['status']; ?>
                                                                    <select name="kehadiran" style="width: 105px; border:none; outline:none;" onchange='this.form.submit()'>
                                                                        <option <?php echo ($kehadiran == 'Hadir') ? "selected" : "" ?> value="Hadir">Hadir</option>
                                                                        <option <?php echo ($kehadiran == 'Tidak Hadir') ? "selected" : "" ?> value="Tidak Hadir">Tidak Hadir</option>
                                                                        <option <?php echo ($kehadiran == 'Izin') ? "selected" : "" ?> value="Izin">Izin</option>
                                                                    </select>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <!-- <script src="../../public/include/data-table-absensi-karyawan.js"></script> -->
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div><!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once "../../public/include/footer.php"; ?>
            <!-- End-Main Footer -->
        </div>
        <!-- ./wrapper -->

    <?php }

    public function Profile()
    { ?>
        <?php

        if ($_SESSION['role'] == 'ROL001') {
            $activePage = 'Administrator';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $activePage = 'Guru';
        } elseif ($_SESSION['role'] == 'ROL003') {
            $activePage = 'Karyawan';
        }
        ?>
        <div class="wrapper">

            <!-- Navbar -->
            <?php require_once "../../public/include/navbar.php"; ?>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <?php
            if ($_SESSION['role'] == 'ROL001') {
                require_once "../../public/include/sidebar-admin.php";
            } elseif ($_SESSION['role'] == 'ROL002') {
                require_once "../../public/include/sidebar-guru.php";
            } elseif ($_SESSION['role'] == 'ROL003') {
                require_once "../../public/include/sidebar-karyawan.php";
            }
            ?>
            <!-- End-Main Sidebar Container -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 fw-bold">Profile</h1>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <!-- Profile Image -->
                                <div class="card">
                                    <?php if ($_SESSION['role'] == 'ROL001') {
                                        $hak_akses = 'Administrator';
                                        $cek_data_admin = mysqli_query($this->koneksi->link, "SELECT *FROM admin where nik_admin = '" . $_SESSION['nik'] . "'");
                                        $row = mysqli_fetch_array($cek_data_admin); ?>
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="../../public/profile/<?= $row['img'] ?>" alt="User profile picture">
                                            </div>

                                            <h3 class="profile-username text-center"><?= $row['nama_admin']; ?></h3>

                                            <p class="text-muted text-center"><?= $hak_akses; ?></p>

                                            <a href="#" data-toggle="modal" data-target="#update-profile<?= $row['nik_admin'] ?>" class="btn btn-primary btn-block"><b>Update</b></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="update-profile<?= $row['nik_admin'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Profile</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../public/user/update-profile.php" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id" value="<?= $row['id_admin'] ?>">
                                                                <div class="form-group">
                                                                    <label>Nama Lengkap</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $row['nama_admin'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Foto Profile</label>
                                                                    <input type="hidden" class="form-control" name="fotolama" value="<?= $row['img'] ?>">
                                                                    <input type="file" class="form-control" name="fotomhs">
                                                                </div>
                                                                <!-- /.card-body -->
                                                                <div class="modal-footer" style="height: 50px;">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.Modal -->
                                        </div>
                                    <?php } elseif ($_SESSION['role'] == 'ROL002') {
                                        $hak_akses = 'Guru';
                                        $cek_data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru where nik_guru = '" . $_SESSION['nik'] . "'");
                                        $row = mysqli_fetch_array($cek_data_guru); ?>
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="../../public/profile/<?= $row['img'] ?>" alt="User profile picture">
                                            </div>

                                            <h3 class="profile-username text-center"><?= $row['nama_guru']; ?></h3>

                                            <p class="text-muted text-center"><?= $hak_akses; ?></p>

                                            <a href="#" data-toggle="modal" data-target="#update-profile<?= $row['nik_guru'] ?>" class="btn btn-primary btn-block"><b>Update</b></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="update-profile<?= $row['nik_guru'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Profile</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../public/user/update-profile.php" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id" value="<?= $row['id_guru'] ?>">
                                                                <div class="form-group">
                                                                    <label>Nama Lengkap</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $row['nama_guru'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Foto Profile</label>
                                                                    <input type="hidden" class="form-control" name="fotolama" value="<?= $row['img'] ?>">
                                                                    <input type="file" class="form-control" name="fotomhs">
                                                                </div>
                                                                <!-- /.card-body -->
                                                                <div class="modal-footer" style="height: 50px;">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.Modal -->
                                        </div>
                                    <?php } elseif ($_SESSION['role'] == 'ROL003') {
                                        $hak_akses = 'Karyawan';
                                        $cek_data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan where nik_karyawan = '" . $_SESSION['nik'] . "'");
                                        $row = mysqli_fetch_array($cek_data_karyawan); ?>
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle" src="../../public/profile/<?= $row['img'] ?>" alt="User profile picture">
                                            </div>

                                            <h3 class="profile-username text-center"><?= $row['nama_karyawan']; ?></h3>

                                            <p class="text-muted text-center"><?= $hak_akses; ?></p>

                                            <a href="#" data-toggle="modal" data-target="#update-profile<?= $row['nik_karyawan'] ?>" class="btn btn-primary btn-block"><b>Update</b></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="update-profile<?= $row['nik_karyawan'] ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Profile</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../public/user/update-profile.php" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id" value="<?= $row['id_karyawan'] ?>">
                                                                <div class="form-group">
                                                                    <label>Nama Lengkap</label>
                                                                    <input type="text" class="form-control" name="nama" value="<?= $row['nama_karyawan'] ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Foto Profile</label>
                                                                    <input type="hidden" class="form-control" name="fotolama" value="<?= $row['img'] ?>">
                                                                    <input type="file" class="form-control" name="fotomhs">
                                                                </div>
                                                                <!-- /.card-body -->
                                                                <div class="modal-footer" style="height: 50px;">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.Modal -->
                                        </div>
                                    <?php } ?>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h3 class="card-title">Profile Pengguna</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <?php
                                        if ($_SESSION['role'] == 'ROL001') { ?>
                                            <?php $hak_akses = 'Administrator'; ?>
                                            <table class="table table-striped table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <th>L/P</th>
                                                        <th>NIK/Username</th>
                                                        <th>NUPTK</th>
                                                        <th>Jabatan</th>
                                                        <th>Password</th>
                                                        <th>Hak Akses</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cek_data_admin = mysqli_query($this->koneksi->link, "SELECT *FROM admin INNER JOIN jabatan ON jabatan.id_jabatan = admin.id_jabatan INNER JOIN user_login ON user_login.nik = admin.nik_admin where admin.nik_admin = '" . $_SESSION['nik'] . "'");
                                                    while ($row = mysqli_fetch_array($cek_data_admin)) {
                                                        $pass = base64_decode($row['password']);
                                                    ?>
                                                        <tr>
                                                            <td><?= $row['nama_admin']; ?></td>
                                                            <td><?= $row['jk']; ?></td>
                                                            <td><?= $row['nik_admin']; ?></td>
                                                            <td><?= $row['nuptk']; ?></td>
                                                            <td><?= $row['nama_jabatan']; ?></td>
                                                            <td><?= $pass; ?></td>
                                                            <td><?= $hak_akses; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } elseif ($_SESSION['role'] == 'ROL002') { ?>
                                            <?php $hak_akses = 'Guru'; ?>
                                            <table class="table table-striped table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <th>L/P</th>
                                                        <th>NIK/Username</th>
                                                        <th>NUPTK</th>
                                                        <th>Jabatan</th>
                                                        <th>Password</th>
                                                        <th>Hak Akses</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cek_data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN jabatan ON jabatan.id_jabatan = guru.id_jabatan INNER JOIN user_login ON user_login.nik = guru.nik_guru where guru.nik_guru = '" . $_SESSION['nik'] . "'");
                                                    while ($row = mysqli_fetch_array($cek_data_guru)) {
                                                        $pass = base64_decode($row['password']);
                                                    ?>
                                                        <tr>
                                                            <td><?= $row['nama_guru']; ?></td>
                                                            <td><?= $row['jk']; ?></td>
                                                            <td><?= $row['nik_guru']; ?></td>
                                                            <td><?= $row['nuptk']; ?></td>
                                                            <td><?= $row['nama_jabatan']; ?></td>
                                                            <td><?= $pass; ?></td>
                                                            <td><?= $hak_akses; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } elseif ($_SESSION['role'] == 'ROL003') { ?>
                                            <?php $hak_akses = 'Guru'; ?>
                                            <table class="table table-striped table-valign-middle">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <th>L/P</th>
                                                        <th>NIK/Username</th>
                                                        <th>NUPTK</th>
                                                        <th>Jabatan</th>
                                                        <th>Password</th>
                                                        <th>Hak Akses</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cek_data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan INNER JOIN jabatan ON jabatan.id_jabatan = karyawan.id_jabatan INNER JOIN user_login ON user_login.nik = karyawan.nik_karyawan where karyawan.nik_karyawan = '" . $_SESSION['nik'] . "'");
                                                    while ($row = mysqli_fetch_array($cek_data_karyawan)) {
                                                        $pass = base64_decode($row['password']);
                                                    ?>
                                                        <tr>
                                                            <td><?= $row['nama_karyawan']; ?></td>
                                                            <td><?= $row['jk']; ?></td>
                                                            <td><?= $row['nik_karyawan']; ?></td>
                                                            <td><?= $row['nuptk']; ?></td>
                                                            <td><?= $row['nama_jabatan']; ?></td>
                                                            <td><?= $pass; ?></td>
                                                            <td><?= $hak_akses; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <?php require_once "../../public/include/footer.php"; ?>
            <!-- End-Main Footer -->
        </div>
        <!-- ./wrapper -->

<?php }
}
