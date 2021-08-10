<?php
    // Include config file
    require_once '../dataUser.php';
    require_once 'subirImagen.php';
    ?>

 <!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <title>PERFIL</title>
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
                
                    <div class="page-header py-4">
                        <h2>Foto de perfil</h2>
                        <p>Puede tener una foto un su perfil</p>
                    </div>

                    <div class="page-header">
                        <form method="post" enctype="multipart/form-data">
                            <div class="col-10 py-2 mx-auto my-2">
                                <h4>Seleccione una imagen para subierla (jpg):</h4>
                                <input type="file"  name="image" class="form-control" />
                                </div>
                                <div style="width:100%; float:left;">
                                <div class="opciones">
                                    <div class="center">
                                <input class="btn btn_rvf1" type="submit" name="submit" value="Guardar" />
                                <a class="btn btn_rvf2" href="../indexs/index.php">Regresar</a>
                                </div>
                                </div>
                            </div> 
                        </form>
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