<?php if (isset($errors) && count($errors) > 0): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (isset($success) && $success != ""): ?>
    <div class="success">
        <p><?php echo $success; ?></p>
    </div>
<?php endif; ?>

<?php
if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    echo '<div class="error-messages">';
    foreach ($_SESSION['errors'] as $error) {
        echo "<p class='error'>$error</p>";
    }
    echo '</div>';
    // Limpiar errores después de mostrarlos
    unset($_SESSION['errors']);
}
?>

<?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
    <div class="error">
        <?php foreach ($_SESSION['errors'] as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>
