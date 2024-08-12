<?php
session_start();
include('db_connect.php'); // Incluye tu archivo de conexión a la base de datos

$errors = array();

// Solicitar restablecimiento de contraseña
if (isset($_POST['reset_password'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);

    if (empty($email)) {
        array_push($errors, "Se requiere el correo electrónico");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($db, $query);

        if (mysqli_num_rows($result) == 1) {
            $token = bin2hex(random_bytes(50)); // Generar token único
            $query = "INSERT INTO password_resets (email, token) VALUES('$email', '$token')";
            mysqli_query($db, $query);

            // Redirigir a la página de restablecimiento con el token en la URL
            header("Location: reset_password.php?token=$token");
            exit(); // Asegurarse de detener la ejecución después de redirigir
        } else {
            array_push($errors, "No se encontró ninguna cuenta con ese correo electrónico");
        }
    }

    // Si hay errores, redirige de vuelta a forgot_password.php con los errores
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: forgot_password.php");
        exit(); // Asegurarse de detener la ejecución después de redirigir
    }
}

// Actualizar la contraseña
if (isset($_POST['update_password'])) {
    $token = mysqli_real_escape_string($db, $_POST['token']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if (empty($password_1)) { 
        array_push($errors, "Se requiere la contraseña"); 
    }
    if ($password_1 != $password_2) { 
        array_push($errors, "Las contraseñas no coinciden"); 
    }

    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $query = "SELECT email FROM password_resets WHERE token='$token'";
        $result = mysqli_query($db, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            $email = $user['email'];
            $query = "UPDATE users SET password='$password' WHERE email='$email'";
            mysqli_query($db, $query);

            // Eliminar el token de restablecimiento
            $query = "DELETE FROM password_resets WHERE token='$token'";
            mysqli_query($db, $query);

            $_SESSION['success'] = "Tu contraseña ha sido actualizada con éxito. Puedes iniciar sesión con tu nueva contraseña.";
            header('Location: login.php');
            exit(); // Asegurarse de detener la ejecución después de redirigir
        } else {
            array_push($errors, "Token de restablecimiento inválido");
        }
    }

    // Si hay errores, redirige de vuelta a reset_password.php con los errores
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: reset_password.php?token=$token");
        exit(); // Asegurarse de detener la ejecución después de redirigir
    }
}

// Manejo de inicio de sesión
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Se requiere el nombre de usuario");
    }
    if (empty($password)) {
        array_push($errors, "Se requiere la contraseña");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_assoc($results);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                header('Location: ../public/index.html'); // Redirigir a la página de inicio
                exit();
            } else {
                array_push($errors, "La contraseña es incorrecta");
            }
        } else {
            array_push($errors, "El nombre de usuario no existe");
        }
    }

    // Si hay errores, redirige de vuelta a login.php con los errores
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../public/login.php");
        exit(); // Asegurarse de detener la ejecución después de redirigir
    }
}

// Manejo de registro
if (isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if (empty($username)) {
        array_push($errors, "Se requiere el nombre de usuario");
    }
    if (empty($email)) {
        array_push($errors, "Se requiere el correo electrónico");
    }
    if (empty($password_1)) {
        array_push($errors, "Se requiere la contraseña");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "Las contraseñas no coinciden");
    }

    if (count($errors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);

        $_SESSION['username'] = $username;
        header('Location: ../public/index.html'); // Redirigir a la página de inicio
        exit();
    }

    // Si hay errores, redirige de vuelta a register.php con los errores
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: ../public/register.php");
        exit(); // Asegurarse de detener la ejecución después de redirigir
    }
}
?>
