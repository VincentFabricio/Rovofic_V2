<?php
    // Include config file
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    // Define variables and initialize with empty values
    $horas1 = array("8:00 AM", "10:00 AM", "2:00 PM", "4:00 PM");
    $horas2 = array("10:00 AM", "12:00 M", "4:00 PM", "6:00 PM");
    $rutas = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "46", "47", "48", "49", "50", "51", "52", "53", "54", "55", "56", "57", "58", "59", "60", "61", "62", "63", "64");
    $clase =$clase_2 = $ejet = $actividad = $objactividad = $tiempo = $tiempo1 = $recursos = $sceo = $qhb = $qhbhm = $qheea =$recursos_2 = $sceo_2 = $qhb_2 = $qhbhm_2 = $qheea_2 = $recomendaciones = $situapendiente = $matApoyo = "";
    $clase_err =$clase_2_err = $ejet_err = $actividad_err = $objactividad_err = $tiempo_err = $tiempo1_err = $recursos_err = $sceo_err = $qhb_err = $qhbhm_err = $qheea_err =$recursos_2_err = $sceo_2_err = $qhb_2_err = $qhbhm_2_err = $qheea_2_err = $recomendaciones_err = $situapendiente_err = "";
    // Processing form data when form is submitted
    if (isset($_GET["est"]) && !empty(trim($_GET["est"])) && isset($_GET["fecha"]) && !empty(trim($_GET["fecha"]))) {
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
                            } else {
                                // tax doesn't contain valid id. Redirect to error page
                                header("location: ../error.php");
                                exit();
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
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

                    $sql3 = "SELECT * FROM ruta";
                    $result3 = mysqli_query($link, $sql3);
                    $result2_1 = mysqli_query($link, $sql3);

                    $rt = $row["clase"];
                    $clase = $row["clase"];
                    $ejet = $row["ejet"];
                    $actividad = $row["actividad"];
                    $objactividad = $row["objactividad"];
                    $t = explode("-", $row["tiempo"]);
                    $tiempo = $t[0];
                    $tiempo1 = $t[1];
                    $recursos = $row["recursos"];
                    $sceo = $row["sceo"];
                    $qhb = $row["qhb"];
                    $qhbhm = $row["qhbhm"];
                    $qheea = $row["qheea"];
                    $recomendaciones = $row["recomendaciones"];
                    $situapendiente = $row["situapendiente"];
                    $clase_2 = $row["clase_2"];
                    $recursos_2 = $row["recursos_2"];
                    $sceo_2 = $row["sceo_2"];
                    $qhb_2 = $row["qhb_2"];
                    $qhbhm_2 = $row["qhbhm_2"];
                    $qheea_2 = $row["qheea_2"];
                    $matApoyo = $row['matApoyo'];
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
    } else {
        // URL doesn't contain valid id parameter. Redirect to error page
        header("location: ../error.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_GET["est"];
        $fecha = $_GET["fecha"];

        $input_clase = trim($_POST["clase"]);
        if (empty($input_clase)) {
            $clase_err = "Please enter a clase.";
        } else {
            $clase = $input_clase;
        }

        $input_clase_2 = trim($_POST["clase_2"]);
        $clase_2 = $input_clase_2;

        $input_recursos = trim($_POST["recursos"]);
        if (empty($input_recursos)) {
            $recursos_err = "Please enter a recursos.";
        } else {
            $recursos = $input_recursos;
        }

        $input_sceo = trim($_POST["sceo"]);
        if (empty($input_sceo)) {
            $sceo_err = "Please enter a sceo.";
        } else {
            $sceo = $input_sceo;
        }

        $input_qhb = trim($_POST["qhb"]);
        $qhb = $input_qhb;

        $input_qhbhm = trim($_POST["qhbhm"]);
        $qhbhm = $input_qhbhm;

        $input_qheea = trim($_POST["qheea"]);
        $qheea = $input_qheea;

        $input_recursos_2 = trim($_POST["recursos_2"]);
        $recursos_2 = $input_recursos_2;

        $input_sceo_2 = trim($_POST["sceo_2"]);
        $sceo_2 = $input_sceo_2;

        $input_qhb_2 = trim($_POST["qhb_2"]);
        $qhb_2 = $input_qhb_2;

        $input_qhbhm_2 = trim($_POST["qhbhm_2"]);
        $qhbhm_2 = $input_qhbhm_2;

        $input_qheea_2 = trim($_POST["qheea_2"]);
        $qheea_2 = $input_qheea_2;


        $input_recomendaciones = trim($_POST["recomendaciones"]);
        if (empty($input_recomendaciones)) {
            $recomendaciones_err = "Please enter a recomendaciones.";
        } else {
            $recomendaciones = $input_recomendaciones;
        }

        $input_situapendiente = trim($_POST["situapendiente"]);
        if (empty($input_situapendiente)) {
            $situapendiente_err = "Please enter a situapendiente.";
        } else {
            $situapendiente = $input_situapendiente;
        }

        $input_matApoyo = trim($_POST["matApoyo"]);
        $matApoyo = $input_matApoyo;


        // Check input errors before inserting in database
        if (empty($clase_err) && empty($ejet_err) && empty($actividad_err) && empty($objactividad_err) && empty($tiempo_err) && empty($tiempo1_err) && empty($recursos_err) && empty($sceo_err) && empty($qhb_err) && empty($qhbhm_err) && empty($qheea_err) && empty($recomendaciones_err) && empty($situapendiente_err)) {
            // Prepare an update statement
            $sql = "UPDATE proceso SET clase=?, ejet=?, actividad=?, objactividad=?, tiempo=?, recursos=? ,sceo=? ,qhb=? ,qhbhm=?, qheea=?, recomendaciones=? ,situapendiente=? ,clase_2=?, recursos_2=? ,sceo_2=? ,qhb_2=? ,qhbhm_2=?, qheea_2=?, matApoyo=? WHERE estudiante=? AND fecha=?";
            
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "sssssssssssssssssssss",
                    $param_clase,
                    $param_ejet,
                    $param_actividad,
                    $param_objactividad,
                    $param_tiempo,
                    $param_recursos,
                    $param_sceo,
                    $param_qhb,
                    $param_qhbhm,
                    $param_qheea,
                    $param_recomendaciones,
                    $param_situapendiente,
                    $param_clase_2,
                    $param_recursos_2,
                    $param_sceo_2,
                    $param_qhb_2,
                    $param_qhbhm_2,
                    $param_qheea_2,
                    $param_matApoyo,
                    $param_id,
                    $param_fecha
                );

                // Set parameters
                $param_clase = $clase;
                $param_ejet = $ejet;
                $param_actividad = $actividad;
                $param_objactividad = $objactividad;
                $param_tiempo = $tiempo . "-" . $tiempo1;
                $param_recursos = $recursos;
                $param_sceo = $sceo;
                $param_qhb = $qhb;
                $param_qhbhm = $qhbhm;
                $param_qheea = $qheea;
                $param_recomendaciones = $recomendaciones;
                $param_situapendiente = $situapendiente;
                $param_clase_2 = $clase_2;
                $param_recursos_2 = $recursos_2;
                $param_sceo_2 = $sceo_2;
                $param_qhb_2 = $qhb_2;
                $param_qhbhm_2 = $qhbhm_2;
                $param_qheea_2 = $qheea_2;
                $param_id = $id;
                $param_fecha = $fecha;
                $param_matApoyo = $matApoyo;

                if (mysqli_stmt_execute($stmt)) {
                    header("location: agregarFotosProceso.php?fecha=$fecha&id=$id");
                    exit();
                } else {
                    header("location: ../error.php");
                    exit();
                }
            }
        }

        // Close connection
        mysqli_close($link);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>EDITAR PROCESO</title>
    <link rel="icon" href="../Ass/img/roxy.webp" sizes="32x32">
    
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../Ass/css/Style_navbar.css" />
    
    <style type="text/css">
    .wrapper {
        width: 500px;
        margin: 0 auto;
    }


    .trselected {
        background: lightgrey;
    }

    .trselected_2 {
        background: lightgrey;
    }
    </style>

