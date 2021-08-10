<?php
    require_once '../proceso/dataUser2.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CLASES</title>
    <link rel="icon" href="../Ass/img/roxy.webp" sizes="32x32">

    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../Ass/css/Style_navbar.css" />

</head>

<body>
    <?php include '../navegator.ini'; ?>
    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                <div class="row">
                    <div class="col-12 py-3">
                        <h1 class="py-3"> </h1>
                    </div>
                    <div class="col-8 pt-3 mx-auto">
                        <div class="py-3 mb-2 alert alert-danger fade show ">
                            <h1>Archivo Subido:</h1>
                            <?php
                            $micarpeta = 'archivos/' . $userRow['username'];
                            if (!file_exists($micarpeta)) {
                                mkdir($micarpeta, 0777, true);
                            }

                                $directorio = 'archivos/' . $userRow['username'] ."/";
                                $subir_archivo = basename($_FILES['subir_archivo']['name']);
                                echo "<div>";
                                if (move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo=$directorio.$userRow['username']. "-" . $userRow['nivel'] . "-" . $userRow['subnivel'] . "-" . $userRow['video'] . " - ".$subir_archivo)) {
                                    echo "El archivo es válido y se cargó correctamente.<br><br>";
                                    echo"<a href='".$subir_archivo."' target='_blank'> Para ver el archivo de click aqui </a>";
                                    
                                    $sql = "INSERT INTO archivos (url, user_id, nivel, subnivel, clase, estado) 
                                    VALUES (?,?,?,?,?,?)";
                                    if ($stmt = mysqli_prepare($link, $sql)) {
                                        mysqli_stmt_bind_param(
                                            $stmt,
                                            "siiiii",
                                            $param_url,
                                            $param_user_id,
                                            $param_nivel,
                                            $param_subnivel,
                                            $param_clase,
                                            $param_state
                                        );
                            
                                        // Set parameters
                                        $param_url = $subir_archivo;
                                        $param_user_id = $userRow['id'];
                                        $param_nivel = $userRow['nivel'];
                                        $param_subnivel = $userRow['subnivel'];
                                        $param_clase = $userRow['video'];
                                        $param_state=1;
                            
                                        if (mysqli_stmt_execute($stmt)) {
                                        } else {
                                            echo "Something went wrong. Please try again later.";
                                        }
                                    }
                                    mysqli_stmt_close($stmt);
                                } else {
                                    echo "La subida ha fallado";
                                }
                                    echo "</div>";
                                    // Close connection
                                mysqli_close($link);
                            ?>
                            <br>
                            <div>
                            <div><a href="clases.php" class="btn btn_rvf2">Regresar </a></div>
                            </div>
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
    <script src="../Ass/js/bootstrap.min.js"></script>
    <script src="../Ass/js/func.js"></script>
</body>
</html>