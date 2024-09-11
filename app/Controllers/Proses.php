<?php
require_once "../../public/include/index.php";
require_once "Login.php";
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");
class Proses extends Login
{
    public function SimpanKegiatan()
    {
        $kegiatan = $_POST['kegiatan'];
        $date_add = $_POST['mulai'];
        $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO kegiatan values('','" . $kegiatan . "','" . $date_add . "')");
        if ($Simpan) {
            //set session sukses
            $_SESSION["berhasil"] = 'kegiatan berhasil ditambahkan';
            //redirect ke halaman
            echo '<script> location.replace("../../public/dashboard/admin"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/dashboard/admin"); </script>';
        }
    }

    public function UpdateAccount()
    {
        if ($_SESSION['role'] == 'ROL001') {
            $home = '../../public/dashboard/admin';
        } elseif ($_SESSION['role'] == 'ROL002') {
            $home = '../../public/dashboard/guru';
        } elseif ($_SESSION['role'] == 'ROL003') {
            $home = '../../public/dashboard/karyawan';
        }

        $id = $_POST['id'];
        $password = base64_encode($_POST['password']);
        $Update = mysqli_query($this->koneksi->link, "UPDATE user_login set password = '" . $password . "' where id_user = '" . $id . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["berhasil"] = 'Password telah diupdate';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        }
    }

    public function UpdateProfile()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $fotolama = $_POST['fotolama'];

        $img_tmp = $_FILES['fotomhs']['tmp_name'];
        $img_name = $_FILES['fotomhs']['name'];

