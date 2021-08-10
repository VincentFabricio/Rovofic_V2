<?php
    require_once '../proceso/dataUser2.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    $sql = "SELECT * FROM seguimiento WHERE nombre = ? and fecha = ?";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_nombre, $param_fecha);
                        
                            ini_set('date.timezone', 'America/Bogota');
                            

                            // Set parameters
                            $param_nombre = "agregarProcesos";
                            $param_fecha = date('jS \of F Y');
                        
                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                $result3 = mysqli_stmt_get_result($stmt);
                        
                                if (mysqli_num_rows($result3) == 1) {
                                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                    $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                } else {
                                    $sql = "INSERT INTO seguimiento (nombre, fecha, clicks) VALUES (?,?,?)";
                                    if ($stmt = mysqli_prepare($link, $sql)) {
                                        // Bind variables to the prepared statement as parameters
                                        mysqli_stmt_bind_param($stmt, "ssi", $param_nombre, $param_fecha, $param_clicks);
                                        $param_nombre = "agregarProcesos";
                                        $param_fecha = date('jS \of F Y');
                                        $param_clicks = 0;
                                        mysqli_stmt_execute($stmt);
                                    }
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }

                        $sql = "SELECT * FROM seguimiento WHERE nombre = ? and fecha = ?";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_nombre, $param_fecha);

                            // Set parameters
                            $param_nombre = "clases";
                            $param_fecha = date('jS \of F Y');
                        
                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                $result4 = mysqli_stmt_get_result($stmt);
                        
                                if (mysqli_num_rows($result4) == 1) {
                                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                    $row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC);
                                } else {
                                    $sql = "INSERT INTO seguimiento (nombre, fecha, clicks) VALUES (?,?,?)";
                                    if ($stmt = mysqli_prepare($link, $sql)) {
                                        // Bind variables to the prepared statement as parameters
                                        mysqli_stmt_bind_param($stmt, "ssi", $param_nombre, $param_fecha, $param_clicks);
                                        $param_nombre = "clases";
                                        $param_fecha = date('jS \of F Y');
                                        $param_clicks = 0;
                                        mysqli_stmt_execute($stmt);
                                    }
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }

                        $sql = "SELECT * FROM seguimiento WHERE nombre = ? and fecha = ?";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_nombre, $param_fecha);

                            // Set parameters
                            $param_nombre = "lupaEstudiantes";
                            $param_fecha = date('jS \of F Y');
                        
                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                $result5 = mysqli_stmt_get_result($stmt);
                        
                                if (mysqli_num_rows($result5) == 1) {
                                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                    $row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC);
                                } else {
                                    $sql = "INSERT INTO seguimiento (nombre, fecha, clicks) VALUES (?,?,?)";
                                    if ($stmt = mysqli_prepare($link, $sql)) {
                                        // Bind variables to the prepared statement as parameters
                                        mysqli_stmt_bind_param($stmt, "ssi", $param_nombre, $param_fecha, $param_clicks);
                                        $param_nombre = "lupaEstudiantes";
                                        $param_fecha = date('jS \of F Y');
                                        $param_clicks = 0;
                                        mysqli_stmt_execute($stmt);
                                    }
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ROVOFIC DESIMGH</title>
    <link rel="icon" href="../Ass/img/roxy.webp" sizes="32x32">

    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../Ass/css/Style_navbar.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    
</head>
<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                <div class="container text-center pt-4 pb-1">
                    <h2 align="center">¡Bienvenido!</h2>
                    <a href="../indexs/indexEstudiantes.php" class="btn btn_rvf1 mx-1" id="btt_clases">Home</a>
                    <!-- <a href="../proceso/entry.php" target="_blank" class="btn btn_rvf1 mx-1" id="btt_agregar_procesos">Proceso +</a> -->
                    <button onclick="window.location.href='../indexs/ProcesosEstudiantes.php'" id="btt_agregar_procesos" class="btn btn_rvf1 mx-1">Procesos</button>
                    <!-- <a href="../clases/clases.php" target="_blank" class="btn btn_rvf1 mx-1" id="btt_clases">Clases</a> -->
                    <button onclick="window.location.href='../clases/clases.php'" id="btt_clases" class="btn btn_rvf1 mx-1">Clases</button>
                    <a href="../indexs/logros.php" class="btn btn_rvf1 mx-1" id="btt_clases">Logros</a>

                    <p class="pt-2 pb-1 mx-auto">Que hoy sea un gran día!!</p>
                </div>
                <div class="page-body mx-auto"> 
                    <div id="carouselExampleIndicators" class="carousel slide carucel_h" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="../Ass/img/Slider/Slider1.webp" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="../Ass/img/Slider/Slider2.webp" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="../Ass/img/Slider/Slider3.webp" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div> 
       
            </div>
        </div>
    </div>

    <script>

        var clicksAgregarProcesos = '<?php echo $row3['clicks']; ?>';

        $('#btt_agregar_procesos').on('click', function() {
            clicksAgregarProcesos++;
            var valor = clicksAgregarProcesos;
            var url = "bttAgregarProcesos.php";
            $.ajax({
                url: url,
                type: "POST",
                data: {valor: valor}
            })
        });
        
        var clicksClases = '<?php echo $row4['clicks']; ?>';

        $('#btt_clases').on('click', function() {
            clicksClases++;
            var valor = clicksClases;
            var url = "bttClases.php";
            $.ajax({
                url: url,
                type: "POST",
                data: {valor: valor}
            })
        });
        
        var clicksLupaEstudiantes = '<?php echo $row5['clicks']; ?>';

        $('#btt_lupa_estudiantes').on('click', function() {
            clicksLupaEstudiantes++;
            var valor = clicksLupaEstudiantes;
            var url = "bttLupaEstudiantes.php";
            $.ajax({
                url: url,
                type: "POST",
                data: {valor: valor}
            })
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->     
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
    <script src="../Ass/js/func.js"></script>
</body>
</html>