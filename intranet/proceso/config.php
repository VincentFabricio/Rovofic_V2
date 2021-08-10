<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER1', 'localhost');
define('DB_USERNAME1', 'root');
define('DB_PASSWORD1', '');
define('DB_NAME1', 'rovofic_com_datos');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER1, DB_USERNAME1, DB_PASSWORD1, DB_NAME1);
global $link;
 
// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
