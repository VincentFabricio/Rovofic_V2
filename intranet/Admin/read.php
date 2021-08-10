<?php
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }

    $respuesta = array("Si", "No");
    $nivel = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
    $dias = array("Martes","Miercoles","Jueves","Viernes","Sabado");
    $horas = array("2 - 4 pm","4 - 6 pm","9 - 11 am","11 - 1 pm");


    // Define variables and initialize with empty values
    $nombres = $apellidos = $identificacion = $colegio = $grado = $jornada = $madre = $telefono = $padre = $telefono1 = $acudiente = 
    $eps = $direccion = $tipo_identificacion = $genero = $fecha_nacimiento = $edad = $rh = $lugar_nacimiento = $estrato = $barrio =
    $telefono_estudiante = $ocupacion_padre = $identificacion_padre = $ocupacion_madre = $identificacion_madre = $correo = $fecha_matricula = $clase1 = $horario1 = $clase2 = $horario2 = $clase3 = $horario3 = $t_fracaso =
    $t_fracaso_com = $t_fracaso_niv = $s_problemas = $s_problemas_com = $s_problemas_niv = $c_concentracion =
    $c_concentracion_com = $c_concentracion_niv = $c_concentracion_mej = $c_concentracion_mej_com = "";

    $nombres_err = $apellidos_err = $identificacion_err = $colegio_err = $grado_err = $jornada_err = $madre_err = $telefono_err = $padre_err =
    $telefono1_err = $acudiente_err = $eps_err = $direccion_err = $tipo_identificacion_err = $genero_err = $fecha_nacimiento_err =
    $edad_err = $rh_err = $lugar_nacimiento_err = $estrato_err = $barrio_err = $telefono_estudiante_err = $ocupacion_padre_err =
    $identificacion_padre_err = $ocupacion_madre_err = $identificacion_madre_err =
    $correo_err = $fecha_matricula_err = $clase1_err = $horario1_err = $clase2_err = $horario2_err = $clase3_err = $horario3_err = $t_fracaso_err =
    $t_fracaso_com_err = $t_fracaso_niv_err = $s_problemas_err = $s_problemas_com_err = $s_problemas_niv_err = $c_concentracion_err =
    $c_concentracion_com_err = $c_concentracion_niv_err = $c_concentracion_mej_err = $c_concentracion_mej_com_err = "";


    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM datos WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $nombres = $row["nombres"];
                    $apellidos = $row["apellidos"];
                    $identificacion = $row["identificacion"];
                    $colegio = $row["colegio"];
                    $grado = $row["grado"];
                    $jornada = $row["jornada"];
                    $madre = $row["madre"];
                    $telefono = $row["telefono"];
                    $padre = $row["padre"];
                    $telefono1 = $row["telefono1"];
                    $acudiente = $row["acudiente"];
                    $eps = $row["eps"];
                    $direccion = $row["direccion"];
                    $tipo_identificacion = $row["tipo_identificacion"];
                    $genero = $row["genero"];
                    $fecha_nacimiento = $row["fecha_nacimiento"];
                    $edad = $row["edad"];
                    $rh = $row["rh"];
                    $lugar_nacimiento = $row["lugar_nacimiento"];
                    $estrato = $row["estrato"];
                    $barrio = $row["barrio"];
                    $telefono_estudiante = $row["telefono_estudiante"];
                    $ocupacion_padre = $row["ocupacion_padre"];
                    $identificacion_padre = $row["identificacion_padre"];
                    $ocupacion_madre = $row["ocupacion_madre"];
                    $identificacion_madre = $row["identificacion_madre"];
                    $correo = $row["correo"];
                    $fecha_matricula = $row["fecha_matricula"];
                    $clase1 = $row["clase1"];
                    $horario1 = $row["horario1"];
                    $clase2 = $row["clase2"];
                    $horario2 = $row["horario2"];
                    $clase3 = $row["clase3"];
                    $horario3 = $row["horario3"];
                    $t_fracaso = $row["t_fracaso"];
        $t_fracaso_com = $row["t_fracaso_com"];
        $t_fracaso_niv = $row["t_fracaso_niv"];
        $s_problemas = $row["s_problemas"];
        $s_problemas_com = $row["s_problemas_com"];
        $s_problemas_niv = $row["s_problemas_niv"];
        $c_concentracion = $row["c_concentracion"];
        $c_concentracion_com = $row["c_concentracion_com"];
        $c_concentracion_niv = $row["c_concentracion_niv"];
        $c_concentracion_mej = $row["c_concentracion_mej"];
        $c_concentracion_mej_com = $row["c_concentracion_mej_com"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LECTURA DE DATOS</title>
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
                
                        <div class="text-center py-4">
                            <h2>Lectura de datos</h2> 
                            <p>Información de matricula:</p>
                        </div>
                        
                        <form class="page-body" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="container">
                            <div class="row align-items-center">
                        
                                <div class="col-6 mx-auto form-group <?php echo (!empty($fecha_matricula_err)) ? 'has-error' : ''; ?>">
                                    <label>Fecha de matricula: </label>
                                    <input disabled type="date" name="fecha_matricula" class="form-control" step="1"
                                        min="2000-01-01" max="2100-12-31" value="<?php echo date("Y-m-d"); ?>">
                                    <span class="help-block"><?php echo $fecha_matricula_err; ?></span>
                                </div>
                            
                                <div class="col-12 py-3 opciones">
                                    <div class="center">
                                        <h5> Datos del niñ@ o adolescente </h5>
                                    </div>
                                </div>

                               
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($nombres_err)) ? 'has-error' : ''; ?>">
                                    <label>Nombres: </label>
                                    <input disabled type="text" name="nombres" class="form-control"
                                        value="<?php echo $nombres; ?>">
                                    <span class="help-block"><?php echo $nombres_err; ?></span>
                                </div>
                          
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($apellidos_err)) ? 'has-error' : ''; ?>">
                                    <label>Apellidos: </label>
                                    <input disabled type="text" name="apellidos" class="form-control"
                                        value="<?php echo $apellidos; ?>">
                                    <span class="help-block"><?php echo $apellidos_err; ?></span>
                                </div>

                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($tipo_identificacion_err)) ? 'has-error' : ''; ?>">
                                    <label>Tipo de identificación: </label>
                                    <input disabled type="text" name="tipo_identificacion" class="form-control"
                                        value="<?php echo $tipo_identificacion; ?>">
                                    <span class="help-block"><?php echo $tipo_identificacion_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($identificacion_err)) ? 'has-error' : ''; ?>">
                                    <label>Numero de identificación</label>
                                    <input disabled type="number" name="identificacion" class="form-control"
                                        value="<?php echo $identificacion; ?>">
                                    <span class="help-block"><?php echo $identificacion_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($genero_err)) ? 'has-error' : ''; ?>">
                                    <label>Genero: </label>
                                    <input disabled type="text" name="genero" class="form-control"
                                        value="<?php echo $genero; ?>">
                                    <span class="help-block"><?php echo $genero_err; ?></span>
                                </div>

                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($edad_err)) ? 'has-error' : ''; ?>">
                                    <label>Edad: </label>
                                    <input disabled type="number" name="edad" class="form-control" value="<?php echo $edad; ?>">
                                    <span class="help-block"><?php echo $edad_err; ?></span>
                                </div>
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($fecha_nacimiento_err)) ? 'has-error' : ''; ?>">
                                    <label>Fecha de nacimiento</label>
                                    <input disabled type="date" name="fecha_nacimiento" class="form-control"
                                        value="<?php echo $fecha_nacimiento; ?>">
                                    <span class="help-block"><?php echo $fecha_nacimiento_err; ?></span>
                                </div>
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($rh_err)) ? 'has-error' : ''; ?>">
                                    <label>Tipo de sangre o Rh: </label>
                                    <input disabled type="text" name="rh" class="form-control" value="<?php echo $rh; ?>">
                                    <span class="help-block"><?php echo $rh_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($lugar_nacimiento_err)) ? 'has-error' : ''; ?>">
                                    <label>Lugar de nacimiento</label>
                                    <input disabled type="text" name="lugar_nacimiento" class="form-control"
                                        value="<?php echo $lugar_nacimiento; ?>">
                                    <span class="help-block"><?php echo $lugar_nacimiento_err; ?></span>
                                </div>
                           
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($colegio_err)) ? 'has-error' : ''; ?>">
                                    <label>Nombre del colegio</label>
                                    <input disabled type="text" name="colegio" class="form-control"
                                        value="<?php echo $colegio; ?>">
                                    <span class="help-block"><?php echo $colegio_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($grado_err)) ? 'has-error' : ''; ?>">
                                    <label>Grado en curso</label>
                                    <input disabled type="text" name="grado" class="form-control" value="<?php echo $grado; ?>">
                                    <span class="help-block"><?php echo $grado_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($jornada_err)) ? 'has-error' : ''; ?>">
                                    <label>Jornada escolar</label>
                                    <input disabled type="text" name="jornada" class="form-control"
                                        value="<?php echo $jornada; ?>">
                                    <span class="help-block"><?php echo $jornada_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 mx-auto form-group <?php echo (!empty($telefono_estudiante_err)) ? 'has-error' : ''; ?>">
                                    <label>Telefono del niñ@ o adolescente</label>
                                    <input disabled type="number" name="telefono_estudiante" class="form-control"
                                        value="<?php echo $telefono_estudiante; ?>">
                                    <span class="help-block"><?php echo $telefono_estudiante_err; ?></span>
                                </div>
                            
                                
                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h5> Datos de la madre </h5>
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($madre_err)) ? 'has-error' : ''; ?>">
                                    <label>Nombre de la madre</label>
                                    <input disabled type="text" name="madre" class="form-control" value="<?php echo $madre; ?>">
                                    <span class="help-block"><?php echo $madre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($identificacion_madre_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de identificación</label>
                                    <input disabled type="number" name="identificacion_madre" class="form-control"
                                        value="<?php echo $identificacion_madre; ?>">
                                    <span class="help-block"><?php echo $identificacion_madre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($ocupacion_madre_err)) ? 'has-error' : ''; ?>">
                                    <label>Ocupación</label>
                                    <input disabled type="text" name="ocupacion_madre" class="form-control"
                                        value="<?php echo $ocupacion_madre; ?>">
                                    <span class="help-block"><?php echo $ocupacion_madre_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de contacto</label>
                                    <input disabled type="number" name="telefono" class="form-control"
                                        value="<?php echo $telefono; ?>">
                                    <span class="help-block"><?php echo $telefono_err; ?></span>
                                </div>
                            
                                
                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h5> Datos del padre </h5>
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($padre_err)) ? 'has-error' : ''; ?>">
                                    <label>Nombre del padre</label>
                                    <input disabled type="tex" name="padre" class="form-control" value="<?php echo $padre; ?>">
                                    <span class="help-block"><?php echo $padre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($identificacion_padre_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de identificación</label>
                                    <input disabled type="number" name="identificacion_padre" class="form-control"
                                        value="<?php echo $identificacion_padre; ?>">
                                    <span class="help-block"><?php echo $identificacion_padre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($ocupacion_padre_err)) ? 'has-error' : ''; ?>">
                                    <label>Ocupación</label>
                                    <input disabled type="text" name="ocupacion_padre" class="form-control"
                                        value="<?php echo $ocupacion_padre; ?>">
                                    <span class="help-block"><?php echo $ocupacion_padre_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($telefono1_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de contacto</label>
                                    <input disabled type="number" name="telefono1" class="form-control"
                                        value="<?php echo $telefono1; ?>">
                                    <span class="help-block"><?php echo $telefono1_err; ?></span>
                                </div>
                            
                                
                                <div class="col-12 py-3">
                                    <div class="center">
                                        <h5> Acudiente:  </h5>
                                    </div>
                                </div>
                            
                                
                                <div class="col-6 mx-auto form-group <?php echo (!empty($acudiente_err)) ? 'has-error' : ''; ?>">
                                    <label>El acudiente es: </label>
                                    <input disabled type="text" name="acudiente" class="form-control"
                                        value="<?php echo $acudiente; ?>">
                                    <span class="help-block"><?php echo $acudiente_err; ?></span>
                                </div>
                            
                                
                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h5> Información adicional </h5>
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($eps_err)) ? 'has-error' : ''; ?>">
                                    <label>Entidad prestadora de salud (EPS): </label>
                                    <input disabled type="text" name="eps" class="form-control" value="<?php echo $eps; ?>">
                                    <span class="help-block"><?php echo $eps_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                                    <label>Dirección: </label>
                                    <input disabled type="text" name="direccion" class="form-control"
                                        value="<?php echo $direccion; ?>">
                                    <span class="help-block"><?php echo $direccion_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($barrio_err)) ? 'has-error' : ''; ?>">
                                    <label>Barrio: </label>
                                    <input disabled type="text" name="barrio" class="form-control"
                                        value="<?php echo $barrio; ?>">
                                    <span class="help-block"><?php echo $barrio_err; ?></span>
                                </div>
                            

                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($estrato_err)) ? 'has-error' : ''; ?>">
                                    <label>Estrato: </label>
                                    <input disabled type="number" name="estrato" class="form-control"
                                        value="<?php echo $estrato; ?>">
                                    <span class="help-block"><?php echo $estrato_err; ?></span>
                                </div>
                            
                                
                                <div class="col-6 mx-auto form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                                    <label>Correo electrónico: </label>
                                    <input disabled type="email" name="correo" class="form-control"
                                        value="<?php echo $correo; ?>">
                                    <span class="help-block"><?php echo $correo_err; ?></span>
                                </div>
                            
                                
                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h3> Evaluación de habilidades </h3>
                                    </div>
                                </div>

                                <div class="col-12 py-2">
                                    <div class="center">
                                        <h5>Tolerantacia al fracaso</h5>
                                        
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 pb-2 py-1 form-group <?php echo (!empty($t_fracaso_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Su hijo tolera el fracaso? </label>
                                    <select disabled class="form-control" name="t_fracaso">
                                        <option></option>
                                        <?php
                                            foreach ($respuesta as $val) {
                                                if ($t_fracaso != "" && $val != "") {
                                                    if ($t_fracaso == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $t_fracaso_err; ?></span>
                                </div>
                           
                                
                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($t_fracaso_niv_err)) ? 'has-error' : ''; ?>">
                                    <label>Enumere de 1 a 10 la capacidad que tiene su hijo de tolerar el fracaso
                                        </label>
                                        <small class="text-muted">
                                        (Siendo 1 muy bajo, 2 medio-bajo, 3 bajo, 4 intermedio, 5 medio-alto, 6 alto y 7-10 muy
                                        alto)</small>
                                    <select disabled class="form-control" name="t_fracaso_niv">
                                        <option></option>
                                        <?php
                                            foreach ($nivel as $val) {
                                                if ($t_fracaso_niv != "" && $val != "") {
                                                    if ($t_fracaso_niv == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $t_fracaso_niv_err; ?></span>
                                </div>

                                <div class="col-md-12 pb-4 form-group <?php echo (!empty($t_fracaso_com_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Por qué?</label>
                                    <input disabled type="text" name="t_fracaso_com" class="form-control"
                                        value="<?php echo $t_fracaso_com; ?>">
                                    <span class="help-block"><?php echo $t_fracaso_com_err; ?></span>
                                </div>


                                <div class="col-12 py-2">
                                    <div class="center">
                                        <h5>Solución e identificación de problemas</h5>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($s_problemas_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Su hijo soluciona los problemas que se le presentan?</label>
                                    <select disabled class="form-control" name="s_problemas">
                                        <option></option>
                                        <?php
                                            foreach ($respuesta as $val) {
                                                if ($s_problemas != "" && $val != "") {
                                                    if ($s_problemas == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $s_problemas_err; ?></span>
                                </div>
                            
                                
                                
                            
                                
                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($s_problemas_niv_err)) ? 'has-error' : ''; ?>">
                                    <label>
                                    Enumere de 1 a 10 la capacidad que tiene su hijo de solucionar problemas
                                    </label>
                                        <small class="text-muted">
                                        (Siendo 1 muy bajo, 2 medio-bajo, 3 bajo, 4 intermedio, 5 medio-alto, 6 alto y 7-10 muy
                                        alto)</small>
                                    <select disabled class="form-control" name="s_problemas_niv">
                                        <option></option>
                                        <?php
                                            foreach ($nivel as $val) {
                                                if ($s_problemas_niv != "" && $val != "") {
                                                    if ($s_problemas_niv == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $s_problemas_niv_err; ?></span>
                                </div>

                                <div class="col-12 pb-4 form-group <?php echo (!empty($s_problemas_com_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Por qué?</label>
                                    <input disabled type="text" name="s_problemas_com" class="form-control"
                                        value="<?php echo $s_problemas_com; ?>">
                                    <span class="help-block"><?php echo $s_problemas_com_err; ?></span>
                                </div>

                                <div class="col-md-12 col-lg-6 pb-2 mx-auto form-group <?php echo (!empty($c_concentracion_mej_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Cree que las clases de robótica mejoraran la capacidad de solucionar
                                        problemas de su hijo? </label>
                                    <select disabled class="form-control" name="c_concentracion_mej">
                                        <option></option>
                                        <?php
                                            foreach ($respuesta as $val) {
                                                if ($c_concentracion_mej != "" && $val != "") {
                                                    if ($c_concentracion_mej == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $c_concentracion_mej_err; ?></span>
                                </div>



                                <div class="col-12 py-2">
                                    <div class="center">
                                        <h5>Concentración</h5>
                                    </div>
                                </div>
                           
                                
                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($c_concentracion_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Cree que las clases de robótica mejoran la concentración de su hijo?</label>
                                    <select disabled class="form-control" name="c_concentracion">
                                        <option></option>
                                        <?php
                                            foreach ($respuesta as $val) {
                                                if ($c_concentracion != "" && $val != "") {
                                                    if ($c_concentracion == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $c_concentracion_err; ?></span>
                                </div>


                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($c_concentracion_niv_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Cree que su hijo tiene buena concentración y/o distrae con facilidad?
                                        Enumere de 1 a 10 la capacidad que tiene su hijo 
                                        </label>
                                        <small class="text-muted">
                                        (Siendo 1 muy bajo, 2 medio-bajo, 3 bajo, 4 intermedio, 5 medio-alto, 6 alto y 7-10 muy
                                        alto)</small>
                                    <select disabled class="form-control" name="c_concentracion_niv">
                                        <option></option>
                                        <?php
                                            foreach ($nivel as $val) {
                                                if ($c_concentracion_niv != "" && $val != "") {
                                                    if ($c_concentracion_niv == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $c_concentracion_niv_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-12 pb-4 form-group <?php echo (!empty($c_concentracion_com_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Por qué?</label>
                                    <input disabled type="text" name="c_concentracion_com" class="form-control"
                                        value="<?php echo $c_concentracion_com; ?>">
                                    <span class="help-block"><?php echo $c_concentracion_com_err; ?></span>
                                </div>
                            
                                
                                
                            
                                
                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h5> Hoarario de las sesiones o actividades </h5>
                                    </div>
                                </div>
                            
                            
                                
                                <div class="col-md-6 pb-2 form-group <?php echo (!empty($clase1_err)) ? 'has-error' : ''; ?>">
                                    <label>*Día de la sesión </label>
                                    <br>
                                    <select disabled class="form-control" name="clase1">
                                    <?php
                                            foreach ($dias as $val) {
                                                if ($clase1 != "" && $val != "") {
                                                    if ($clase1 == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $clase1_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-6 pb-2 form-group <?php echo (!empty($horario1_err)) ? 'has-error' : ''; ?>">
                                    <label>*Horario de la sesión </label>
                                    <select disabled class="form-control" name="horario1">
                                    <?php
                                            foreach ($horas as $val) {
                                                if ($horario1 != "" && $val != "") {
                                                    if ($horario1 == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $horario1_err; ?></span>
                                </div>
                            

                                <div class="col-12 form-group" id="oculto2" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-6 pb-2 form-group <?php echo (!empty($clase2_err)) ? 'has-error' : ''; ?>">
                                            <label>Segundo día de la sesión </label>
                                            <br>
                                            <select disabled class="form-control" name="clase2">
                                            <?php
                                                    foreach ($dias as $val) {
                                                        if ($clase2 != "" && $val != "") {
                                                            if ($clase2 == $val) {
                                                                echo "<option value='$val' selected>$val</option>";
                                                            } else {
                                                                echo "<option value='$val'>$val</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                            <span class="help-block"><?php echo $clase2_err; ?></span>
                                        </div>
                                    
                                        <div class="col-md-6 pb-2 form-group <?php echo (!empty($horario2_err)) ? 'has-error' : ''; ?>">
                                            <label>Horario de la segunda sesión </label>
                                            <select disabled class="form-control" name="horario2">
                                            <?php
                                                    foreach ($horas as $val) {
                                                        if ($horario2 != "" && $val != "") {
                                                            if ($horario2 == $val) {
                                                                echo "<option value='$val' selected>$val</option>";
                                                            } else {
                                                                echo "<option value='$val'>$val</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                            <span class="help-block"><?php echo $horario2_err; ?></span>
                                        </div>
                                    </div>
                                        
                                </div>

                                <div class="col-12 form-group" id="oculto3" style="display:none;">
                                
                                    <div class="row">
                                        <div class="col-md-6 pb-2 form-group <?php echo (!empty($clase3_err)) ? 'has-error' : ''; ?>">
                                            <label>Tercer día de la sesión </label>
                                            <br>
                                            <select disabled class="form-control" name="clase3">
                                            <?php
                                                    foreach ($dias as $val) {
                                                        if ($clase3 != "" && $val != "") {
                                                            if ($clase3 == $val) {
                                                                echo "<option value='$val' selected>$val</option>";
                                                            } else {
                                                                echo "<option value='$val'>$val</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                            <span class="help-block"><?php echo $clase3_err; ?></span>
                                        </div>
                                    
                                        <div class="col-md-6 pb-2 form-group <?php echo (!empty($horario3_err)) ? 'has-error' : ''; ?>">
                                            <label>Horario de la tercera sesión </label>
                                            <select disabled class="form-control" name="horario3">
                                            <?php
                                                    foreach ($horas as $val) {
                                                        if ($horario3 != "" && $val != "") {
                                                            if ($horario3 == $val) {
                                                                echo "<option value='$val' selected>$val</option>";
                                                            } else {
                                                                echo "<option value='$val'>$val</option>";
                                                            }
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                            <span class="help-block"><?php echo $horario3_err; ?></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 py-3 col_btn">
                                    <a class="btn btn_rvf1" onclick="ocultarismo()">Ver otra sesión</a>
                                </div>
                                <div class="col-12 col_btn form-group" id="ocultoBtt" style="display:none;">
                                    <a class="btn btn_rvf2" onclick="resetOcult()">Restaurar sesiones</a>
                                    
                                </div>

                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <div class="col-12 ">
                                    <a class="btn btn_rvf2" href="../indexs/index.php">Regresar</a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
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