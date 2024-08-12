<?php 
include('server.php');

// Recuperar errores de la sesión, si los hay
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
unset($_SESSION['errors']);

// Recuperar el token de la URL
$token = isset($_GET['token']) ? htmlspecialchars($_GET['token']) : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Restablecer Contraseña</h2>
    </div>

    <form method="post" action="server.php">
        <?php include('errors.php'); ?>

        <!-- Token oculto para actualizar la contraseña -->
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        
        <div class="input-group">
            <label>Nueva Contraseña</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirmar Nueva Contraseña</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="update_password">Actualizar Contraseña</button>
        </div>
    </form>
</body>
</html>
