<?php
require_once "../../phpqrcode/qrlib.php";
$koneksi = mysqli_connect("localhost", "root", "", "db_absensi");
$penyimpanan = "../../temp/";
$key = $_GET['key'];
$ambil_nik = mysqli_query($koneksi, "SELECT *FROM guru INNER JOIN jabatan ON guru.id_jabatan = jabatan.id_jabatan INNER JOIN jurusan ON guru.id_jurusan = jurusan.id_jurusan INNER JOIN user_login ON guru.nik_guru = user_login.nik where guru.nik_guru = '" . $key . "'");
$row_guru = mysqli_fetch_array($ambil_nik);
// isi qrcode yang ingin dibuat. akan muncul saat di scan
$isi = $row_guru['nik_guru'];

// perintah untuk membuat qrcode dan menyimpannya dalam folder temp
QRcode::png($isi, $penyimpanan . "qrcode.png");
// echo '<h5>Scann Barcode</h5>';
// menampilkan qrcode 
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kartu Absensi Guru - <?= $row_guru['nama_guru']; ?> <?php echo date('Y') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
        body {
            background-color: transparent;
        }

        .profile {
            margin-top: -805px;
            width: 120px;
            height: 120px;
            margin-left: 0px;
            border-radius: 50%;
            border: 1px solid #fff;
        }

        .qr {
            width: 120px;
            /* margin-top: 0px; */
            width: 150px;
            height: 150px;
            /* margin-left: 200px; */
        }

        .qr1 {
            width: 120px;
            margin-top: -10px;
            width: 70px;
            height: 70px;
            margin-left: 170px;
        }




        .card {
            border: 1px solid #fff;
        }
    </style>
</head>

<body class="container">
    <center>
        <div class="row mt-4">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card text-center" style="width: 21rem;">
                    <img src="../../temp/background-absensi1.jpg" style="height:530px; border: 1px solid #4682B4;">
                    <div class="card-body">
                        <?php echo '<img src="../../public/profile/' . $row_guru['img'] . '" class="profile">'; ?>
                        <h5 class="card-title" style="margin-top: -330px; font-size:16px; text-transform:uppercase; "><b><?= $row_guru['nama_guru']; ?></b></h5>
                        <h5 class=" card-title" style="margin-top:-5px; font-size:14px; text-transform:uppercase;color:#4682B4;"><b><?= $row_guru['nama_jabatan']; ?></b></h5><br>
                        <p class="card-text" style="text-align: left; margin-left:50px; margin-top:-15px; font-weight:600; color:grey">ID &ensp; &ensp; &ensp;&ensp;: <?= $row_guru['nik_guru']; ?><br>Induk&ensp; &ensp;: <?= $row_guru['induk']; ?><br>
                            TMT &ensp;&ensp;&ensp;: <?= $row_guru['tmt']; ?> <br>Telepon : <?= $row_guru['tlp_guru']; ?></p>
                        <?php echo '<img src="' . $penyimpanan . 'qrcode.png" class="qr1">'; ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card text-center" style="width: 21rem;">
                    <img src="../../temp/background-absensi2.jpg" style="height:530px; border: 1px solid #4682B4;">
                    <div class="card-body">
                        <h5 class="card-title" style="margin-top: -470px;font-size:16px;"><b>Term and Condition</b></h5>
                        <?php echo '<img src="' . $penyimpanan . 'qrcode.png" class="qr">'; ?>
                        <h5 class="card-title" style="font-size:16px; text-transform:uppercase; "><b><?= $row_guru['nama_guru']; ?></b></h5>
                        <h5 class=" card-title" style="margin-top:-5px;font-size:14px; text-transform:uppercase;color:#4682B4;"><b><?= $row_guru['nama_jabatan']; ?></b></h5><br>
                        <h5 class=" card-title" style="margin-top:-15px;font-size:16px;"><b>ID : <?= $row_guru['nik_guru']; ?></b></h5>
                        <h5 class=" card-title" style="margin-top:-5px;font-size:16px;"><b>EXPIRED : 31/12/<?php echo date('Y') ?></b></h5>
                        <p class="card-text" style="margin-top: 25px;">
                        <ul>
                            <li style="text-align: justify; font-size:12px;">Kartu ini berfungsi sebagai kartu identitas & absensi.</li>
                            <li style="text-align: justify; font-size:12px;">Kartu identitas ini wajib digunakan selama betugas.</li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <script>
        window.print();
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>