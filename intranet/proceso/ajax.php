<?php
    require_once 'conf.php';
    $sql = "SELECT * FROM contador WHERE id = ?";
                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "i", $param_id);
                    
                        // Set parameters
                        $param_id = 1;
                    
                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                    
                            if (mysqli_num_rows($result) == 1) {
                                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                                $row3 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                echo $row3['contador'];
                            }else{
                                echo "No hay nada";
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                    }
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>

        <a href="compras.php" target='_blank' class="btn btn_rvf1 mx-1" id="sumar">incremento</a>

    <script>
        var cont = '<?php echo $row3['contador']; ?>';
        var sumar = document.getElementById('sumar');

        /* sumar.addEventListener('click', function(event) {
            event.preventDefault();
            cont++;
        }); */

        $('#sumar').on('click', function() {
            cont++;
            alert(cont)
            var valor = cont;
            var url = "bttCompras.php";
            $.ajax({
                url: url,
                type: "POST",
                data: {valor: valor}
            })
        });
    </script>
</body>
</html>