        if ($_SESSION['role'] == 'ROL001') {
            if ($img_name) {
                unlink('../../public/profile/' . $fotolama);
                move_uploaded_file($img_tmp, '../../public/profile/' . $img_name);
                $Update = mysqli_query($this->koneksi->link, "UPDATE admin set nama_admin = '" . $nama . "', img = '$img_name' where id_admin = '" . $id . "'");
            } else {
                $Update = mysqli_query($this->koneksi->link, "UPDATE admin set nama_admin = '" . $nama . "' where id_admin ='" . $id . "'");
            }
            if ($Update) {
                //set session sukses
                $_SESSION["berhasil"] = 'Profile telah diupdate';
                //redirect ke halaman
                echo '<script> location.replace("../../public/dashboard/admin"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/dashboard/admin"); </script>';
            }
        } elseif ($_SESSION['role'] == 'ROL002') {
            if ($img_name) {
                unlink('../../public/profile/' . $fotolama);
                move_uploaded_file($img_tmp, '../../public/profile/' . $img_name);
                $Update = mysqli_query($this->koneksi->link, "UPDATE guru set nama_guru = '" . $nama . "', img = '$img_name' where id_guru = '" . $id . "'");
            } else {
                $Update = mysqli_query($this->koneksi->link, "UPDATE guru set nama_guru = '" . $nama . "' where id_guru ='" . $id . "'");
            }
            if ($Update) {
                //set session sukses
                $_SESSION["berhasil"] = 'Profile telah diupdate';
                //redirect ke halaman
                echo '<script> location.replace("../../public/dashboard/guru"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/dashboard/guru"); </script>';
            }
        } elseif ($_SESSION['role'] == 'ROL003') {
            if ($img_name) {
                unlink('../../public/profile/' . $fotolama);
                move_uploaded_file($img_tmp, '../../public/profile/' . $img_name);
                $Update = mysqli_query($this->koneksi->link, "UPDATE karyawan set nama_karyawan = '" . $nama . "', img = '$img_name' where id_karyawan = '" . $id . "'");
            } else {
                $Update = mysqli_query($this->koneksi->link, "UPDATE karyawan set nama_karyawan = '" . $nama . "' where id_karyawan ='" . $id . "'");
            }
            if ($Update) {
                //set session sukses
                $_SESSION["berhasil"] = 'Profile telah diupdate';
                //redirect ke halaman
                echo '<script> location.replace("../../public/dashboard/karyawan"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/dashboard/karyawan"); </script>';
            }
        }
    }

    public function DeleteKegiatan()
    {
        $key = $_GET['key'];
        $Delete = mysqli_query($this->koneksi->link, "DELETE FROM kegiatan where id_kegiatan = '" . $key . "'");
        if ($Delete) {
            //set session sukses
            $_SESSION["berhasil"] = 'kegiatan berhasil dihapus';
            //redirect ke halaman
            echo '<script> location.replace("../../public/dashboard/admin"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/dashboard/admin"); </script>';
        }
    }

    public function SimpanPelajaran()
    {
        $nama = $_POST['nama'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM pelajaran where nama_pelajaran = '" . $nama . "'");
        $jml = mysqli_num_rows($cek);
        if ($jml > 0) {
            //set session gagal
            $_SESSION["gagal"] = 'Data pelajaran sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/pelajaran/mata-pelajaran"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT pelajaran values('','" . $nama . "')");

            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/pelajaran/mata-pelajaran"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/pelajaran/mata-pelajaran"); </script>';
            }
        }
    }

    public function UpdatePelajaran()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $Update = mysqli_query($this->koneksi->link, "UPDATE pelajaran set nama_pelajaran = '" . $nama . "' where id_mata_pelajaran = '" . $id . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil diupdate';
            //redirect ke halaman
            echo '<script> location.replace("../../public/pelajaran/mata-pelajaran"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/pelajaran/mata-pelajaran"); </script>';
        }
    }

    public function DeletePelajaran()
    {
        $key = $_GET['key'];
        $Delete = mysqli_query($this->koneksi->link, "DELETE FROM pelajaran where id_mata_pelajaran = '" . $key . "'");
        if ($Delete) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil dihapus';
            //redirect ke halaman
            echo '<script> location.replace("../../public/pelajaran/mata-pelajaran"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/pelajaran/mata-pelajaran"); </script>';
        }
    }

    public function SimpanJurusan()
    {
        $nama = $_POST['nama'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM jurusan where nama_jurusan = '" . $nama . "'");
        $jml = mysqli_num_rows($cek);
        if ($jml > 0) {
            //set session gagal
            $_SESSION["gagal"] = 'Data jurusan sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jurusan/data-jurusan"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT jurusan values('','" . $nama . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/jurusan/data-jurusan"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/jurusan/data-jurusan"); </script>';
            }
        }
    }

    public function UpdateJurusan()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $Update = mysqli_query($this->koneksi->link, "UPDATE jurusan set nama_jurusan = '" . $nama . "' where id_jurusan = '" . $id . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil diupdate';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jurusan/data-jurusan"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jurusan/data-jurusan"); </script>';
        }
    }

    public function DeleteJurusan()
    {
        $key = $_GET['key'];
        $Delete = mysqli_query($this->koneksi->link, "DELETE FROM jurusan where id_jurusan = '" . $key . "'");
        if ($Delete) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil dihapus';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jurusan/data-jurusan"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jurusan/data-jurusan"); </script>';
        }
    }

    public function SimpanJabatan()
    {
        $nama = $_POST['nama'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM jabatan where nama_jabatan = '" . $nama . "'");
        $jml = mysqli_num_rows($cek);
        if ($jml > 0) {
            //set session gagal
            $_SESSION["gagal"] = 'Data jabatan sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jabatan/data-jabatan"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT jabatan values('','" . $nama . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/jabatan/data-jabatan"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/jabatan/data-jabatan"); </script>';
            }
        }
    }

    public function UpdateJabatan()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $Update = mysqli_query($this->koneksi->link, "UPDATE jabatan set nama_jabatan = '" . $nama . "' where id_jabatan = '" . $id . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil diupdate';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jabatan/data-jabatan"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jabatan/data-jabatan"); </script>';
        }
    }

    public function DeleteJabatan()
    {
        $key = $_GET['key'];
        $Delete = mysqli_query($this->koneksi->link, "DELETE FROM jabatan where id_jabatan = '" . $key . "'");
        if ($Delete) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil dihapus';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jabatan/data-jabatan"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jabatan/data-jabatan"); </script>';
        }
    }

    public function SimpanAdmin()
    {
        $nik = $_POST['nik'];
        $nuptk = $_POST['nuptk'];
        $nama_admin = $_POST['nama'];
        $jk = $_POST['jk'];
        $id_jabatan = $_POST['id_jabatan'];
        $id_jurusan = $_POST['id_jurusan'];
        $induk = $_POST['induk'];
        $tmt = $_POST['tmt'];
        // $profile = $_POST['profile'];
        $password = base64_encode($_POST['password']);
        $status_active = 0;
        $status_aktivasi = 1;
        $role = 'ROL001';
        $date_add = date('Y-m-d H:i:s');

        $cek_admin = mysqli_query($this->koneksi->link, "SELECT *FROM admin INNER JOIN user_login ON admin.nik_admin = user_Login.nik where user_login.nik = '" . $nik . "'");
        $jml = mysqli_num_rows($cek_admin);
        if ($jml > 0) {
            //set session gagal
            $_SESSION["gagal"] = 'NIK sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/admin/data-admin"); </script>';
        } else {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $nama = $_FILES['file']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 20044070) {
                    move_uploaded_file($file_tmp, '../../public/profile/' . $nama);
                    $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO admin values('','" . $nik . "','" . $nuptk . "','" . $nama_admin . "','" . $jk . "','" . $id_jabatan . "','" . $id_jurusan . "','" . $induk . "','" . $tmt . "','" . $nama . "')");
                    $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO user_login values('','" . $nik . "','" . $password . "','" . $role . "','" . $status_active . "','" . $status_aktivasi . "','" . $date_add . "')");
                    if ($Simpan) {
                        //set session sukses
                        $_SESSION["berhasil"] = 'Data admin berhasil disimpan';
                        //redirect ke halaman
                        echo '<script> location.replace("../../public/admin/data-admin"); </script>';
                    } else {
                        //set session gagal
                        $_SESSION["gagal"] = 'gagal!';
                        //redirect ke halaman
                        echo '<script> location.replace("../../public/admin/data-admin"); </script>';
                    }
                }
            }
        }
    }

    public function DeleteAdmin()
    {
        $key = $_GET['key'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM admin INNER JOIN user_login on admin.nik_admin = user_login.nik WHERE user_login.nik = '$key'");
        $data = mysqli_fetch_array($cek);

        if ($data['status_active'] == '1') {
            $_SESSION["gagal"] = 'Administrator tidak bisa dihapus karena user sedang login';
            echo '<script> location.replace("../../public/admin/data-admin"); </script>';
        } else {
            // $detele = mysqli_query($this->koneksi->link, "DELETE FROM user_login where status_active = '$user'");
            $Delete = mysqli_query($this->koneksi->link, "DELETE admin, user_login FROM admin INNER JOIN user_login ON admin.nik_admin = user_login.nik where user_login.nik = '$key'");
            if ($Delete) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data admin berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/admin/data-admin"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/admin/data-admin"); </script>';
            }
        }
    }

    public function SimpanGuru()
    {
        $nik = $_POST['nik'];
        $nuptk = $_POST['nuptk'];
        $nama_guru = $_POST['nama'];
        $jk = $_POST['jk'];
        $id_jabatan = $_POST['id_jabatan'];
        $id_mata_pelajaran = implode(', ', $_POST['nama_pelajaran']);;
        $id_jurusan = $_POST['id_jurusan'];
        $induk = $_POST['induk'];
        $tmt = $_POST['tmt'];
        // $profile = $_POST['profile'];
        $password = base64_encode($_POST['password']);
        $status_active = 0;
        $status_aktivasi = 1;
        $role = 'ROL002';
        $date_add = date('Y-m-d H:i:s');
        $tlp = $_POST['tlp'];

        $cek_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN user_login ON guru.nik_guru = user_Login.nik where user_login.nik = '" . $nik . "'");
        $jml = mysqli_num_rows($cek_guru);
        if ($jml > 0) {
            //set session gagal
            $_SESSION["gagal"] = 'NIK sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/guru/data-guru"); </script>';
        } else {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $nama = $_FILES['file']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 20044070) {
                    move_uploaded_file($file_tmp, '../../public/profile/' . $nama);
                    $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO guru values('','" . $nik . "','" . $nuptk . "','" . $nama_guru . "','" . $jk . "','" . $id_jabatan . "','" . $id_mata_pelajaran . "','" . $id_jurusan . "','" . $induk . "','" . $tmt . "','" . $nama . "','" . $tlp . "')");
                    $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO user_login values('','" . $nik . "','" . $password . "','" . $role . "','" . $status_active . "','" . $status_aktivasi . "','" . $date_add . "')");
                    if ($Simpan) {
                        //set session sukses
                        $_SESSION["berhasil"] = 'Data guru berhasil disimpan';
                        //redirect ke halaman
                        echo '<script> location.replace("../../public/guru/data-guru"); </script>';
                    } else {
                        //set session gagal
                        $_SESSION["gagal"] = 'gagal!';
                        //redirect ke halaman
                        echo '<script> location.replace("../../public/guru/data-guru"); </script>';
                    }
                }
            }
        }
    }

    public function DeleteGuru()
    {
        $key = $_GET['key'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM guru INNER JOIN user_login on guru.nik_guru = user_login.nik WHERE user_login.nik = '$key'");
        $data = mysqli_fetch_array($cek);

        if ($data['status_active'] == '1') {
            $_SESSION["gagal"] = 'Data Guru tidak bisa dihapus karena user sedang login';
            echo '<script> location.replace("../../public/guru/data-guru"); </script>';
        } else {
            // $detele = mysqli_query($this->koneksi->link, "DELETE FROM user_login where status_active = '$user'");
            $Delete = mysqli_query($this->koneksi->link, "DELETE guru, user_login FROM guru INNER JOIN user_login ON guru.nik_guru = user_login.nik where user_login.nik = '$key'");
            if ($Delete) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data guru berhasil dihapus';
                //redirect ke halaman
                echo '<script> location.replace("../../public/guru/data-guru"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/guru/data-guru"); </script>';
            }
        }
    }

    public function SimpanKaryawan()
    {
        $nik = $_POST['nik'];
        $nuptk = $_POST['nuptk'];
        $nama_karyawan = $_POST['nama'];
        $jk = $_POST['jk'];
        $id_jabatan = $_POST['id_jabatan'];
        $id_mata_pelajaran = implode(', ', $_POST['nama_pelajaran']);;
        $id_jurusan = $_POST['id_jurusan'];
        $induk = $_POST['induk'];
        $tmt = $_POST['tmt'];
        // $profile = $_POST['profile'];
        $password = base64_encode($_POST['password']);
        $status_active = 0;
        $status_aktivasi = 1;
        $role = 'ROL003';
        $date_add = date('Y-m-d H:i:s');

        $cek_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan INNER JOIN user_login ON karyawan.nik_karyawan = user_Login.nik where user_login.nik = '" . $nik . "'");
        $jml = mysqli_num_rows($cek_karyawan);
        if ($jml > 0) {
            //set session gagal
            $_SESSION["gagal"] = 'Nomor Induk Karyawan sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/karyawan/data-karyawan"); </script>';
        } else {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $nama = $_FILES['file']['name'];
            $x = explode('.', $nama);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran < 20044070) {
                    move_uploaded_file($file_tmp, '../../public/profile/' . $nama);
                    $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO karyawan values('','" . $nik . "','" . $nuptk . "','" . $nama_karyawan . "','" . $jk . "','" . $id_jabatan . "','" . $id_mata_pelajaran . "','" . $id_jurusan . "','" . $induk . "','" . $tmt . "','" . $nama . "')");
                    $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO user_login values('','" . $nik . "','" . $password . "','" . $role . "','" . $status_active . "','" . $status_aktivasi . "','" . $date_add . "')");
                    if ($Simpan) {
                        //set session sukses
                        $_SESSION["berhasil"] = 'Data karyawan berhasil disimpan';
                        //redirect ke halaman
                        echo '<script> location.replace("../../public/karyawan/data-karyawan"); </script>';
                    } else {
                        //set session gagal
                        $_SESSION["gagal"] = 'gagal!';
                        //redirect ke halaman
                        echo '<script> location.replace("../../public/karyawan/data-karyawan"); </script>';
                    }
                }
            }
        }
    }

    public function DeleteKaryawan()
    {
        $key = $_GET['key'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan INNER JOIN user_login on karyawan.nik_karyawan = user_login.nik WHERE user_login.nik = '$key'");
        $data = mysqli_fetch_array($cek);

        if ($data['status_active'] == '1') {
            $_SESSION["gagal"] = 'Data Karyawan tidak bisa dihapus karena user sedang login';
            echo '<script> location.replace("../../public/karyawan/data-karyawan"); </script>';
        } else {
            // $detele = mysqli_query($this->koneksi->link, "DELETE FROM user_login where status_active = '$user'");
            $Delete = mysqli_query($this->koneksi->link, "DELETE karyawan, user_login FROM karyawan INNER JOIN user_login ON karyawan.nik_karyawan = user_login.nik where user_login.nik = '$key'");
            if ($Delete) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data karyawan berhasil dihapus';
                //redirect ke halaman
                echo '<script> location.replace("../../public/karyawan/data-karyawan"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/karyawan/data-karyawan"); </script>';
            }
        }
    }

    public function SimpanJadwal()
    {
        $nama = $_POST['nama'];
        $jam_masuk = $_POST['jam_masuk'];
        $jam_istirahat = $_POST['jam_istirahat'];
        $jam_pulang = $_POST['jam_pulang'];
        $cek = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $nama . "'");
        $jml = mysqli_num_rows($cek);
        if ($jml > 0) {
            //set session gagal
            $_SESSION["gagal"] = 'Jadwal sudah ada!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jadwal/data-jadwal"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT jadwal values('','" . $nama . "','" . $jam_masuk . "','" . $jam_istirahat . "','" . $jam_pulang . "')");

            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data jadwal berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/jadwal/data-jadwal"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/jadwal/data-jadwal"); </script>';
            }
        }
    }

    public function UpdateJadwal()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $jam_masuk = $_POST['jam_masuk'];
        $jam_istirahat = $_POST['jam_istirahat'];
        $jam_pulang = $_POST['jam_pulang'];
        $Update = mysqli_query($this->koneksi->link, "UPDATE jadwal set hari = '" . $nama . "', jam_masuk = '" . $jam_masuk . "', jam_istirahat = '" . $jam_istirahat . "', jam_pulang = '" . $jam_pulang . "'  where id_jadwal = '" . $id . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil diupdate';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jadwal/data-jadwal"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jadwal/data-jadwal"); </script>';
        }
    }

    public function DeleteJadwal()
    {
        $key = $_GET['key'];
        $Delete = mysqli_query($this->koneksi->link, "DELETE FROM jadwal where id_jadwal = '" . $key . "'");
        if ($Delete) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data berhasil dihapus';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jadwal/data-jadwal"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/jadwal/data-jadwal"); </script>';
        }
    }

    public function SimpanAbsenMasuk()
    {
        $key = $_GET['key'];
        $ambil_data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru where nik_guru = '" . $_SESSION['nik'] . "'");
        $row_guru = mysqli_fetch_array($ambil_data_guru);
        $nik = $row_guru['nik_guru'];

        $hari = hari_ini();
        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
        $row_hari = mysqli_fetch_array($data_jadwal);
        $id_jadwal = $row_hari['id_jadwal'];
        $date_add = date('Y-m-d');
        $absen_masuk = 'Masuk';
        $absen_masuk1 = strtotime(date('H:i:s'));
        $jam_masuk = strtotime(date($row_hari['jam_masuk']));
        $absen_pulang = '-';
        $terlambat = $absen_masuk1 - $jam_masuk;

        if ($terlambat > 0) {
            $jam   = floor($terlambat / (60 * 60));
            $menit = $terlambat - ($jam * (60 * 60));
            // $detik = $terlambat % 60;
            $hasil = ' ' . $jam .  ' jam, ' . floor($menit / 60) . ' menit ';
        } else {
            $hasil =  "Bagus, Tidak terlambat.";
        }
        $status = 'Hadir';
        $selesai = 'Tidak';

        $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and tgl_absen = '" . $date_add . "'");
        $ambil_absen = mysqli_fetch_array($cek_absensi);
        $tgl_absensi = date("Y-m-d", strtotime($ambil_absen['tgl_absen']));
        if ($tgl_absensi == $date_add) {
            //set session gagal
            $_SESSION["gagal"] = 'Anda sudah melakukan Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/absen-guru"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO absensi values('','" . $nik . "','" . $id_jadwal . "','" . $date_add . "','" . $absen_masuk . "','" . $absen_pulang . "','" . $hasil . "','" . $status . "','" . $selesai . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Absen berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-guru"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-guru"); </script>';
            }
        }
    }

    public function SimpanAbsenIzin()
    {
        $key = $_GET['key'];
        $ambil_data_guru = mysqli_query($this->koneksi->link, "SELECT *FROM guru where nik_guru = '" . $_SESSION['nik'] . "'");
        $row_guru = mysqli_fetch_array($ambil_data_guru);
        $nik = $row_guru['nik_guru'];

        $hari = hari_ini();
        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
        $row_hari = mysqli_fetch_array($data_jadwal);
        $id_jadwal = $row_hari['id_jadwal'];
        $date_add = date('Y-m-d');
        $absen_masuk = '-';
        $absen_pulang = '-';
        $terlambat = '-';

        $status = 'Izin';
        $selesai = 'Ya';

        $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and tgl_absen = '" . $date_add . "'");
        $ambil_absen = mysqli_fetch_array($cek_absensi);
        $tgl_absensi = date("Y-m-d", strtotime($ambil_absen['tgl_absen']));
        if ($tgl_absensi == $date_add) {
            //set session gagal
            $_SESSION["gagal"] = 'Anda sudah melakukan Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/absen-guru"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO absensi values('','" . $nik . "','" . $id_jadwal . "','" . $date_add . "','" . $absen_masuk . "','" . $absen_pulang . "','" . $terlambat . "','" . $status . "','" . $selesai . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Izin Absen berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-guru"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-guru"); </script>';
            }
        }
    }

    public function SimpanAbsenMasukKaryawan()
    {
        $key = $_GET['key'];
        $ambil_data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan where nik_karyawan = '" . $_SESSION['nik'] . "'");
        $row_karyawan = mysqli_fetch_array($ambil_data_karyawan);
        $nik = $row_karyawan['nik_karyawan'];

        $hari = hari_ini();
        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
        $row_hari = mysqli_fetch_array($data_jadwal);
        $id_jadwal = $row_hari['id_jadwal'];
        $date_add = date('Y-m-d');
        $absen_masuk = 'Masuk';
        $absen_masuk1 = strtotime(date('H:i:s'));
        $jam_masuk = strtotime(date($row_hari['jam_masuk']));
        $absen_pulang = '-';
        $terlambat = $absen_masuk1 - $jam_masuk;

        if ($terlambat > 0) {
            $jam   = floor($terlambat / (60 * 60));
            $menit = $terlambat - ($jam * (60 * 60));
            // $detik = $terlambat % 60;
            $hasil = ' ' . $jam .  ' jam, ' . floor($menit / 60) . ' menit ';
        } else {
            $hasil =  "Bagus, Tidak terlambat.";
        }
        $status = 'Hadir';
        $selesai = 'Tidak';

        $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and tgl_absen = '" . $date_add . "'");
        $ambil_absen = mysqli_fetch_array($cek_absensi);
        $tgl_absensi = date("Y-m-d", strtotime($ambil_absen['tgl_absen']));
        if ($tgl_absensi == $date_add) {
            //set session gagal
            $_SESSION["gagal"] = 'Anda sudah melakukan Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/absen-karyawan"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO absensi values('','" . $nik . "','" . $id_jadwal . "','" . $date_add . "','" . $absen_masuk . "','" . $absen_pulang . "','" . $hasil . "','" . $status . "','" . $selesai . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Absen berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-karyawan"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-karyawan"); </script>';
            }
        }
    }

    public function SimpanAbsenIzinKaryawan()
    {
        $key = $_GET['key'];
        $ambil_data_karyawan = mysqli_query($this->koneksi->link, "SELECT *FROM karyawan where nik_karyawan = '" . $_SESSION['nik'] . "'");
        $row_karyawan = mysqli_fetch_array($ambil_data_karyawan);
        $nik = $row_karyawan['nik_karyawan'];

        $hari = hari_ini();
        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
        $row_hari = mysqli_fetch_array($data_jadwal);
        $id_jadwal = $row_hari['id_jadwal'];
        $date_add = date('Y-m-d');
        $absen_masuk = '-';
        $absen_pulang = '-';
        $terlambat = '-';

        $status = 'Izin';
        $selesai = 'Ya';

        $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $_SESSION['nik'] . "' and tgl_absen = '" . $date_add . "'");
        $ambil_absen = mysqli_fetch_array($cek_absensi);
        $tgl_absensi = date("Y-m-d", strtotime($ambil_absen['tgl_absen']));
        if ($tgl_absensi == $date_add) {
            //set session gagal
            $_SESSION["gagal"] = 'Anda sudah melakukan Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/absen-karyawan"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO absensi values('','" . $nik . "','" . $id_jadwal . "','" . $date_add . "','" . $absen_masuk . "','" . $absen_pulang . "','" . $terlambat . "','" . $status . "','" . $selesai . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Izin Absen berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-karyawan"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/absen-karyawan"); </script>';
            }
        }
    }

    public function SimpanAbsenPulang()
    {
        $key = $_GET['key'];
        $hari_ini = date('Y-m-d');
        $cek_absen = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $key . "' and tgl_absen = '" . $hari_ini . "'");
        $ambil_absen = mysqli_fetch_array($cek_absen);
        // $tgl_absen = date('Y-m-d', strtotime($ambil_absen['tgl_absen']));

        if ($_SESSION['role'] == 'ROL002') {
            $home = '../../public/absensi/absen-guru';
        } elseif ($_SESSION['role'] == 'ROL003') {
            $home = '../../public/absensi/absen-karyawan';
        }
        if ($ambil_absen['status'] == 'Izin') {
            //set session gagal
            $_SESSION["gagal"] = 'Anda sudah melakukan Izin Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        } elseif ($ambil_absen['status'] == 'Tidak Hadir') {
            //set session gagal
            $_SESSION["gagal"] = 'Anda tidak melakukan Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("' . $home . '"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "UPDATE absensi set absen_pulang = 'Pulang', selesai = 'Ya' where nik ='" . $key . "' and tgl_absen = '" . $hari_ini . "'");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Anda berhasil melakukan absen pulang hari ini';
                //redirect ke halaman
                echo '<script> location.replace("' . $home . '"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("' . $home . '"); </script>';
            }
        }
    }

    public function ResetAbsensi()
    {
        $Delete = mysqli_query($this->koneksi->link, "DELETE FROM absensi");
        if ($Delete) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data absensi berhasil direset';
            //redirect ke halaman
            echo '<script> location.replace("../../public/dashboard/admin"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/dashboard/admin"); </script>';
        }
    }

    public function SimpanKetidakHadiranGuru()
    {
        $nik_guru = $_POST['nik'];

        $hari = hari_ini();
        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
        $row_hari = mysqli_fetch_array($data_jadwal);
        $id_jadwal = $row_hari['id_jadwal'];
        $date_add = date('Y-m-d');
        $absen_masuk = '-';
        $absen_pulang = '-';
        $terlambat = '-';

        $status = 'Tidak Hadir';
        $selesai = 'Ya';

        $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $nik_guru . "' and tgl_absen = '" . $date_add . "'");
        $ambil_absen = mysqli_fetch_array($cek_absensi);
        $tgl_absensi = date("Y-m-d", strtotime($ambil_absen['tgl_absen']));
        if ($tgl_absensi == $date_add) {
            //set session gagal
            $_SESSION["gagal"] = 'Guru sudah melakukan Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/data-absensi-guru"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO absensi values('','" . $nik_guru . "','" . $id_jadwal . "','" . $date_add . "','" . $absen_masuk . "','" . $absen_pulang . "','" . $terlambat . "','" . $status . "','" . $selesai . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data Absen berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/data-absensi-guru"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/data-absensi-guru"); </script>';
            }
        }
    }

    public function SimpanKetidakHadiranKaryawan()
    {
        $nik_karyawan = $_POST['nik'];

        $hari = hari_ini();
        $data_jadwal = mysqli_query($this->koneksi->link, "SELECT *FROM jadwal where hari = '" . $hari . "'");
        $row_hari = mysqli_fetch_array($data_jadwal);
        $id_jadwal = $row_hari['id_jadwal'];
        $date_add = date('Y-m-d');
        $absen_masuk = '-';
        $absen_pulang = '-';
        $terlambat = '-';

        $status = 'Tidak Hadir';
        $selesai = 'Ya';

        $cek_absensi = mysqli_query($this->koneksi->link, "SELECT *FROM absensi where nik = '" . $nik_karyawan . "' and tgl_absen = '" . $date_add . "'");
        $ambil_absen = mysqli_fetch_array($cek_absensi);
        $tgl_absensi = date("Y-m-d", strtotime($ambil_absen['tgl_absen']));
        if ($tgl_absensi == $date_add) {
            //set session gagal
            $_SESSION["gagal"] = 'Karyawan sudah melakukan Absen hari ini!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/data-absensi-karyawan"); </script>';
        } else {
            $Simpan = mysqli_query($this->koneksi->link, "INSERT INTO absensi values('','" . $nik_karyawan . "','" . $id_jadwal . "','" . $date_add . "','" . $absen_masuk . "','" . $absen_pulang . "','" . $terlambat . "','" . $status . "','" . $selesai . "')");
            if ($Simpan) {
                //set session sukses
                $_SESSION["berhasil"] = 'Data Absen berhasil disimpan';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/data-absensi-karyawan"); </script>';
            } else {
                //set session gagal
                $_SESSION["gagal"] = 'gagal!';
                //redirect ke halaman
                echo '<script> location.replace("../../public/absensi/data-absensi-karyawan"); </script>';
            }
        }
    }

    public function UpdateAbsensiGuru()
    {
        $key = $_GET['key'];
        $status = $_POST['kehadiran'];
        if ($status == 'Hadir') {
            $absen_masuk = 'Masuk';
            $absen_pulang = 'Pulang';
            $selesai = 'Ya';
        } elseif ($status == 'Tidak Hadir') {
            $absen_masuk = '-';
            $absen_pulang = '-';
            $selesai = 'Ya';
        } elseif ($status == 'Izin') {
            $absen_masuk = '-';
            $absen_pulang = '-';
            $selesai = 'Ya';
        }
        $Update = mysqli_query($this->koneksi->link, "UPDATE absensi set absen_masuk = '" . $absen_masuk . "', absen_pulang = '" . $absen_pulang . "', status = '" . $status . "', selesai = '" . $selesai . "' where id_absensi = '" . $key . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data Absen berhasil diupdate';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/data-absensi-guru"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/data-absensi-guru"); </script>';
        }
    }

    public function UpdateAbsensiKaryawan()
    {
        $key = $_GET['key'];
        $status = $_POST['kehadiran'];
        if ($status == 'Hadir') {
            $absen_masuk = 'Masuk';
            $absen_pulang = 'Pulang';
            $selesai = 'Ya';
        } elseif ($status == 'Tidak Hadir') {
            $absen_masuk = '-';
            $absen_pulang = '-';
            $selesai = 'Ya';
        } elseif ($status == 'Izin') {
            $absen_masuk = '-';
            $absen_pulang = '-';
            $selesai = 'Ya';
        }
        $Update = mysqli_query($this->koneksi->link, "UPDATE absensi set absen_masuk = '" . $absen_masuk . "', absen_pulang = '" . $absen_pulang . "', status = '" . $status . "', selesai = '" . $selesai . "' where id_absensi = '" . $key . "'");
        if ($Update) {
            //set session sukses
            $_SESSION["berhasil"] = 'Data Absen berhasil diupdate';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/data-absensi-karyawan"); </script>';
        } else {
            //set session gagal
            $_SESSION["gagal"] = 'gagal!';
            //redirect ke halaman
            echo '<script> location.replace("../../public/absensi/data-absensi-karyawan"); </script>';
        }
    }
}
