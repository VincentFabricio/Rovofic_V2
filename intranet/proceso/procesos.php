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
    <title>ROVOFIC</title>
    <link rel="icon" href="../Ass/img/roxy.webp" sizes="32x32">
    
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
                            <h2>Procesos</h2>
                            <?php
                            if ($_SESSION['role']==3) {
                                echo "<a href='../proceso/procesos.php' class='btn btn_rvf mx-1'>Procesos</a>";
                            echo "<a href='../ruta/rutas.php' class='btn btn_rvf  mx-1'>Rutas</a>";
                            echo "<a href='../usuarios/usuarios.php' class='btn btn_rvf  mx-1'>Usuarios</a>";
                            }else{
                                echo "<a href='../indexs/index.php' class='btn btn_rvf mx-1'>Home</a>";
                                echo "<a href='../proceso/procesos.php' class='btn btn_rvf mx-1'>Procesos</a>";
                                echo "<a href='../ruta/rutas.php' class='btn btn_rvf  mx-1'>Rutas</a>";
                                echo "<a href='../usuarios/usuarios.php' class='btn btn_rvf  mx-1'>Usuarios</a>";
                                echo "<a href='../cursos/cursos.php' class='btn btn_rvf  mx-1'>Cursos</a>";
                                echo "<a href='../compras/compras.php' class='btn btn_rvf  mx-1'>Compras</a>";
                            }
                            ?>
                            
                        </div>
                        <div class="page-body">
                        <?php
                            // Include config file
                            require_once '../config.php';
                            
                            // Attempt select query execution
                            $sql = "SELECT * FROM proceso";
                            if ($result = mysqli_query($link, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<input class='col-9 form-control mb-2 mx-auto' id='myInput' type='text' onkeyup='myFunctions(1)' placeholder='Buscar...'>";
                            
                                    echo "<table class='table table-striped' id='myTable'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th style='width:10%;' onclick='sortTable(0,1)'>CODIGO</th>";
                                    echo "<th style='width:20%;' onclick='sortTable(1,1)'>ESTUDIANTE</th>";
                                    echo "<th style='width:10%;' onclick='sortTable(2,1)'>FECHA</th>";
                                    echo "<th style='width:25%;' onclick='sortTable(3,1)'>RECOMENDACIONES</th>";
                                    echo "<th style='width:25%;' onclick='sortTable(4,1)'>PENDIENTE</th>";
                                    echo "<th style='width:10%;' >OPCIONES</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody id='tbody'>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        $sql2 = "SELECT nombres FROM datos WHERE id =".$row['estudiante'];
                                        $result2 = mysqli_query($link, $sql2);
                                        $row2 = mysqli_fetch_array($result2);
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $row['id'] . "</td>";
                                        echo "<td class='text-justify'>" . $row2['nombres'] . "</td>";
                                        echo "<td class='text-justify'>" . $row['fecha'] . "</td>";
                                        echo "<td class='text-justify'>" . $row['recomendaciones'] . "</td>";
                                        echo "<td class='text-justify'>" . $row['situapendiente'] . "</td>";
                                        echo "<td class='text-center'>";
                                        
                                        echo "<a class='mx-1 my-1' href='read1.php?fecha=" . $row['fecha'] . "&est=".$row['estudiante']."' title='Buscar procesos'><img src='../Ass/img/Icons/ver.webp' class='Icons_h'></a>";
                                        echo "<a class='mx-1 my-1' href='update1.php?fecha=" . $row['fecha'] . "&est=".$row['estudiante']."' title='Editar procesos'><img src='../Ass/img/Icons/editar.webp' class='Icons_h'></a>";
                                        echo "<a class='mx-1 my-1' href='delete.php?id=" . $row['id'] . "' title='Eliminar proceso'><img src='../Ass/img/Icons/eliminar.webp' class='Icons_h'></a>";
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