<?php 
session_start(); 

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Debes iniciar sesión";
    header('location: login.php');
    exit(); // Asegúrate de salir del script después de redirigir
}

// Manejo de cierre de sesión
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']); // Asegúrate de usar el nombre de sesión correcto
    header("location: login.php");
    exit(); // Asegúrate de salir del script después de redirigir
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link
