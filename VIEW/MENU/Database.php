<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "inventario";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
