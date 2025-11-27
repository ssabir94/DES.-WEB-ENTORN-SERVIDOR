<?php
//És important posar aquest codi abans de qualsevol sortida al navegador, sino pot donar error.
session_start();

//He de possar missatge d'error buit
$missatge_error = "";

//Comprovar si l'usuari ja està loguejat
if (isset($_SESSION['username'])) {
// Si ja està loguejat, el redirigeixo al panell privat
    header("Location: panell.php");
    exit();
}

// Gestionar possible missatge d'error que vingui d'altres pàgines
if (isset($_SESSION['error'])) {
    $missatge_error = $_SESSION['error'];
    // Perquè només es mostri una vegada
    unset($_SESSION['error']); 
}

// Comptador de visites amb cookiesss, sino existeix, pasa a valer 1
$visites_totals = 1;

if (isset($_COOKIE['total_visits'])) {
    // Si ja existeix, incremento en 1 amb comptador
    $visites_totals = (int) $_COOKIE['total_visits'] + 1;
}

// Actualitzo la cookie amb el nou valor i caducitat d'un mes
setcookie('total_visits', $visites_totals, time() + 2592000);
?>


<!--Ara la benvinguda i l'enllaç per iniciar sessió-->
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Inici</title>
</head>
<body>
    <h1>Benvingudx!</h1>
    
    <?php
    //Si l'usuari accedeix a panell.php sense estar loguejat, el reenvio aquí amb el missatge d'error !!
    if (!empty($missatge_error)) {
        echo "<p style='color:red'>" . $missatge_error . "</p>"; //color vermell per resaltar error
    }
    ?>

    <p>Per iniciar sessió:</p>
    <a href="login.php">Login</a>
    
    <!--Posso això per separar una mica i que quedi més acceptable-->
    <br><br>
    <hr>
    <br><br>

    <?php
    // Missatge de primera visita :)
    if ($visites_totals == 1) {
        echo "<p>Benvingudx per primera vegada a la nostra aplicació!</p>";
    }
     
    // Comptador de visites total. En cursiva per destacar
    echo "<p><i>Aquesta és la teva visita número " . $visites_totals . " :) .</i></p>";
    ?>

</body>
</html>
