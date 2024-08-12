<?php 
include('server.php'); 

// Recuperar errores de la sesión, si los hay
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
unset($_SESSION['errors']);

$username = ""; // Inicializa la variable $username
$email = ""; // Inicializa la variable $email

if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Registro</h2>
    </div>
    
    <form method="post" action="register.php">
        <?php include('errors.php'); ?>

        <div class="input-group">
            <label>Nombre de usuario</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        </div>
        <div class="input-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>
        <div class="input-group">
            <label>Contraseña</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirmar contraseña</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Registrarse</button>
        </div>
        <p>
            ¿Ya eres miembro? <a href="login.php">Iniciar sesión</a>
        </p>
    </form>
</body>
</html>
