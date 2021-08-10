<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PROCESO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Proceso Individual</h2>
                    </div>
                    <p>Complete este formulario y envíelo para agregar proceso individual a la base de datos.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-groupform <?php echo (!empty($estudiante_err)) ? 'has-error' : ''; ?>">
                            <label>Niñ@ o joven</label>
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
                            <input type="submit" class="btn btn-primary" value="BUSCAR">
                            <a href="../indexs/index.php" class="btn btn-default">CANCELAR</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>