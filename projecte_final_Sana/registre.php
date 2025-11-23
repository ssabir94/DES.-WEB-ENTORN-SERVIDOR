<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Registre d'usuaris</title>
</head>
<body>

    <header>
        <h1>Registre de clients</h1>
    </header>

    <main>
        <!-- Envio el formulari a processa_registre.php utilitzant el mètode POST tal com he vist als dossiers. -->
        <form action="processa_registre.php" method="post">
            <fieldset>
                <legend>Dades del client</legend>

                <label for="nom">Nom complet:</label><br>
                <input type="text" id="nom" name="nom"><br><br>

                <label for="email">Correu electrònic:</label><br>
                <input type="email" id="email" name="email"><br><br>

                <label for="tipus">Tipus de client:</label><br>
                <select id="tipus" name="tipus">
                    <option value="">-- Selecciona una opció --</option>
                    <option value="client">Client estàndard</option>
                    <option value="client_premium">Client premium</option>
                </select><br><br>

                <input type="submit" value="Registrar client">
            </fieldset>
        </form>

        <p>
            <a href="index.php">Tornar a l'inici</a>
        </p>
    </main>

</body>
</html>
