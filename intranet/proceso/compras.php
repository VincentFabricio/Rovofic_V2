<?php
// Include config file
require_once '../dataUser.php';
include "../cursos/mcript.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

// Define variables and initialize with empty values
$estudiante = $fecha = "";
$estudiante_err = $fecha_err = "";
$nuevoHijo=0;

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
        header("location: read1.php?fecha=" . $fecha . "&est=" . $estudiante);
    }
}
if ($_SESSION['role'] == 2) {
    $sql = "SELECT id_estudiante FROM hijos where id_padre = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = $_SESSION['user'];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */

                $sql = "SELECT * FROM datos where ";
                $cadena = "";
                $i = 0;
                if ($i == 0) {
                    $cadena .= "id = " . $row['id_estudiante'];
                } else {
                    $cadena .= " or id = " . $row['id_estudiante'];
                }
                $i++;
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    $sql = $sql . $cadena;
    $result = mysqli_query($link, $sql);
    $result2 = mysqli_query($link, $sql);
    $row2 = mysqli_fetch_array($result2);
} else {
    $sql = "SELECT id,nombres,apellidos FROM datos";

    $result = mysqli_query($link, $sql);
}

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

</head>

<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                        <div class="container text-center pt-4 pb-3">
                            <h2>Compras</h2>
                            <p>Selecciona el nivel para hacer el pago por medio de ePayco.</p>
                        </div>
                        
                        <div class="page-body w-50">
                            <?php
                                $sql = "SELECT * FROM compras";
                                if ($result = mysqli_query($link, $sql)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<button class='cursos'>".$row['name']."</button>";
                                            echo "<div class='panel'>";
                                            echo "<div class='col-md-4'>";

                                            echo "<h2>".$row['description']."</h2>";
                                            echo "<h3>".$row['amount']."</h3>";
                                            echo "<form>";
                                            echo "<script src='https://checkout.epayco.co/checkout.js'";
                                                    
                                                echo "data-epayco-key='".$desencriptar($row['keyy'])."'";
                                                echo "class='epayco-button'";
                                                echo "data-epayco-amount='".$row['amount']."'";
                                                echo "data-epayco-tax='".$row['tax']."'";
                                                echo "data-epayco-tax-base='".$row['tax_base']."'";
                                                echo "data-epayco-name='".$row['name']."'";
                                                echo "data-epayco-description='".$row['description']."'";
                                                echo $row['description'];
                                                echo "data-epayco-currency='COP'";
                                                echo "data-epayco-country='CO'";
                                                echo "data-epayco-test='false'";
                                                echo "data-epayco-external='false'";

                                                echo "data-epayco-email-billing='".$row2['correo']."'";
                                                echo "data-epayco-name-billing='".$row2['padre']."'";
                                                echo "data-epayco-address-billing='".$row2['direccion']."'";
                                                echo "data-epayco-type-doc-billing='CC'";
                                                echo "data-epayco-mobilephone-billing='".$row2['telefono1']."'";
                                                echo "data-epayco-number-doc-billing='".$row2['identificacion_padre']."'";
                                                echo "data-epayco-response='https://ejemplo.com/respuesta.html'";
                                                echo "data-epayco-confirmation='https://ejemplo.com/confirmacion'";
                                                echo "data-epayco-button='https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/btn1.png'>";
                                            echo "</script> ";
                                            echo "</form>";



                                            echo "<h2>".$row['description2']."</h2>";
                                            echo "<h3>".$row['amount2']."</h3>";
                                            echo "<form>";
                                            echo "<script src='https://checkout.epayco.co/checkout.js'";
                                                    
                                                echo "data-epayco-key='".$desencriptar($row['keyy'])."'";
                                                echo "class='epayco-button'";
                                                echo "data-epayco-amount='".$row['amount2']."'";
                                                echo "data-epayco-tax='".$row['tax2']."'";
                                                echo "data-epayco-tax-base='".$row['tax_base2']."'";
                                                echo "data-epayco-name='".$row['name']."'";
                                                echo "data-epayco-description='".$row['description2']."'";
                                                echo $row['description2'];
                                                echo "data-epayco-currency='COP'";
                                                echo "data-epayco-country='CO'";
                                                echo "data-epayco-test='false'";
                                                echo "data-epayco-external='false'";

                                                echo "data-epayco-email-billing='".$row2['correo']."'";
                                                echo "data-epayco-name-billing='".$row2['padre']."'";
                                                echo "data-epayco-address-billing='".$row2['direccion']."'";
                                                echo "data-epayco-type-doc-billing='CC'";
                                                echo "data-epayco-mobilephone-billing='".$row2['telefono1']."'";
                                                echo "data-epayco-number-doc-billing='".$row2['identificacion_padre']."'";
                                                echo "data-epayco-response='https://ejemplo.com/respuesta.html'";
                                                echo "data-epayco-confirmation='https://ejemplo.com/confirmacion'";
                                                echo "data-epayco-button='https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/btn1.png'>";
                                            echo "</script> ";
                                            echo "</form>";

                                            echo "</div>";
                                            echo "</div>";
                                            
                                            
                                        }
                                        mysqli_free_result($result);
                                    } else {
                                        echo "<p class='lead'><em>No se encontraron datos.</em></p>";
                                    }
                                } else {
                                    echo "ERROR: No pudo ejecutar $ sql. " . mysqli_error($link);
                                }

                                // Close connection
                                mysqli_close($link);
                            ?>
                            <div class="col-12 mx-auto py-2 my-2">
								<a href="fecha.php" class="btn btn_rvf2">Regresar</a>
							</div>
                    </div>
            </div>
        </div>
    </div>
    
    <script>
        var acc = document.getElementsByClassName("cursos");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].onclick = function(){
                this.classList.toggle("active");
                this.nextElementSibling.classList.toggle("show");
        }
        }
    </script>
    </body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
    
</html>