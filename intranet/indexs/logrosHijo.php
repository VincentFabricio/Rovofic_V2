<?php
    // Include config file
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    // Define variables and initialize with empty values
    $estudiante = $fecha = "";
    $estudiante_err = $fecha_err = "";
    $nuevoHijo=0;

    // Processing form data when form is submitted

    // Get hidden input value
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_estudiante = trim($_POST["estudiante"]);
        if (empty($input_estudiante)) {
            $estudiante_err = "Please enter a estudiante.";
        } else {
            $estudiante = $input_estudiante;
        }
        // Validate apellidos
        $input_fecha = trim($_POST["fecha"]);
        if (empty($input_fecha)) {
            $fecha_err = "Please enter a fecha.";
        } else {
            $fecha = $input_fecha;
        }

        // Check input error_log(message)s before inserting in database
        if (empty($estudiante_err) && empty($fecha_err)) {
            header("location: read1.php?fecha=" . $fecha . "&est=" . $estudiante);
        }
    }
    if ($_SESSION['role'] == 2) {
        $sql = "SELECT id_estudiante FROM hijos where id_padre = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $_SESSION['user'];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                $sql = "SELECT * FROM datos where ";
                $sql2 = "SELECT * FROM proceso WHERE ";
                $cadena = "";
                $cadena2 = "";
                $i = 0;

                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    if ($i == 0) {
                        $cadena .= "id = " . $row['id_estudiante'];
                        $cadena2 .= "estudiante = " . $row['id_estudiante'];
                    } else {
                        $cadena .= " or id = " . $row['id_estudiante'];
                        $cadena2 .= " or estudiante = " . $row['id_estudiante'];
                    }
                    $i++;
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        $sql = $sql . $cadena;
        $sql2 = $sql2 . $cadena2;
        /* echo $sql2; */
        $result = mysqli_query($link, $sql2);
        $result3 = mysqli_query($link, $sql2);
        $result4 = mysqli_query($link, $sql);
    }

    $sql = "SELECT * FROM seguimiento WHERE nombre = ? and fecha = ?";
                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ss", $param_nombre, $param_fecha);
                        
                            ini_set('date.timezone', 'America/Bogota');
                            
                            // Set parameters
                            $param_nombre = "compras";
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
                                        $param_nombre = "compras";
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
                            $param_nombre = "lupaPadres";
                            $param_fecha = date('jS \of F Y');
                        
                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                $result6 = mysqli_stmt_get_result($stmt);
                        
                                if (mysqli_num_rows($result6) == 1) {
                                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                    $row6 = mysqli_fetch_array($result6, MYSQLI_ASSOC);
                                } else {
                                    $sql = "INSERT INTO seguimiento (nombre, fecha, clicks) VALUES (?,?,?)";
                                    if ($stmt = mysqli_prepare($link, $sql)) {
                                        // Bind variables to the prepared statement as parameters
                                        mysqli_stmt_bind_param($stmt, "ssi", $param_nombre, $param_fecha, $param_clicks);
                                        $param_nombre = "lupaPadres";
                                        $param_fecha = date('jS \of F Y');
                                        $param_clicks = 0;
                                        mysqli_stmt_execute($stmt);
                                    }
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }
    // Close connection
    /* mysqli_close($link); */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PROCESO</title>
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
                
                    <div class="container text-center pt-4 pb-3">
                        <h2>Logros</h2>
                        <a href="../indexs/indexPadres.php" class="btn btn_rvf1 mx-1" id="btt_clases">Home</a>
                        <a href="../proceso/fecha.php" class="btn btn_rvf1 mx-1">Procesos</a>
                        <!-- <a href="compras.php" class="btn btn_rvf1 mx-1" id="compras">Compras</a> -->
                        <button onclick="window.location.href='compras.php'" id="compras" class="btn btn_rvf1 mx-1">Compras</button>
                        <a href="../indexs/logrosHijo.php" class="btn btn_rvf1 mx-1" id="btt_clases">Logros</a>

                        <p class="col-10 pt-3 mx-auto text-justify">En esta sección podrás ver proximamente los logros obtenidos  de su hijo o hija y cursos realizados</p>
                    
                    </div>

                    <div class="page-body ">

                                

                        </div>
                    
            </div>
        </div>
    </div>

    <script>

        var clicksCompras = '<?php echo $row5['clicks']; ?>';

        $('#compras').on('click', function() {
            clicksCompras++;
            var valor = clicksCompras;
            var url = "bttCompras.php";
            $.ajax({
                url: url,
                type: "POST",
                data: {valor: valor}
            })
        });
        
        var clicksLupaPadres = '<?php echo $row6['clicks']; ?>';

        $('#btt_lupa_padres').on('click', function() {
            clicksLupaPadres++;
            var valor = clicksLupaPadres;
            var url = "bttLupaPadres.php";
            $.ajax({
                url: url,
                type: "POST",
                data: {valor: valor}
            })
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/func.js"></script>
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
    
</body>

</html>