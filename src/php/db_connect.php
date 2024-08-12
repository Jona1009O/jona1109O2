<?php
// Cambia estos valores a los de tu configuración
$servername = "localhost"; // o la dirección de tu servidor de base de datos
$username = "root"; // tu nombre de usuario de la base de datos
$password = ""; // tu contraseña de la base de datos
$database = "registration"; // el nombre de tu base de datos

// Crear conexión
$db = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($db->connect_error) {
    die("La conexión ha fallado: " . $db->connect_error);
}
?>
