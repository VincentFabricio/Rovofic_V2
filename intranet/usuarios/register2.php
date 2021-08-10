<?php
ob_start();
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}
include_once '../dbconnect.php';

if (isset($_POST['signup'])) {
    $uname = trim($_POST['uname']); // get posted data and remove whitespace
    $email = trim($_POST['email']);
    $upass = trim($_POST['pass']);
    $role = trim($_POST['role']);
    $pregunta=trim($_POST['pregunta']);
    $respuesta=trim($_POST['respuesta']);
    $estado=0;

    // hash password with SHA256;
    $password = hash('sha256', $upass);

    // check email exist or not
    $stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $count = $result->num_rows;

    if ($count == 0) { // if email is not found add user


        $stmts = $conn->prepare("INSERT INTO users(username,email,password,role,Estado, pregunta, respuesta) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmts->bind_param("sssiiis", $uname, $email, $password, $role, $estado, $pregunta, $respuesta);
        $res = $stmts->execute(); //get result
        $stmts->close();

        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; // set session and redirect to index page
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: ../logout.php?logout");
                exit;
            }
        } else {
            $errTyp = "danger";
            $errMSG = "Algo salió mal, intenta de nuevo";
        }
    } else {
        $errTyp = "warning";
        $errMSG = "El email ya está en uso";
    }
}
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registrarse</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/CheckPassword.js"></script>
    <link href="../assets/css/CheckPassword.css" rel="stylesheet" />
</head>

<body>

    <div class="container">

        <div id="login-form">
            <form method="post" autocomplete="off">

                <div class="col-md-12">

                    <div class="form-group">
                        <h2 class="">Registrarse</h2>
                    </div>

                    <div class="form-group">
                        <hr />
                    </div>

                    <?php
                    if (isset($errMSG)) {
                        ?>
                        <div class="form-group">
                            <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="uname" class="form-control" placeholder="Usuario" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email" class="form-control" placeholder="Email" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input ID="txtPassword" type="password" name="pass" class="form-control" placeholder="Contraseña" required />
                        </div>
                        <div id="strengthMessage"></div>
                    </div>

            
                                    <label>Tipo de usuario</label>
                                    <select class="form-control" name="role" required> 
                                        <option value="" selected="selected"></option>
                                        <option value="3">Docente</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Padre familia</option>
                                    </select>

                                    <label>Pregunta de seguridad</label>
                                    <select class="form-control" name="pregunta" required> 
                                        <option value="" selected="selected"></option>
                                        <option value="1">¿Cuál es tu película favorita?</option>
                                        <option value="2">¿Qué animal te gustaría ser?</option>
                                        <option value="3">¿Cuál es tu género de música favorita?</option>
                                        <option value="4">¿Qué defecto es el que menos soportas de alguien?</option>
                                        <option value="5">¿Qué comprarías si sólo pudieras conseguir una cosa?</option>
                                    </select>

                                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-check"></span></span>
                            <input type="text" name="respuesta" class="form-control" placeholder="Respuesta" required />
                        </div>
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" id="TOS" value="This"><a href="#">Estoy de acuerdo con los términos del servicio</a></label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn    btn-block btn-primary" name="signup" id="reg">Registrarse</button>
                    </div>

                    <div class="form-group">
                        <hr />
                    </div>

                    <!-- <div class="form-group">
                    <a href="login.php" type="button" class="btn btn-block btn-success" name="btn-login">Login</a>
                </div> -->

                </div>

            </form>
        </div>

    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/tos.js"></script>

</body>

</html>