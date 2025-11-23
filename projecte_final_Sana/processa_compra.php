<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Resultat de la compra</title>
</head>
<body>
<?php
    // Carrego el catàleg i les funcions per poder calcular preus i mostrar els productes.
    require_once "includes/dades.php";
    require_once "includes/funcions.php";

    // Creo un array per guardar errors de validació.
    $errors = [];

    // Comprovo que aquesta pàgina s'estigui cridant amb el mètode POST.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Agafo el tipus de client i les quantitats del formulari.
        $tipus_client = isset($_POST["tipus_client"]) ? $_POST["tipus_client"] : "client";
        $quantitats   = isset($_POST["quantitats"]) ? $_POST["quantitats"] : [];

        // Valido el tipus de client per seguretat.
        if ($tipus_client !== "client" && $tipus_client !== "client_premium") {
            $errors[] = "El tipus de client rebut no és vàlid.";
        }

        // Comprovo que s'hagi seleccionat com a mínim un producte amb quantitat > 0.
        $hi_ha_alguna_quantitat = false;
        if (is_array($quantitats)) {
            foreach ($quantitats as $q) {
                if (is_numeric($q) && (int)$q > 0) {
                    $hi_ha_alguna_quantitat = true;
                    break;
                }
            }
        }

        if (!$hi_ha_alguna_quantitat) {
            $errors[] = "Has de seleccionar com a mínim un producte amb quantitat superior a zero.";
        }

        /* SI NO HI HA ERRORS, CALCULO EL TOTAL*/
        if (empty($errors)) {

            // Inicialitzo el total de la compra sense descompte.
            $total_sense_descompte = 0;

            // Guardo les línies de compra per mostrar-les en una taula.
            $linies_compra = [];

            // Recorro els productes i les quantitats per calcular subtotals.
            foreach ($productes as $index => $producte) {

                // Si el producte no està disponible, el salto per seguretat.
                if (!$producte['disponible']) {
                    continue;
                }

                $quantitat = 0;

                if (isset($quantitats[$index]) && is_numeric($quantitats[$index])) {
                    $quantitat = (int)$quantitats[$index];
                }

                // Només calculo si la quantitat és positiva.
                if ($quantitat > 0) {
                    $preu_unitari = $producte['preu'];
                    $subtotal = $preu_unitari * $quantitat;
                    $total_sense_descompte += $subtotal;

                    // Guardo aquesta línia de compra per poder-la mostrar després.
                    $linies_compra[] = [
                        "nom"       => $producte['nom'],
                        "quantitat" => $quantitat,
                        "preu"      => $preu_unitari,
                        "subtotal"  => $subtotal
                    ];
                }
            }

            // Decideixo el percentatge de descompte segons el tipus de client.
            $percentatge_descompte = 0;
            if ($tipus_client === "client_premium") {
                $percentatge_descompte = 10;
            }

            // Calculo l'import del descompte i el total final.
            $import_descompte = 0;
            if ($percentatge_descompte > 0) {
                $import_descompte = $total_sense_descompte * $percentatge_descompte / 100;
            }

            $total_amb_descompte = $total_sense_descompte - $import_descompte;
            ?>

            <h1>Resum de la compra</h1>

            <h2>Línies de compra</h2>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>Producte</th>
                    <th>Quantitat</th>
                    <th>Preu unitari</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach ($linies_compra as $linia) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($linia['nom']); ?></td>
                        <td><?php echo $linia['quantitat']; ?></td>
                        <td><?php echo formatar_preu($linia['preu']); ?></td>
                        <td><?php echo formatar_preu($linia['subtotal']); ?></td>
                    </tr>
                <?php } ?>
            </table>

            <h2>Totals</h2>
            <p><strong>Total sense descompte:</strong> <?php echo formatar_preu($total_sense_descompte); ?></p>
            <p><strong>Tipus de client:</strong> <?php echo htmlspecialchars($tipus_client); ?></p>

            <?php if ($percentatge_descompte > 0) { ?>
                <p><strong>Descompte aplicat:</strong> <?php echo $percentatge_descompte; ?>%</p>
                <p><strong>Import descomptat:</strong> <?php echo formatar_preu($import_descompte); ?></p>
            <?php } else { ?>
                <p>No s'aplica cap descompte perquè s'ha indicat un client estàndard.
                   Si vols gaudir de descomptes, considera fer-te client premium!
                </p>
            <?php } ?>

            <p><strong>Total final a pagar:</strong> <?php echo formatar_preu($total_amb_descompte); ?></p>

            <p><a href="compra.php">Fer una altra compra</a></p>
            <p><a href="index.php">Tornar a l'inici</a></p>

            <?php

        } else {
            /* SI HI HA ERRORS, ELS MOSTRO I TORNO AL FORMULARI */
            ?>
            <h1>Hi ha errors en la compra</h1>
            <p>Revisa els punts següents i torna al formulari de compra:</p>

            <ul>
                <?php
                foreach ($errors as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                ?>
            </ul>

            <p><a href="compra.php">Tornar al formulari de compra</a></p>
            <p><a href="index.php">Tornar a l'inici</a></p>
            <?php
        }

    } else {
        /*SI ENTRO DIRECTAMENT SENSE ENVIAR FORMULARI*/
        ?>
        <h1>No s'han rebut dades de compra</h1>
        <p>Per calcular un total de compra, primer omple el formulari de la compra.</p>
        <p><a href="compra.php">Anar al formulari de compra</a></p>
        <p><a href="index.php">Tornar a l'inici</a></p>
        <?php
    }
?>

</body>
</html>
