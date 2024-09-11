<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Absensi</title>
    <link rel="shortcut icon" type="image/png" href="" />
    <style>
        .swal2-popup {
            font-family: inherit;
            font-size: 14px !important;
        }
    </style>

</head>

<body>
    <?php
    require_once "Koneksi.php";

    class Login
    {
        var $koneksi, $username, $password;

        function __construct()
        {
            $this->koneksi = new Koneksi;
            $this->koneksi->BukaDB();

            if (isset($_POST['username'])) {
                $this->username = $_POST['username'];
            }

            if (isset($_POST['password'])) {
                $this->password = $_POST['password'];
            }
        }

        function __destruct()
        {
            $this->koneksi = new Koneksi;
            $this->koneksi->TutupDB();
        }

        function Dologin()
        {
            $login = mysqli_query($this->koneksi->link, "SELECT *FROM user_login where nik = '$this->username'");
            $data =  mysqli_fetch_array($login);
            date_default_timezone_set('Asia/Jakarta');

            $pass = base64_decode($data['password']);
            if (($this->username != $data['nik'])) {
                session_start();
                $_SESSION["error"] = 'username tidak terdaftar!';
                header('Location: ./');
            } elseif (($this->password != $pass)) {
                session_start();
                $_SESSION["error"] = 'password anda salah!';
                header('Location: ./');
            } elseif (($data['status_aktivasi'] != '1')) {
                session_start();
                $_SESSION["error"] = 'akun belum di daftarkan, silahkan hubungi administrator!';
                header('Location: ./');
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['role'] = $data['role'];
                $_SESSION['nik'] = $data['nik'];
                $_SESSION['status_active'] = $data['status_active'];
                $_SESSION['log_datetime'] = date("j F Y, g:i a", strtotime($data['log_datetime']));

                $today = date("Y-m-d H:i:s");
                $status_active = '1';
                $last = ("UPDATE user_login SET status_active = '$status_active', log_datetime = '$today' where nik = '$this->username'");
                $query = mysqli_query($this->koneksi->link, $last);
                if ($data['role'] == "ROL001") {
                    session_start();

                    $_SESSION["success"] = 'Berhasil Login';

                    header('Location: public/dashboard/admin');
                } elseif ($data['role'] == "ROL002") {
                    session_start();
                    $_SESSION["success"] = 'Berhasil Login';

                    header('Location: public/dashboard/guru');
                } elseif ($data['role'] == "ROL003") {
                    session_start();
                    $_SESSION["success"] = 'Berhasil Login';

                    header('Location: public/dashboard/karyawan');
                }
            }
        }

        function logout()
        {
            session_start(); //memeriksa apakah ada yg sudah login
            session_destroy(); //memeriksa apakah ada yg sudah logout
            include "../../public/include/session.php";
        }

        function Update()
        {
            $session = $_SESSION['nik'];
            $status_Nonactive = '0';
            $last = ("UPDATE user_login SET status_active = '$status_Nonactive' where nik = '$session'");
            $query = mysqli_query($this->koneksi->link, $last);
            echo "<script type='text/javascript'>alert('Berhasil keluar dari sistem');
            window.location='../.././'</script>";
        }

        function getError()
        {
            if (@$_SESSION['error']) {
                echo " <script>
                            Swal.fire({icon: 'error', title: 'Login gagal', text: '$_SESSION[error]',
                            showConfirmButton: false,
                            timer: 3000
                            })
                        </script>";
                unset($_SESSION['error']);
            }
        }

        function getSuccess()
        {
            if (@$_SESSION['success']) {
                echo " <script>
                            Swal.fire({icon: 'success', title: 'Berhasil', text: '$_SESSION[success]',
                            showConfirmButton: false,
                            timer: 1500
                            })
                        </script>";
                unset($_SESSION['success']);
            }
        }
    }

    ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>