</head>

<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">

                    <div class="page-header pt-4 pb-3">
                        <h2>Editar Datos</h2>
                        <p class="col-10 mx-auto text-justify">Edite los valores de entrada y envíe para actualizar el registro.</p>
                    </div>
                    
                    
                <div class="page-body">

                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="container">
                            <div class="row">

                                <div class="col-12 center">
                                    <div class="page-header">
                                        <h3>Primera Sesion</h3>
                                    </div>
                                </div>

                                

                                <div class="col-12 form-group <?php echo (!empty($clase_err)) ? 'has-error' : ''; ?>">
                                    <label>Tema de la sesión: </label>
                                    <input disabled type="text" name="xd" class="form-control"
                                        value="<?php echo $row2['categoria']; ?>">
                                    <span class="help-block"><?php echo $clase_err; ?></span>
                                </div>

                                <div class="col-12 form-group <?php echo (!empty($ejet_err)) ? 'has-error' : ''; ?>">
                                    <label>Ejes Tematicos (TEMAS): </label>
                                    <input disabled name="xd" class="form-control"
                                        value="<?php echo $row2['nivel']; ?>">
                                    <span class="help-block"><?php echo $ejet_err; ?></span>
                                </div>

                                <div class="col-12">
                                    <div class="form-group <?php echo (!empty($actividad_err)) ? 'has-error' : ''; ?>">
                                        <label>Actividad (DESCRIPCION)</label>
                                        <input disabled name="xd" class="form-control" value="<?php echo $row2['tema']; ?>">
                                        <span class="help-block"><?php echo $actividad_err; ?></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group <?php echo (!empty($objactividad_err)) ? 'has-error' : ''; ?>">
                                        <label>Objetivo de la actividad</label>
                                        <input disabled type="text" name="xd" class="form-control"
                                            value="<?php echo $row2['contenido']; ?>">
                                        <span class="help-block"><?php echo $objactividad_err; ?></span>
                                    </div>
                                </div>

                                <div class="col-12 py-2">
                                    <input class='form-control' id='myInput' type='text' onkeyup='myFunctions(1)'
                                        placeholder='Buscar...'>
                                </div>

                                <div class="col-12 py-4">
                                    <div class="scroll_2 mx-auto">
                                        <?php
                                        if (mysqli_num_rows($result3) > 0) {
                                            echo "<table class='table table-bordered'>";
                                            echo "<thead>";
                                            echo "<tr>";
                                            echo "<th>ID</th>";
                                            echo "<th style='width:10%;'>CATEGORIA</th>";
                                            echo "<th>NIVEL</th>";
                                            echo "<th>TEMA</th>";
                                            echo "<th>CONTENIDO</th>";
                                            echo "</tr>";
                                            echo "</thead>";
                                            echo "<tbody id ='tbody'>";
                                            while ($row = mysqli_fetch_array($result3)) {
                                                echo "<tr id=" . $row['id'] . " onclick='myFunction(this)'>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['categoria'] . "</td>";
                                                echo "<td>" . $row['nivel'] . "</td>";
                                                echo "<td>" . $row['tema'] . "</td>";
                                                echo "<td>" . $row['contenido'] . "</td>";
                                                echo "</tr>";
                                            }
                                            echo "</tbody>";
                                            echo "</table>";
                                            // Free result set
                                            mysqli_free_result($result3);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="col-12 pb-4">
                                    <div class="form-group <?php echo (!empty($clase_err)) ? 'has-error' : ''; ?>">
                                        <input type="text" name="clase" class="form-control" value="<?php echo $clase; ?>">
                                        <span class="help-block"><?php echo $clase_err; ?></span>
                                    </div>
                                </div>

                                <br>

                                <div class="col-12">
                                    <div class="form-group <?php echo (!empty($recursos_err)) ? 'has-error' : ''; ?>">
                                        <label>Recursos (MATERIALES)</label>
                                        <input type="text" name="recursos" class="form-control"
                                            value="<?php echo $recursos; ?>">
                                        <span class="help-block"><?php echo $recursos_err; ?></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group <?php echo (!empty($sceo_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Cumplió el objetivo?</label>
                                        <input type="text" name="sceo" class="form-control" value="<?php echo $sceo; ?>">
                                        <span class="help-block"><?php echo $sceo_err; ?></span>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group py-3 <?php echo (!empty($qhb_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Qué hiciste bien?</label>
                                        <input type="text" name="qhb" class="form-control" value="<?php echo $qhb; ?>">
                                        <span class="help-block"><?php echo $qhb_err; ?></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group py-3 <?php echo (!empty($qhbhm_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Qué podría mejorar?</label>
                                        <input type="text" name="qhbhm" class="form-control" value="<?php echo $qhbhm; ?>">
                                        <span class="help-block"><?php echo $qhbhm_err; ?></span>
                                    </div>
                                </div>

                                <div class="col-12 py-3">
                                    <div class="form-group <?php echo (!empty($qheea_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Qué aprendiste de la actividad?</label>
                                        <input type="text" name="qheea" class="form-control" value="<?php echo $qheea; ?>">
                                        <span class="help-block"><?php echo $qheea_err; ?></span>
                                    </div>
                                </div>
                                

                                <div class="col-12 center pb-2">
                                    <div class="page-header">
                                        <h3>Evidencia fotografica de la actividad</h3>
                                    </div>
                                </div>

                                <div class="col-12 center">
                                    <img class="imagenes" height="300px" src="data:image/jpg;base64,<?php echo base64_encode($rowss['image']);?>"/>
                                </div>

                                

                                <!------- Oculto -------->

                                    
                                        <div class="form-group col-12" id="oculto2" style="display:none;">
                                            <div class="col-12 center">
                                                <div class="page-header">
                                                    <h3>Segunda Sesion</h3>
                                                </div>
                                            </div>

                                            <div class="col-12 form-group <?php echo (!empty($clase_err)) ? 'has-error' : ''; ?>">
                                                <label>Clase De:</label>
                                                <input disabled type="text" name="xd" class="form-control"
                                                    value="<?php echo $row3['categoria']; ?>">
                                                <span class="help-block"><?php echo $clase_err; ?></span>
                                            </div>

                                            <div class="col-12 form-group <?php echo (!empty($ejet_err)) ? 'has-error' : ''; ?>">
                                                <label>Ejes Tematicos (TEMAS)</label>
                                                <input disabled name="xd" class="form-control"
                                                    value="<?php echo $row3['nivel']; ?>">
                                                <span class="help-block"><?php echo $ejet_err; ?></span>
                                            </div>

                                            <div class="col-12 form-group <?php echo (!empty($actividad_err)) ? 'has-error' : ''; ?>">
                                                <label>Actividad (DESCRIPCION)</label>
                                                <input disabled name="xd" class="form-control" value="<?php echo $row3['tema']; ?>">
                                                <span class="help-block"><?php echo $actividad_err; ?></span>
                                            </div>

                                            <div class="col-12 form-group <?php echo (!empty($objactividad_err)) ? 'has-error' : ''; ?>">
                                                <label>Objetivo de la actividad</label>
                                                <input disabled type="text" name="xd" class="form-control"
                                                    value="<?php echo $row3['contenido']; ?>">
                                                <span class="help-block"><?php echo $objactividad_err; ?></span>
                                            </div>

                                            <div class="col-12 py-2">
                                                <input class='form-control' id='myInput2' type='text' onkeyup='myFunctions(2)'
                                                    placeholder='Buscar...'>
                                            </div>

                                            <div class="col-12 py-4">
                                                <div class="scroll_2 mx-auto">
                                                    <?php
                                                        if (mysqli_num_rows($result2_1) > 0) {
                                                            echo "<table class='table table-bordered'>";
                                                            echo "<thead>";
                                                            echo "<tr>";
                                                            echo "<th>ID</th>";
                                                            echo "<th style='width:10%;'>CATEGORIA</th>";
                                                            echo "<th>NIVEL</th>";
                                                            echo "<th>TEMA</th>";
                                                            echo "<th>CONTENIDO</th>";
                                                            echo "</tr>";
                                                            echo "</thead>";
                                                            echo "<tbody id ='tbody'>";
                                                            while ($row = mysqli_fetch_array($result2_1)) {
                                                                echo "<tr id=" . $row['id'] . " onclick='myFunction_2(this)'>";
                                                                echo "<td>" . $row['id'] . "</td>";
                                                                echo "<td>" . $row['categoria'] . "</td>";
                                                                echo "<td>" . $row['nivel'] . "</td>";
                                                                echo "<td>" . $row['tema'] . "</td>";
                                                                echo "<td>" . $row['contenido'] . "</td>";
                                                                echo "</tr>";
                                                            }
                                                            echo "</tbody>";
                                                            echo "</table>";
                                                            // Free result set
                                                            mysqli_free_result($result2_1);
                                                        }
                                                        ?>
                                                </div>
                                            </div>

                                            <div class="col-12 form-group <?php echo (!empty($clase_2_err)) ? 'has-error' : ''; ?>">
                                                <label>Clase De: </label>
                                                <input type="text" name="clase_2" class="form-control"
                                                    value="<?php echo $clase_2; ?>">
                                                <span class="help-block"><?php echo $clase_2_err; ?></span>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group <?php echo (!empty($recursos_2_err)) ? 'has-error' : ''; ?>">
                                                    <label>Recursos (MATERIALES)</label>
                                                    <input type="text" name="recursos_2" class="form-control"
                                                        value="<?php echo $recursos_2; ?>">
                                                    <span class="help-block"><?php echo $recursos_2_err; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group <?php echo (!empty($sceo_2_err)) ? 'has-error' : ''; ?>">
                                                    <label>¿Cumplió el objetivo?</label>
                                                    <input type="text" name="sceo_2" class="form-control"
                                                        value="<?php echo $sceo_2; ?>">
                                                    <span class="help-block"><?php echo $sceo_2_err; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group <?php echo (!empty($qhb_2_err)) ? 'has-error' : ''; ?>">
                                                    <label>¿Qué hiciste bien?</label>
                                                    <input type="text" name="qhb_2" class="form-control" value="<?php echo $qhb_2; ?>">
                                                    <span class="help-block"><?php echo $qhb_2_err; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group <?php echo (!empty($qhbhm_2_err)) ? 'has-error' : ''; ?>">
                                                    <label>¿Qué podría mejorar?</label>
                                                    <input type="text" name="qhbhm_2" class="form-control"
                                                        value="<?php echo $qhbhm_2; ?>">
                                                    <span class="help-block"><?php echo $qhbhm_2_err; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group <?php echo (!empty($qheea_2_err)) ? 'has-error' : ''; ?>">
                                                    <label>¿Qué aprendiste de la actividad?</label>
                                                    <input type="text" name="qheea_2" class="form-control"
                                                        value="<?php echo $qheea_2; ?>">
                                                    <span class="help-block"><?php echo $qheea_2_err; ?></span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="center">
                                                    <img class="imagenes" height="300px" src="data:image/jpg;base64,<?php echo base64_encode($rowss['image2']);?>"/>
                                                </div>
                                            </div>

                                            
                                        </div>

                                        <br>

                                        <div class="col-12 center py-3">
                                            <div class="page-header">
                                                    <h3>Anotaciones del tutor</h3>
                                                </div>
                                            </div>

                                            <div class="col-12 form-group <?php echo (!empty($recomendaciones_err)) ? 'has-error' : ''; ?>">
                                                <label>RECOMENDACIONES</label>
                                                <input type="text" name="recomendaciones" class="form-control"
                                                    value="<?php echo $recomendaciones; ?>">
                                                <span class="help-block"><?php echo $recomendaciones_err; ?></span>
                                            </div>
                                            <div class=" col-md-12 form-group <?php echo (!empty($situapendiente_err)) ? 'has-error' : ''; ?>">
                                                <label>Situación pendiente</label>
                                                <input type="text" name="situapendiente" class="form-control"
                                                    value="<?php echo $situapendiente; ?>">
                                                <span class="help-block"><?php echo $situapendiente_err; ?></span>
                                            </div>
                                            <div class=" col-md-12 form-group">
                                                <label>Material de Apoyo</label>
                                                <input type="text" name="matApoyo" class="form-control"
                                                    value="<?php echo $matApoyo; ?>">
                                                <span class="help-block"></span>
                                            </div>
                                        
                                        <br>

                                        <div class="col-12 col_btn py-3">
                                            <a class="btn btn_rvf1 " onclick="ocultarismo()" role="button">Ver segunda Sesion</a>
                                        </div>

                                        <div class="col-12 pb-3">
                                            <input type="submit" class="btn btn_rvf1" value="Guardar">
                                            <a href="procesos.php" class="btn btn_rvf2" role="button">Regresar</a>
                                        </div>
                        </div> 
                                    
                    </form>

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