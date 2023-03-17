<?php
$servername = "db";
$username = "admin";
$password = "admin12345";
$dbname = "computadora_db";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>