<?php
$servername = "localhost";
$port = 3306; // Puerto redirigido en el host
$username = "secretaria";
$password = "imcutidg";
$database = "patrimonio_dev"; // Reemplaza con el nombre de tu base de datos

$connOld = new mysqli($servername, $username, $password, $database, $port);

if ($connOld->connect_error) {
    die("Error de conexión: " . $connOld->connect_error);
}
?>
