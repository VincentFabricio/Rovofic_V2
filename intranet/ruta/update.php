<?php
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }

    // Define variables and initialize with empty values
    $categoria = $nivel = $tema = $contenido = "";
    $categoria_err = $nivel_err = $tema_err = $contenido_err = "";

    // Processing form data when form is submitted
    if (isset($_POST["id"]) && !empty($_POST["id"])) {
        // Get hidden input values
        $id = $_POST["id"];

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
            // Prepare an update statement
            $sql = "UPDATE ruta SET categoria=?, nivel=?, tema=?, contenido=?
            WHERE id=?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "ssssi",
                    $param_categoria,
                    $param_nivel,
                    $param_tema,
                    $param_contenido,
                    $param_id
                );

                // Set parameters
                $param_categoria = $categoria;
                $param_nivel = $nivel;
                $param_tema = $tema;
                $param_contenido = $contenido;
                $param_id = $id;

                if (mysqli_stmt_execute($stmt)) {
                    // Records updated successfully. Redirect to landing page
                    header("location: ../index.php");
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
            $sql = "SELECT * FROM ruta WHERE id = ?";
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
                        $categoria = $row["categoria"];
                        $nivel = $row["nivel"];
                        $tema = $row["tema"];
                        $contenido = $row["contenido"];
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

                    <div class="page-header pt-4 pb-3">
                        <h2>Editar Datos De La Ruta </h2>                        
                    </div>
                        <p class="col-10 mx-auto">Puede modificar lo datos de la ruta:</p>
                        <form class="page-body" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                            <div class="col-11 mx-auto">
                                <div class="form-group <?php echo (!empty($categoria_err)) ? 'has-error' : ''; ?>">
                                    <label>Categoria</label>
                                    <input type="text" name="categoria" class="form-control"
                                        value="<?php echo $categoria; ?>">
                                    <span class="help-block"><?php echo $categoria_err; ?></span>
                                </div>
                            </div>

                            <div class="col-11 mx-auto">
                                <div class="form-group <?php echo (!empty($nivel_err)) ? 'has-error' : ''; ?>">
                                    <label>Nivel</label>
                                    <input type="text" name="nivel" class="form-control" value="<?php echo $nivel; ?>">
                                    <span class="help-block"><?php echo $nivel_err; ?></span>
                                </div>
                            </div>

                            <div class="col-11 mx-auto">
                                <div class="form-group <?php echo (!empty($tema_err)) ? 'has-error' : ''; ?>">
                                    <label>Tema</label>
                                    <input type="text" name="tema" class="form-control" value="<?php echo $tema; ?>">
                                    <span class="help-block"><?php echo $tema_err; ?></span>
                                </div>
                            </div>

                            <div class="col-11 mx-auto">
                                <div class="form-group <?php echo (!empty($contenido_err)) ? 'has-error' : ''; ?>">
                                    <label>Contenido</label>
                                    <input type="text" name="contenido" class="form-control"
                                        value="<?php echo $contenido; ?>">
                                    <span class="help-block"><?php echo $contenido_err; ?></span>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <div class="col-11 mx-auto">
                                <div class="opciones">
                                    <div class="center">
                                         <button class="btn btn_rvf1" onclick="myFunction1()">Guardar</button>
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