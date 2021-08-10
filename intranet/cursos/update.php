<?php
    // Include config file
    require_once '../dataUser.php';
    include "mcript.php";

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

        $ArrTema = array("1", "2", "3", "4", "5", "6");
        $ArrNombTema = array("Blockly","Freecad","Arduino","Fritzing","Eagle","Electronica");
        $Arrnivel = array("0","1", "2", "3");
        $ArrNombNivel = array("Sin Asignar","Básico","Intermedio","Avanzado");
        $Arrclase = array("1", "2", "3", "4", "5", "6");

        // Define variables and initialize with empty values
        $titulo = $subtitulo = $url = $tema = $nivel = $clase = $prueba = $enlace = "";
        $titulo_err = $subtitulo_err = $url_err = $tema_err = $nivel_err = $clase_err = $prueba_err = "";

    // Processing form data when form is submitted
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        // Get hidden input values
        $id = $_POST["id"];

        // Validate titulo
        $input_titulo = trim($_POST["titulo"]);
        if (empty($input_titulo)) {
            $titulo_err = "Por favor ingrese un titulo.";
        } else {
            $titulo = $input_titulo;
        }

        // Validate subtitulo
        $input_subtitulo = trim($_POST["subtitulo"]);
        if (empty($input_subtitulo)) {
            $subtitulo_err = "Por favor ingrese un subtitulo.";
        } else {
            $subtitulo = $input_subtitulo;
        }

        // Validate url
        $input_url = trim($_POST["url"]);
        if (empty($input_url)) {
            $url_err = "Por favor ingrese una url.";
        } else {
            $url = $input_url;
        }

        // Validate tema
        $input_tema = trim($_POST["tema"]);
        if (empty($input_tema)) {
            $tema_err = "Por favor ingrese el tema.";
        } else {
            $tema = $input_tema;
        }

        // Validate nivel
        $input_nivel = trim($_POST["nivel"]);
        if (empty($input_nivel)) {
            $nivel_err = "Por favor ingrese el nivel.";
        } else {
            $nivel = $input_nivel;
        }

        // Validate clase
        $input_clase = trim($_POST["clase"]);
        if (empty($input_clase)) {
            $clase_err = "Por favor ingrese la clase.";
        } else {
            $clase = $input_clase;
        }

        $input_enlace = trim($_POST["enlace"]);
        $enlace = $input_enlace;


        // Check input errors before inserting in database
        if (
            empty($titulo_err) && empty($subtitulo_err) && empty($url_err) && empty($tema_err) && empty($nivel_err) && empty($clase_err))
        {
            // Prepare an update statement
            $sql = "UPDATE cursos SET titulo=?, subtitulo=?, url=?, tema=?, nivel=?, clase=?, enlace=?
            WHERE id=?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                //
                mysqli_stmt_bind_param(
                    $stmt,
                    "sssiiisi",
                    $param_titulo,
                    $param_subtitulo,
                    $param_url,
                    $param_tema,
                    $param_nivel,
                    $param_clase,
                    $param_enlace,
                    $param_id
                );

                // Set parameters
                $param_titulo = $titulo;
                $param_subtitulo = $subtitulo;
                $param_url = $encriptar($url);
                $param_tema = $tema;
                $param_nivel = $nivel;
                $param_clase = $clase;
                $param_enlace = $encriptar($enlace);
                $param_id=$id;

                if (mysqli_stmt_execute($stmt)) {
                    // Records updated successfully. Redirect to landing page
                    header("location: cursos.php");
                    exit();
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }
        }

            // Close statement
            mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // Check existence of id parameter before processing further
        if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            // Get URL parameter
            $id =  trim($_GET["id"]);

            // Prepare a select statement
            $sql = "SELECT * FROM cursos WHERE id = ?";
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
                        $titulo = $row["titulo"];
                        $subtitulo = $row["subtitulo"];
                        $url = $desencriptar($row["url"]);
                        $tema = $row["tema"];
                        $nivel = $row["nivel"];
                        $clase = $row["clase"];
                        $enlace = $desencriptar($row["enlace"]);

                    } else {
                        // URL doesn't contain valid id. Redirect to error page
                        header("location: ../error.php");
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
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CURSOS</title>
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
                
                <div class="container text-center pt-4 pb-3">
                    <h2>Editar Datos Del Curso </h2>
                </div>
                <p class="col-10 mx-auto text-justify">Puede modificar lo datos del curso:</p>

                <div class="page-body">
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                                <div class="form-group <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
                                     <label>Titulo</label>
                                     <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>">
                                     <span class="help-block"><?php echo $titulo_err; ?></span>
                                 </div>

                                 <div class="form-group <?php echo (!empty($subtitulo_err)) ? 'has-error' : ''; ?>">
                                     <label>Subtitulo</label>
                                     <input type="text" name="subtitulo" class="form-control" value="<?php echo $subtitulo; ?>">
                                     <span class="help-block"><?php echo $subtitulo_err; ?></span>
                                 </div>

                                 <div class="form-group <?php echo (!empty($url_err)) ? 'has-error' : ''; ?>">
                                     <label>URL</label>
                                     <input type="url" name="url" class="form-control" value="<?php echo $url; ?>">
                                     <span class="help-block"><?php echo $url_err; ?></span>
                                 </div>

                                 <div class="form-group <?php echo (!empty($tema_err)) ? 'has-error' : ''; ?>">
                                    <label>Tema del curso</label>
                                    <select class="form-control" name="tema">
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

                                <div class="form-group <?php echo (!empty($nivel_err)) ? 'has-error' : ''; ?>">
                                    <label>Nivel del curso</label>
                                    <select class="form-control" name="nivel">
                                        <option></option>
                                        <?php
                                            foreach ($Arrnivel as $val) {
                                                    if ($nivel == $val) {
                                                        echo "<option value='$val' selected>$ArrNombNivel[$val]</option>";
                                                    } else {
                                                        echo "<option value='$val'>$ArrNombNivel[$val]</option>";
                                                    }
                                            }
                                            ?>
                                    </select>
                                </div>

                                <div class="form-group <?php echo (!empty($clase_err)) ? 'has-error' : ''; ?>">
                                    <label>Clase del curso</label>
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
                                
                                <div
                                    class="col-md-12 col-lg-6 py-1 form-group">
                                    <label>Enlace</label>
                                    <input type="url" name="enlace" class="form-control"
                                        value="<?php echo $enlace; ?>">
                                </div> 


                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <div class="opciones">
                                    <div class="center">
                                        <button class="btn btn_rvf1" onclick="myFunction()" type="submit">Guardar</button>
                                        <a class="btn btn_rvf2" href="cursos.php">Regresar</a>
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
</body>

</html>