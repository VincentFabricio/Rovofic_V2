<?php
    require_once '../dataUser.php';

    if (!isset($_SESSION['user'])) {
        header("Location: login.php");
        exit;
    }

    // Process delete operation after confirmation
    if (isset($_POST["id"]) && !empty($_POST["id"])) {

        // Prepare a delete statement
        $sql = "DELETE FROM datos WHERE id = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = trim($_POST["id"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records deleted successfully. Redirect to landing page
                header("location: indexs/index.php");
                exit();
            } else {
                echo "Oops! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    } else {
        // Check existence of id parameter
        if (empty(trim($_GET["id"]))) {
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
    <title>ELIMINAR</title>
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
                
                        <div class="py-5">
                            <h2>Eliminar niñ@ o adolecente</h2>
                        </div>
                        <form class="w-50 pb-5 mx-auto overflow-auto" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="alert alert-danger fade show">
                                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                                <p>¿Estás seguro de eliminar este niñ@ o adolecente?</p><br>
                                <p>
                                    <button onclick="myFunction()" type="submit" value="Si"
                                        class="btn btn-danger">SI</button>
                                    <a class="btn btn-light" href="../indexs/index.php">NO</a>
                                </p>
                            </div>
                        </form>
                    
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script></body></body>

</html>