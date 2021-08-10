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
                
                        <div class="container text-center pt-4 pb-3">
                            <h2 align="center">ROVOFIC</h2>
                            <a href="../indexs/indexEstudiantes.php" class="btn btn_rvf1 mx-1" id="btt_clases">Home</a>
                            <!-- <a href="../proceso/entry.php" target="_blank" class="btn btn_rvf1 mx-1" id="btt_agregar_procesos">Proceso +</a> -->
                            <button onclick="window.location.href='../indexs/ProcesosEstudiantes.php'" id="btt_agregar_procesos" class="btn btn_rvf1 mx-1">Procesos</button>
                            <!-- <a href="../clases/clases.php" target="_blank" class="btn btn_rvf1 mx-1" id="btt_clases">Clases</a> -->
                            <button onclick="window.location.href='../clases/clases.php'" id="btt_clases" class="btn btn_rvf1 mx-1">Clases</button>
                            <a href="../indexs/logros.php" class="btn btn_rvf1 mx-1" id="btt_clases">Logros</a>
                        </div>
                        <div class="page-body"> 
                            <?php
                            // Include config file
                            require_once '../config.php';
                            
                            // Attempt select query execution
                            $sql = "SELECT * FROM proceso WHERE estudiante =?";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                //
                                mysqli_stmt_bind_param(
                                    $stmt,
                                    "i",
                                    $param_id
                                );
                                $param_id=$_SESSION['user'];
                                if (mysqli_stmt_execute($stmt)) {
                                    $result = mysqli_stmt_get_result($stmt);
                                    echo "<input class='form-control' id='myInput' type='text' onkeyup='myFunctions(1)' placeholder='Buscar...'>";
                                    echo "<a href='../proceso/entry.php' title='Agregar ruta'><img src='../Ass/img/Icons/agregar.webp' class='py-1 Icons_hh'></a>";
                                    echo "<br>";
                                    echo "<table class='table table-striped' id='myTable'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th style='width:20%;' onclick='sortTable(1,1)'>ESTUDIANTE</th>";
                                    echo "<th style='width:10%;' onclick='sortTable(2,1)'>FECHA</th>";
                                    echo "<th style='width:10%;' style='width:3%;'>OPCIONES</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody id='tbody'>";
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $sql2 = "SELECT nombres FROM datos WHERE id =?";
                                        if ($stmt2 = mysqli_prepare($link, $sql2)) {
                                            // Bind variables to the prepared statement as parameters
                                            mysqli_stmt_bind_param($stmt2, "i", $param_id);
                                    
                                            // Set parameters
                                            $param_id = $row['estudiante'];
                                    
                                            // Attempt to execute the prepared statement
                                            if (mysqli_stmt_execute($stmt2)) {
                                                $result2 = mysqli_stmt_get_result($stmt2);
                                                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                                            }
                                        }
                                        mysqli_stmt_close($stmt2);
                                    
                                        echo "<tr>";
                                        echo "<td>" . $row2['nombres'] . "</td>";
                                        echo "<td>" . $row['fecha'] . "</td>";
                                        echo "<td>";
                                        /* echo "<a id='btt_lupa_estudiantes' target='_blank' class='mx-1 my-1' href='../proceso/read1.php?fecha=" . $row['fecha'] . "&est=".$row['estudiante']."' title='Buscar procesos'><img src='../Ass/img/Icons/ver.webp' class='Icons_h'></a>"; */
                            
                                        echo "<button onclick=window.location.href='../proceso/read1.php?fecha=" . $row['fecha'] . "&est=".$row['estudiante']."' id='btt_lupa_estudiantes' class='mx-1 my-1' title='Buscar procesos'><img src='../Ass/img/Icons/ver.webp' class='Icons_h'></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "<p class='lead'><em>No se encontraron datos.</em></p>";
                                }
                            } else {
                                echo "ERROR: No pudo ejecutar $ sql. " . mysqli_error($link);
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