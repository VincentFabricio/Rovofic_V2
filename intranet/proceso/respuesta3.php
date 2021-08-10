<?php 
	require_once 'conf.php';
	$valor=$_POST["valor"];

	$sql = "UPDATE contador SET contador = ? WHERE id = ?";
	if ($stmt = mysqli_prepare($link, $sql)) {
		// Bind variables to the prepared statement as parameters
		mysqli_stmt_bind_param($stmt, "ii", $param_cont,$param_id);
	
		// Set parameters
		$param_id = 1;
		$param_cont = $valor;
	
		// Attempt to execute the prepared statement
		mysqli_stmt_execute($stmt);
	}

	echo "Datos devueltos ".$valor;
?>