<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    // Include config file
    require_once '../dataUser.php';
    

    $mensaje = $asunto = "";
    $mensaje_err = $asunto_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $input_asunto = trim($_POST["asunto"]);
        if (empty($input_asunto)) {
            $asunto_err = "Por favor ingrese un asunto.";
        } else {
            $asunto = $input_asunto;
        }

        // Validate mensaje
        $input_mensaje = trim($_POST["mensaje"]);
        if (empty($input_mensaje)) {
            $mensaje_err = "Por favor ingrese un mensaje.";
        } else {
            $mensaje = $input_mensaje;
        }

        if (empty($mensaje_err) && empty($asunto_err)) {
            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'rovoficdesigmh@gmail.com';                     // SMTP username
    $mail->Password   = 'rovofic2020desigmh';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
                $mail->setFrom('rovoficdesigmh@gmail.com', 'Rovofic');
                $mail->addAddress('vincent@rovofic.com');     // Add a recipient

                // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $asunto;
                $mail->Body = $mensaje;
                $mail->send();
                echo 'Message has been sent';
                header("location: ../indexs/index.php");
                    echo "<script language='javascript'>window.location='../indexs/index.php'</script>;";
                    exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
?>

 <!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <title>PERFIL</title>
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

                        <div class="page-header pt-4">
                            <h2>!Escríbenos¡</h2>
                            <p class="col-9 mx-auto">
                                Enviarnos un mensaje a nuestro email o WhatsApp</p>
                        </div>
                        
                         <form class="page-body" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            
                            <h4 class="pt-2">Email</h4>
                            <div class="col-11 mx-auto">
                                 <div class="form-group  <?php echo (!empty($asunto_err)) ? 'has-error' : ''; ?>">
                                    <label>Asunto</label>
                                    <input type="text" name="asunto" class="form-control">
                                    <span class="help-block"><?php echo $asunto_err; ?></span>
                                </div>
                            </div>

                            <div class="col-11 mx-auto">
                                <div class="form-group <?php echo (!empty($mensaje_err)) ? 'has-error' : ''; ?>">
                                    <label>Mensaje</label>
                                    <input type="text" name="mensaje" class="form-control">
                                    <span class="help-block"><?php echo $mensaje_err; ?></span>
                                </div>
                            </div>

                            <div class="col-11 mx-auto">
                                <div class="opciones">
                                    <div class="center">
                                        <button class="btn btn_rvf1" onclick="myFunction()">Enviar</button>
                                        <a class="btn btn_rvf2" href="../indexs/index.php">Cancelar</a>
                                    </div>
                                </div>
                            </div>

                            <h4 class="pt-4">WhatsApp</h4>
                                <a href="https://api.whatsapp.com/send?phone=573212410960&text=hola%2C%20Rovofic%20quiero%20más%20información..." id="contact"><img src="../../img/Icons/whatsapp.webp" height="100px"></a>

                        </form>
                     
             </div>
         </div>
     </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../Ass/js/jquery-3.3.1.slim.min.js"></script>
<script src="../Ass/js/popper.min.js"></script>
<script src="../Ass/js/bootstrap.min.js"></script>
<script src="../Ass/js/func.js"></script>
</body>

 

 </html>