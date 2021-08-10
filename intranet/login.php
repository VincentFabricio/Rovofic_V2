<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';

  // if session is set direct to index
  if (isset($_SESSION['user'])) {
      header("Location: indexs/index.php");
      exit;
  }

  if (isset($_POST['btn-login'])) {
      $email = $_POST['email'];
      $upass = $_POST['pass'];

      $password = hash('sha256', $upass); // password hashing using SHA256
      $stmt = $conn->prepare("SELECT id, username, password, role, Estado FROM users WHERE email= ?");
      $stmt->bind_param("s", $email);
      /* execute query */
      $stmt->execute();
      //get result
      $res = $stmt->get_result();
      $stmt->close();

      $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

      $count = $res->num_rows;
      if ($count == 1 && $row['password'] == $password) {
          $_SESSION['user'] = $row['id'];
          $_SESSION['role'] = $row['role'];
          $_SESSION['estado']=$row['Estado'];
          $_SESSION['username']=$row['username'];
          header("Location: indexs/index.php");
      } elseif ($count == 1) {
          $errMSG = "Contraseña incorrecta";
      } else { //$errMSG = "Usuario no encontrado";
          $stmt = $conn->prepare("SELECT id, username, password, role FROM datos WHERE email_user= ?");
          $stmt->bind_param("s", $email);
          /* execute query */
          $stmt->execute();
          //get result
          $res = $stmt->get_result();
          $stmt->close();

          $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

          $count = $res->num_rows;
          if ($count == 1 && $row['password'] == $password) {
              $_SESSION['user'] = $row['id'];
              $_SESSION['role'] = $row['role'];
              $_SESSION['username']=$row['username'];
              header("Location: indexs/index.php");
          } elseif ($count == 1) {
              $errMSG = "Contraseña incorrecta";
          } else {
              $errMSG = "Usuario no encontrado";
          }
      }
  }
?>

<!doctype html>
<html lang="en">
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

  <body >
    <div class="container-fluid text-center">
      <div id="login">
        <div class="Log_login container align-items-center">
          <!--img src="img/Login/Login_Logo.webp" class="img-fluid" alt="Responsive image"-->
        </div>
        <form class="form-signin container-fluid" method="post" autocomplete="off">

          

          <h1 class="pt-2 pb-1"><b>Login</b></h1>

         


          <div class="email_text form-login py-1">
            <label for="inputEmail" class="sr-only">
              Email
            </label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
          </div>

          <div class="pass_text form-login pb-1">
            <label for="inputPassword" class="sr-only">
              Contraseña
            </label>
            <input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Contraseña" required>
          </div>

          <!--div class="checkbox ">
            <label>
              <input type="checkbox" value="remember-me"> Recuérdame
            </label>
          </div-->
          <div class="container_btn mx-auto form-login py-1">
            <a>
              <img src="Ass/img/Button/boton1.png" 
              onemouseover="this.src='Ass/img/Button/boton2.png'"
              onmouseout="this.src='Ass/img/Button/boton1.png'">
          </a>
            <button class="btn" type="submit" name="btn-login">Login</button>
          </div>
          
          <!--button class="btn btn-lg btn-primary btn-block" type="submit">
            Sign in
          </button-->
          <h6 class="pt-1 pb-4"><a href="recuperacion.php">Olvidaste tu clave?</a></h6>
          
          <!--p class="text-muted pb-2">&copy; 2020</p-->
        </form>
      </div>
      
    </div>
  </body>
</html>
