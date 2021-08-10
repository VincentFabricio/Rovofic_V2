<?php
    // Include config file
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    // Define variables and initialize with empty values
    $categoria = $nivel = $tema = $contenido = "";
    $categoria_err = $nivel_err = $tema_err = $contenido_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validate categoria
        $input_categoria = trim($_POST["categoria"]);
        if (empty($input_categoria)) {
            $categoria_err = "Por favor ingrese una categoria.";
        } else {
            $categoria = $input_categoria;
        }

        // Validate nivel
        $input_nivel = trim($_POST["nivel"]);
        if (empty($input_nivel)) {
            $nivel_err = "Por favor ingrese un nivel.";
        } else {
            $nivel = $input_nivel;
        }

        // Validate tema
        $input_tema = trim($_POST["tema"]);
        if (empty($input_tema)) {
            $tema_err = "Por favor ingrese un tema.";
        } else {
            $tema = $input_tema;
        }

        // Validate contenido
        $input_contenido = trim($_POST["contenido"]);
        if (empty($input_contenido)) {
            $contenido_err = "Por favor ingrese el contenido.";
        } else {
            $contenido = $input_contenido;
        }

        // Check input errors before inserting in database
        if (
            empty($categoria_err) && empty($nivel_err) && empty($tema_err) && empty($contenido_err)) {

            // Prepare an insert statement
            $sql = "INSERT INTO ruta (categoria, nivel, tema, contenido) 
        VALUES (?,?,?,?)";

            if ($stmt = mysqli_prepare($link, $sql)) {
                //
                mysqli_stmt_bind_param(
                    $stmt,
                    "ssss",
                    $param_categoria,
                    $param_nivel,
                    $param_tema,
                    $param_contenido
                );

                // Set parameters
                $param_categoria = $categoria;
                $param_nivel = $nivel;
                $param_tema = $tema;
                $param_contenido = $contenido;

                if (mysqli_stmt_execute($stmt)) {
                    // Records created successfully. Redirect to landing page
                    header("location: rutas.php");
                    echo "<script language='javascript'>window.location='rutas.php'</script>;";
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
     <title>RUTA</title>
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

                    <div class="page-header pt-3 pb-1">
                        <h2>Crear Ruta</h2>
                    </div>
                    
                    <p class="col-10 mx-auto text-justify">
                        Complete este formulario para agregar el registro de la ruta a la base de datos
                    </p>
                    <br>

                         <form class="page-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                             <div class="col-11 mx-auto">
                                 <div class="form-group <?php echo (!empty($categoria_err)) ? 'has-error' : ''; ?>">
                                     <label>Categoria:</label>
                                     <input type="text" name="categoria" class="form-control" value="<?php echo $categoria; ?>">
                                     <span class="help-block"><?php echo $categoria_err; ?></span>
                                 </div>
                             </div>

                             <div class="col-11 mx-auto">
                                 <div class="form-group <?php echo (!empty($nivel_err)) ? 'has-error' : ''; ?>">
                                     <label>Nivel:</label>
                                     <input type="text" name="nivel" class="form-control" value="<?php echo $nivel; ?>">
                                     <span class="help-block"><?php echo $nivel_err; ?></span>
                                 </div>
                             </div>

                             <div class="col-11 mx-auto">
                                 <div class="form-group <?php echo (!empty($tema_err)) ? 'has-error' : ''; ?>">
                                     <label>Tema:</label>
                                     <input type="text" name="tema" class="form-control" value="<?php echo $tema; ?>">
                                     <span class="help-block"><?php echo $tema_err; ?></span>
                                 </div>
                             </div>

                             <div class="col-11 mx-auto">
                                 <div class="form-group <?php echo (!empty($contenido_err)) ? 'has-error' : ''; ?>">
                                     <label>Contenido:</label>
                                     <input type="text" name="contenido" class="form-control" value="<?php echo $contenido; ?>">
                                     <span class="help-block"><?php echo $contenido_err; ?></span>
                                 </div>
                             </div>

                             <div class="col-11 mx-auto">
                                 <div class="opciones">
                                     <div class="center">
                                         <button class="btn btn_rvf1" onclick="myFunction()">Guardar</button>
                                         <a class="btn btn_rvf2" href="rutas.php">Regresar</a>
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