<?php
require_once '../dataUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ROVOFIC DESIMGH</title>
    <link rel="icon" href="../Ass/img/favi.png" sizes="32x32">

    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../Ass/css/Style_navbar.css" />
    
</head>
<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                        <div class="container text-center pt-4 pb-3">
                            <h2>Interfaz Docente</h2>
                            <a href="../proceso/procesos.php" class="btn btn_rvf mx-1">Procesos</a>
                            <a href="../ruta/rutas.php" class="btn btn_rvf mx-1">Rutas</a>
                            <a href="../usuarios/usuarios.php" class="btn btn_rvf mx-1">Usuarios</a>
                        </div>
                        <div class="page-body"> 
                            <?php
                            // Include config file
                            require_once '../config.php';
                            
                            // Attempt select query execution
                            $sql = "SELECT * FROM datos";
                            if ($result = mysqli_query($link, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<table class='table table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th style='width:10%;'>CODIGO</th>";
                                    echo "<th>NOMBRES</th>";
                                    echo "<th>APELLIDOS</th>";
                                    echo "<th>OPCIONES</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['nombres'] . "</td>";
                                        echo "<td>" . $row['apellidos'] . "</td>";
                                        echo "<td>";
                                        echo "<a href='../read.php?id=". $row['id'] ."' title='Ver datos' data-toggle='tooltip'><span class='glyphicon glyphicon-search'></span></a>";
                                        echo "<a href='../update.php?id=". $row['id'] ."' title='Modificar datos' data-toggle='tooltip'><span class='glyphicon glyphicon-wrench'></span></a>";
                                        echo "<a href='../delete.php?id=". $row['id'] ."' title='Eliminar datos' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "<a href='../download.php?id=" . $row['id'] . "&niv=".$row['nivel']."&sub=".$row['subnivel']."&cla=".$row['video']."' title='Descargar archivo' data-toggle='tooltip'><span class='glyphicon glyphicon-cloud-download '></span></a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result);
                                } else {
                                    echo "<p class='lead'><em>No se encontraron datos.</em></p>";
                                }
                            } else {
                                echo "ERROR: No pudo ejecutar $ sql. " . mysqli_error($link);
                            }
         
                            // Close connection
                            mysqli_close($link);
                            ?>
                        </div>
                            
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
</body>
</html>