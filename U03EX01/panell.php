<?php
session_start();

// Control d'accés
if (!isset($_SESSION['username'])) {
    // Guardar un missatge d'avís a la sessió
    $_SESSION['error'] = "Has d'iniciar sessió per accedir a l'àrea privada.";

    // Redirigir a la pàgina d'inici
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Panell</title>
</head>
<body>

    <h1>Àrea Privada</h1>

    <p>Benvingudx, <strong><?php echo $_SESSION['username']; ?></strong></p>

    <p><a href="logout.php">Tancar sessió</a></p>

</body>
</html>
