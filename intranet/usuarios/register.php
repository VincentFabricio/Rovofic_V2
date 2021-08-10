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
    <title>REGRISTRO</title>
    <link rel="icon" href="../Ass/img/roxy.webp" sizes="32x32">

    <link rel="stylesheet" href="../assets/css/style.css" type="text/css" />
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="../Ass/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="../Ass/css/Style_navbar.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../assets/js/CheckPassword.js"></script>
    <link href="../assets/css/CheckPassword.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation Bar-->
    <?php include '../navegator.ini'; ?>

    <div class="container-fluid">
        <div class="fondo_pag">
            <div class="text-center fondo_img h-100">
                
                <div class="text-center pt-4 pb-1 mx-auto">
                    <h2>Registrarse</h2>   
                </div>


            <div class="page-body">

            <form method="post" autocomplete="off">

                <div class="col-12 mx-auto">

                    <div class="form-group">
                        <hr />
                    </div>

                    <?php
                    if (isset($errMSG)) {
                        ?>
                        <div class="col-12 mx-auto form-group">
                            <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                                <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="col-12 py-3 mx-auto">
                        <div class="">
                            <input type="text" name="uname" class="form-control" placeholder="Usuario" required />
                        </div>
                    </div>

                    <div class="col-12 mx-auto">
                        <div class="">
                            <label for="inputEmail" class="sr-only">
                                Email
                            </label>
                            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required />
                        </div>
                    </div>

                    <div class="col-12 py-3 mx-auto">
                        <div class="">
                            <input ID="txtPassword" type="password" name="pass" class="form-control" placeholder="Contraseña" required />
                        </div>
                        <div id="strengthMessage"></div>
                    </div>


                    <div class="col-12 mx-auto py-3">
                        <label>Tipo de usuario</label>
                        <select class="form-control py-1" name="role" required> 
                            <option value="" selected="selected"></option>
                            <option value="3">Docente</option>
                            <option value="1">Administrador</option>
                            <option value="2">Padre familia</option>
                        </select>
                    </div>
            
                                    
                    <div class="col-12 mx-auto">
                        <label>Pregunta de seguridad</label>
                        <select class="form-control py-1" name="pregunta" required> 
                            <option value="" selected="selected"></option>
                            <option value="1">¿Cuál es tu película favorita?</option>
                            <option value="2">¿Qué animal te gustaría ser?</option>
                            <option value="3">¿Cuál es tu género de música favorita?</option>
                            <option value="4">¿Qué defecto es el que menos soportas de alguien?</option>
                            <option value="5">¿Qué comprarías si sólo pudieras conseguir una cosa?</option>
                        </select>
                    </div>

                    <div class="col-12 mx-auto">
                        <div class="py-3">
                            
                            <input type="text" name="respuesta" class="form-control" placeholder="Respuesta" required />
                        </div>
                    </div>

                    <div class="checkbox text-justify">
                        <label><input type="checkbox" id="chekTerm" value="chekTerm"><a href="#">Estoy de acuerdo con los términos del servicio</a></label>
                    </div>

                    <div class="form-group">
                        <button type="submit" disabled class="btn btn_rvf1" name="signup" id="registro">Registrarse</button>
                    </div>

                    <div class="col-12 center pb-3">
                        <a href="usuarios.php" class="btn btn_rvf2" role="button">Regresar</a>
                    </div>


                    <!-- <div class="form-group">
                    <a href="login.php" type="button" class="btn btn-block btn-success" name="btn-login">Login</a>
                </div> -->

                </div>

            </form>
            </div>
        </div>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Ass/js/popper.min.js"></script>
    <script src="../Ass/js/bootstrap.min.js"></script>
    <script src="../Ass/js/func.js"></script>

    <script>
        document.getElementById("chekTerm").addEventListener('change', checkAccepted);

        function checkAccepted(event) {
  var btnEnviar = document.getElementById("registro");
  console.log(this.checked);
  btnEnviar.disabled = !this.checked;

}
    </script>

</body>

</html>