<?php
// Include config file
require_once '../dataUser.php';
include "../cursos/mcript.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

    // Define variables and initialize with empty values
    $key = $amount = $tax = $tax_base = $name = $description = $amount2 = $tax2 = $tax_base2 = $description2 = "";
    $key_err = $amount_err = $tax_err = $tax_base_err = $name_err = $description_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input values
    $id = $_POST["id"];

    $key = "17bdbe4c0483d098be7f65886289d3a8";

    // Validate amount
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Por favor ingrese un name.";
    } else {
        $name = $input_name;
    }
        
    // Validate amount
    $input_amount = trim($_POST["amount"]);
    if (empty($input_amount)) {
        $amount_err = "Por favor ingrese un amount.";
    } else {
        $amount = $input_amount;
    }

    // Validate tax
    $input_tax = trim($_POST["tax"]);
    $tax = $input_tax;

    // Validate tax_base
    $input_tax_base = trim($_POST["tax_base"]);
    if (empty($input_tax_base)) {
        $tax_base_err = "Por favor ingrese el tax_base.";
    } else {
        $tax_base = $input_tax_base;
    }

    $input_amount2 = trim($_POST["amount2"]);
    $amount2 = $input_amount2;

    $input_tax2 = trim($_POST["tax2"]);
    $tax2 = $input_tax2;

    $input_tax_base2 = trim($_POST["tax_base2"]);
    $tax_base2 = $input_tax_base2;

    $input_description2 = trim($_POST["description2"]);
    $description2 = $input_description2;

    // Check input errors before inserting in database
    if (
         empty($key_err) && empty($amount_err) && empty($tax_err) && empty($tax_base_err) && empty($name_err) && empty($description_err)) {
             // Prepare an update statement
             $sql = "UPDATE compras SET keyy=?, amount=?, tax=?, tax_base=?, name=?, description=?, amount2=?, tax2=?, tax_base2=?, description2=?
         WHERE id=?";

             if ($stmt = mysqli_prepare($link, $sql)) {
                 mysqli_stmt_bind_param(
                     $stmt,
                     "ssssssssssi",
                     $param_key,
                     $param_amount,
                     $param_tax,
                     $param_tax_base,
                     $param_name,
                     $param_description,
                     $param_amount2,
                     $param_tax2,
                     $param_tax_base2,
                     $param_description2,
                     $param_id
                 );

                 // Set parameters
                 $param_key = $encriptar($key);
                 $param_amount = $amount;
                 $param_tax = $tax;
                 $param_tax_base = $tax_base;
                 $param_name = $name;
                 $param_description = $description;
                 $param_amount2 = $amount2;
                 $param_tax2 = $tax2;
                 $param_tax_base2 = $tax_base2;
                 $param_description2 = $description2;
                 $param_id = $id;

                 if (mysqli_stmt_execute($stmt)) {
                     // Records updated successfully. Redirect to landing page
                     header("location: compras.php");
                     exit();
                 } else {
                     echo "Something went wrong. Please try again later.";
                 }
             }
         }
        // Close connection
        mysqli_close($link);
    } else {
        // Check existence of id parameter before processing further
        if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
            // Get tax parameter
            $id =  trim($_GET["id"]);

            // Prepare a select statement
            $sql = "SELECT * FROM compras WHERE id = ?";
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
                        $key = $desencriptar($row["keyy"]);
                        $name = $row["name"];
                        $amount = $row["amount"];
                        $tax = $row["tax"];
                        $tax_base = $row["tax_base"];
                        $description = $row["description"];
                        $amount2 = $row["amount2"];
                        $tax2 = $row["tax2"];
                        $tax_base2 = $row["tax_base2"];
                        $description2 = $row["description2"];
                    } else {
                        // tax doesn't contain valid id. Redirect to error page
                        header("location: ../error.php");
                        exit();
                    }
                }

                // Close statement
                mysqli_stmt_close($stmt);
            }

            // Close connection
            mysqli_close($link);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>COMPRAS</title>
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
                        <h2>Editar Datos De la compra </h2>
                    </div>
                    <p>Puede modificar lo datos de la compra:</p>
                    
                    <form class="page-body" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($key_err)) ? 'has-error' : ''; ?>">
                                     <label>Key</label>
                                     <input type="text" name="key" class="form-control" disabled value="<?php echo $key; ?>">
                                     <span class="help-block"><?php echo $key_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                                     <label>Nombre del curso</label>
                                     <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                     <span class="help-block"><?php echo $name_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                                     <label>Cantidad</label>
                                     <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
                                     <span class="help-block"><?php echo $amount_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($tax_err)) ? 'has-error' : ''; ?>">
                                     <label>Tax</label>
                                     <input type="number" name="tax" class="form-control" value="<?php echo $tax; ?>">
                                     <span class="help-block"><?php echo $tax_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($tax_base_err)) ? 'has-error' : ''; ?>">
                                     <label>Tax base</label>
                                     <input type="number" name="tax_base" class="form-control" value="<?php echo $tax_base; ?>">
                                     <span class="help-block"><?php echo $tax_base_err; ?></span>
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                                     <label>Descripcion</label>
                                     <input type="text" name="description" class="form-control" value="<?php echo $description; ?>">
                                     <span class="help-block"><?php echo $description_err; ?></span>
                                 </div>
                             </div>

                             <div id="oculto2" style="display:none;">

                             <h2>Segunda Compra (Opcional)</h2>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($amount_err)) ? 'has-error' : ''; ?>">
                                     <label>Cantidad</label>
                                     <input type="text" name="amount2" class="form-control" value="<?php echo $amount2; ?>">
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($tax_err)) ? 'has-error' : ''; ?>">
                                     <label>Tax</label>
                                     <input type="number" name="tax2" class="form-control" value="<?php echo $tax2; ?>">
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($tax_base_err)) ? 'has-error' : ''; ?>">
                                     <label>Tax base</label>
                                     <input type="number" name="tax_base2" class="form-control" value="<?php echo $tax_base2; ?>">
                                 </div>
                             </div>

                             <div style="width:100%; float:left;">
                                 <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                                     <label>Descripcion</label>
                                     <input type="text" name="description2" class="form-control" value="<?php echo $description2; ?>">
                                 </div>
                             </div>

                             </div>

                            <input type="hidden" name="id" value="<?php echo $id; ?>" />

                            <div class="mx-auto ">
                                <div class="form-group">
                                    <a class="btn btn_rvf1" onclick="ocultarismo()">Agregar otra sesión</a>
                                </div>
                                <div class="form-group" id="ocultoBtt" style="display:block;">
                                    <a class="btn btn_rvf2" onclick="resetOcult()">Restaurar sesión</a>
                                </div>
                            </div>

                            <div style="width:100%; float:left;">
                                <div class="opciones">
                                    <div class="center">
                                        <button class="btn btn_rvf1" onclick="myFunction()" type="submit">Guardar</button>
                                        <a class="btn btn_rvf2" href="compras.php">Regresar</a>
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
    <script src="../Ass/js/func.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
</body>

</html>