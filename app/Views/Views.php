<?php
require_once "../../public/include/index.php";
require_once "../../app/Controllers/Login.php";
require_once "../../phpqrcode/qrlib.php";
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
class View extends Login
{
    public function Kegiatan()
    { ?>
        <?php
        $activePage = 'Administrator';
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
                                <h5 class="m-0 fw-bold">Data Kegiatan</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Kegiatan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th>Kegiatan</th>
                                                    <th>Tanggal</th>
                                                    <th style="width: 40px">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $cek_kegiatan = mysqli_query($this->koneksi->link, "SELECT *FROM kegiatan");
                                                $no = 1;
                                                while ($row = mysqli_fetch_array($cek_kegiatan)) {
                                                    $date_add = date("d-m-Y", strtotime($row['date_add']));
                                                ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['kegiatan']; ?></td>
                                                        <td><?= $date_add; ?></td>
                                                        <td>
                                                            <a href="../../public/kegiatan/delete.php?key=<?= $row['id_kegiatan'] ?>" id="btn-delete">
                                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer clearfix">
                                        <a href="../../public/dashboard/admin">
                                            <button type="button" class="btn btn-primary btn-sm float-right"><i class="fas fa-angle-left right"></i> Kembali</button>
                                        </a>
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

    //MASTER DATA
    public function MataPelajaran()
    { ?>
        <?php
        $master = "Master";
        $activePage = 'MataPelajaran';
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
                                <h5 class="m-0 fw-bold">Data Pelajaran</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Mata Pelajaran</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="../../public/pelajaran/simpan.php" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Pelajaran</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Mata Pelajaran" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Mata Pelajaran</h3>


                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                        <table id="example2" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">No</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th style="width: 20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $data_pelajaran = mysqli_query($this->koneksi->link, "SELECT *FROM pelajaran ORDER BY nama_pelajaran ASC");
                                                $countdata = mysqli_num_rows($data_pelajaran);
                                                $nomor = 1;
                                                if ($countdata > 0) {
                                                    while ($row = mysqli_fetch_array($data_pelajaran)) {
                                                ?>
                                                        <tr>
                                                            <td><?= $nomor++; ?></td>
                                                            <td><?= $row['nama_pelajaran']; ?></td>
                                                            <td>
                                                                <a href="../../public/pelajaran/delete.php?key=<?= $row['id_mata_pelajaran'] ?>" id="btn-delete">
                                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update<?= $row['id_mata_pelajaran'] ?>"><i class="fa fa-pencil-alt"></i></a>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="update<?= $row['id_mata_pelajaran'] ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Update Mata Pelajaran</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="../../public/pelajaran/update.php" method="post">
                                                                                    <input type="hidden" name="id" value="<?= $row['id_mata_pelajaran'] ?>">
                                                                                    <div class="form-group">
                                                                                        <label>Nama Pelajaran</label>
                                                                                        <input type="text" class="form-control" name="nama" value="<?= $row['nama_pelajaran'] ?>" required>
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
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan='4' style="text-align: center;">Data Kosong</td>
                                                    </tr>
                                                <?php   } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

                                    <!-- Pagenation -->
                                    <!-- End-Pagenation -->

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

    public function Jurusan()
    { ?>
        <?php
        $master = "Master";
        $activePage = 'Jurusan';
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
                                <h5 class="m-0 fw-bold">Data Jurusan</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Jurusan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="../../public/jurusan/simpan.php" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama Jurusan</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Nama Jurusan" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Jurusan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                        <table id="example2" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">No</th>
                                                    <th>Nama Jurusan</th>
                                                    <th style="width: 20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $data_jurusan = mysqli_query($this->koneksi->link, "SELECT *FROM jurusan ORDER BY nama_jurusan ASC");
                                                $countdata = mysqli_num_rows($data_jurusan);
                                                $nomor = 1;
                                                if ($countdata > 0) {
                                                    while ($row = mysqli_fetch_array($data_jurusan)) {
                                                ?>
                                                        <tr>
                                                            <td><?= $nomor++; ?></td>
                                                            <td><?= $row['nama_jurusan']; ?></td>
                                                            <td>
                                                                <a href="../../public/jurusan/delete.php?key=<?= $row['id_jurusan'] ?>" id="btn-delete">
                                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update<?= $row['id_jurusan'] ?>"><i class="fa fa-pencil-alt"></i></a>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="update<?= $row['id_jurusan'] ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Update Data Jurusan</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="../../public/jurusan/update.php" method="post">
                                                                                    <input type="hidden" name="id" value="<?= $row['id_jurusan'] ?>">
                                                                                    <div class="form-group">
                                                                                        <label>Nama Jurusan</label>
                                                                                        <input type="text" class="form-control" name="nama" value="<?= $row['nama_jurusan'] ?>" required>
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
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan='4' style="text-align: center;">Data Kosong</td>
                                                    </tr>
                                                <?php   } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

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

    public function Jabatan()
    { ?>
        <?php
        $master = "Master";
        $activePage = 'Jabatan';
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
                                <h5 class="m-0 fw-bold">Data Jabatan</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Jabatan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="../../public/jabatan/simpan.php" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama Jabatan</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Nama Jabatan" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                        </div>
                                        <!-- /.card-body -->
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Data Jabatan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                        <table id="example2" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">No</th>
                                                    <th>Nama Jabatan</th>
                                                    <th style="width: 20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data_jabatan = mysqli_query($this->koneksi->link, "SELECT *FROM jabatan ORDER BY nama_jabatan ASC");
                                                $countdata = mysqli_num_rows($data_jabatan);
                                                $nomor = 1;
                                                if ($countdata > 0) {
                                                    while ($row = mysqli_fetch_array($data_jabatan)) {
                                                ?>
                                                        <tr>
                                                            <td><?= $nomor++; ?></td>
                                                            <td><?= $row['nama_jabatan']; ?></td>
                                                            <td>
                                                                <a href="../../public/jabatan/delete.php?key=<?= $row['id_jabatan'] ?>" id="btn-delete">
                                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update<?= $row['id_jabatan'] ?>"><i class="fa fa-pencil-alt"></i></a>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="update<?= $row['id_jabatan'] ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Update Data Jabatan</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="../../public/jabatan/update.php" method="post">
                                                                                    <input type="hidden" name="id" value="<?= $row['id_jabatan'] ?>">
                                                                                    <div class="form-group">
                                                                                        <label>Nama Jabatan</label>
                                                                                        <input type="text" class="form-control" name="nama" value="<?= $row['nama_jabatan'] ?>" required>
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
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan='4' style="text-align: center;">Data Kosong</td>
                                                    </tr>
                                                <?php   } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

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

    public function DataJadwal()
    { ?>
        <?php
        $master = "Master";
        $activePage = 'DataJadwal';
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
                                <h5 class="m-0 fw-bold">Jadwal Hari dan Jam Kerja</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Jadwal</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form action="../../public/jadwal/simpan.php" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Hari</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Hari" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jam Masuk</label>
                                                <input type="time" class="form-control" name="jam_masuk" placeholder="Jam Masuk" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jam Istirahat</label>
                                                <input type="time" class="form-control" name="jam_istirahat" placeholder="Jam Istirahat" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jam Pulang</label>
                                                <input type="time" class="form-control" name="jam_pulang" placeholder="Jam Pulang" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                                        </div>
                                        <!-- /.card-body -->

                                    </form>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Daftar Jadwal</h3>


                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">
                                        <table id="example2" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">No</th>
                                                    <th>Hari</th>
                                                    <th>Jam Masuk</th>
                                                    <th>Jam Istirahat</th>
                                                    <th>Jam Pulang</th>
                                                    <th style="width: 20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $data_pelajaran = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal");
                                                $countdata = mysqli_num_rows($data_pelajaran);
                                                $nomor = 1;
                                                if ($countdata > 0) {
                                                    while ($row = mysqli_fetch_array($data_pelajaran)) {
                                                        $jam1 = date("H:i", strtotime($row['jam_masuk']));
                                                        $jam2 = date("H:i", strtotime($row['jam_istirahat']));
                                                        $jam3 = date("H:i", strtotime($row['jam_pulang']));
                                                ?>
                                                        <tr>
                                                            <td><?= $nomor++; ?></td>
                                                            <td><?= $row['hari']; ?></td>
                                                            <td><?= $jam1; ?></td>
                                                            <td><?= $jam2; ?></td>
                                                            <td><?= $jam3; ?></td>
                                                            <td>
                                                                <a href="../../public/jadwal/delete.php?key=<?= $row['id_jadwal'] ?>" id="btn-delete">
                                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update<?= $row['id_jadwal'] ?>"><i class="fa fa-pencil-alt"></i></a>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="update<?= $row['id_jadwal'] ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">Update Jadwal</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="../../public/jadwal/update.php" method="post">
                                                                                    <input type="hidden" name="id" value="<?= $row['id_jadwal'] ?>">
                                                                                    <div class="form-group">
                                                                                        <label>Hari</label>
                                                                                        <input type="text" class="form-control" name="nama" value="<?= $row['hari'] ?>" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Jam Masuk</label>
                                                                                        <input type="time" class="form-control" name="jam_masuk" value="<?= $row['jam_masuk'] ?>" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Jam Istirahat</label>
                                                                                        <input type="time" class="form-control" name="jam_istirahat" value="<?= $row['jam_istirahat'] ?>" required>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label>Jam Pulang</label>
                                                                                        <input type="time" class="form-control" name="jam_pulang" value="<?= $row['jam_pulang'] ?>" required>
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
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan='4' style="text-align: center;">Data Kosong</td>
                                                    </tr>
                                                <?php   } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

                                    <!-- Pagenation -->
                                    <!-- End-Pagenation -->

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

    public function DataAdmin()
    { ?>
        <?php
        $master = "Master1";
        $activePage = 'DataAdmin';
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
                        timer: 3000
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
                                <h5 class="m-0 fw-bold">Data Admin</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><a href="../../public/admin/form-admin"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</button></a></h3>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">

                                        <table id="example1" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%">No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>L/P</th>
                                                    <th>NIK</th>
                                                    <th>NUPTK</th>
                                                    <th>Jabatan</th>
                                                    <th>Jurusan</th>
                                                    <th>Induk</th>
                                                    <th>TMT</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data_admin = mysqli_query($this->koneksi->link, "SELECT *FROM admin INNER JOIN jabatan ON admin.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON admin.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON admin.nik_admin = user_login.nik ORDER BY admin.nama_admin ASC");
                                                $countdata = mysqli_num_rows($data_admin);
                                                $nomor = 1;
                                                if ($countdata > 0) {
                                                    while ($row = mysqli_fetch_array($data_admin)) {
                                                        $date = tgl_indo(date("Y-m-d", strtotime($row['tmt'])));
                                                ?>
                                                        <tr>
                                                            <td><?= $nomor++; ?></td>
                                                            <td><?= $row['nama_admin']; ?></td>
                                                            <td><?= $row['jk']; ?></td>
                                                            <td><?= $row['nik_admin']; ?></td>
                                                            <td><?= $row['nuptk']; ?></td>
                                                            <td><?= $row['nama_jabatan']; ?></td>
                                                            <td><?= $row['nama_jurusan']; ?></td>
                                                            <td><?= $row['induk']; ?></td>
                                                            <td><?= $date; ?></td>
                                                            <td>
                                                                <a href="../../public/admin/delete.php?key=<?= $row['nik_admin'] ?>" id="btn-delete">
                                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?= $row['nik'] ?>"><i class="fa fa-eye"></i></button>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="details<?= $row['nik'] ?>" data-backdrop="static" data-keyboard="false">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detail Login</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="../../public/jabatan/update.php" method="post">
                                                                            <input type="hidden" name="id" value="<?= $row['id_jabatan'] ?>">
                                                                            <div class="form-group">
                                                                                <label>Username</label>
                                                                                <input type="text" class="form-control" value="<?= $row['nik'] ?>" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Password</label>
                                                                                <input type="text" class="form-control" value="<?= base64_decode($row['password']) ?>" readonly>
                                                                            </div>
                                                                            <!-- /.card-body -->
                                                                            <div class="modal-footer" style="height: 50px;">
                                                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.Modal -->
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan='10' style="text-align: center;">Data Kosong</td>
                                                    </tr>
                                                <?php   } ?>
                                            </tbody>
                                            <script src="../../public/include/data-table.js"></script>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

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

    public function FormAdmin()
    { ?>
        <?php
        $master = "Master1";
        $activePage = 'DataAdmin';
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
                                <h5 class="m-0 fw-bold">Form Data Admin</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Tambah Data Admin</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form action="../../public/admin/simpan.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>NIK</label>
                                                        <input type="number" class="form-control" name="nik" min="1" placeholder="NIK" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NUPTK <code>*Jika tidak memiliki NUPTK silahkan isi dengan " - "</code></label>
                                                        <input type="text" class="form-control" name="nuptk" min="1" placeholder="NUPTK" required>
                                                        <!-- <label></label> -->
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama Admin" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-control" name="jk" required>
                                                            <option value="">Pilih</option>
                                                            <option value="L">Laki-Laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Foto Profile</label>
                                                        <input type="file" class="form-control" name="file" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password Login</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Password Login" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <select class="select2" name="id_jabatan" style="width: 100%;" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_jabatan = mysqli_query($this->koneksi->link, "SELECT *FROM jabatan ORDER BY nama_jabatan ASC");
                                                            while ($row_jabatan = mysqli_fetch_array($cek_jabatan)) {
                                                            ?>
                                                                <option value="<?= $row_jabatan['id_jabatan'] ?>"><?= $row_jabatan['nama_jabatan']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir/Jurusan</label>
                                                        <select class="select2" name="id_jurusan" style="width: 100%;" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_jurusan = mysqli_query($this->koneksi->link, "SELECT *FROM jurusan ORDER BY nama_jurusan ASC");
                                                            while ($row_jurusan = mysqli_fetch_array($cek_jurusan)) {
                                                            ?>
                                                                <option value="<?= $row_jurusan['id_jurusan'] ?>"><?= $row_jurusan['nama_jurusan']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Induk</label>
                                                        <select class="form-control" name="induk" required>
                                                            <option value="">Pilih</option>
                                                            <option value="Ya">Ya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>TMT</label>
                                                        <input type="date" class="form-control" name="tmt" placeholder="Terhitung Mulai Tahun" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <a href="../../public/admin/data-admin">
                                                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
                                                        </a>
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                    <!-- /.card-body -->

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

    public function DataGuru()
    { ?>
        <?php
        $master = "Master1";
        $activePage = 'DataGuru';
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
                        timer: 3000
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
                                <h5 class="m-0 fw-bold">Data Guru</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><a href="../../public/guru/form-guru"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</button></a></h3>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">

                                        <table id="example1" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="width: 6%">No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>L/P</th>
                                                    <th>NIK</th>
                                                    <th>NUPTK</th>
                                                    <th>Jabatan</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Jurusan</th>
                                                    <th>Induk</th>
                                                    <th>TMT</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN jabatan ON guru.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON guru.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON guru.nik_guru = user_login.nik ORDER BY guru.nama_guru ASC");
                                                $countdata = mysqli_num_rows($data_guru);
                                                $nomor = 1;
                                                if ($countdata > 0) {
                                                    while ($row = mysqli_fetch_array($data_guru)) {
                                                ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= $nomor++; ?></td>
                                                            <td><?= $row['nama_guru']; ?></td>
                                                            <td><?= $row['jk']; ?></td>
                                                            <td><?= $row['nik_guru']; ?></td>
                                                            <td><?= $row['nuptk']; ?></td>
                                                            <td><?= $row['nama_jabatan']; ?></td>
                                                            <td><?= $row['mata_pelajaran']; ?></td>
                                                            <td><?= $row['nama_jurusan']; ?></td>
                                                            <td><?= $row['induk']; ?></td>
                                                            <td><?= $row['tmt']; ?></td>
                                                            <td>
                                                                <a href="../../public/guru/delete.php?key=<?= $row['nik_guru'] ?>" id="btn-delete">
                                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?= $row['nik_guru'] ?>"><i class="fa fa-eye"></i></button>
                                                                <a href="../../public/guru/cetak-kartu-absensi-guru.php?key=<?= $row['nik_guru'] ?>" target="_blank">
                                                                    <button class="btn btn-info btn-sm"><i class="fa fa-fingerprint"></i></button>
                                                                </a>

                                                            </td>
                                                        </tr>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="details<?= $row['nik'] ?>" data-backdrop="static" data-keyboard="false">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detail Login</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="../../public/jabatan/update.php" method="post">
                                                                            <input type="hidden" name="id" value="<?= $row['id_jabatan'] ?>">
                                                                            <div class="form-group">
                                                                                <label>Username</label>
                                                                                <input type="text" class="form-control" value="<?= $row['nik'] ?>" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Password</label>
                                                                                <input type="text" class="form-control" value="<?= base64_decode($row['password']) ?>" readonly>
                                                                            </div>
                                                                            <!-- /.card-body -->
                                                                            <div class="modal-footer" style="height: 50px;">
                                                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.Modal -->
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan='12' style="text-align: center;">Data Kosong</td>
                                                    </tr>
                                                <?php   } ?>
                                            </tbody>
                                            <script src="../../public/include/data-table-guru.js"></script>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

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

    public function FormGuru()
    { ?>
        <?php
        $master = "Master1";
        $activePage = 'DataGuru';
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
                                <h5 class="m-0 fw-bold">Form Data Guru</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Tambah Data Guru</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form action="../../public/guru/simpan.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>NIK</label>
                                                        <input type="number" class="form-control" name="nik" min="1" placeholder="NIK" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NUPTK <code>*Jika tidak memiliki NUPTK silahkan isi dengan " - "</code></label>
                                                        <input type="text" class="form-control" name="nuptk" min="1" placeholder="NUPTK" required>
                                                        <!-- <label></label> -->
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama Guru" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-control" name="jk" required>
                                                            <option value="">Pilih</option>
                                                            <option value="L">Laki-Laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Foto Profile</label>
                                                        <input type="file" class="form-control" name="file" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Telepon/WA</label>
                                                        <input type="number" class="form-control" name="tlp" placeholder="No.Telepon" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password Login</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Password Login" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <select class="select2" style="width: 100%;" name="id_jabatan" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_jabatan = mysqli_query($this->koneksi->link, "SELECT *FROM jabatan ORDER BY nama_jabatan ASC");
                                                            while ($row_jabatan = mysqli_fetch_array($cek_jabatan)) {
                                                            ?>
                                                                <option value="<?= $row_jabatan['id_jabatan'] ?>"><?= $row_jabatan['nama_jabatan']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Mata Pelajaran</label>
                                                        <select class="select2" multiple="multiple" data-placeholder="pilih" style="width: 100%;" name="nama_pelajaran[]" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_mata_pelajaran = mysqli_query($this->koneksi->link, "SELECT *FROM pelajaran ORDER BY nama_pelajaran ASC");
                                                            while ($row_mata_pelajaran = mysqli_fetch_array($cek_mata_pelajaran)) {
                                                            ?>
                                                                <option value="<?= $row_mata_pelajaran['nama_pelajaran'] ?>"><?= $row_mata_pelajaran['nama_pelajaran']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir/Jurusan</label>
                                                        <select class="select2" style="width: 100%;" name="id_jurusan" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_jurusan = mysqli_query($this->koneksi->link, "SELECT *FROM jurusan ORDER BY nama_jurusan ASC");
                                                            while ($row_jurusan = mysqli_fetch_array($cek_jurusan)) {
                                                            ?>
                                                                <option value="<?= $row_jurusan['id_jurusan'] ?>"><?= $row_jurusan['nama_jurusan']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Induk</label>
                                                        <select class="form-control" name="induk" required>
                                                            <option value="">Pilih</option>
                                                            <option value="Ya">Ya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>TMT</label>
                                                        <input type="number" class="form-control" name="tmt" min="1" placeholder="Terhitung Mulai Tahun" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <a href="../../public/guru/data-guru">
                                                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
                                                        </a>
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                    <!-- /.card-body -->

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

    public function DataKaryawan()
    { ?>
        <?php
        $master = "Master1";
        $activePage = 'DataKaryawan';
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
                        timer: 3000
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
                                <h5 class="m-0 fw-bold">Data Karyawan</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><a href="../../public/karyawan/form-karyawan"><button type="button" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah</button></a></h3>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive">

                                        <table id="example1" class="table table-hover text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="width: 6%">No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>L/P</th>
                                                    <th>NIK</th>
                                                    <th>NUPTK</th>
                                                    <th>Jabatan</th>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Jurusan</th>
                                                    <th>Induk</th>
                                                    <th>TMT</th>
                                                    <th style="width: 10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON karyawan.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON karyawan.nik_karyawan = user_login.nik ORDER BY karyawan.nama_karyawan ASC");
                                                $countdata = mysqli_num_rows($data_karyawan);
                                                $nomor = 1;
                                                if ($countdata > 0) {
                                                    while ($row = mysqli_fetch_array($data_karyawan)) {
                                                        $date = tgl_indo(date("Y-m-d", strtotime($row['tmt'])));
                                                ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><?= $nomor++; ?></td>
                                                            <td><?= $row['nama_karyawan']; ?></td>
                                                            <td><?= $row['jk']; ?></td>
                                                            <td><?= $row['nik_karyawan']; ?></td>
                                                            <td><?= $row['nuptk']; ?></td>
                                                            <td><?= $row['nama_jabatan']; ?></td>
                                                            <td><?= $row['mata_pelajaran']; ?></td>
                                                            <td><?= $row['nama_jurusan']; ?></td>
                                                            <td><?= $row['induk']; ?></td>
                                                            <td><?= $date; ?></td>
                                                            <td>
                                                                <a href="../../public/karyawan/delete.php?key=<?= $row['nik_karyawan'] ?>" id="btn-delete">
                                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                                </a>
                                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details<?= $row['nik'] ?>"><i class="fa fa-eye"></i></button>

                                                            </td>
                                                        </tr>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="details<?= $row['nik'] ?>" data-backdrop="static" data-keyboard="false">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Detail Login</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="../../public/jabatan/update.php" method="post">
                                                                            <input type="hidden" name="id" value="<?= $row['id_jabatan'] ?>">
                                                                            <div class="form-group">
                                                                                <label>Username</label>
                                                                                <input type="text" class="form-control" value="<?= $row['nik'] ?>" readonly>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Password</label>
                                                                                <input type="text" class="form-control" value="<?= base64_decode($row['password']) ?>" readonly>
                                                                            </div>
                                                                            <!-- /.card-body -->
                                                                            <div class="modal-footer" style="height: 50px;">
                                                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                                <!-- /.modal-content -->
                                                            </div>
                                                            <!-- /.modal-dialog -->
                                                        </div>
                                                        <!-- /.Modal -->
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan='12' style="text-align: center;">Data Kosong</td>
                                                    </tr>
                                                <?php   } ?>
                                            </tbody>
                                            <script src="../../public/include/data-table-karyawan.js"></script>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->

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

    public function FormKaryawan()
    { ?>
        <?php
        $master = "Master1";
        $activePage = 'DataKaryawan';
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
                                <h5 class="m-0 fw-bold">Form Data Karyawan</h5>
                            </div><!-- /.col -->

                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Form Tambah Data Karyawan</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <form action="../../public/karyawan/simpan.php" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Nomor Induk Karyawan</label>
                                                        <input type="number" class="form-control" name="nik" min="1" placeholder="Nomor Induk Karyawan" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NUPTK <code>*Jika tidak memiliki NUPTK silahkan isi dengan " - "</code></label>
                                                        <input type="text" class="form-control" name="nuptk" min="1" placeholder="NUPTK" required>
                                                        <!-- <label></label> -->
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="nama" placeholder="Nama Karyawan" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <select class="form-control" name="jk" required>
                                                            <option value="">Pilih</option>
                                                            <option value="L">Laki-Laki</option>
                                                            <option value="P">Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Foto Profile</label>
                                                        <input type="file" class="form-control" name="file" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password Login</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Password Login" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Jabatan</label>
                                                        <select class="select2" style="width: 100%;" name="id_jabatan" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_jabatan = mysqli_query($this->koneksi->link, "SELECT *FROM jabatan ORDER BY nama_jabatan ASC");
                                                            while ($row_jabatan = mysqli_fetch_array($cek_jabatan)) {
                                                            ?>
                                                                <option value="<?= $row_jabatan['id_jabatan'] ?>"><?= $row_jabatan['nama_jabatan']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Mata Pelajaran</label>
                                                        <select class="select2" multiple="multiple" data-placeholder="pilih" style="width: 100%;" name="nama_pelajaran[]" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_mata_pelajaran = mysqli_query($this->koneksi->link, "SELECT *FROM pelajaran ORDER BY nama_pelajaran ASC");
                                                            while ($row_mata_pelajaran = mysqli_fetch_array($cek_mata_pelajaran)) {
                                                            ?>
                                                                <option value="<?= $row_mata_pelajaran['nama_pelajaran'] ?>"><?= $row_mata_pelajaran['nama_pelajaran']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Pendidikan Terakhir/Jurusan</label>
                                                        <select class="select2" style="width: 100%;" name="id_jurusan" required>
                                                            <option value="">Pilih</option>
                                                            <?php
                                                            $cek_jurusan = mysqli_query($this->koneksi->link, "SELECT *FROM jurusan ORDER BY nama_jurusan ASC");
                                                            while ($row_jurusan = mysqli_fetch_array($cek_jurusan)) {
                                                            ?>
                                                                <option value="<?= $row_jurusan['id_jurusan'] ?>"><?= $row_jurusan['nama_jurusan']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Induk</label>
                                                        <select class="form-control" name="induk" required>
                                                            <option value="">Pilih</option>
                                                            <option value="Ya">Ya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>TMT</label>
                                                        <input type="date" class="form-control" name="tmt" placeholder="Terhitung Mulai Tahun" required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <a href="../../public/guru/data-guru">
                                                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batal</button>
                                                        </a>
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>
                                    <!-- /.card-body -->

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

    public function AbsensiGuru()
    { ?>
        <?php
        $activePage = 'AbsensiGuru';
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
                        Swal.fire({icon: 'error', title: 'Maaf!', text: '$_SESSION[gagal]',
                        showConfirmButton: false,
                        timer: 3000
                        })
                    </script>";
            unset($_SESSION['gagal']);
        }
        ?>
        <div class="wrapper">
            <meta http-equiv="refresh" content="60">
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
                        <div class="row">


                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                    Kehadiran Guru ataupun Karyawan merupakan kunci bagi terwujudnya kegiatan pembelajaran yang efektif dalam proses belajar mengajar maupun kedisiplinan dalam sekolah. Ketidakhadiran Guru ataupun Karyawan menunjukkan adanya pelanggaran disiplin dan mengindikasikan kinerja yang rendah.
                                </div>
                                <?php
                                $data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN jabatan ON guru.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON guru.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON guru.nik_guru = user_login.nik where guru.nik_guru = '" . $_SESSION['nik'] . "'");
                                $row_guru = mysqli_fetch_array($data_guru)
                                ?>
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fa fa-clock-o"></i> Jam : <b><span id="jam" style="font-size:24"></span></b> WIB
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:45%">Nama Lengkap</th>
                                                        <td>: <?= $row_guru['nama_guru']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NIK</th>
                                                        <td>: <?= $row_guru['nik_guru']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NUPTK</th>
                                                        <td>: <?= $row_guru['nuptk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jenis Kelamin</th>
                                                        <td>: <?= $row_guru['jk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jabatan</th>
                                                        <td>: <?= $row_guru['nama_jabatan']; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:45%">Mata Pelajaran</th>
                                                        <td>: <?= $row_guru['mata_pelajaran']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jurusan</th>
                                                        <td>: <?= $row_guru['nama_jurusan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Induk</th>
                                                        <td>: <?= $row_guru['induk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TMT</th>
                                                        <td>: <?= $row_guru['tmt']; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->

                                        <?php

                                        $hari = hari_ini();

                                        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
                                        $row_hari = mysqli_fetch_array($data_jadwal);
                                        $jam1 = date("H:i", strtotime($row_hari['jam_masuk']));
                                        $jam2 = date("H:i", strtotime($row_hari['jam_istirahat']));
                                        $jam3 = date("H:i", strtotime($row_hari['jam_pulang']));
                                        $date = tgl_indo(date('Y-m-d'));
                                        $batasan_time = date('H:i:s');
                                        if ($batasan_time <= $jam1) {
                                            $button1 =  '<button class="btn btn-primary btn-sm disabled"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Absen Masuk</button>';
                                            $status_absensi = '<small class="badge badge-danger"><i class="far fa-clock"></i> Absensi Belum Dimulai</small>';
                                            $button2 = '<button class="btn btn-warning btn-sm disabled">Izin Absen</button>';
                                        } elseif ($batasan_time >= $jam1) {
                                            $button1 = '
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#webcam' . $_SESSION['nik'] . '"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Absen Masuk</button>';
                                            $status_absensi = '<small class="badge badge-success"><i class="fa fa-check"></i> Absensi Sudah Dimulai</small>';
                                            $button2 = '<a href="../../public/absensi/absen-izin.php?key=' . $_SESSION['nik'] . '" id="btn-confirm-absen-izin">
                                            <button class="btn btn-warning btn-sm">Izin Absen</button>
                                            </a>';
                                        }

                                        ?>
                                        <!-- Modal -->
                                        <div class="modal fade" id="webcam<?= $_SESSION['nik'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Scann ID Card QRCode</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>
                                                            <video id="my_camera" class="solid" style="width: 100px;"></video>
                                                        </center>

                                                        <!-- /.card-body -->
                                                        <div class="modal-footer" style="height: 50px;">
                                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                                        </div>

                                                        <script type="text/javascript">
                                                            // Configure a few settings and attach camera

                                                            Webcam.set({
                                                                width: 400,
                                                                height: 340,
                                                                image_format: 'jpeg',
                                                                jpeg_quality: 100
                                                            });
                                                            Webcam.attach('#my_camera');

                                                            // preload shutter audio clip
                                                            var shutter = new Audio();
                                                            shutter.autoplay = true;
                                                            shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';


                                                            // SELESAI-----Configure a few settings and attach camera
                                                            //===========================================ajax
                                                        </script>
                                                        <script type="text/javascript">
                                                            $(document).ready(function() {
                                                                let scanner = new Instascan.Scanner({
                                                                    video: document.getElementById('my_camera'),
                                                                    mirror: false
                                                                });
                                                                scanner.addListener('scan', function(content) {
                                                                    let data14 = content;
                                                                    // play sound effect
                                                                    shutter.play();
                                                                    let angka_random = Math.floor(Math.random() * 1000000) + 1000;
                                                                    let sekarang = Date.now();
                                                                    let random = angka_random + sekarang;

                                                                    $.ajax({
                                                                            type: 'POST',
                                                                            url: "../../public/guru/index_webcam_action.php",
                                                                            data: {
                                                                                qrcode: data14
                                                                            },
                                                                            success: function(response) {
                                                                                if (response != null && response != "") {
                                                                                    response = JSON.parse(response);
                                                                                    console.log(response);
                                                                                    
                                                                                    // Menampilkan data JSON jika absensi berhasil disimpan
                                                                                    if (response.status === 'success') {
                                                                                        $('#no_daftar').html(response.data.no_daftar);
                                                                                        $('#giat_penerimaan').html(response.data.giat_penerimaan);
                                                                                        $('#nama').html(response.data.nama_calon);
                                                                                        $('#ttl').html(response.data.ttl);
                                                                                        $('#hasil').html(response.data.hasil);
                                                                                        $('#karena').html(response.data.karena);
                                                                                        $('#id_data').val(response.data.id_data);
                                                                                        $('#results').load('../../public/absensi/absen-masuk.php');
                                                                                        
                                                                                        const Toast = Swal.mixin({
                                                                                            toast: true,
                                                                                            position: 'top-end',
                                                                                            showConfirmButton: false,
                                                                                            timer: 3000,
                                                                                            timerProgressBar: true,
                                                                                            didOpen: (toast) => {
                                                                                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                                                                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                                                                                            }
                                                                                        });

                                                                                        Swal.fire({
                                                                                            icon: 'success',
                                                                                            title: 'Success',
                                                                                            text: 'Absen berhasil disimpan',
                                                                                            showConfirmButton: false,
                                                                                            timer: 1500
                                                                                        }).then(function() {
                                                                                            window.location.href = "../../public/absensi/absen-guru";
                                                                                        });
                                                                                    } else if (response.status === 'warning') {
                                                                                        Swal.fire({
                                                                                            icon: 'warning',
                                                                                            title: 'Perhatian',
                                                                                            text: response.message
                                                                                        });
                                                                                    } else if (response.status === 'error') {
                                                                                        Swal.fire({
                                                                                            icon: 'error',
                                                                                            title: 'Oops...',
                                                                                            text: response.message
                                                                                        });
                                                                                    }
                                                                                }
                                                                            }
                                                                        });
                                                                });

                                                                Instascan.Camera.getCameras().then(function(cameras) {
                                                                    if (cameras.length > 0) {
                                                                        scanner.start(cameras[0]);

                                                                        //ini pakai vanilla js
                                                                        if (document.querySelector('input[name="options"]')) {
                                                                            document.querySelectorAll('input[name="options"]').forEach((element) => {
                                                                                element.addEventListener("change", function(event) {
                                                                                    var item = event.target.value;
                                                                                    //console.log(item);
                                                                                    if (item == 1) {
                                                                                        if (cameras[0] != "") {
                                                                                            scanner.start(cameras[0]);
                                                                                        } else {
                                                                                            alert('No Front camera found!');
                                                                                        }
                                                                                    } else if (item == 2) {
                                                                                        if (cameras[1] != "") {
                                                                                            scanner.start(cameras[1]);
                                                                                        } else {
                                                                                            alert('No Back camera found!');
                                                                                        }
                                                                                    }
                                                                                });
                                                                            });
                                                                        }

                                                                        //Ini kalau pakai JQUERY
                                                                        /* $('[name="options"]').on('change', function() {
                                                                            if ($(this).val() == 1) {
                                                                                if (cameras[0] != "") {
                                                                                    scanner.start(cameras[0]);
                                                                                } else {
                                                                                    alert('No Front camera found!');
                                                                                }
                                                                            } else if ($(this).val() == 2) {
                                                                                if (cameras[1] != "") {
                                                                                    scanner.start(cameras[1]);
                                                                                } else {
                                                                                    alert('No Back camera found!');
                                                                                }
                                                                            }
                                                                        }); */
                                                                    } else {
                                                                        console.error('No cameras found.');
                                                                        alert('No cameras found.');
                                                                    }
                                                                }).catch(function(e) {
                                                                    console.error(e);
                                                                    alert(e);
                                                                });

                                                                //ini vanilla js
                                                                const pdf_button = document.getElementById('id_data')
                                                                pdf_button.addEventListener("click", function() {
                                                                    const pdf_value = document.getElementById('id_data').value
                                                                    if (pdf_value !== "") {
                                                                        location.href = 'data_dompdf_perorangan.php?id=' + pdf_value
                                                                    }

                                                                })

                                                                //ini jquery
                                                                /*  $("#id_data").on("click", function() {
                                                                     const dataid = $("#id_data").val()
                                                                     location.href = 'data_dompdf_perorangan.php?id=' + dataid
                                                                 }) */

                                                            });
                                                        </script>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.Modal -->
                                        <div class="col-sm-4 invoice-col">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:40%">Hari</th>
                                                        <td>: <?= $row_hari['hari']; ?>, <?= $date; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Masuk</th>
                                                        <td>: <?= $jam1; ?> WIB</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Istirahat</th>
                                                        <td>: <?= $jam2; ?> WIB</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Pulang</th>
                                                        <td>: <?= $jam3; ?> WIB</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Absensi</th>
                                                        <td>: <?= $status_absensi; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- this row will not appear when printing -->
                                    <div class="row no-print mb-4">
                                        <div class="col-12">
                                            <?= $button1; ?>
                                            <?php
                                            $hari_ini = date('Y-m-d');
                                            $data_jadwal1 = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
                                            $row_hari1 = mysqli_fetch_array($data_jadwal1);
                                            $absen_jam_pulang = date("H:i", strtotime($row_hari1['jam_pulang']));
                                            $date_pulang = date('H:i:s');
                                            if ($date_pulang <= $absen_jam_pulang) {
                                                $button_absen_pulang = '<button class="btn btn-danger btn-sm disabled"><i class="fa fa-hand-o-down" aria-hidden="true"></i> Absen Pulang</button>';
                                            } elseif ($date_pulang >= $absen_jam_pulang) {
                                                $button_absen_pulang = '<a href="../../public/absensi/absen-pulang.php?key=' . $_SESSION['nik'] . '" id="btn-confirm-pulang"><button class="btn btn-danger btn-sm"><i class="fa fa-hand-o-down" aria-hidden="true"></i> Absen Pulang</button></a>';
                                            }
                                            ?>
                                            <?= $button_absen_pulang; ?>
                                            <?= $button2; ?>
                                        </div>
                                    </div>

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table id="example2" class="table table-striped">
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
                                                        <th>Ket</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal INNER JOIN guru ON absensi.nik = guru.nik_guru where absensi.nik = '" . $_SESSION['nik'] . "' and absensi.tgl_absen = '" . $hari_ini . "' ORDER BY absensi.tgl_absen ASC");
                                                    $countdata = mysqli_num_rows($cek_absensi);
                                                    if ($countdata > 0) {
                                                        $nomor = 1;
                                                        while ($row_absensi_guru = mysqli_fetch_array($cek_absensi)) {
                                                            $jam_masuk = date("H:i", strtotime($row_absensi_guru['jam_masuk']));
                                                            $jam_pulang = date("H:i", strtotime($row_absensi_guru['jam_pulang']));
                                                            // $absen_masuk = date("H:i", strtotime($row_absensi_guru['absen_masuk']));
                                                            // $absen_pulang = date("H:i", strtotime($row_absensi_guru['absen_pulang']));
                                                            // $terlambat = date("H:i:s", strtotime($row_absensi_guru['terlambat']));
                                                            $tgl_absensi = tgl_indo(date("Y-m-d", strtotime($row_absensi_guru['tgl_absen'])));
                                                            if ($row_absensi_guru['status'] == 'Hadir') {
                                                                $izin = '<small class="badge badge-success">Hadir</small>';
                                                            } elseif ($row_absensi_guru['status'] == 'Izin') {
                                                                $izin = '<small class="badge badge-warning">Izin</small>';
                                                            } elseif ($row_absensi_guru['status'] == 'Tidak Hadir') {
                                                                $izin = '<small class="badge badge-danger">Tidak Hadir</small>';
                                                            }
                                                            if ($row_absensi_guru['selesai'] == 'Tidak') {
                                                                $selesai = '-';
                                                            } elseif ($row_absensi_guru['selesai'] == 'Ya') {
                                                                $selesai = 'Selesai';
                                                            }

                                                    ?>
                                                            <tr>
                                                                <td><?= $row_absensi_guru['nama_guru']; ?></td>
                                                                <td><?= $jam_masuk; ?> WIB</td>
                                                                <td><?= $jam_pulang; ?> WIB</td>
                                                                <td style="color: green;"><?= $row_absensi_guru['absen_masuk'] ?></td>
                                                                <td style="color: red;"><?= $row_absensi_guru['absen_pulang']; ?></td>
                                                                <td><?= $row_absensi_guru['terlambat']; ?></td>
                                                                <td><?= $tgl_absensi; ?></td>
                                                                <td><?= $izin; ?></td>
                                                                <td><?= $selesai; ?></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td colspan='9' style="text-align: center;">Data Masih Kosong</td>
                                                        </tr>
                                                    <?php   } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
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

    public function AbsenKaryawan()
    { ?>
        <?php
        $activePage = 'AbsensiKaryawan';
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
                        Swal.fire({icon: 'error', title: 'Maaf!', text: '$_SESSION[gagal]',
                        showConfirmButton: false,
                        timer: 3000
                        })
                    </script>";
            unset($_SESSION['gagal']);
        }
        ?>
        <div class="wrapper">
            <meta http-equiv="refresh" content="60">
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
                        <div class="row">


                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="callout callout-info">
                                    <h5><i class="fas fa-info"></i> Note:</h5>
                                    Kehadiran Guru ataupun Karyawan merupakan kunci bagi terwujudnya kegiatan pembelajaran yang efektif dalam proses belajar mengajar maupun kedisiplinan dalam sekolah. Ketidakhadiran Guru ataupun Karyawan menunjukkan adanya pelanggaran disiplin dan mengindikasikan kinerja yang rendah.
                                </div>
                                <?php
                                $data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON karyawan.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON karyawan.nik_karyawan = user_login.nik where karyawan.nik_karyawan = '" . $_SESSION['nik'] . "'");
                                $row_karyawan = mysqli_fetch_array($data_karyawan)
                                ?>
                                <!-- Main content -->
                                <div class="invoice p-3 mb-3">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>
                                                <i class="fa fa-clock-o"></i> Jam : <b><span id="jam" style="font-size:24"></span></b> WIB
                                            </h4>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:45%">Nama Lengkap</th>
                                                        <td>: <?= $row_karyawan['nama_karyawan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NIK</th>
                                                        <td>: <?= $row_karyawan['nik_karyawan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>NUPTK</th>
                                                        <td>: <?= $row_karyawan['nuptk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jenis Kelamin</th>
                                                        <td>: <?= $row_karyawan['jk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jabatan</th>
                                                        <td>: <?= $row_karyawan['nama_jabatan']; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:45%">Mata Pelajaran</th>
                                                        <td>: <?= $row_karyawan['mata_pelajaran']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jurusan</th>
                                                        <td>: <?= $row_karyawan['nama_jurusan']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Induk</th>
                                                        <td>: <?= $row_karyawan['induk']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>TMT</th>
                                                        <td>: <?= tgl_indo(date('Y-m-d', strtotime($row_karyawan['tmt']))); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->

                                        <?php

                                        $hari = hari_ini();

                                        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
                                        $row_hari = mysqli_fetch_array($data_jadwal);
                                        $jam1 = date("H:i", strtotime($row_hari['jam_masuk']));
                                        $jam2 = date("H:i", strtotime($row_hari['jam_istirahat']));
                                        $jam3 = date("H:i", strtotime($row_hari['jam_pulang']));
                                        $date = tgl_indo(date('Y-m-d'));
                                        $batasan_time = date('H:i:s');
                                        if ($batasan_time <= $jam1) {
                                            $button1 =  '<button class="btn btn-primary btn-sm disabled"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Absen Masuk</button>';
                                            $status_absensi = '<small class="badge badge-danger"><i class="far fa-clock"></i> Absensi Belum Dimulai</small>';
                                            $button2 = '<button class="btn btn-warning btn-sm disabled">Izin Absen</button>';
                                        } elseif ($batasan_time >= $jam1) {
                                            $button1 = '<a href="../../public/absensi/absen-masuk-karyawan.php?key=' . $_SESSION['nik'] . '" id="btn-confirm-absen-masuk">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Absen Masuk</button>
                                            </a>';
                                            $status_absensi = '<small class="badge badge-success"><i class="fa fa-check"></i> Absensi Sudah Dimulai</small>';
                                            $button2 = '<a href="../../public/absensi/absen-izin-karyawan.php?key=' . $_SESSION['nik'] . '" id="btn-confirm-absen-izin">
                                            <button class="btn btn-warning btn-sm">Izin Absen</button>
                                            </a>';
                                        }

                                        ?>
                                        <div class="col-sm-4 invoice-col">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tr>
                                                        <th style="width:40%">Hari</th>
                                                        <td>: <?= $row_hari['hari']; ?>, <?= $date; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Masuk</th>
                                                        <td>: <?= $jam1; ?> WIB</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Istirahat</th>
                                                        <td>: <?= $jam2; ?> WIB</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Jam Pulang</th>
                                                        <td>: <?= $jam3; ?> WIB</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status Absensi</th>
                                                        <td>: <?= $status_absensi; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                     

                                    <!-- this row will not appear when printing -->
                                    <div class="row no-print mb-4">
                                        <div class="col-12">
                                            <?= $button1; ?>
                                            <?php
                                            $hari_ini = date('Y-m-d');
                                            $data_jadwal1 = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
                                            $row_hari1 = mysqli_fetch_array($data_jadwal1);
                                            $absen_jam_pulang = date("H:i", strtotime($row_hari1['jam_pulang']));
                                            $date_pulang = date('H:i:s');
                                            if ($date_pulang <= $absen_jam_pulang) {
                                                $button_absen_pulang = '<button class="btn btn-danger btn-sm disabled"><i class="fa fa-hand-o-down" aria-hidden="true"></i> Absen Pulang</button>';
                                            } elseif ($date_pulang >= $absen_jam_pulang) {
                                                $button_absen_pulang = '<a href="../../public/absensi/absen-pulang.php?key=' . $_SESSION['nik'] . '" id="btn-confirm-pulang"><button class="btn btn-danger btn-sm"><i class="fa fa-hand-o-down" aria-hidden="true"></i> Absen Pulang</button></a>';
                                            }
                                            ?>
                                            <?= $button_absen_pulang; ?>
                                            <?= $button2; ?>
                                        </div>
                                    </div>

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <table id="example2" class="table table-striped">
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
                                                        <th>Ket</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal INNER JOIN karyawan ON absensi.nik = karyawan.nik_karyawan where absensi.nik = '" . $_SESSION['nik'] . "' and absensi.tgl_absen = '" . $hari_ini . "' ORDER BY absensi.tgl_absen ASC");
                                                    $countdata = mysqli_num_rows($cek_absensi);
                                                    if ($countdata > 0) {
                                                        $nomor = 1;
                                                        while ($row_absensi_karyawan = mysqli_fetch_array($cek_absensi)) {
                                                            $jam_masuk = date("H:i", strtotime($row_absensi_karyawan['jam_masuk']));
                                                            $jam_pulang = date("H:i", strtotime($row_absensi_karyawan['jam_pulang']));
                                                            // $absen_masuk = date("H:i", strtotime($row_absensi_karyawan['absen_masuk']));
                                                            // $absen_pulang = date("H:i", strtotime($row_absensi_karyawan['absen_pulang']));
                                                            // $terlambat = date("H:i:s", strtotime($row_absensi_guru['terlambat']));
                                                            $tgl_absensi = tgl_indo(date("Y-m-d", strtotime($row_absensi_karyawan['tgl_absen'])));
                                                            if ($row_absensi_karyawan['status'] == 'Hadir') {
                                                                $izin = '<small class="badge badge-success">Hadir</small>';
                                                            } elseif ($row_absensi_karyawan['status'] == 'Izin') {
                                                                $izin = '<small class="badge badge-warning">Izin</small>';
                                                            } elseif ($row_absensi_karyawan['status'] == 'Tidak Hadir') {
                                                                $izin = '<small class="badge badge-danger">Tidak Hadir</small>';
                                                            }
                                                            if ($row_absensi_karyawan['selesai'] == 'Tidak') {
                                                                $selesai = '-';
                                                            } elseif ($row_absensi_karyawan['selesai'] == 'Ya') {
                                                                $selesai = 'Selesai';
                                                            }

                                                    ?>
                                                            <tr>
                                                                <td><?= $row_absensi_karyawan['nama_karyawan']; ?></td>
                                                                <td><?= $jam_masuk; ?> WIB</td>
                                                                <td><?= $jam_pulang; ?> WIB</td>
                                                                <td style="color: green;"><?= $row_absensi_karyawan['absen_masuk']; ?></td>
                                                                <td style="color: red;"><?= $row_absensi_karyawan['absen_pulang']; ?></td>
                                                                <td><?= $row_absensi_karyawan['terlambat']; ?></td>
                                                                <td><?= $tgl_absensi; ?></td>
                                                                <td><?= $izin; ?></td>
                                                                <td><?= $selesai; ?></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td colspan='9' style="text-align: center;">Data Masih Kosong</td>
                                                        </tr>
                                                    <?php   } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                </div>
                                <!-- /.invoice -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
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


    //REPORT
    public function QRcode_guru()
    { ?>
        <?php
        $master = "Master1";
        $activePage = 'DataGuru';
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
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">QRCode Guru</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php
                                                // nama folder tempat penyimpanan file qrcode
                                                $penyimpanan = "../../temp/";
                                                $key = $_GET['key'];
                                                $ambil_nik = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN jabatan ON guru.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON guru.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON guru.nik_guru = user_login.nik where guru.nik_guru = '" . $key . "'");
                                                $row_guru = mysqli_fetch_array($ambil_nik);
                                                // isi qrcode yang ingin dibuat. akan muncul saat di scan
                                                $isi = $row_guru['nik_guru'];

                                                // perintah untuk membuat qrcode dan menyimpannya dalam folder temp
                                                QRcode::png($isi, $penyimpanan . "qrcode.png");
                                                // echo '<h5>Scann Barcode</h5>';
                                                // menampilkan qrcode 


                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                echo '<center><img class="img-fluid" src="' . $penyimpanan . 'qrcode.png" style="width:150px"></center>';
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <!-- <blockquote class="quote-secondary"> -->
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th style="width:40%">Nama Lengkap</th>
                                                            <td>: <?= $row_guru['nama_guru']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>NIK</th>
                                                            <td>: <?= $row_guru['nik_guru']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>NUPTK</th>
                                                            <td>: <?= $row_guru['nuptk']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jenis Kelamin</th>
                                                            <td>: <?= $row_guru['jk']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Jabatan</th>
                                                            <td>: <?= $row_guru['nama_jabatan']; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <!-- </blockquote> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../../public/guru/data-guru">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Kembali</button>
                                        </a>
                                        <a href="../../public/guru/cetak-kartu-absensi-guru.php?key=<?= $row_guru['nik_guru'] ?>" target="_blank">
                                            <button type="button" class="btn btn-primary btn-sm">Cetak Kartu Absensi</button>
                                        </a>
                                    </div>
                                    <!-- /.card-body -->
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

    public function QRcode_Karyawan() {}
}
