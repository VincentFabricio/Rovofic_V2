<?php
    require_once "dataUser2.php";

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    // Define variables and initialize with empty values
    $horas1 = array("8:00 AM", "10:00 AM", "2:00 PM", "4:00 PM");
    $horas2 = array("10:00 AM", "12:00 M", "4:00 PM", "6:00 PM");
    $estudiante = $clase = $fecha = $ejet = $actividad = $objactividad = $tiempo = $tiempo1 = $recursos = $sceo = $qhb = $qhbhm = $qheea = $recomendaciones = $situapendiente = $clase_2 = $recursos_2 = $sceo_2 = $qhb_2 = $qhbhm_2 = $qheea_2 = "";
    $estudiante_err = $clase_err = $fecha_err = $ejet_err = $actividad_err = $objactividad_err = $tiempo_err = $tiempo1_err = $recursos_err = $sceo_err = $qhb_err = $qhbhm_err = $qheea_err = $recomendaciones_err = $situapendiente_err = $clase_2_err = $recursos_2_err = $sceo_2_err = $qhb_2_err = $qhbhm_2_err = $qheea_2_err = "";

    // Get hidden input value
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_estudiante = trim($_POST["estudiante"]);
        if (empty($input_estudiante)) {
            $estudiante_err = "Please enter a estudiante.";
        } else {
            $estudiante = $input_estudiante;
        }

        $input_clase = trim($_POST["clase"]);
        if (empty($input_clase)) {
            $clase_err = "Please enter a clase.";
        } else {
            $clase = $input_clase;
        }
        // Validate apellidos
        $input_fecha = trim($_POST["fecha"]);
        if (empty($input_fecha)) {
            $fecha_err = "Please enter a fecha.";
        } else {
            $fecha = $input_fecha;
        }

        $input_recursos = trim($_POST["recursos"]);
        if (empty($input_recursos)) {
            $recursos_err= "Please enter a recurso";
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
        if (empty($input_qhb)) {
            $qhb_err = "Please enter a qhb.";
        } else {
            $qhb = $input_qhb;
        }

        $input_qhbhm = trim($_POST["qhbhm"]);
        if (empty($input_qhbhm)) {
            $qhbhm_err = "Please enter a qhbhm.";
        } else {
            $qhbhm = $input_qhbhm;
        }

        $input_qheea = trim($_POST["qheea"]);
        if (empty($input_qheea)) {
            $qheea_err = "Please enter a qheea.";
        } else {
            $qheea = $input_qheea;
        }

        $input_clase_2 = trim($_POST["clase_2"]);
        $clase_2 = $input_clase_2;

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

        // Check input errors before inserting in database
        if (empty($estudiante_err) && empty($clase_err) && empty($fecha_err) && empty($ejet_err) && empty($actividad_err) && empty($objactividad_err) && empty($tiempo_err) && empty($tiempo1_err) && empty($recursos_err) && empty($sceo_err) && empty($qhb_err) && empty($qhbhm_err) && empty($qheea_err) && empty($recomendaciones_err) && empty($situapendiente_err)) {
            // Prepare an insert statement

            // Processing form data when form is submitted
    $sql = "SELECT * FROM proceso WHERE estudiante=? AND fecha=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "is", $param_id,$param_fecha);

        // Set parameters
        $param_id = $_SESSION['user'];
        $param_fecha = $fecha;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result4 = mysqli_stmt_get_result($stmt);
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
            $Cont="0";
            if (mysqli_num_rows($result4) == 1) {
                $Cont="1";
            }
            if ($Cont=="1") {
                echo "El proceso ya ha sido creado para esa fecha";
            } else {
                $sql = "INSERT INTO proceso (estudiante, clase, fecha, ejet, actividad, objactividad, tiempo, recursos, sceo, qhb, qhbhm, qheea, recomendaciones, situapendiente, clase_2, recursos_2, sceo_2, qhb_2, qhbhm_2, qheea_2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                if ($stmt = mysqli_prepare($link, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $param_estudiante, $param_clase, $param_fecha, $param_ejet, $param_actividad, $param_objactividad, $param_tiempo, $param_recursos, $param_sceo, $param_qhb, $param_qhbhm, $param_qheea, $param_recomendaciones, $param_situapendiente, $param_clase_2, $param_recursos_2, $param_sceo_2, $param_qhb_2, $param_qhbhm_2, $param_qheea_2);

                    // Set parameters
                    $param_estudiante = $estudiante;
                    $param_clase = $clase;
                    $param_fecha = $fecha;
                    $param_ejet = $ejet;
                    $param_actividad = $actividad;
                    $param_objactividad = $objactividad;
                    $param_tiempo = $tiempo . '-' . $tiempo1;
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

                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Records created successfully. Redirect to landing page
                        header("location: ../indexs/indexEstudiantes.php");
                        exit();
                    } else {
                        echo "Something went wrong. Please try again later.";
                    }
                }
            }
        }
    }

    $sql = "SELECT id,nombres,apellidos FROM datos WHERE id=?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        //
        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $param_id
        );

        $param_clase=$_SESSION['user'];
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
        }
    }

    $sql2 = "SELECT categoria,nivel,tema,contenido,id FROM ruta";
    $result2 = mysqli_query($link, $sql2);
    $result2_1 = mysqli_query($link, $sql2);

    $sql3 = "SELECT id FROM ruta";
    $result3 = mysqli_query($link, $sql3);

    // Close connection
    mysqli_close($link);
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
    
    <style type="text/css">


		th {
			cursor: pointer;
		}
    </style>
