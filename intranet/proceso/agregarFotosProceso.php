<?php
require_once '../dataUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
if (isset($_GET["fecha"]) && !empty(trim($_GET["fecha"])) && isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Get URL parameter
    $fecha =  trim($_GET["fecha"]);
    $estudiante=trim($_GET["id"]);

    $consulta = "SELECT * from imagesprocesos WHERE id_Usuario = '$estudiante' AND fecha = '$fecha'";
            $result = mysqli_query($link, $consulta);
            $conf = mysqli_fetch_array($result, MYSQLI_ASSOC);
            

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = addslashes(file_get_contents($image));
            $image2 = $_FILES['image2']['tmp_name'];
            $imgContent2 = addslashes(file_get_contents($image2));

            
            if (!$conf) {
                $insert = $link->query("INSERT into imagesprocesos (image,image2, fecha,id_Usuario) VALUES ('$imgContent','$imgContent2', '$fecha','$estudiante')");
                if ($insert) {
                    header("location: ../indexs/index.php");
                    echo "<script language='javascript'>window.location='procesos.php'</script>;";
                    exit();
                }
            }else{
                $sql = "UPDATE imagesprocesos SET image='$imgContent', image2='$imgContent2' WHERE fecha ='$fecha' AND id_Usuario = " . $estudiante;
                $result = mysqli_query($link, $sql);
                header("location: procesos.php");
                echo "<script language='javascript'>window.location='procesos.php'</script>;";
                exit();
            }
        
        }
    }
}
?>

<!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <title>Evidencia procesos</title>
     <link rel="icon" href="../Ass/img/roxy.webp" sizes="32x32">
    
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../Ass/css/Style_navbar.css" />
    
 </head>

 <body>
     <!-- Navigation Bar-->
<!--     <?php include '../navegator.ini'; ?>
 -->
    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                    <div class="container text-center pt-4 pb-1 w-75">
                        <h2>Evidencia de la Sesion 1 (jpg)*</h2>
                        <p>Puede agregar una foto o imagen que se podrá ser vista por el padre de familia</p>
                    
                    </div>
                    
                    <div class="page-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="col-12 py-2 my-2">
                                <h4>Agregue la evidencia de la Sesión 1 (jpg)*</h4>
                                <input type="file"  name="image" class="form-control" />
                                <div class="col-12 py-2 my-2 form-group" id="oculto2" style="display:none;">
                                    <h4>Agregue la evidencia de la Sesión 2 (jpg)</h4>
                                    <input type="file"  name="image2" class="form-control" />
                                </div>
                            </div>

                            <div class="col-12 py-2 my-2">
                                <a class="btn btn_rvf1" onclick="ocultarismo()">Otra evidencia</a>
                            </div>
                            
                            <div class="center">
                                <input class="btn btn_rvf1" type="submit" name="submit" value="Guardar" />
                                <a class="btn btn_rvf2" href="procesos.php">CANCEL</a>
                            </div>
                            
                        </form>
                    </div> 
                
        </div>
    </div>
</div>

    <script src="../Ass/js/func.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
 </body>

 </html>