<?php
require_once 'dataUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ERROR</title>
    <link rel="icon" href="Ass/img/roxy.webp" sizes="32x32">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="Ass/css/Style_navbar.css" />

    <style type="text/css">
        .wrapper {
            width: 750px;
            margin: 0 auto;
        }

        body {
            background-image: url(../img/fondo.jpg);
            background-size: 100% 100%;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar-->
    <?php include 'navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                <div class="row">
                    <div class="col-8 mx-auto pt-3">
                        <div class="pt-3">
                            <h1 class="pt-3">SOLICITUD NO VÁLIDA</h1>
                        </div>
                        <div class="alert alert-danger fade show">
                            <p>Lo sentimos, has realizado una solicitud no válida. Por favor regrese y vuelva a intentarlo.<a href="indexs/index.php" class="alert-link">REGRESE</a> y vuelva a intentarlo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="Ass/js/popper.min.js"></script>
    <script src="Ass/js/bootstrap.min.js"></script>
    <script src="Ass/js/func.js"></script>
</body>

</html>