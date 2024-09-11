
    // Configure a few settings and attach camera

    Webcam.set({
        width: 560,
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
                url: "index_webcam_action.php",
                data: {
                    qrcode: data14
                },
                success: function(response) {
                    if (response != null && response != "") {
                        response = JSON.parse(response);
                        console.log(response)
                        //amibl data JSON
                        $('#no_daftar').html(response.no_daftar);
                        $('#giat_penerimaan').html(response.giat_penerimaan);
                        $('#nama').html(response.nama_calon);
                        $('#ttl').html(response.ttl);
                        $('#hasil').html(response.hasil);
                        $('#karena').html(response.karena);
                        $('#id_data').val(response.id_data);
                        $('#results').load('index_webcam_action.php')
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Surat terdaftar, cek isi surat!'
                        })

                        if (response == 1) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Surat tidak terdaftar!',
                            })

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
