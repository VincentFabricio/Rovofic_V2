<?php
// Include config file
require_once '../dataUser.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$respuesta = array("Si", "No");
$Arnivel = array("1", "2", "3", "4", "5", "6","7","8","9","10");
$ArrTema = array("1", "2", "3", "4", "5", "6");
$ArrNombTema = array("Blockly","Freecad","Arduino","Fritzing","Eagle","Electronica");
$Arrnivel = array("0","1", "2", "3");
$ArrNombNivel = array("Sin Asignar","Básico","Intermedio","Avanzado");
$Arrclase = array("1", "2", "3", "4", "5", "6");
$dias = array("Martes","Miércoles","Jueves","Viernes","Sábado");
$horas = array("2 - 4 pm","4 - 6 pm","9 - 11 am","11 - 1 pm");
$ArrGenero= array("Masculino", "Femenino");
$ArrRh=array("A+","B+","O+","AB+","A-","B-","O-","AB-");
$ArrNUIP=array("TI","CC");
$ArrJornada=array("Mañana","Tarde","Sabatina");
$ArrAcudiente=array("Padre","Madre");

// Define variables and initialize with empty values
$nombres = $apellidos = $identificacion = $colegio = $grado = $jornada = $madre = $telefono = $padre = $telefono1 = $acudiente =
        $eps = $direccion = $tipo_identificacion = $genero = $fecha_nacimiento = $edad = $rh = $lugar_nacimiento = $estrato = $barrio =
        $telefono_estudiante = $ocupacion_padre = $identificacion_padre = $ocupacion_madre = $identificacion_madre = $correo = $fecha_matricula = $clase1 = $horario1 = $clase2 = $horario2 = $clase3 = $horario3 = $t_fracaso =
        $t_fracaso_com = $t_fracaso_niv = $s_problemas = $s_problemas_com = $s_problemas_niv = $c_concentracion =
        $c_concentracion_com = $c_concentracion_niv = $c_concentracion_mej = $c_concentracion_mej_com = $nivel = "";

    $nombres_err = $apellidos_err = $identificacion_err = $colegio_err = $grado_err = $jornada_err = $madre_err = $telefono_err = $padre_err =
        $telefono1_err = $acudiente_err = $eps_err = $direccion_err = $tipo_identificacion_err = $genero_err = $fecha_nacimiento_err =
        $edad_err = $rh_err = $lugar_nacimiento_err = $estrato_err = $barrio_err = $telefono_estudiante_err = $ocupacion_padre_err =
        $identificacion_padre_err = $ocupacion_madre_err = $identificacion_madre_err =
        $correo_err = $fecha_matricula_err = $clase1_err = $horario1_err = $clase2_err = $horario2_err = $clase3_err = $horario3_err = $t_fracaso_err =
        $t_fracaso_com_err = $t_fracaso_niv_err = $s_problemas_err = $s_problemas_com_err = $s_problemas_niv_err = $c_concentracion_err =
        $c_concentracion_com_err = $c_concentracion_niv_err = $c_concentracion_mej_err = $c_concentracion_mej_com_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input values
    $id = $_POST["id"];

    $input_nombres = trim($_POST["nombres"]);
    if (empty($input_nombres)) {
        $nombres_err = "Please enter a nombres.";
    } else {
        $nombres = $input_nombres;
    }
    // Validate apellidos
    $input_apellidos = trim($_POST["apellidos"]);
    if (empty($input_apellidos)) {
        $apellidos_err = "Please enter a apellidos.";
    } else {
        $apellidos = $input_apellidos;
    }

    // Validate numero identificacion
    $input_identificacion = trim($_POST["identificacion"]);
    if (empty($input_identificacion)) {
        $identificacion_err = "Please enter the identificacion amount.";
    } else {
        $identificacion = $input_identificacion;
    }

    // Validate colegio
    $input_colegio = trim($_POST["colegio"]);
    if (empty($input_colegio)) {
        $colegio_err = "Please enter a colegio.";
    } else {
        $colegio = $input_colegio;
    }

    // Validate grado

    $input_grado = trim($_POST["grado"]);
    if (empty($input_grado)) {
        $grado_err = "Please enter the grado amount.";
    } else {
        $grado = $input_grado;
    }



    // Validate jornada
    $input_jornada = trim($_POST["jornada"]);
    if (empty($input_jornada)) {
        $jornada_err = "Please enter a jornada.";
    } else {
        $jornada = $input_jornada;
    }

    // Validate nombre madre
    $input_madre = trim($_POST["madre"]);
    if (empty($input_madre)) {
        $madre_err = "Please enter a madre.";
    } else {
        $madre = $input_madre;
    }

    // Validate telefono
    $input_telefono = trim($_POST["telefono"]);
    if (empty($input_telefono)) {
        $telefono_err = "Please enter the telefono amount.";
    } else {
        $telefono = $input_telefono;
    }

    // Validate nombre padre
    $input_padre = trim($_POST["padre"]);
    if (empty($input_padre)) {
        $padre_err = "Please enter a padre.";
    } else {
        $padre = $input_padre;
    }

    // Validate telefono1
    $input_telefono1 = trim($_POST["telefono1"]);
    if (empty($input_telefono1)) {
        $telefono1_err = "Please enter the telefono1 amount.";
    } else {
        $telefono1 = $input_telefono1;
    }

    // Validate nombre acudiente
    $input_acudiente = trim($_POST["acudiente"]);
    if (empty($input_acudiente)) {
        $acudiente_err = "Please enter a acudiente.";
    } else {
        $acudiente = $input_acudiente;
    }

    // Validate eps
    $input_eps = trim($_POST["eps"]);
    if (empty($input_eps)) {
        $eps_err = "Please enter a eps.";
    } else {
        $eps = $input_eps;
    }

    // Validate direccion
    $input_direccion = trim($_POST["direccion"]);
    if (empty($input_direccion)) {
        $direccion_err = 'Please enter an direccion.';
    } else {
        $direccion = $input_direccion;
    }

    // Validate tipo_identificacion
    $input_tipo_identificacion = trim($_POST["tipo_identificacion"]);
    if (empty($input_tipo_identificacion)) {
        $tipo_identificacion_err = "Por favor ingrese el tipo de identificacion.";
    } else {
        $tipo_identificacion = $input_tipo_identificacion;
    }

    // Validate genero
    $input_genero = trim($_POST["genero"]);
    if (empty($input_genero)) {
        $genero_err = "Por favor ingrese el genero.";
    } else {
        $genero = $input_genero;
    }

    // Validate fecha_nacimiento
    $input_fecha_nacimiento = trim($_POST["fecha_nacimiento"]);
    if (empty($input_fecha_nacimiento)) {
        $fecha_nacimiento_err = "Por favor ingrese la fecha de nacimiento.";
    } else {
        $fecha_nacimiento = $input_fecha_nacimiento;
    }

    // Validate rh
    $input_rh = trim($_POST["rh"]);
    if (empty($input_rh)) {
        $rh_err = "Por favor ingrese el rh.";
    } else {
        $rh = $input_rh;
    }

    // Validate lugar_nacimiento
    $input_lugar_nacimiento = trim($_POST["lugar_nacimiento"]);
    if (empty($input_lugar_nacimiento)) {
        $lugar_nacimiento_err = "Por favor ingrese el lugar de nacimiento.";
    } else {
        $lugar_nacimiento = $input_lugar_nacimiento;
    }

    // Validate estrato
    $input_estrato = trim($_POST["estrato"]);
    if (empty($input_estrato)) {
        $estrato_err = "Por favor ingrese el estrato.";
    } else {
        $estrato = $input_estrato;
    }

    // Validate barrio
    $input_barrio = trim($_POST["barrio"]);
    if (empty($input_barrio)) {
        $barrio_err = "Por favor ingrese el barrio.";
    } else {
        $barrio = $input_barrio;
    }

    // Validate telefono_estudiante
    $input_telefono_estudiante = trim($_POST["telefono_estudiante"]);
    if (empty($input_telefono_estudiante)) {
        $telefono_estudiante_err = "Por favor ingrese el telefono del estudiante.";
    } else {
        $telefono_estudiante = $input_telefono_estudiante;
    }

    // Validate ocupacion_padre
    $input_ocupacion_padre = trim($_POST["ocupacion_padre"]);
    if (empty($input_ocupacion_padre)) {
        $ocupacion_padre_err = "Por favor ingrese la ocupacion del padre.";
    } else {
        $ocupacion_padre = $input_ocupacion_padre;
    }

    // Validate identificacion_padre
    $input_identificacion_padre = trim($_POST["identificacion_padre"]);
    if (empty($input_identificacion_padre)) {
        $identificacion_padre_err = "Por favor ingrese el numero de identificacion del padre.";
    } else {
        $identificacion_padre = $input_identificacion_padre;
    }

    // Validate ocupacion_madre
    $input_ocupacion_madre = trim($_POST["ocupacion_madre"]);
    if (empty($input_ocupacion_madre)) {
        $ocupacion_madre_err = "Por favor ingrese la ocupacion de la madre.";
    } else {
        $ocupacion_madre = $input_ocupacion_madre;
    }

    // Validate identificacion_madre
    $input_identificacion_madre = trim($_POST["identificacion_madre"]);
    if (empty($input_identificacion_madre)) {
        $identificacion_madre_err = "Por favor ingrese el numero de identificacion de la madre.";
    } else {
        $identificacion_madre = $input_identificacion_madre;
    }

    // Validate correo
    $input_correo = trim($_POST["correo"]);
    if (empty($input_correo)) {
        $correo_err = "Por favor ingrese el correo.";
    } else {
        $correo = $input_correo;
    }

    // Validate fecha_matricula
    $input_fecha_matricula = trim($_POST["fecha_matricula"]);
    if (empty($input_fecha_matricula)) {
        $fecha_matricula_err = "Por favor ingrese la fecha de matricula.";
    } else {
        $fecha_matricula = $input_fecha_matricula;
    }

    // Validate clase1
    $input_clase1 = trim($_POST["clase1"]);
    if (empty($input_clase1)) {
        $clase1_err = "Por favor ingrese el dia de clase.";
    } else {
        $clase1 = $input_clase1;
    }

    // Validate horario1
    $input_horario1 = trim($_POST["horario1"]);
    if (empty($input_horario1)) {
        $horario1_err = "Por favor ingrese la hora de la clase.";
    } else {
        $horario1 = $input_horario1;
    }

    // Validate clase2
    $input_clase2 = trim($_POST["clase2"]);
    $clase2 = $input_clase2;

    // Validate horario2
    $input_horario2 = trim($_POST["horario2"]);
    $horario2 = $input_horario2;


    // Validate clase3
    $input_clase3 = trim($_POST["clase3"]);
    $clase3 = $input_clase3;


    // Validate horario3
    $input_horario3 = trim($_POST["horario3"]);
    $horario3 = $input_horario3;

    // Validate t_fracaso
    $input_t_fracaso = trim($_POST["t_fracaso"]);
    if (empty($input_t_fracaso)) {
        $t_fracaso_err = "Por favor ingrese la tolerancia al fracaso.";
    } else {
        $t_fracaso = $input_t_fracaso;
    }

    // Validate t_fracaso_com
    $input_t_fracaso_com = trim($_POST["t_fracaso_com"]);
    if (empty($input_t_fracaso_com)) {
        $t_fracaso_com_err = "Por favor ingrese el comentario de la tolerancia al fracaso.";
    } else {
        $t_fracaso_com = $input_t_fracaso_com;
    }

    // Validate t_fracaso_niv
    $input_t_fracaso_niv = trim($_POST["t_fracaso_niv"]);
    if (empty($input_t_fracaso_niv)) {
        $t_fracaso_niv_err = "Por favor ingrese el nivel de la tolerancia al fracaso.";
    } else {
        $t_fracaso_niv = $input_t_fracaso_niv;
    }

    // Validate s_problemas
    $input_s_problemas = trim($_POST["s_problemas"]);
    if (empty($input_s_problemas)) {
        $s_problemas_err = "Por favor ingrese la solucion de problemas.";
    } else {
        $s_problemas = $input_s_problemas;
    }

    // Validate s_problemas_com
    $input_s_problemas_com = trim($_POST["s_problemas_com"]);
    if (empty($input_s_problemas_com)) {
        $s_problemas_com_err = "Por favor ingrese el comentario de la solucion de problemas.";
    } else {
        $s_problemas_com = $input_s_problemas_com;
    }

    // Validate s_problemas_niv
    $input_s_problemas_niv = trim($_POST["s_problemas_niv"]);
    if (empty($input_s_problemas_niv)) {
        $s_problemas_niv_err = "Por favor ingrese el nivel de la solucion de problemas.";
    } else {
        $s_problemas_niv = $input_s_problemas_niv;
    }

    // Validate c_concentracion
    $input_c_concentracion = trim($_POST["c_concentracion"]);
    if (empty($input_c_concentracion)) {
        $c_concentracion_err = "Por favor ingrese si la robotica mejora la capacidad de concentracion.";
    } else {
        $c_concentracion = $input_c_concentracion;
    }

    // Validate c_concentracion_com
    $input_c_concentracion_com = trim($_POST["c_concentracion_com"]);
    if (empty($input_c_concentracion_com)) {
        $c_concentracion_com_err = "Por favor ingrese el comentario si la robotica mejora la capacidad de concentracion.";
    } else {
        $c_concentracion_com = $input_c_concentracion_com;
    }

    // Validate c_concentracion_niv
    $input_c_concentracion_niv = trim($_POST["c_concentracion_niv"]);
    if (empty($input_c_concentracion_niv)) {
        $c_concentracion_niv_err = "Por favor ingrese el nivel de concentracion.";
    } else {
        $c_concentracion_niv = $input_c_concentracion_niv;
    }

    // Validate c_concentracion_mej
    $input_c_concentracion_mej = trim($_POST["c_concentracion_mej"]);
    if (empty($input_c_concentracion_mej)) {
        $c_concentracion_mej_err = "Por favor ingrese si la robotica mejora la capacidad de solucionar problemas.";
    } else {
        $c_concentracion_mej = $input_c_concentracion_mej;
    }

    // Validate c_concentracion_mej_com
    $input_c_concentracion_mej_com = "";
        $c_concentracion_mej_com = $input_c_concentracion_mej_com;

    // Validate nivel clase
    $input_nivel = trim($_POST["nivel"]);
    $nivel = $input_nivel;
    // Validate subnivel clase
    $input_subnivel = trim($_POST["subnivel"]);
    $subnivel = $input_subnivel;

    $input_clase = trim($_POST["clase"]);
    $clase = $input_clase;

    // Check input errors before inserting in database
    if (
        empty($nombres_err) && empty($apellidos_err) && empty($identificacion_err) && empty($colegio_err) && empty($grado_err)
            && empty($jornada_err) && empty($madre_err) && empty($telefono_err) && empty($padre_err) && empty($telefono1_err) && empty($acudiente_err)
            && empty($eps_err) && empty($direccion_err) && empty($tipo_identificacion_err) && empty($genero_err)
            && empty($fecha_nacimiento_err) && empty($rh_err) && empty($lugar_nacimiento_err) && empty($estrato_err)
            && empty($barrio_err) && empty($telefono_estudiante_err) && empty($ocupacion_padre_err) && empty($identificacion_padre_err)
            && empty($ocupacion_madre_err) && empty($identificacion_madre_err) && empty($correo_err) && empty($fecha_matricula_err) && empty($clase1_err)
            && empty($horario1_err) && empty($t_fracaso_err) && empty($t_fracaso_com_err) && empty($t_fracaso_niv_err) && empty($s_problemas_err)
            && empty($s_problemas_com_err) && empty($s_problemas_niv_err) && empty($c_concentracion_err) && empty($c_concentracion_com_err) && empty($c_concentracion_niv_err)
            && empty($c_concentracion_mej_err) && empty($c_concentracion_mej_com_err)
    ) {
        // Prepare an update statement
        $sql = "UPDATE datos SET nombres=?, apellidos=?, identificacion=?,
         colegio=?, grado=?, jornada=?, madre=?, telefono=? ,padre=? ,
         telefono1=? ,acudiente=?, eps=? ,direccion=?,
         tipo_identificacion=?, genero=?, fecha_nacimiento=?, edad=?,
          rh=?, lugar_nacimiento=?, estrato=?, barrio=?,
         telefono_estudiante=?, ocupacion_padre=?,
          identificacion_padre=?, ocupacion_madre=?, 
          identificacion_madre=?, correo=?, fecha_matricula=?, 
         clase1=?, horario1=?, clase2=?, horario2=?, clase3=?, horario3=?,
         t_fracaso=?, t_fracaso_com=?, t_fracaso_niv=?, 
         s_problemas=?, s_problemas_com=?, s_problemas_niv=?, 
         c_concentracion=?, c_concentracion_com=?, 
         c_concentracion_niv=?, c_concentracion_mej=?,
          c_concentracion_mej_com=?, nivel=?, subnivel=?, video=?
         WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            //
            mysqli_stmt_bind_param(
                $stmt,
                "ssissssisissssssissisisisissssssssssissississiiii",
                $param_nombres,
                $param_apellidos,
                $param_identificacion,
                $param_colegio,
                $param_grado,
                $param_jornada,
                $param_madre,
                $param_telefono,
                $param_padre,
                $param_telefono1,
                $param_acudiente,
                $param_eps,
                $param_direccion,
                $param_tipo_identificacion,
                $param_genero,
                $param_fecha_nacimiento,
                $param_edad,
                $param_rh,
                $param_lugar_nacimiento,
                $param_estrato,
                $param_barrio,
                $param_telefono_estudiante,
                $param_ocupacion_padre,
                $param_identificacion_padre,
                $param_ocupacion_madre,
                $param_identificacion_madre,
                $param_correo,
                $param_fecha_matricula,
                $param_clase1,
                $param_horario1,
                $param_clase2,
                $param_horario2,
                $param_clase3,
                $param_horario3,
                $param_t_fracaso,
                $param_t_fracaso_com,
                $param_t_fracaso_niv,
                $param_s_problemas,
                $param_s_problemas_com,
                $param_s_problemas_niv,
                $param_c_concentracion,
                $param_c_concentracion_com,
                $param_c_concentracion_niv,
                $param_c_concentracion_mej,
                $param_c_concentracion_mej_com,
                $param_nivel,
                $param_subnivel,
                $param_clase,
                $param_id
            );

            // Set parameters
            $param_nombres = $nombres;
            $param_apellidos = $apellidos;
            $param_identificacion = $identificacion;
            $param_colegio = $colegio;
            $param_grado = $grado;
            $param_jornada =  $jornada;
            $param_madre = $madre;
            $param_telefono = $telefono;
            $param_padre = $padre;
            $param_telefono1 = $telefono1;
            $param_acudiente = $acudiente;
            $param_eps = $eps;
            $param_direccion = $direccion;
            $param_tipo_identificacion = $tipo_identificacion;
            $param_genero = $genero;
            $param_fecha_nacimiento = $fecha_nacimiento;
            $param_edad = $edad;
            $param_rh = $rh;
            $param_lugar_nacimiento = $lugar_nacimiento;
            $param_estrato = $estrato;
            $param_barrio = $barrio;
            $param_telefono_estudiante = $telefono_estudiante;
            $param_ocupacion_padre = $ocupacion_padre;
            $param_identificacion_padre = $identificacion_padre;
            $param_ocupacion_madre = $ocupacion_madre;
            $param_identificacion_madre = $identificacion_madre;
            $param_correo = $correo;
            $param_fecha_matricula = $fecha_matricula;
            $param_clase1 = $clase1;
            $param_horario1 = $horario1;
            $param_clase2 = $clase2;
            $param_horario2 = $horario2;
            $param_clase3 = $clase3;
            $param_horario3 = $horario3;
            $param_t_fracaso = $t_fracaso;
            $param_t_fracaso_com = $t_fracaso_com;
            $param_t_fracaso_niv = $t_fracaso_niv;
            $param_s_problemas = $s_problemas;
            $param_s_problemas_com = $s_problemas_com;
            $param_s_problemas_niv = $s_problemas_niv;
            $param_c_concentracion = $c_concentracion;
            $param_c_concentracion_com = $c_concentracion_com;
            $param_c_concentracion_niv = $c_concentracion_niv;
            $param_c_concentracion_mej = $c_concentracion_mej;
            $param_c_concentracion_mej_com = $c_concentracion_mej_com;
            $param_id = $id;
            $param_nivel=$nivel;
            $param_subnivel=$subnivel;
            $param_clase=$clase;
            $param_id=$id;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records updated successfully. Redirect to landing page
                header("location: ../indexs/index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
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
                    $nivel=$row["nivel"];
                    $subnivel=$row["subnivel"];
                    $clase=$row["video"];
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>EDITAR DATOS</title>
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
                        <h2>Editar Datos</h2>
                    </div>
                
                    <p>Edición de los datos de la matricula:</p>
                    <form class="page-body" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="container">
                            <div class="row align-items-center">
                        
                                <div class="col-6 mx-auto form-group <?php echo (!empty($fecha_matricula_err)) ? 'has-error' : ''; ?>">
                                    <label>Fecha matricula</label>
                                    <input type="date" name="fecha_matricula" class="form-control" step="1"
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
                                    <input type="text" name="nombres" class="form-control"
                                        value="<?php echo $nombres; ?>">
                                    <span class="help-block"><?php echo $nombres_err; ?></span>
                                </div>
                          
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($apellidos_err)) ? 'has-error' : ''; ?>">
                                    <label>Apellidos: </label>
                                    <input type="text" name="apellidos" class="form-control"
                                        value="<?php echo $apellidos; ?>">
                                    <span class="help-block"><?php echo $apellidos_err; ?></span>
                                </div>

                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($tipo_identificacion_err)) ? 'has-error' : ''; ?>">
                                    <label>Tipo de identificacion</label>
                                        <select class="form-control" name="tipo_identificacion">
                                    <?php
                                            foreach ($ArrNUIP as $val) {
                                                if ($tipo_identificacion != "" && $val != "") {
                                                    if ($tipo_identificacion == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $tipo_identificacion_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($identificacion_err)) ? 'has-error' : ''; ?>">
                                    <label>Numero de identificación</label>
                                    <input type="number" name="identificacion" class="form-control"
                                        value="<?php echo $identificacion; ?>">
                                    <span class="help-block"><?php echo $identificacion_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($genero_err)) ? 'has-error' : ''; ?>">
                                    <label>Genero</label>
                                        <select class="form-control" name="genero">
                                    <?php
                                            foreach ($ArrGenero as $val) {
                                                if ($genero != "" && $val != "") {
                                                    if ($genero == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $genero_err; ?></span>
                                </div>

                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($edad_err)) ? 'has-error' : ''; ?>">
                                    <label>Edad: </label>
                                    <input type="number" name="edad" class="form-control" value="<?php echo $edad; ?>">
                                    <span class="help-block"><?php echo $edad_err; ?></span>
                                </div>
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($fecha_nacimiento_err)) ? 'has-error' : ''; ?>">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date" name="fecha_nacimiento" class="form-control"
                                        value="<?php echo $fecha_nacimiento; ?>">
                                    <span class="help-block"><?php echo $fecha_nacimiento_err; ?></span>
                                </div>
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($rh_err)) ? 'has-error' : ''; ?>">
                                    <label>Rh</label>
                                    <select class="form-control" name="rh">
                                    <?php
                                            foreach ($ArrRh as $val) {
                                                if ($rh != "" && $val != "") {
                                                    if ($rh == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $rh_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($lugar_nacimiento_err)) ? 'has-error' : ''; ?>">
                                    <label>Lugar de nacimiento</label>
                                    <input type="text" name="lugar_nacimiento" class="form-control"
                                        value="<?php echo $lugar_nacimiento; ?>">
                                    <span class="help-block"><?php echo $lugar_nacimiento_err; ?></span>
                                </div>
                           
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($colegio_err)) ? 'has-error' : ''; ?>">
                                    <label>Nombre del colegio</label>
                                    <input type="text" name="colegio" class="form-control"
                                        value="<?php echo $colegio; ?>">
                                    <span class="help-block"><?php echo $colegio_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($grado_err)) ? 'has-error' : ''; ?>">
                                    <label>Grado en curso</label>
                                    <input type="text" name="grado" class="form-control" value="<?php echo $grado; ?>">
                                    <span class="help-block"><?php echo $grado_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($jornada_err)) ? 'has-error' : ''; ?>">
                                    <label>Jornada escolar</label>
                                    <input type="text" name="jornada" class="form-control"
                                        value="<?php echo $jornada; ?>">
                                    <span class="help-block"><?php echo $jornada_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 mx-auto form-group <?php echo (!empty($telefono_estudiante_err)) ? 'has-error' : ''; ?>">
                                    <label>Telefono del niñ@ o adolescente</label>
                                    <input type="number" name="telefono_estudiante" class="form-control"
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
                                    <input type="text" name="madre" class="form-control" value="<?php echo $madre; ?>">
                                    <span class="help-block"><?php echo $madre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($identificacion_madre_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de identificación</label>
                                    <input type="number" name="identificacion_madre" class="form-control"
                                        value="<?php echo $identificacion_madre; ?>">
                                    <span class="help-block"><?php echo $identificacion_madre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($ocupacion_madre_err)) ? 'has-error' : ''; ?>">
                                    <label>Ocupación</label>
                                    <input type="text" name="ocupacion_madre" class="form-control"
                                        value="<?php echo $ocupacion_madre; ?>">
                                    <span class="help-block"><?php echo $ocupacion_madre_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de contacto</label>
                                    <input type="number" name="telefono" class="form-control"
                                        value="<?php echo $telefono; ?>">
                                    <span class="help-block"><?php echo $telefono_err; ?></span>
                                </div>
                            
                                
                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h5>Datos del padre</h5>
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($padre_err)) ? 'has-error' : ''; ?>">
                                    <label>Nombre del padre</label>
                                    <input type="tex" name="padre" class="form-control" value="<?php echo $padre; ?>">
                                    <span class="help-block"><?php echo $padre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($identificacion_padre_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de identificación</label>
                                    <input type="number" name="identificacion_padre" class="form-control"
                                        value="<?php echo $identificacion_padre; ?>">
                                    <span class="help-block"><?php echo $identificacion_padre_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($ocupacion_padre_err)) ? 'has-error' : ''; ?>">
                                    <label>Ocupación</label>
                                    <input type="text" name="ocupacion_padre" class="form-control"
                                        value="<?php echo $ocupacion_padre; ?>">
                                    <span class="help-block"><?php echo $ocupacion_padre_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($telefono1_err)) ? 'has-error' : ''; ?>">
                                    <label>Número de contacto</label>
                                    <input type="number" name="telefono1" class="form-control"
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
                                        <select class="form-control" name="acudiente">
                                        <option></option>
                                        <?php
                                            foreach ($ArrAcudiente as $val) {
                                                if ($acudiente != "" && $val != "") {
                                                    if ($acudiente == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $acudiente_err; ?></span>
                                </div>
                            
                                
                                <div class="col-12 py-3">
                                    <div class="center">
                                        <h5> Información adicional </h5>
                                    </div>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($eps_err)) ? 'has-error' : ''; ?>">
                                    <label>Entidad prestadora de salud (EPS): </label>
                                    <input type="text" name="eps" class="form-control" value="<?php echo $eps; ?>">
                                    <span class="help-block"><?php echo $eps_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($direccion_err)) ? 'has-error' : ''; ?>">
                                    <label>Dirección: </label>
                                    <input type="text" name="direccion" class="form-control"
                                        value="<?php echo $direccion; ?>">
                                    <span class="help-block"><?php echo $direccion_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($barrio_err)) ? 'has-error' : ''; ?>">
                                    <label>Barrio: </label>
                                    <input type="text" name="barrio" class="form-control"
                                        value="<?php echo $barrio; ?>">
                                    <span class="help-block"><?php echo $barrio_err; ?></span>
                                </div>
                            

                                <div class="col-md-12 col-lg-6 py-1 form-group <?php echo (!empty($estrato_err)) ? 'has-error' : ''; ?>">
                                    <label>Estrato: </label>
                                    <input type="number" name="estrato" class="form-control"
                                        value="<?php echo $estrato; ?>">
                                    <span class="help-block"><?php echo $estrato_err; ?></span>
                                </div>
                            
                                
                                <div class="col-md-12 col-lg-6 py-1 mx-auto form-group <?php echo (!empty($correo_err)) ? 'has-error' : ''; ?>">
                                    <label>Correo electrónico alternativo: </label>
                                    <input type="email" name="correo" class="form-control"
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
                                    <label>¿Su hij@ tolera el fracaso? </label>
                                    <select class="form-control" name="t_fracaso">
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
                                    <label>Enumere de 1 a 10 la capacidad que tiene su hij@ de tolerar el fracaso
                                    </label>
                                        <small class="text-muted">
                                        (Siendo 1 muy bajo, 2 medio-bajo, 3 bajo, 4 intermedio, 5 medio-alto, 6 alto y 7-10 muy
                                        alto)</small>
                                    <select class="form-control" name="t_fracaso_niv">
                                        <option></option>
                                        <?php
                                            foreach ($Arnivel as $val) {
                                                if ($t_fracaso_niv == $val) {
                                                    echo "<option value='$val' selected>$val</option>";
                                                } else {
                                                    echo "<option value='$val'>$val</option>";
                                                }
                                            }
                                            ?>
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $t_fracaso_niv_err; ?></span>
                                </div>

                                <div class="col-12 pb-2 form-group <?php echo (!empty($t_fracaso_com_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Por qué?</label>
                                    <input type="text" name="t_fracaso_com" class="form-control"
                                        value="<?php echo $t_fracaso_com; ?>">
                                    <span class="help-block"><?php echo $t_fracaso_com_err; ?></span>
                                </div>


                                <div class="col-12 py-2">
                                    <div class="center">
                                        <h5>Solución e identificación de problemas</h5>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($s_problemas_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Su hij@ soluciona los problemas que se le presentan?</label>
                                    <select class="form-control" name="s_problemas">
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
                            
                                
                                <div class="col-md-6 pb-2 form-group <?php echo (!empty($s_problemas_niv_err)) ? 'has-error' : ''; ?>">
                                    <label>Enumere de 1 a 10 la capacidad que tiene su hij@ de solucionar problemas
                                    </label>
                                        <small class="text-muted">
                                        (Siendo 1 muy bajo, 2 medio-bajo, 3 bajo, 4 intermedio, 5 medio-alto, 6 alto y 7-10 muy
                                        alto)</small>
                                    <select class="form-control" name="s_problemas_niv">
                                        <option></option>
                                        <?php
                                            foreach ($Arnivel as $val) {
                                                if ($s_problemas_niv == $val) {
                                                    echo "<option value='$val' selected>$val</option>";
                                                } else {
                                                    echo "<option value='$val'>$val</option>";
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $s_problemas_niv_err; ?></span>
                                </div>

                                <div class="col-12 pb-4 form-group <?php echo (!empty($s_problemas_com_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Por qué?</label>
                                    <input type="text" name="s_problemas_com" class="form-control"
                                        value="<?php echo $s_problemas_com; ?>">
                                    <span class="help-block"><?php echo $s_problemas_com_err; ?></span>
                                </div>

                                <div class="col-md-6 pb-2 mx-auto form-group <?php echo (!empty($c_concentracion_mej_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Cree que las clases de robótica mejoraran la capacidad de solucionar
                                        problemas de su hij@? </label>
                                    <select class="form-control" name="c_concentracion_mej">
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
                                    <label>¿Cree que las clases de robótica mejoran la concentración de su hij@?</label>
                                    <select class="form-control" name="c_concentracion">
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
                                    <label>¿Cree que su hij@ tiene buena concentración y/o distrae con facilidad?
                                        Enumere de 1 a 10 la capacidad que tiene su hij@ </label>
                                        <small class="text-muted">
                                        (Siendo 1 muy bajo, 2 medio-bajo, 3 bajo, 4 intermedio, 5 medio-alto, 6 alto y 7-10 muy
                                        alto)</small>
                                    <select class="form-control" name="c_concentracion_niv">
                                        <option></option>
                                        <?php
                                            foreach ($Arnivel as $val) {
                                                if ($c_concentracion_niv == $val) {
                                                    echo "<option value='$val' selected>$val</option>";
                                                } else {
                                                    echo "<option value='$val'>$val</option>";
                                                }
                                            }
                                            ?>
                                    </select>
                                    <span class="help-block"><?php echo $c_concentracion_niv_err; ?></span>
                                </div>
                            
                                
                                <div
                                    class="col-12 pb-4 form-group <?php echo (!empty($c_concentracion_com_err)) ? 'has-error' : ''; ?>">
                                    <label>¿Por qué?</label>
                                    <input type="text" name="c_concentracion_com" class="form-control"
                                        value="<?php echo $c_concentracion_com; ?>">
                                    <span class="help-block"><?php echo $c_concentracion_com_err; ?></span>
                                </div>



                                
                            
                                
                                
                            
                                
                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h4> Hoarario de las sesiones o actividades </h4>
                                    </div>
                                </div>
                            
                            
                                
                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($clase1_err)) ? 'has-error' : ''; ?>">
                                    <label>*Día de la sesión </label>
                                    <br>
                                    <select class="form-control" name="clase1">
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
                            
                                
                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($horario1_err)) ? 'has-error' : ''; ?>">
                                    <label>*Horario de la sesión </label>
                                    <select class="form-control" name="horario1">
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

                                <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($clase2_err)) ? 'has-error' : ''; ?>">
                                        <label>Segundo día de la sesión</label>
                                        <select class="form-control" name="clase2">
                                            <optgroup label="Semana">
                                                <option><?php echo $clase2; ?></option>
                                                <option>Martes</option>
                                                <option>Miércoles</option>
                                                <option>Jueves</option>
                                                <option>Viernes</option>
                                            </optgroup>
                                            <optgroup label="Fin de semana">
                                                <option>Sábado</option>
                                            </optgroup>
                                        </select>
                                        <span class="help-block"><?php echo $clase2_err; ?></span>
                                    </div>

                                    <div class="col-md-12 col-lg-6 pb-2 form-group <?php echo (!empty($horario2_err)) ? 'has-error' : ''; ?>">
                                        <label>Horario de la segunda sesión</label>
                                        <select class="form-control" name="horario2">
                                        <optgroup label="Semana">
                                                <option><?php echo $horario2; ?></option>
                                                <option>2 - 4 pm</option>
                                                <option>4 - 6 pm</option>
                                            </optgroup>
                                            <optgroup label="Fin de semana">
                                                <option>9 - 11 am</option>
                                                <option>11 - 1 pm</option>
                                            </optgroup>
                                        </select>
                                        <span class="help-block"><?php echo $horario2_err; ?></span>
                                    </div>
                            


                                <div class="col-12 form-group" id="oculto2" style="display:none;">
                                
                                    <div class="row">
                                        <div class="col-md-12 col-lg-6 pb-2 form-group">
                                            <label>Tercer día de la sesión </label>
                                            <br>
                                            <select class="form-control" name="clase3">
                                            <optgroup label="Semana">
                                                <option><?php echo $clase3; ?></option>
                                                <option>Martes</option>
                                                <option>Miércoles</option>
                                                <option>Jueves</option>
                                                <option>Viernes</option>
                                            </optgroup>
                                            <optgroup label="Fin de semana">
                                                <option>Sábado</option>
                                            </optgroup>
                                        </select>
                                        </div>
                                    
                                        <div class="col-md-12 col-lg-6 pb-2 form-group">
                                            <label>Horario de la tercera sesión </label>
                                            <select class="form-control" name="horario3">
                                        <optgroup label="Semana">
                                                <option><?php echo $horario3; ?></option>
                                                <option>2 - 4 pm</option>
                                                <option>4 - 6 pm</option>
                                            </optgroup>
                                            <optgroup label="Fin de semana">
                                                <option>9 - 11 am</option>
                                                <option>11 - 1 pm</option>
                                            </optgroup>
                                        </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 py-3 col_btn">
                                    <a class="btn btn_rvf1" onclick="ocultarismo()">Agregar otra sesión</a>
                                </div>
                                <div class="col-12 col_btn form-group" id="ocultoBtt" style="display:none;">
                                    <a class="btn btn_rvf1" onclick="resetOcult()">Restaurar sesiones</a>
                                    
                                </div>



                                <div class="col-12 py-4">
                                    <div class="center">
                                        <h5> Actividades virtuales </h5>
                                    </div>
                                </div>


                                
                                <div class="col-12 py-1 form-group">
                                    <label>Tema actual</label>
                                        <select class="form-control" name="nivel">
                                            <option></option>
                                            <?php
                                                foreach ($ArrTema as $val) {
                                                    if ($nivel == $val) {
                                                        $val2=$val-1;
                                                        echo "<option value='$val' selected> $ArrNombTema[$val2] </option>";
                                                    } else {
                                                        $val2=$val-1;
                                                        echo "<option value='$val'> $ArrNombTema[$val2] </option>";
                                                    }
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-6 pb-2 form-group">
                                        <label>Nivel actual del joven</label>
                                        <select class="form-control" name="subnivel">
                                            <option></option>
                                            <?php
                                                foreach ($Arrnivel as $val) {
                                                    if ($subnivel == $val) {
                                                        echo "<option value='$val' selected>$ArrNombNivel[$val]</option>";
                                                    } else {
                                                        echo "<option value='$val'>$ArrNombNivel[$val]</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12 col-lg-6 pb-2 form-group">
                                        <label>Clase actual del joven</label>
                                            <select class="form-control" name="clase">
                                            <option></option>
                                            <?php
                                                foreach ($Arrclase as $val) {
                                                    if ($clase == $val) {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    } else {
                                                        echo "<option value='$val'>$val</option>";
                                                    }
                                                }
                                            ?>
                                            </select>
                                    </div>
                                </div>        

                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <div class="col-12 ">
                                    <button class="btn btn_rvf1" onclick="myFunction()" type="submit">Guardar</button>
                                    <a class="btn btn_rvf2" href="../indexs/index.php">Regresar</a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </form>
                    
            </div>
        </div>
    </div>
    <script src="../Ass/js/func.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script></body>

</html>