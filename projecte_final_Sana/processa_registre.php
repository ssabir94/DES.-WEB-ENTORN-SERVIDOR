<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Registre de client</title>
</head>
<body>
<?php
    // Carrego les dades i les funcions perquè necessito l'array d'usuaris i les eines de validació.
    require_once "includes/dades.php";
    require_once "includes/funcions.php";

    // Creo un array buit on vaig guardant els missatges d'error de validació.
    $errors = [];

    // Comprovo que aquesta pàgina s'estigui cridant amb el mètode POST.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Agafo les dades que venen del formulari de registre.
        $nom_formulari   = isset($_POST['nom']) ? $_POST['nom'] : "";
        $email_formulari = isset($_POST['email']) ? $_POST['email'] : "";
        $tipus_formulari = isset($_POST['tipus']) ? $_POST['tipus'] : "";

        // Valido el nom: ha de tenir algun contingut.
        if (!es_text_no_buit($nom_formulari)) {
            $errors[] = "Has d'introduir un nom.";
        }

        // Valido l'email: primer comprovo que no estigui buit i després el format.
        if (!es_text_no_buit($email_formulari)) {
            $errors[] = "Has d'introduir un correu electrònic.";
        } elseif (!es_email_valid($email_formulari)) {
            $errors[] = "El correu electrònic no té un format vàlid.";
        }

        // Valido el tipus de client.
        // Encara que el desplegable només permet 'client estàndard' o 'client premium', vull assegurar-me que 
        // el valor rebut és realment un d'aquests dos.
        if (!es_text_no_buit($tipus_formulari)) {
            $errors[] = "Has de seleccionar un tipus de client.";
        } elseif ($tipus_formulari !== "client" && $tipus_formulari !== "client_premium") {
            // Aquí faig servir un operador lògic AND per assegurar-me que el valor és un dels esperats.
            $errors[] = "El tipus de client rebut no és vàlid.";
        }

        // Si no hi ha errors, considero que el formulari és correcte.
        if (empty($errors)) {

            // Netejo les dades abans de mostrar-les o guardar-les.
            $nom_net   = netejar_dada($nom_formulari);
            $email_net = netejar_dada($email_formulari);
            $tipus_net = netejar_dada($tipus_formulari);

            // Creo un nou usuari com a array associatiu.
            $nou_usuari = [
                "nom"   => $nom_net,
                "email" => $email_net,
                "tipus" => $tipus_net
            ];

            // Afegeixo aquest usuari a l'array d'usuaris que he carregat des de dades.php.
            // Simulo que la BBDD creix a mesura que registro nous clients.
            $usuaris[] = $nou_usuari;
            ?>
            <h1>Registre correcte</h1>

            <p>Dades nou client:</p>
            <ul>
                <li><strong>Nom:</strong> <?php echo $nom_net; ?></li>
                <li><strong>Correu electrònic:</strong> <?php echo $email_net; ?></li>
                <li><strong>Tipus de client:</strong> <?php echo $tipus_net; ?></li>
            </ul>

            <?php if ($tipus_net === "client_premium") { ?>
                <?php
                    /* Per donar sentit al tipus de client premium, afegeixo un petit exemple de descompte.
                    D'aquesta manera practico també operadors aritmètics amb variables :P */
                    $preu_exemple = 50;      
                    $descompte    = 10;      
                    $import_descomptat = $preu_exemple - ($preu_exemple * $descompte / 100);
                ?>
                <h2>Avantatges Premium</h2>
                <p><em>
                    Com a client premium, tens un descompte del <?php echo $descompte; ?>% en compres seleccionades.<br>
                    Per exemple, si una compra té un preu de <?php echo $preu_exemple; ?> €, amb el descompte pagues
                    <?php echo $import_descomptat; ?> €.
                    </em>
                </p>
            <?php } ?>

            <?php
                // Reutilitzo la funció per mostrar tots els usuaris en una taula.
                mostrar_taula_usuaris($usuaris);
            ?>

            <p><a href="registre.php">Registrar nou client</a></p>
            <p><a href="index.php">Tornar a l'inici</a></p>

            <?php
        } else {
            // Si hi ha errors, els mostro en una llista perquè l'usuari pugui revisar el formulari.
            ?>
            <h1>Hi ha hagut errors en el registre</h1>

            <p>Revisar els errors i tornar enrere per corregir el formulari:</p>
            <ul>
                <?php
                foreach ($errors as $error) {
                    echo "<li>" . htmlspecialchars($error) . "</li>";
                }
                ?>
            </ul>

            <p><a href="registre.php">Tornar al formulari de registre</a></p>
            <p><a href="index.php">Tornar a l'inici</a></p>

            <?php
        }

    } else {
        // Si algú entra directament a aquesta pàgina, mitjançant URL, sense passar pel formulari, ho informo.
        ?>
        <h1>Oh!, no he rebut dades del formulari. Completa-ho per seguir endavant. </h1>
        <p><a href="registre.php">Anar al formulari de registre</a></p>
        <p><a href="index.php">Tornar a l'inici</a></p>
        <?php
    }
?>

</body>
</html>
