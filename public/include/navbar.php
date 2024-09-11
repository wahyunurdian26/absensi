<?php
if ($_SESSION['role'] == 'ROL001') {
    $cek1 = mysqli_query($this->koneksi->link, "SELECT *FROM admin INNER JOIN jabatan ON admin.id_jabatan = jabatan.id_jabatan where admin.nik_admin = '" . $_SESSION['nik'] . "'");
    $data1 = mysqli_fetch_array($cek1);
    $nama = $data1['nama_admin'];
    $img = $data1['img'];
    $jabatan = $data1['nama_jabatan'];
} elseif ($_SESSION['role'] == 'ROL002') {
    $cek2 = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN jabatan ON guru.id_jabatan = jabatan.id_jabatan where guru.nik_guru = '" . $_SESSION['nik'] . "'");
    $data2 = mysqli_fetch_array($cek2);
    $nama = $data2['nama_guru'];
    $img = $data2['img'];
    $jabatan = $data2['nama_jabatan'];
} elseif ($_SESSION['role'] == 'ROL003') {
    $cek3 = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan where karyawan.nik_karyawan = '" . $_SESSION['nik'] . "'");
    $data3 = mysqli_fetch_array($cek3);
    $nama = $data3['nama_karyawan'];
    $img = $data3['img'];
    $jabatan = $data3['nama_jabatan'];
}

?>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <small style="font-size: 14px;"><b>Hi, <?= $nama; ?> <i class="fas fa-angle-down"></i></b></small>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="../profile/<?= $img ?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                <?= $nama; ?>
                                <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> -->
                            </h3>
                            <p class="text-muted"><?= $jabatan; ?></p>
                            <!-- <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> -->
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>

                <a href="../../public/user/profile" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#update<?= $_SESSION['nik'] ?>">
                    <i class="fas fa-gear mr-2"></i> Setting Account
                </a>


                <div class="dropdown-divider"></div>
                <a href="../include/logout.php" id="btn-logout" class="dropdown-item dropdown-footer">Logout</a>
            </div>
        </li>

    </ul>
</nav>

<?php
$cek_session = mysqli_query($this->koneksi->link, "SELECT *FROM user_login where nik = '" . $_SESSION['nik'] . "'");
$row_session = mysqli_fetch_array($cek_session);
$pass = base64_decode($row_session['password']);
?>
<!-- Modal -->
<div class="modal fade" id="update<?= $_SESSION['nik'] ?>" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../public/user/update-setting.php" method="post">
                    <input type="hidden" name="id" value="<?= $row_session['id_user'] ?>">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $row_session['nik'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="password" placeholder="Password Baru" required>
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