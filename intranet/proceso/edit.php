<?php
    // Include config file
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: ../login.php");
        exit;
    }


    // Define variables and initialize with empty values
    $estudiante = $fecha = "";
    $estudiante_err = $fecha_err = "";

    // Processing form data when form is submitted

    // Get hidden input value
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_estudiante = trim($_POST["estudiante"]);
        if (empty($input_estudiante)) {
            $estudiante_err = "Please enter a estudiante.";
        } else {
            $estudiante = $input_estudiante;
        }
        // Validate apellidos
        $input_fecha = trim($_POST["fecha"]);
        if (empty($input_fecha)) {
            $fecha_err = "Please enter a fecha.";
        } else {
            $fecha = $input_fecha;
        }


        // Check input error_log(message)s before inserting in database
        if (empty($estudiante_err) && empty($fecha_err)) {
            header("location: update1.php?fecha=" . $fecha . "&est=" . $estudiante);
        }
    }

    $sql = "SELECT id,nombres,apellidos FROM datos";

    $result = mysqli_query($link, $sql);
    // Close connection
    mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PROCESO</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="../assets/css/index.css" type="text/css" />
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }

        body {
            background-image: url(../../img/fondo.jpg);
            background-size: 100% 100%;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Proceso Individual</h2>
                        </div>
                        <p class="col-10 mx-auto text-justify">Complete este formulario y envíelo para agregar proceso individual a la base de datos.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($estudiante_err)) ? 'has-error' : ''; ?>">
                                <label>Joven</label>
                                <select class="form-control" name="estudiante">
                                    <option value="">Seleccione...</option>
                                    <?php
                                    while ($row = mysqli_fetch_array($result)) {
                                        if ($estudiante != "" && $row['id'] != "") {
                                            if ($estudiante == $row['id']) {
                                                echo "<option value='$row[id]' selected>$row[nombres] $row[apellidos]</option>";
                                            }
                                        }
                                        echo "<option value='$row[id]'>$row[nombres] $row[apellidos]</option>";
                                    }
                                    ?>
                                </select>
                                <span class="help-block"><?php echo $estudiante_err; ?></span>
                                <div class="form-group <?php echo (!empty($fecha_err)) ? 'has-error' : ''; ?>">
                                    <label>Fecha de Clase:</label>
                                    <input type="date" name="fecha" class="form-control" step="1" min="2000-01-01" max="2100-12-31" value="<?php echo date("Y-m-d"); ?>">
                                    <span class="help-block"><?php echo $fecha_err; ?></span>
                                </div>
                                <div class="opciones">
                                    <div class="center">
                                        <input type="submit" class="btn btn-primary" value="BUSCAR">
                                        <a href="../indexs/index.php" class="btn btn-default">CANCELAR</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>