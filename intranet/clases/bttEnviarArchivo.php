<?php
require_once '../proceso/dataUser2.php';
$valor=$_POST["valor"];
ini_set('date.timezone', 'America/Bogota');
$sql = "UPDATE seguimiento SET clicks = ? WHERE nombre = ? and fecha = ?";
if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "iss", $param_clicks,$param_nombre,$param_fecha);

    // Set parameters
    $param_clicks = $valor;
    $param_nombre = "enviarArchivo";
    $param_fecha = date('jS \of F Y');

    // Attempt to execute the prepared statement
    mysqli_stmt_execute($stmt);
}
?>