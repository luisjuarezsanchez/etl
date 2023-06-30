<?php
$servername = "127.0.0.1";
$port = 33069; // Puerto redirigido en el host
$username = "root";
$password = "ripples";
$database = "public"; // Reemplaza con el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
