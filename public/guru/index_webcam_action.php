<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "db_absensi");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['qrcode'])) {
    // Mengambil data dari QR Code yang di-scan
    $qr_data = $_POST['qrcode'];
    // QR Code berisi NIK
    $nik = $qr_data;
    $date_add = date('Y-m-d');
    $hari_ini = date('l'); // Mendapatkan nama hari ini dalam format teks (misalnya Senin, Selasa, dll)

    // Map hari dalam format teks ke bahasa Indonesia
    $hari_map = [
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu',
        'Sunday' => 'Minggu'
    ];

    $hari_indonesia = $hari_map[$hari_ini];

    // Cek apakah data guru dengan NIK tersebut ada
    $sql = mysqli_query($koneksi, "SELECT * FROM guru WHERE nik_guru='$nik'");
    $data = mysqli_fetch_array($sql);

    if ($data) {
        // Ambil data yang diperlukan
        $absen_masuk = 'Masuk';
        $absen_pulang = '-';
        $status = 'Hadir';
        $selesai = 'Tidak';

        // Cek apakah sudah absen hari ini
        $cek_absensi = mysqli_query($koneksi, "SELECT * FROM absensi WHERE nik = '$nik' AND tgl_absen = '$date_add'");
        
        if (mysqli_num_rows($cek_absensi) == 0) {
            // Cari id_jadwal berdasarkan hari ini
            $jadwal_query = mysqli_query($koneksi, "SELECT id_jadwal FROM jadwal WHERE hari = '$hari_indonesia'");
            $jadwal_data = mysqli_fetch_array($jadwal_query);
            
            if ($jadwal_data) {
                $id_jadwal = $jadwal_data['id_jadwal'];

                // Simpan absen jika belum ada
                $Simpan = mysqli_query($koneksi, "INSERT INTO absensi (nik, id_jadwal, tgl_absen, absen_masuk, absen_pulang, terlambat, status, selesai) VALUES ('$nik', '$id_jadwal', '$date_add', '$absen_masuk', '$absen_pulang', '-', '$status', '$selesai')");

                if ($Simpan) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Absensi berhasil disimpan.',
                        'data' => $data
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat menyimpan absensi. Silakan coba lagi.',
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Data jadwal tidak ditemukan untuk hari ini.',
                ];
            }
        } else {
            $response = [
                'status' => 'warning',
                'message' => 'Anda sudah melakukan absensi hari ini!',
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Data guru tidak ditemukan. Pastikan Anda menggunakan QR Code yang benar.',
        ];
    }

    echo json_encode($response);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'QR Code tidak terdeteksi. Silakan coba lagi.',
    ]);
}
?>
