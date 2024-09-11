<?php session_start() ?>
<!--  -->
<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_absensi");
$tgl_awal = $_GET['key1']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
$tgl_akhir = $_GET['key2']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
$tgl_awal1 = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
$tgl_akhir1 = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laporan Absen Karyawan Periode : <?= $tgl_awal1; ?> s/d <?= $tgl_akhir1; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>



<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <center>
                            <img src="../assets/dist/img/kop-surat.jpg" alt="" style="width: 800px; height:200px">
                        </center>

                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                    <address style="text-align: center;">
                        <strong style="font-size: 25px;">Laporan Absensi Karyawan</strong><br>
                        <small>Periode: <?= $tgl_awal1; ?> s/d <?= $tgl_akhir1; ?></small>
                    </address>
                </div>


            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row mt-2">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
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
                            if (empty($tgl_awal) or empty($tgl_akhir)) {
                                $data = mysqli_query($koneksi, "SELECT *FROM absensi INNER JOIN karyawan ON absensi.nik = karyawan.nik_karyawan INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal");
                            } else {
                                $data = mysqli_query($koneksi, "SELECT *FROM absensi INNER JOIN karyawan ON absensi.nik = karyawan.nik_karyawan INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal where absensi.tgl_absen BETWEEN '" . $tgl_awal . "' and '" . $tgl_akhir . "'");
                            }
                            $countdata = mysqli_num_rows($data);
                            if ($countdata > 0) {
                                while ($row_absen_karyawan = mysqli_fetch_array($data)) {
                                    $jam_masuk = date("H:i", strtotime($row_absen_karyawan['jam_masuk']));
                                    $jam_pulang = date("H:i", strtotime($row_absen_karyawan['jam_pulang']));
                                    if ($row_absen_karyawan['status'] == 'Hadir') {
                                        $izin = '<small style="color:green">Hadir</small>';
                                    } elseif ($row_absen_karyawan['status'] == 'Izin') {
                                        $izin = '<small style="color:yellow">Izin</small>';
                                    } elseif ($row_absen_karyawan['status'] == 'Tidak Hadir') {
                                        $izin = '<small style="color:red">Tidak Hadir</small>';
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
                                <?php }
                            } else { ?>
                                <tr>
                                    <td colspan='8' style="text-align: center;">Data Masih Kosong</td>
                                </tr>
                            <?php   } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>