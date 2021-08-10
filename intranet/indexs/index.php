<?php
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }
    if ($_SESSION['role'] == 2) {
        if ($stmt = $link->prepare("SELECT Estado FROM users WHERE id=?")) {
            /* ligar parámetros para marcadores */
            $stmt->bind_param("s", $_SESSION['user']);
            /* ejecutar la consulta */
            $stmt->execute();
            /* ligar variables de resultado */
            $stmt->bind_result($district);
            /* obtener valor */
            $stmt->fetch();
            $stmt->close();
        }
        if ($district == 0) {
            header("Location: ../indexs/create.php");
            exit;
        } else {
            header("Location: ../indexs/indexPadres.php");
            exit;
        }
    }
    if ($_SESSION['role'] == 3) {
        header("Location: indexDocentes.php");
        exit;
    }
    if ($_SESSION['role'] == 4) {
        header("Location: indexEstudiantes.php");
        exit;
    }
?>
<!-- ALTER TABLE compras AUTO_INCREMENT=1000000  -->
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
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                        <div class="container text-center pt-4 pb-3">
                            <h2>Interfaz Administrador</h2>
                            <a href="index.php" class="btn btn_rvf mx-1">Home</a>
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
                            $sql = "SELECT * FROM datos";
                            if ($result = mysqli_query($link, $sql)) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo "<table class='table table-striped'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th style='width:20%;'>CODIGO</th>";
                                    echo "<th style='width:30%;'>NOMBRES</th>";
                                    echo "<th style='width:30%;'>APELLIDOS</th>";
                                    echo "<th style='width:20%;'>OPCIONES</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $row['id'] . "</td>";
                                        echo "<td class='text-justify'>" . $row['nombres'] . "</td>";
                                        echo "<td class='text-justify'>" . $row['apellidos'] . "</td>";
                                        echo "<td class='text-center'>";
                                        echo "<a class='m-auto' href='../Admin/read.php?id=" . $row['id'] . "' title='Ver datos'><img src='../Ass/img/Icons/ver.webp' class='Icons_h'></a>";
                                        echo "<a class='m-auto' href='../Admin/update.php?id=" . $row['id'] . "' title='Modificar datos'><img src='../Ass/img/Icons/editar.webp' class='Icons_h'></a>";
                                        echo "<a class='m-auto' href='../Admin/delete.php?id=" . $row['id'] . "' title='Eliminar datos'><img src='../Ass/img/Icons/eliminar.webp' class='Icons_h'></a>";
                                        echo "<a class='m-auto' href='../Admin/download.php?id=" . $row['id'] . "' title='Descargar datos'><img src='../Ass/img/Icons/download.webp' class='Icons_h'></a>";
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
    <script src="../Ass/js/func.js"></script>
</body>

</html>