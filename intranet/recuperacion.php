<?php
    ob_start();
    session_start();
    require_once 'dbconnect.php';
    require_once 'config.php';

    // if session is set direct to index
    if (isset($_SESSION['user'])) {
        header("Location: indexs/index.php");
        exit;
    }

    if (isset($_POST['btn-login'])) {
        $email = $_POST['email'];
        $pregunta = $_POST['pregunta'];
        $respuesta = $_POST['respuesta'];
        $upass = trim($_POST['pass']);

        $stmt = $conn->prepare("SELECT id, username, password, role, Estado, pregunta, respuesta FROM users WHERE email= ?");
        $stmt->bind_param("s", $email);
        /* execute query */
        $stmt->execute();
        //get result
        $res = $stmt->get_result();
        $stmt->close();

        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

        $count = $res->num_rows;
        if ($count == 1 && $row['pregunta'] == $pregunta && $row['respuesta']==$respuesta) {
            $_SESSION['user'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['estado']=$row['Estado'];
            $_SESSION['username']=$row['username'];
            $id=$row['id'];
            // hash password with SHA256;
            $password = hash('sha256', $upass);

            $sql2 = "UPDATE users SET password=? WHERE id=?";

            if ($stmt2 = mysqli_prepare($link, $sql2)) {
                //
                mysqli_stmt_bind_param(
                    $stmt2,
                    "si",
                    $param_password,
                    $param_id
                );

                // Set parameters
                $param_password = $password;
                $param_id= $id;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt2)) {
                    // Records updated successfully. Redirect to landing page
                    header("location: logout.php?logout");
                    exit();
                } else {
                    echo "Something went wrong. Please try again later.";
                }
            }

            // Close statement
            mysqli_stmt_close($stmt2);
            // Close connection
            mysqli_close($link);
        } elseif ($count == 1) {
            $errMSG = "Informacion incorrecta";
        }
    }
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login">
    <meta name="author" content="Vincent">
    
    <title>LOGIN</title>
    <link rel="icon" href="Ass/img/roxy.webp" sizes="32x32">
    
    <!-- Bootstrap core CSS -->
    <link href="Ass/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="Ass/css/signin.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid text-center">
        <div id="login">
            <div class="Log_login2 container align-items-center">
            <!--img src="img/Login/Login_Logo.webp" class="img-fluid" alt="Responsive image"-->
            </div>
            <form class="form-signin container-fluid" method="post" autocomplete="off">

                

                    <div>
                        <h5 style="color:#ffff">Sistema de recuperación</h5>
                    </div>

                    <?php
                        if (isset($errMSG)) {
                            ?>
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                                </div>
                            </div>
                        <?php
                        }
                    ?>

                    <div class="email_text form-login py-1">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required />
                    </div>

                    <div class="pt-2 pb-1">
                        <h6>Pregunta de seguridad</h6>
                    </div>

                    <div class="form-login pb-2">
                        <select class="form-control" name="pregunta" required> 
                            <option value="" selected="selected"></option>
                            <option value="1">¿Cuál es tu película favorita?</option>
                            <option value="2">¿Qué animal te gustaría ser?</option>
                            <option value="3">¿Cuál es tu género de música favorita?</option>
                            <option value="4">¿Qué defecto es el que menos soportas de alguien?</option>
                            <option value="5">¿Qué comprarías si sólo pudieras conseguir una cosa?</option>
                        </select>
                    </div>
                            

                    <div class="py-1">
                        <div class="form-login">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-check"></span></span>
                            <input type="text" name="respuesta" class="form-control" placeholder="Respuesta" required />
                        </div>
                    </div>

                    <div class=" py-2">
                        <div class="form-login">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Nueva contraseña" required />
                        </div>
                    </div>


                    <div class="container_btn form-login mx-auto">
                        <a>
                            <img src="Ass/img/Button/boton1.png" 
                            onemouseover="this.src='Ass/img/Button/boton2.png'"
                            onmouseout="this.src='Ass/img/Button/boton1.png'">
                        </a>
                        <button class="btn" type="submit" name="btn-login">Enviar</button>
                    </div>

                    <div class="pb-3"></div>
                        
            </form>
        </div>

    </div>
</body>

</html>