</head>

<body>
    <!-- Navigation Bar-->
	<?php include '../navegator.ini'; ?>
    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                    <div class="container text-center pt-4 pb-1 w-75">
                        <h2>Proceso Individual</h2>
                        <p class="col-10 mx-auto">Guarde el proceso <span
                            style="color:red;">(*)</span></p>
                    
                    </div>
                    
                    <div class="page-body">
                        
                         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            
                            <div class="col-lg-8 col-md-10 mx-auto pb-2 form-group <?php echo (!empty($estudiante_err)) ? 'has-error' : ''; ?>">
                                <label>Niñ@ o Joven *</label>
                                <select class="form-control" name="estudiante">
                                    <option></option>
                                    <?php
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        if ($estudiante != "" && $row['id'] != "") {
                                            if ($estudiante == $row['id']) {
                                                echo "<option value='$row[id]' selected>$row[nombres] $row[apellidos]</option>";
                                            } else {
                                                echo "<option value='$row[id]'>$row[nombres] $row[apellidos]</option>";
                                            }
                                        } else {
                                            echo "<option value='$row[id]'>$row[nombres] $row[apellidos]</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="help-block"><?php echo $estudiante_err; ?></span>
                            </div>
                            
                            <div class="col-lg-4 col-md-7 mx-auto py-2 form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                                <label>Fecha de Clase: *</label>
                                <input type="date" name="fecha" class="form-control" step="1" min="2000-01-01"
                                        max="2100-12-31" value="<?php echo date("Y-m-d"); ?>">
                                <span class="help-block"><?php echo $fecha_err; ?></span>
                            </div>

                            <div class="col-12 py-2 mx-auto">
                                <div class="">
                                    <h4> Primera Sesión (*) </h4>
                                </div>
                            </div>

                            <input class='col-lg-8 col-md-10 mx-auto py-2 form-control' id='myInput' type='text' onkeyup='myFunctions(1)'
                                placeholder='Buscar...'>
                            
                            <div class="col-12 py-4 mx-auto">
                                <div class="scroll_2">
                                    <?php
                                    if (mysqli_num_rows($result2) > 0) {
                                        echo "<br>";
                                        echo "<table class='table table-bordered' id='myTable'>";
                                        echo "<thead>";
                                        echo "<tr>";
                                        echo "<th style='width:5%;' onclick='sortTable(0,1)' >CODIGO</th>";
                                        echo "<th onclick='sortTable(1,1)'>CATEGORIA</th>";
                                        echo "<th onclick='sortTable(2,1)'>NIVEL</th>";
                                        echo "<th style='width:10%;' onclick='sortTable(3,1)'>TEMA</th>";
                                        echo "<th onclick='sortTable(4,1)'>CONTENIDO</th>";
                                        echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody id ='tbody'>";
                                        while ($row = mysqli_fetch_array($result2)) {
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
                                        mysqli_free_result($result2);
                                    }
                                    ?>
                                </div>
                            </div>

                                <div class="col-lg-8 col-md-10 mx-auto py-2">
                                    <div class="form-group <?php echo (!empty($clase_err)) ? 'has-error' : ''; ?>">
                                        <label>Clase De: *</label>
                                        <input type="text" name="clase" class="form-control"
                                            value="<?php echo $clase; ?>">
                                        <span class="help-block"><?php echo $clase_err; ?></span>
                                    </div>
                                </div>
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-12 py-2">
                                    <div class="form-group <?php echo (!empty($recursos_err)) ? 'has-error' : ''; ?>">
                                        <label>Recursos (MATERIALES USADOS) *</label>
                                        <input type="text" name="recursos" class="form-control"
                                            value="<?php echo $recursos; ?>">
                                        <span class="help-block"><?php echo $recursos_err; ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 py-2">
                                    <div class="form-group <?php echo (!empty($sceo_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Se cumplió el objetivo? *</label>
                                        <select class="form-control" name="sceo">
                                        <option value="" selected="selected"></option>
                                        <option>Si</option>
                                        <option>No</option>
                                        <option>En proceso</option>
                                    </select>
                                        <span class="help-block"><?php echo $sceo_err; ?></span>
                                    </div>
                                </div>
                            </div>
                                

                            <div class="row">
                                <div class="col-lg-6 col-md-12 py-2">
                                    <div class="form-group <?php echo (!empty($qhb_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Qué hiciste bien? *</label>
                                        <input type="text" name="qhb" class="form-control" value="<?php echo $qhb; ?>">
                                        <span class="help-block"><?php echo $qhb_err; ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12 py-2">
                                    <div class="form-group <?php echo (!empty($qhbhm_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Qué podría haber hecho mejor? *</label>
                                        <input type="text" name="qhbhm" class="form-control"
                                            value="<?php echo $qhbhm; ?>">
                                        <span class="help-block"><?php echo $qhbhm_err; ?></span>
                                    </div>
                                </div>

                            </div>
                                

                                <div class="col-12 py-2">
                                    <div class="form-group <?php echo (!empty($qheea_err)) ? 'has-error' : ''; ?>">
                                        <label>¿Qué aprendiste en esta actividad? *</label>
                                        <input type="text" name="qheea" class="form-control"
                                            value="<?php echo $qheea; ?>">
                                        <span class="help-block"><?php echo $qheea_err; ?></span>
                                    </div>
                                </div>

								<div class="form-group" id="oculto2" style="display:none;">
                                    
                                    <div class="col-12 py-2 mx-auto">
                                        <div class="">
                                            <h4> Segunda Sesión</h4>
                                        </div>
                                    </div>
                                

                                    <input class='col-lg-8 col-md-10 mx-auto py-2 form-control' id='myInput2' type='text' onkeyup='myFunctions(2)'
                                        placeholder='Buscar...'>
                                    
                                    <div class="col-12 py-4">
                                        <div class="scroll_2 mx-auto">
                                            <?php
                                            if (mysqli_num_rows($result2_1) > 0) {
                                                echo "<table class='table table-bordered' id='myTable2'>";
                                                echo "<thead>";
                                                echo "<tr>";
                                                echo "<th style='width:5%;' onclick='sortTable(0, 2)' >CODIGO</th>";
                                                echo "<th onclick='sortTable(1,2)'>CATEGORIA</th>";
                                                echo "<th onclick='sortTable(2,2)'>NIVEL</th>";
                                                echo "<th style='width:10%;' onclick='sortTable(3,2)'>TEMA</th>";
                                                echo "<th onclick='sortTable(4,2)'>CONTENIDO</th>";
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody id ='tbody2'>";
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

                                    <div class="col-lg-8 col-md-10 mx-auto">
                                        <div class="form-group <?php echo (!empty($clase_2_err)) ? 'has-error' : ''; ?>">
                                            <label>Clase De: </label>
                                            <input type="text" name="clase_2" class="form-control"
                                                value="<?php echo $clase_2; ?>">
                                            <span class="help-block"><?php echo $clase_2_err; ?></span>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-lg-6 col-md-12 py-2">
                                            <div class="form-group <?php echo (!empty($recursos_2_err)) ? 'has-error' : ''; ?>">
                                                <label>Recursos (MATERIALES USADOS) </label>
                                                <input type="text" name="recursos_2" class="form-control"
                                                    value="<?php echo $recursos_2; ?>">
                                                <span class="help-block"><?php echo $recursos_2_err; ?></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12 py-2">
                                            <div class="form-group <?php echo (!empty($sceo_2_err)) ? 'has-error' : ''; ?>">
                                                <label>¿Se cumplió el objetivo? </label>
                                                <select class="form-control" name="sceo_2">
                                                <option value="" selected="selected"></option>
                                                <option>Si</option>
                                                <option>No</option>
                                                <option>En proceso</option>
                                            </select>
                                                <span class="help-block"><?php echo $sceo_2_err; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row pl-2 pr-2">
                                        <div class="col-lg-6 col-md-12 py-2">
                                            <div class="form-group <?php echo (!empty($qhb_2_err)) ? 'has-error' : ''; ?>">
                                                <label>¿Qué hiciste bien?</label>
                                                <input type="text" name="qhb_2" class="form-control"
                                                    value="<?php echo $qhb_2; ?>">
                                                <span class="help-block"><?php echo $qhb_2_err; ?></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-12 py-2">
                                            <div class="form-group <?php echo (!empty($qhbhm_2_err)) ? 'has-error' : ''; ?>">
                                                <label>¿Qué podría haber hecho mejor?</label>
                                                <input type="text" name="qhbhm_2" class="form-control"
                                                    value="<?php echo $qhbhm_2; ?>">
                                                <span class="help-block"><?php echo $qhbhm_2_err; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="col-12 py-2">
                                        <div class="form-group <?php echo (!empty($qheea_2_err)) ? 'has-error' : ''; ?>">
                                            <label>¿Qué aprendiste en esta actividad?</label>
                                            <input type="text" name="qheea_2" class="form-control"
                                                value="<?php echo $qheea_2; ?>">
                                            <span class="help-block"><?php echo $qheea_2_err; ?></span>
                                        </div>
                                    </div>
								</div>

								<!--div class="opciones">
                                    <div class="col-12 py-2">
                                        <a class="btn btn_rvf1" onclick="ocultarismo()">Agregar Sesion</a>
									</div>
								</div-->

                                <div class="col-10 col_btn py-3 mx-auto">
                                    <a class="btn btn_rvf1" onclick="ocultarismo()" role="button">Añadir</a>
                                </div>

                                
									<div class="col-10 py-2 my-2 mx-auto">
											<input type="submit" class="btn btn_rvf1" value="Guardar">
											<a href="../indexs/indexEstudiantes.php" class="btn btn_rvf2">Regresar</a>
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