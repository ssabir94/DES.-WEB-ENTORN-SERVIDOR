<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Resultat del formulari del gat</title>
</head>
<body>
<?php
    /* NOTA!: Carlos, com demanaves més d'un form, he enchufat un amb informació deL gat. A més, veuras que 
    he fet també un amb informació de la compra. */
    
    // Carrego funcions perquè vull reutilitzar la neteja de dades i mantenir el codi ordenat.
    require_once "includes/funcions.php";

    // Inicialitzo un array per guardar els missatges d'error.
    $errors = [];

    // Comprovo que aquesta pàgina s'estigui cridant amb el mètode POST.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Agafo les dades que venen del formulari.
        $nom_gat        = isset($_POST["nom_gat"]) ? $_POST["nom_gat"] : "";
        $edat_gat       = isset($_POST["edat_gat"]) ? $_POST["edat_gat"] : "";
        $tipus_menjar   = isset($_POST["tipus_menjar"]) ? $_POST["tipus_menjar"] : "";
        $entorn         = isset($_POST["entorn"]) ? $_POST["entorn"] : "";
        $rebre_novetats = isset($_POST["rebre_novetats"]) ? $_POST["rebre_novetats"] : "";
        $interessos     = isset($_POST["interessos"]) ? $_POST["interessos"] : [];

        /* Quan vull comprovar el tipus i el valor real d'una variable, puc utilitzar var_dump(). */
        // var_dump($edat_gat);

        // Valido el nom del gat.
        if (!es_text_no_buit($nom_gat)) {
            $errors[] = "Indicar nom del gat.";
        }

        // Valido l'edat: ha de ser numèrica i en un rang raonable.
        if (!es_text_no_buit($edat_gat)) {
            $errors[] = "Cal indicar l'edat del gat.";
        } elseif (!is_numeric($edat_gat)) {
            $errors[] = "L'edat del gat ha de ser un número.";
        } elseif ($edat_gat < 0 || $edat_gat > 30) {
            // Aquí faig servir un operador lògic OR per controlar el rang.
            $errors[] = "Posar una edat entre 0 i 30 anys.";
        }

        // Valido el tipus de menjar preferit.
        if (!es_text_no_buit($tipus_menjar)) {
            $errors[] = "Seleccionar un tipus d'aliment.";
        }

        // Valido l'entorn del gat.
        if (!es_text_no_buit($entorn)) {
            $errors[] = "Indicar si el gat és d'interior o té accés a l'exterior.";
        }

        // Valido la selecció múltiple d'interessos.
        if (empty($interessos) || !is_array($interessos)) {
            $errors[] = "Seleccionar almenys un tipus de productes que m'interessin.";
        }

        // Si no hi ha errors, genero una resposta personalitzada.
        if (empty($errors)) {

            // Netejo les dades abans de mostrar-les.
            $nom_gat_net      = netejar_dada($nom_gat);
            $tipus_menjar_net = netejar_dada($tipus_menjar);
            $entorn_net       = netejar_dada($entorn);
            $edat_gat_num     = (int)$edat_gat; // Aquí faig una conversió explícita a enter.

            // Netejo també els interessos, ja que venen com un array.
            $interessos_nets = [];
            foreach ($interessos as $int) {
                $interessos_nets[] = netejar_dada($int);
            }
            $llista_interessos = implode(", ", $interessos_nets);

            // Decideixo una categoria d'edat per al gat amb if / elseif.
            if ($edat_gat_num < 1) {
                $categoria_edat = "cadell";
            } elseif ($edat_gat_num <= 6) {
                $categoria_edat = "adult jove";
            } else {
                $categoria_edat = "gat sènior";
            }

            // Creo un petit text sobre recomanació de menjar amb un switch.
            $recomanacio_menjar = "";

            switch ($tipus_menjar_net) {
                case "sec":
                    $recomanacio_menjar = "Penso que el menjar sec és pràctic, però vigilo que begui prou aigua.";
                    break;

                case "humit":
                    $recomanacio_menjar = "El menjar humit sol agradar molt als gats i ajuda amb la hidratació.";
                    break;

                case "mixt":
                    $recomanacio_menjar = "Amb una combinació de sec i humit puc adaptar millor l'alimentació del gat.";
                    break;

                default:
                    // Aquest cas no hauria de passar, però el deixo per si arriba un valor inesperat.
                    $recomanacio_menjar = "S'ha indicat un tipus d'aliment desconegut.";
                    break;
            }

            // Missatge sobre l'entorn.
            $text_entorn = "";
            if ($entorn_net === "interior") {
                $text_entorn = "Com que el gat viu a l'interior, valoro tenir rascadors i joguines perquè faci exercici.";
            } else {
                $text_entorn = "Com que el gat té accés a l'exterior, vaig amb compte amb desparasitacions i higiene.";
            }

            // Afegeixo una recomanació extra amb un operador lògic AND.
            $alerta_senior_exterior = "";
            if ($edat_gat_num > 10 && $entorn_net === "exterior") {
                $alerta_senior_exterior = "Com que el gat és sènior i surt a l'exterior, vaig especialment al dia amb les revisions veterinàries.";
            }

            // Missatge sobre novetats.
            $text_novetats = "";
            if ($rebre_novetats === "si") {
                $text_novetats = "He indicat que vull rebre novetats i recomanacions de productes per al meu gat.";
            } else {
                $text_novetats = "Ara mateix no vull rebre novetats per correu.";
            }
            ?>
            <h1>Informació gat:</h1>

            <ul>
                <li><strong>Nom del gat:</strong> <?php echo $nom_gat_net; ?></li>
                <li><strong>Edat:</strong> <?php echo $edat_gat_num; ?> anys (<?php echo $categoria_edat; ?>)</li>
                <li><strong>Aliment preferit:</strong> <?php echo $tipus_menjar_net; ?></li>
                <li><strong>Entorn:</strong> <?php echo $entorn_net; ?></li>
                <li><strong>Tipus de productes que m'interessen:</strong> <?php echo $llista_interessos; ?></li>
            </ul>

            <h2>Les seves cures:</h2>
            <p><?php echo $recomanacio_menjar; ?></p>
            <p><?php echo $text_entorn; ?></p>
            <?php if ($alerta_senior_exterior !== "") { ?>
                <p><?php echo $alerta_senior_exterior; ?></p>
            <?php } ?>
            <p><?php echo $text_novetats; ?></p>

            <p><a href="formulari.php">Tornar al formulari del gat</a></p>
            <p><a href="index.php">Tornar a l'inici</a></p>

            <?php
        } else {
            // Si hi ha errors, els mostro en una llista perquè pugui corregir el formulari.
            ?>
            <h1>Hi ha errors al formulari del gat. Corregeix per continuar.</h1>
            <ul>
                <?php
                foreach ($errors as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                ?>
            </ul>

            <p><a href="formulari.php">Tornar al formulari del gat</a></p>
            <p><a href="index.php">Tornar a l'inici</a></p>
            <?php
        }

    } else {
        // Si algú entra directament sense enviar el formulari, ho informo.
        ?>
        <h1>Oh!, no he rebut dades del formulari. Completa-ho per seguir endavant. </h1>
        <p><a href="registre.php">Anar al formulari de registre</a></p>
        <p><a href="index.php">Tornar a l'inici</a></p>
        <?php
    }
?>

</body>
</html>

