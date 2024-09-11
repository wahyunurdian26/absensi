<!doctype html>
<html lang="en">

<head>
    <title>Aplikasi Absensi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/png" href="public/assets/dist/img/logo.png" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type='text/css'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="public/login/css/style.css">
    <style>
        body {
            background-color: #DCDCDC;
        }
    </style>

</head>

<?php session_start() ?>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-5 p-md-4">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span><i class="fa fa-key"></i></span>
                        </div>
                        <h3 class="text-center mb-4">Absensi Online</h3>
                        <form action="cek-login.php" class="login-form" method="post">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control rounded-left" placeholder="Masukan NIK" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" name="password" class="form-control rounded-left" id="inputPassword" placeholder="Password" required>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Tampil Password
                                        <input type="checkbox" onclick="myFunction()" id="rememberMe">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary rounded submit p-3 px-5">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="public/login/js/jquery.min.js"></script>
    <script src="public/login/js/popper.js"></script>
    <script src="public/login/js/bootstrap.min.js"></script>
    <script src="public/login/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <?php
    require_once "app/Controllers/Login.php";
    $error = new Login;
    $error->getError();
    ?>

</body>

</html>