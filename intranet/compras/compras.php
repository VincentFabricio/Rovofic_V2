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
                            <h2>Compras</h2>
                            <a href="../indexs/index.php" class="btn btn_rvf mx-1">Home</a>
                            <a href="../proceso/procesos.php" class="btn btn_rvf mx-1">Procesos</a>
                            <a href="../ruta/rutas.php" class="btn btn_rvf  mx-1">Rutas</a>
                            <a href="../usuarios/usuarios.php" class="btn btn_rvf  mx-1">Usuarios</a>
                            <a href="../cursos/cursos.php" class="btn btn_rvf  mx-1">Cursos</a>
                            <a href="../compras/compras.php" class="btn btn_rvf  mx-1">Compras</a>
                            
                        </div>
                        <div class="page-body">
                            <?php
                            // Include config file
                            require_once '../config.php';
                            
                            // Attempt select query execution
                            $sql = "SELECT * FROM compras";
                            if ($result = mysqli_query($link, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<input class='form-control' id='myInput' type='text' onkeyup='myFunctions(1)' placeholder='Buscar...'>";
                                    echo "<br>";
                                    echo "<table class='table table-striped' id='myTable'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th style='width:3%;'><a href='create.php' title='Agregar compra'><img src='../Ass/img/Icons/agregar.webp' class='Icons_hh'></a></th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                    echo "<th style='width:5%;' onclick='sortTable(0,1)' >CODIGO</th>";
                                    echo "<th onclick='sortTable(1,1)'>TITULO</th>";
                                    echo "<th onclick='sortTable(2,1)'>DESCRIPCION</th>";
                                    echo "<th style='width:10%;' onclick='sortTable(3,1)'>CANTIDAD</th>";
                                    echo "<th onclick='sortTable(4,1)'>BASE</th>";
                                    echo "<th>OPCIONES</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody id='tbody'>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['description'] . "</td>";
                                        echo "<td>" . $row['amount'] . "</td>";
                                        echo "<td>" . $row['tax_base'] . "</td>";
                                        echo "<td>";
                                        echo "<a class='m-auto' href='update.php?id=". $row['id'] ."' title='Modificar ruta'><img src='../Ass/img/Icons/editar.webp' class='Icons_h'></a>";
                                        echo "<a class='m-auto' href='delete.php?id=". $row['id'] ."' title='Eliminar ruta'><img src='../Ass/img/Icons/eliminar.webp' class='Icons_h'></a>";
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
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script></body></body>
</body>

</html>