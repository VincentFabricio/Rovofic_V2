<?php
ob_start();
session_start();
require_once 'config.php';
// select logged in users detail
$sql = "SELECT * FROM datos WHERE id=?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_id);

    // Set parameters
    $param_id = $_SESSION['user'];

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
            $userRow = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } else {
            // tax doesn't contain valid id. Redirect to error page
            header("location: ../error.php");
            exit();
        }
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

// $res = mysqli_query($link, $sql);
// $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
//images from db
$sql="SELECT * FROM images WHERE id_Usuario =" . $_SESSION['user'];
$res = mysqli_query($link, $sql);
$rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
if ($rows==null) {
    $sql="SELECT * FROM images WHERE id_Usuario = 0 ";
    $res = mysqli_query($link, $sql);
    $rows = mysqli_fetch_array($res, MYSQLI_ASSOC);
}
