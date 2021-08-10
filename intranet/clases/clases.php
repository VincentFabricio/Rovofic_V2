<?php
    require_once '../proceso/dataUser2.php';
    include "../cursos/mcript.php";

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
                            $param_nombre = "enviarArchivo";
                            $param_fecha = date('jS \of F Y');
                        
                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                $result2 = mysqli_stmt_get_result($stmt);
                        
                                if (mysqli_num_rows($result2) == 1) {
                                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                } else {
                                    $sql = "INSERT INTO seguimiento (nombre, fecha, clicks) VALUES (?,?,?)";
                                    if ($stmt = mysqli_prepare($link, $sql)) {
                                        // Bind variables to the prepared statement as parameters
                                        mysqli_stmt_bind_param($stmt, "ssi", $param_nombre, $param_fecha, $param_clicks);
                                        $param_nombre = "enviarArchivo";
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
                            $param_nombre = "blockly";
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
                                        $param_nombre = "blockly";
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
                            $param_nombre = "drive";
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
                                        $param_nombre = "drive";
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
    <title>CLASES</title>
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

                
                    <?php
                    if ($userRow['nivel']!=0) {
                        echo "<div class='container text-center pt-4 pb-3'>";
                        echo "<h2 align='center'>".titulo($userRow['nivel'])."</h2>";
                        echo "</div>";
                        echo "<div class='page-body'>";

                    }else {
                        echo "<div class='page-body pt-4'>";
                        echo "<p class='lead pt-4'><em>No se encontraron datos.</em></p>";
                        echo "</div>";
                    }
                                    
                                $sql = "SELECT * FROM cursos WHERE  tema = ? AND nivel = ? AND clase = ?";
                                if ($stmt = mysqli_prepare($link, $sql)) {
                                    //
                                    mysqli_stmt_bind_param(
                                        $stmt,
                                        "iii",
                                        $param_tema,
                                        $param_nivel,
                                        $param_clase
                                    );

                                    $param_tema=$userRow['nivel'];
                                    $param_nivel=$userRow['subnivel'];
                                    $param_clase=$userRow['video'];
                                    $lmt=0;
                                    if (mysqli_stmt_execute($stmt)) {
                                        $result = mysqli_stmt_get_result($stmt);
                                        if (mysqli_num_rows($result)!=0) {
                                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                $lmt=$lmt+1;
                                                echo "<h3 class='py-2'>".$row['titulo']."</h3>";
                                                echo "<p>".$row['subtitulo']."</p>";
                                                echo "<iframe src= '". $desencriptar($row['url']) ."' width='640' height='480' frameborder='0' allow='autoplay; fullscreen' allowfullscreen></iframe>";
                                                if (!empty($row['enlace'])) {
                                                    echo "<div class='col-12 pt-4 pb-2'>";
                                                    echo "<a id='btt_drive' class='btn btn_rvf2' href='" . $desencriptar($row['enlace']) . "' target='_blank'>Enlace</a>";
                                                    echo "</div>";
                                                }
                                            }
                                            
                                            echo "<div class='py-3 mx-auto'>";
                                            echo "<h1> </h1>";
                                            echo "</div>";
                                            
                                            echo "<div class='py-3 mb-2 alert alert-danger fade show text-white w-75 mx-auto'>";
                                            echo "<h1>Enviar prueba de la sesión</h1>";
                                            echo "<br>";
                                            echo "<form enctype='multipart/form-data' action='upload.php' method='POST'>";
                                            echo "<input type='hidden'/>";
                                            echo "<p> Enviar mi prueba: <input name='subir_archivo' type='file' /></p>";
                                            echo "<p> <button class='btn btn_rvf1' type='submit' id='btt_enviar_archivo'> Guardar </button> </p>";
                                            echo "</div>";

                                            echo "</form>";                                            

                                            echo "<div class='col-12 pt-4 pb-2'>";
                                            echo "<a class='btn btn_rvf2' href='../indexs/indexEstudiantes.php'>Regresar</a>";
                                            echo "</div>";
                                        }
                                    } else {
                                        echo "ERROR: No pudo ejecutar $ sql. " . mysqli_error($link);
                                    }
                                }
                            mysqli_stmt_close($stmt);

                                // Close connection
                                mysqli_close($link);
                                
                            ?>
                </div>
                
            </div>
        </div>
    </div>

    <script>

var clicksEnviarArchivo = '<?php echo $row2['clicks']; ?>';

$('#btt_enviar_archivo').on('click', function() {
    clicksEnviarArchivo++;
    var valor = clicksEnviarArchivo;
    var url = "bttEnviarArchivo.php";
    $.ajax({
        url: url,
        type: "POST",
        data: {valor: valor}
    })
});

/* var clicksBlockly = '<?php echo $row3['clicks']; ?>';

$('#btt_blockly').on('click', function() {
    clicksBlockly++;
    var valor = clicksBlockly;
    var url = "bttBlockly.php";
    $.ajax({
        url: url,
        type: "POST",
        data: {valor: valor}
    })
}); */

var clicksDrive = '<?php echo $row4['clicks']; ?>';

$('#btt_drive').on('click', function() {
    clicksDrive++;
    var valor = clicksDrive;
    var url = "bttDrive.php";
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
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
</body>

</html>

<?php
    function titulo($number)
    {
        switch ($number) {
            case 1:
                $x="BLOCKLY";
                break;
            case 2:
                $x="FREECAD";
                break;
            case 3:
                $x="ARDUINO";
                break;
            case 4:
                $x="FRITZING";
                break;
            case 5:
                $x="EAGLE";
                 break;
            case 6:
                $x="ELECTRÓNICA Y ROBÓTICA";
                 break;
        }
        return $x;
    }
?>