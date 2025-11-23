<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <?php
        // Definixo el títol de la pàgina en una variable perquè si el vull canviar només ho faig en un lloc.
        $titol_pagina = "Formulari d'informació del meu gat";
    ?>
    <title><?php echo $titol_pagina; ?></title>
</head>
<body>

    <header>
        <h1><?php echo $titol_pagina; ?></h1>
    </header>

    <main>
        <!-- Envio el formulari a processa.php amb el mètode POST, tal com faig al projecte de la unitat. -->
        <form method="post" action="processa.php">
            <fieldset>
                <legend>Dades del gat</legend>

                <label for="nom_gat">Nom del gat:</label><br>
                <input type="text" id="nom_gat" name="nom_gat"><br><br>

                <label for="edat_gat">Edat del gat (anys):</label><br>
                <input type="number" id="edat_gat" name="edat_gat"><br><br>

                <label for="tipus_menjar">Tipus d'aliment preferit:</label><br>
                <select id="tipus_menjar" name="tipus_menjar">
                    <option value="">-- Selecciona una opció --</option>
                    <option value="sec">Menjar sec</option>
                    <option value="humit">Menjar humit</option>
                    <option value="mixt">Combinació de sec i humit</option>
                </select><br><br>

                <label>Entorn del gat:</label><br>
                <input type="radio" id="interior" name="entorn" value="interior">
                <label for="interior">Gat d'interior</label><br>

                <input type="radio" id="exterior" name="entorn" value="exterior">
                <label for="exterior">Gat amb accés a l'exterior</label><br><br>

                <label>
                    <input type="checkbox" name="rebre_novetats" value="si">
                    Vull rebre novetats i recomanacions de productes per al meu gat
                </label><br><br>

                <label>Tipus de productes que m'interessen:</label><br>
                <!-- Aquí faig servir diversos checkbox amb el mateix nom perquè pugui seleccionar més d'una opció. -->
                <input type="checkbox" id="int_alimentacio" name="interessos[]" value="Alimentació">
                <label for="int_alimentacio">Alimentació</label><br>

                <input type="checkbox" id="int_accesoris" name="interessos[]" value="Accesoris">
                <label for="int_accesoris">Accesoris</label><br>

                <input type="checkbox" id="int_higiene" name="interessos[]" value="Higiene">
                <label for="int_higiene">Higiene</label><br>

                <input type="checkbox" id="int_joguines" name="interessos[]" value="Joguines">
                <label for="int_joguines">Joguines</label><br><br>

                <input type="submit" value="Enviar informació">
            </fieldset>
        </form>

        <p>
            <a href="index.php">Tornar a l'inici</a>
        </p>
    </main>

</body>
</html>
