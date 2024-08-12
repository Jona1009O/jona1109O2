<?php 
include('server.php'); 

// Recuperar errores de la sesión, si los hay
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
unset($_SESSION['errors']);

$username = ""; // Inicializa la variable $username

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Iniciar sesión</h2>
    </div>
    
    <form method="post" action="login.php">
        <?php include('errors.php'); ?>

        <div class="input-group">
            <label>Nombre de usuario</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
        </div>
        <div class="input-group">
            <label>Contraseña</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="login_user">Iniciar sesión</button>
        </div>
        <p>
            ¿No eres miembro aún? <a href="register.php">Regístrate</a>
        </p>
        <p>
            <a href="forgot_password.php">¿Olvidaste tu contraseña?</a>
        </p>
    </form>
</body>
</html>
