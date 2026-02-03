<?php
include "backend/classes/class.repositorio.php";
$repositorio = new Repositorio;
$conexion = $repositorio->connectDB();

if ($conexion) {
} else {
    echo "❌ Error al conectar con la base de datos.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Multipagos Express</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">
    <link href="img/multipagos.jpg" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">MULTIPAGOS</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.php" class="nav-item nav-link active">Inicio</a>
                    <!-- <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="service.html" class="nav-item nav-link">Service</a>
                    <a href="menu.html" class="nav-item nav-link">Menu</a> -->
                    <a href="contacto.php" class="nav-item nav-link">Contactos</a>
                    <a href="logeo.php" class="nav-item nav-link">Lo hacemos por ti</a>
                    <a href="https://sistema.multipagoscofre.com" class="nav-item nav-link">Multiservicios Cofre</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">

                <!-- Primer Slide -->
                <div class="carousel-item active">
                    <img src="img/foto.jpg" class="d-block w-100" alt="Image" style="height: 700px; object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Es un placer atenderles</h2>
                        <h1 class="display-1 text-white m-0">MULTIPAGOS COFRE</h1>
                    </div>
                </div>

                <!-- Segundo Slide -->
                <div class="carousel-item">
                    <img src="img/foto.jpg" class="d-block w-100" alt="Image" style="height: 700px; object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">Es un placer atenderles</h2>
                        <h1 class="display-1 text-white m-0">MULTIPAGOS COFRE</h1>
                    </div>

                </div>

            </div>

            <!-- Controles -->
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>


        <!-- Contact Start -->
        <div class="container-fluid pt-5">
            <div class="container">
                <div class="section-title">
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">SUCURSALES</h4>
                    <h1 class="display-4">Visita nuestras sucursales</h1>
                </div>
                <div class="row px-3 pb-2">
                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                        <h5 class="font-weight-bold">MULTIPAGOS COFRE - HOSPITAL</h5>
                        <iframe
                            src="https://maps.google.com/maps?q=-0.934669,-78.62285&hl=es&z=14&output=embed"
                            width="100%"
                            height="443"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-solid fa-camera mb-3 text-primary"></i>
                        <h4 class="font-weight-bold">Imagen</h4>
                        <img src="img/hospital.jpg" width="100%" height="443">
                    </div>


                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                        <h4 class="font-weight-bold">PUJILI</h4>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.067284812613!2d-78.6936149!3d-0.949472!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwNTYnNTguMSJTIDc4wrA0MScyNy43Ilc!5e0!3m2!1ses!2s!4v1717950000000"
                            width="100%"
                            height="443"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-solid fa-camera mb-3 text-primary"></i>
                        <h4 class="font-weight-bold">Imagen</h4>
                        <img src="img/pujili.jpg" width="100%" height="443">
                    </div>



                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                        <h4 class="font-weight-bold">RIOBAMBA</h4>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.320402326845!2d-78.664489!3d-1.662948!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91d30708dc2040f7%3A0x24c81922ea68312a!2sLocal%20Multipagos%20Cofre!5e0!3m2!1ses-419!2sec!4v1717920000000"
                            width="100%"
                            height="443"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-solid fa-camera mb-3 text-primary"></i>
                        <h4 class="font-weight-bold">Imagen</h4>
                        <img src="img/riobamba.jpg" width="100%" height="443">
                    </div>

                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-map-marker-alt mb-3 text-primary"></i>
                        <h4 class="font-weight-bold">MAYORISTA</h4>
                        <iframe
                            src="https://www.google.com/maps?q=-0.934669,-78.62285&hl=es;z=14&output=embed"
                            width="100%"
                            height="443"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>

                    </div>
                    <div class="col-sm-6 text-center mb-3">
                        <i class="fa fa-2x fa-solid fa-camera mb-3 text-primary"></i>
                        <h4 class="font-weight-bold">Imagen</h4>
                        <img src="img/riomama.jpg" width="100%" height="443">
                    </div>


                </div>

            </div>
        </div>

    </div>

<!-- <input type="text" id="url" placeholder="Ingresa la URL">
<button onclick="generarQR()">Generar QR</button>
<canvas id="qrCanvas"></canvas>

<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
<script>
  function generarQR() {
    let url = document.getElementById('url').value;
    new QRious({
      element: document.getElementById('qrCanvas'),
      value: url,
      size: 200
    });
  }
</script> -->

    <!-- Footer Start -->
    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">

        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; <a class="font-weight-bold" href="#">Domain</a>Profsolutions.</a></p>
            <p class="m-0 text-white">Creado por <a class="font-weight-bold" href="https://profesysolutions.com/">Profsolutions</a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>



    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
