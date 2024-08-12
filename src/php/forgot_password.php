<?php 
include('server.php'); 

// Recuperar errores de la sesión, si los hay
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
unset($_SESSION['errors']);

$email = ""; // Inicializa la variable $email

if (isset($_POST['reset_password'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Recuperar Contraseña</h2>
    </div>

    <form method="post" action="server.php">
        <?php include('errors.php'); ?>

        <div class="input-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reset_password">Recuperar Contraseña</button>
        </div>
    </form>
</body>
</html>
