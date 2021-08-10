<?php
// Include config file
require_once '../dataUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
/*/
if(!isset($_SESSION['roll'])==2) {
    header("Location: ../fecha.php");
    exit;
}
/*/
// Check existence of id parameter before processing further
if (isset($_GET["est"]) && !empty(trim($_GET["est"])) && isset($_GET["fecha"]) && !empty(trim($_GET["fecha"]))) {
    // Prepare a select statement
    $sql = "SELECT * FROM `imagesprocesos` WHERE `id_Usuario` = ? AND `fecha` = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "is", $param_id, $param_fecha);
    
        // Set parameters
        $param_id = trim($_GET["est"]);
        $param_fecha = trim($_GET["fecha"]);
    
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
    
            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $rowss = mysqli_fetch_array($result, MYSQLI_ASSOC);
            }else{ 
        $sql="SELECT * FROM imagesprocesos WHERE id_Usuario = ? ";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
        
            // Set parameters
            $param_id = 0;
        
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
        
                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $rowss = mysqli_fetch_array($result, MYSQLI_ASSOC);
                }
            }
        }
            }
        }
    }

    $sql = "SELECT * FROM `proceso` WHERE `estudiante` = ? AND `fecha` = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "is", $param_id, $param_fecha);
    
        // Set parameters
        $param_id = trim($_GET["est"]);
        $param_fecha = trim($_GET["fecha"]);
    
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
    
            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $sql = "SELECT * FROM ruta WHERE id = ?";

                if ($stmt = mysqli_prepare($link, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                    // Set parameters
                    $param_id = $row['clase'];
                
                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                
                        if (mysqli_num_rows($result) == 1) {
                            /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                            $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        } else {
                            // tax doesn't contain valid id. Redirect to error page
                            header("location: ../error.php");
                            exit();
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }

                if (!empty($row['clase_2'])) {
                    $sql = "SELECT * FROM ruta WHERE id = ?";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "i", $param_id);
                    
                        // Set parameters
                        $param_id = $row['clase_2'];
                    
                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                    
                            if (mysqli_num_rows($result) == 1) {
                                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                $row3 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            } else {
                                // tax doesn't contain valid id. Redirect to error page
                                header("location: ../error.php");
                                exit();
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
                } else {
                    $row3["categoria"]="";
                    $row3["nivel"]="";
                    $row3["tema"]="";
                    $row3["contenido"]="";
                }
            } else {
                // tax doesn't contain valid id. Redirect to error page
                header("location: error.php");
                exit();
            }
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: ../error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PROCESO</title>
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
                        <h2>Proceso individual</h2>
                        <p>Lectura del proceso</p>
                    </div>

                    <div class="page-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>Fecha De Clase:</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row['fecha']; ?>">
                            </div>

                            <div class="col-12 page-header">
                                <h3>Ejes de la primera sesión</h3>
                            </div>

                            <div class="col-12 form-group">
                                <label>Clase De:</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row2['categoria']; ?>">
                            </div>
                            <div class="col-12 form-group">
                                <label>Ejes Tematicos (TEMAS)</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row2['nivel']; ?>">
                            </div>
                            <div class="col-12 form-group">
                                <label>Actividad (DESCRIPCION)</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row2['tema']; ?>">
                            </div>
                            <div class="col-12 form-group">
                                <label>Objetivo de la actividad</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row2['contenido']; ?>">
                            </div>

                            <div class="col-12 form-group">
                                <label>Recursos (MATERIALES USADOS)</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row['recursos']; ?>">
                            </div>

                            <div class="col-12 opciones">
                                <div class="center">
                                    <div class="page-header">
                                        <h3>Experiencias</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <label>¿Se cumplió el objetivo?</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row['sceo']; ?>">
                            </div>
                            <div class="col-12 form-group">
                                <label>¿Qué hiciste bien?</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row['qhb']; ?>">
                            </div>
                            <div class="col-12 form-group">
                                <label>¿Qué podría haber hecho mejor?</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row['qhbhm']; ?>">
                            </div>
                            <div class="col-12 form-group">
                                <label>¿Qué aprendiste en esta actividad?</label>
                                <input disabled type="text" class="form-control" value="<?php echo $row['qheea']; ?>">
                            </div>

                            <div class="col-12 mx-auto center">
                                <div class="col-12 mx-auto center">
                                    <img class="imagenes" height="300px" src="data:image/jpg;base64,<?php echo base64_encode($rowss['image']);?>"/>
                                </div>
                            </div>



                            <div class="col-12 form-group" id="oculto2" style="display:none;">
                                <div class="opciones">
                                    <div class="center">
                                        <div class="page-header">
                                            <h3>Ejes de la segunda sesiòn</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label>Clase De:</label>
                                    <input disabled type="text" class="form-control"
                                        value="<?php echo $row3['categoria']; ?>">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Ejes Tematicos (TEMAS)</label>
                                    <input disabled type="text" class="form-control" value="<?php echo $row3['nivel']; ?>">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Actividad (DESCRIPCION)</label>
                                    <input disabled type="text" class="form-control" value="<?php echo $row3['tema']; ?>">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Objetivo de la actividad</label>
                                    <input disabled type="text" class="form-control"
                                        value="<?php echo $row3['contenido']; ?>">
                                </div>

                                <div class="col-12 form-group">
                                    <label>Recursos (MATERIALES USADOS)</label>
                                    <input disabled type="text" class="form-control"
                                        value="<?php echo $row['recursos_2']; ?>">
                                </div>

                                <div class="col-12 opciones">
                                    <div class="center">
                                        <div class="page-header">
                                            <h3>Experiencias</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 form-group">
                                    <label>¿Se cumplió el objetivo?</label>
                                    <input disabled type="text" class="form-control" value="<?php echo $row['sceo_2']; ?>">
                                </div>
                                <div class="col-12 form-group">
                                    <label>¿Qué hiciste bien?</label>
                                    <input disabled type="text" class="form-control" value="<?php echo $row['qhb_2']; ?>">
                                </div>
                                <div class="col-12 form-group">
                                    <label>¿Qué podría haber hecho mejor?</label>
                                    <input disabled type="text" class="form-control" value="<?php echo $row['qhbhm_2']; ?>">
                                </div>
                                <div class="col-12 form-group">
                                    <label>¿Qué aprendiste en esta actividad?</label>
                                    <input disabled type="text" class="form-control" value="<?php echo $row['qheea_2']; ?>">
                                </div>

                                <div>
                                    <div class="col-12 opciones">
                                        <div class="center">
                                            <img class="imagenes" height="300px" src="data:image/jpg;base64,<?php echo base64_encode($rowss['image2']);?>"/>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 py-3">
                                <div class="center">
                                    <div class="page-header">
                                        <h3>Anotaciones del tutor</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <label>RECOMENDACIONES</label>
                                <input disabled type="text" class="form-control"
                                    value="<?php echo $row['recomendaciones']; ?>">
                            </div>
                            <div class="col-12 form-group">
                                <label>Situación pendiente</label>
                                <input disabled type="text" class="form-control"
                                    value="<?php echo $row['situapendiente']; ?>">
                            </div>
                            <div class=" col-md-12 form-group">
                                                <label>Material de Apoyo</label>
                                                <input disabled type="text" name="matApoyo" class="form-control"
                                                    value="<?php echo $row['matApoyo']; ?>">
                                            </div>
                            <br>

                            <div class="col-12 col_btn py-3">
                                <a class="btn btn_rvf1" onclick="ocultarismo()" role="button">Ver segunda Sesion</a>
                            </div>

                            <!-- <div class="col-12 col_btn py-3">
                                <a class="btn btn_rvf1" onclick="ocultarismo()" role="button">Agregar Sesión</a>
                            </div> -->
                            <!-- <div class="col-12 py-2 my-2">
                                <a class="btn btn_rvf1" onclick="ocultarismo()">Otra evidencia</a>
                            </div> -->

                            <div class="col-12 center pb-3">
                                <?php
                                if ($_SESSION['role']==2) {
                                    echo "<a href='fecha.php' class='btn btn_rvf2' role='button'>Regresar</a>";
                                }else if($_SESSION['role']==4){
                                    echo "<a href='../indexs/indexEstudiantes.php' class='btn btn_rvf2' role='button'>Regresar</a>";
                                }else{
                                    echo "<a href='procesos.php' class='btn btn_rvf2' role='button'>Regresar</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
        
                        
                    </div>
                    
            </div>
        </div>
    </div>
    
    
    </body>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
    <script src="../Ass/js/func.js"></script>

</html>