<?php
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }

    // Process delete operation after confirmation
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
    } else {
        // Check existence of id parameter
        if (empty(trim($_GET["id"]))) {
            // URL doesn't contain id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>DESCARGAS</title>
    <link rel="icon" href="../Ass/img/roxy.webp" sizes="32x32">

    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../Ass/css/Style_navbar.css" />
    <style type="text/css">

    .main {
        margin: auto;
        border: 1px solid #7C7A7A;
        width: 100%;
        text-align: left;
        padding: 10px;
        background: #FFFDD0;
        opacity: 0.8;
        font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
        margin: 80px auto;
    }

    input[type=submit] {
        background: #6ca16e;
        width: 100%;
        padding: 5px 15px;
        background: #ccc;
        cursor: pointer;
        font-size: 16px;
    }
    </style>
</head>

<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                        <div class="text-center py-4">
                            <h2>Descarga de archivos</h2> 
                            <p class="col-10 mx-auto text-justify">Podrá descargar los archivos relacionados con le usuarios</p>
                        </div>

                        <div class="page-body">
                            <?php
                            $sql = "SELECT * FROM archivos WHERE user_id = ? AND nivel = ? AND subnivel = ? AND clase = ?";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                //
                                mysqli_stmt_bind_param(
                                    $stmt,
                                    "iiii",
                                    $param_id,
                                    $param_tema,
                                    $param_nivel,
                                    $param_clase
                                );

                                $param_id=trim($_GET["id"]);
                                $param_tema=trim($_GET["niv"]);
                                $param_nivel=trim($_GET["sub"]);
                                $param_clase=trim($_GET["cla"]);
                                if (mysqli_stmt_execute($stmt)) {
                                    $result = mysqli_stmt_get_result($stmt);
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $url="/scripts/rovofic.com/intranet/clases/".$row['url'];
                                        echo"<a href='".$url."' target='_blank'> Para ver el directorio: ". $row['url'] ." </a>";
                                        echo "<br>";
                                    }
                                } else {
                                    echo "ERROR: No pudo ejecutar $ sql. " . mysqli_error($link);
                                }
                            }
                            mysqli_stmt_close($stmt);

                                // Close connection
                                mysqli_close($link);
                            ?>
                            <br>
                            <div class="col-11 mx-auto">
                                <a class="btn btn_rvf2" href="../indexs/index.php">Regresar</a>
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