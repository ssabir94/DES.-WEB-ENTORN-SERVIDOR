<?php
session_start();

// Definir usuari i password "correctes"
$usuari_correcte = "admin";
$pass_correcte   = "daw";
//Inicialitzo missatge d'error buit per defecte, dp li afegeixo el missatge
$missatge_error = "";

// Comprovar si s'ha enviat el formulari
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuari   = $_POST['usuari'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($usuari == $usuari_correcte && $password == $pass_correcte) {
        // Guardo la sessió amb el nom d'usuari
        $_SESSION['username'] = $usuari;

        // Redirigeixo al panell privat
        header("Location: panell.php");
        exit();
    } else {
        // Credencials incorrectes? 
        $missatge_error = "Vaja, sembla que les credencials són incorrectes!:( ";
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <h2>Iniciar sessió</h2>

    <form action="login.php" method="POST">
        Usuari: <input type="text" name="usuari"><br><br>
        Contrasenya: <input type="password" name="password"><br><br>
        <button type="submit">Entrar</button>
    </form>

    <?php
    // Si hi ha error, el mostrem sota el formulari
    if (!empty($missatge_error)) {
        echo "<p style='color:red'>" . $missatge_error . "</p>";
    }
    ?>

</body>
</html>

