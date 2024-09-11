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
<html>

<head>
    <title>Data Absensi Guru</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Absensi Guru Periode.xls");
    ?>

    <center>
        <h3>Data Absensi Guru 2024</h3>
    </center>

    <table border="1">
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
            if (empty($tgl_awal) or empty($tgl_akhir)) {
                $data = mysqli_query($koneksi, "SELECT *FROM absensi INNER JOIN guru ON absensi.nik = guru.nik_guru INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal");
            } else {
                $data = mysqli_query($koneksi, "SELECT *FROM absensi INNER JOIN guru ON absensi.nik = guru.nik_guru INNER JOIN jadwal ON absensi.id_jadwal = jadwal.id_jadwal where absensi.tgl_absen BETWEEN '" . $tgl_awal . "' and '" . $tgl_akhir . "'");
            }
            $countdata = mysqli_num_rows($data);
            if ($countdata > 0) {
                while ($row_absen_guru = mysqli_fetch_array($data)) {
                    $jam_masuk = date("H:i", strtotime($row_absen_guru['jam_masuk']));
                    $jam_pulang = date("H:i", strtotime($row_absen_guru['jam_pulang']));
                    if ($row_absen_guru['status'] == 'Hadir') {
                        $izin = '<small style="color:green">Hadir</small>';
                    } elseif ($row_absen_guru['status'] == 'Izin') {
                        $izin = '<small style="color:black">Izin</small>';
                    } elseif ($row_absen_guru['status'] == 'Tidak Hadir') {
                        $izin = '<small style="color:red">Tidak Hadir</small>';
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
                <?php }
            } else { ?>
                <tr>
                    <td colspan='8' style="text-align: center;">Data Masih Kosong</td>
                </tr>
            <?php   } ?>
        </tbody>
    </table>

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

</body>

</html>