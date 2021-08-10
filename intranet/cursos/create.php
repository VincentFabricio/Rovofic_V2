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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
            empty($titulo_err) && empty($subtitulo_err) && empty($url_err) && empty($tema_err) && empty($nivel_err) && empty($clase_err)) {

            // Prepare an insert statement
            $sql = "INSERT INTO cursos (titulo, subtitulo, url, tema, nivel, clase, enlace) 
        VALUES (?,?,?,?,?,?,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                //
                mysqli_stmt_bind_param(
                    $stmt,
                    "sssiiis",
                    $param_titulo,
                    $param_subtitulo,
                    $param_url,
                    $param_tema,
                    $param_nivel,
                    $param_clase,
                    $param_enlace
                );

                // Set parameters
                $param_titulo = $titulo;
                $param_subtitulo = $subtitulo;
                $param_url = $encriptar($url);
                $param_tema = $tema;
                $param_nivel = $nivel;
                $param_clase = $clase;
                $param_enlace = $encriptar($enlace);

                if (mysqli_stmt_execute($stmt)) {
                    // Records created successfully. Redirect to landing page
                    header("location: cursos.php");
                    echo "<script language='javascript'>window.location='cursos.php'</script>;";
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
    }
?>

 <!DOCTYPE html>
 <html lang="es">

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

                    <div class="page-header pt-4 pb-3">
                             <h2>Crear Curso</h2>
                         </div>
                         <p class="col-10 mx-auto text-justify">Complete este formulario y envíelo para agregar el registro de la ruta a la base de datos.</p>
                         <form class="page-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($titulo_err)) ? 'has-error' : ''; ?>">
                                     <label>Titulo</label>
                                     <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>">
                                     <span class="help-block"><?php echo $titulo_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($subtitulo_err)) ? 'has-error' : ''; ?>">
                                     <label>Subtitulo</label>
                                     <input type="text" name="subtitulo" class="form-control" value="<?php echo $subtitulo; ?>">
                                     <span class="help-block"><?php echo $subtitulo_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($url_err)) ? 'has-error' : ''; ?>">
                                     <label>URL</label>
                                     <input type="url" name="url" class="form-control" value="<?php echo $url; ?>">
                                     <span class="help-block"><?php echo $url_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
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
                            </div>

                            <div style="width:100%; float:left;">
                                <div class="form-group <?php echo (!empty($nivel_err)) ? 'has-error' : ''; ?>">
                                    <label>Nivel del curso</label>
                                    <select class="form-control" name="nivel">
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
                            </div>

                            <div style="width:100%; float:left;">
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
                            </div>

                            <div style="width:100%; float:left;">
                                    <label>Enlace</label>
                                    <input type="url" name="enlace" class="form-control"
                                        value="<?php echo $enlace; ?>">
                                </div> 

                             <div style="width:100%; float:left;">
                                 <div class="opciones">
                                     <div class="center">
                                         <button class="btn btn_rvf1" onclick="myFunction()">Guardar</button>
                                         <a class="btn btn_rvf2" href="cursos.php">Regresar</a>
                                     </div>
                                 </div>
                             </div>

                         </form>
                     
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