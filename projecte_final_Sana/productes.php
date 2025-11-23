<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Catàleg de productes per a gats</title>
</head>
<body>
<?php
    // Carrego els arrays d'usuaris i productes perquè vull tenir el catàleg disponible en aquesta pàgina.
    require_once "includes/dades.php";

    // Carrego les funcions perquè vull reutilitzar el mateix codi per mostrar taules i formatar dades.
    require_once "includes/funcions.php";
?>

    <header>
        <h1>Els nostres productes</h1>
    </header>

    <main>
        <?php
            // Crido la funció que mostra tots els productes en format taula HTML.
            mostrar_taula_productes($productes);
        ?>

        <p>
            <!-- Afegeixo un enllaç per tornar fàcilment a la pàgina principal del projecte. -->
            <a href="index.php">Tornar a l'inici</a>
        </p>
    </main>

</body>
</html>
