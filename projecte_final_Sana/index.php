<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Projecte Final: Gatificat!</title>
</head>
<body>
<?php
    //Defineixo el títol de la pàgina perquè si el vull canviar només ho faig en un sol lloc.
    $titol_pagina = "Gatificat!";
    //Guardo la data actual perquè vull mostrar un contingut dinàmic al carregament de la pàgina.
    $data_avui = date("d/m/Y");
?>

    <header>
        <h1><?php echo $titol_pagina; ?></h1>
        <p><?php echo "Data: " . $data_avui; ?></p>
    </header>
    <hr>

    <nav>
        <h2>Menú principal</h2>
        <ul>
            <li><em><a href="registre.php">Formulari de registre d'usuaris</a></em></li>
            <li><em><a href="formulari.php">Formulari pels peluts</a></em></li>
            <li><em><a href="productes.php">Els nostres productes</a></em></li>
            <br>
            <li><a href="compra.php">Carretó</a></li>

        </ul>
    </nav>

    <footer>
        <hr>
        <p>
            <?php
                // Afegeixo un peu de pàgina dinàmic perquè vull reutilitzar l'any actual sense haver-lo de canviar manualment :P
                echo "&copy; " . date("Y") . " - Gatificat! by Sana Sabir";
            ?>
        </p>
    </footer>
</body>
</html>
