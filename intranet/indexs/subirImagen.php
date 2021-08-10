<?php
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if(isset($_POST["submit"])){

    $tamImage = $_FILES['image']['size'];
    $typImage = $_FILES['image']['type'];
    
    if ($tamImage>0) {
        if ($tamImage<1000000) {
            if ($typImage=="image/jpeg" || $typImage=="image/jpg" || $typImage=="image/png") {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check !== false){
                    $image = $_FILES['image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));
                    $dataTime = date("Y-m-d H:i:s");
    
                //Insert image content into database
                $sql = "SELECT * FROM images WHERE id_Usuario = " . $_SESSION['user'];
                $result = mysqli_query($link, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($row==null) {
                    $insert = $link->query("INSERT into images (image, created,id_Usuario) VALUES ('$imgContent', '$dataTime','$_SESSION[user]')");
                if($insert){
                    echo "<script> alert('Subida correcta'); </script>";
                    header("location: ../indexs/index.php");
                            echo "<script language='javascript'>window.location='../indexs/index.php'</script>;";
                            exit();
                }else{
                    echo "File upload failed, please try again.";
                }
                }else{
                    $insert = $link->query("UPDATE images SET image='$imgContent', created ='$dataTime' WHERE id_Usuario = " . $_SESSION['user']);
                    if($insert){
                        echo "<script> alert('Actualizacion correcta'); </script>";
                        header("location: ../indexs/index.php");
                                echo "<script language='javascript'>window.location='../indexs/index.php'</script>;";
                                exit();
                    }else{
                        echo "File upload failed, please try again.";
                    }
                }
            }else{
                echo "Please select an image file to upload.";
            }
            }else{
                echo "<script> alert('Tipo de archivo no valido'); </script>";
            }
        }else{
            echo "<script> alert('Imagen demasiado grande'); </script>";
        }
    }else{
        echo "<script> alert('Seleccione un archivo'); </script>";
    }
}
?>