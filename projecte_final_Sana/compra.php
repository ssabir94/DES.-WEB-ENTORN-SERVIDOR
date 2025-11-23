<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Carretó</title>
</head>
<body>
<?php
    // Carrego les dades i les funcions perquè vull reutilitzar el catàleg i el format del preu.
    require_once "includes/dades.php";
    require_once "includes/funcions.php";
?>

    <header>
        <h1>Carretó</h1>
    </header>

    <main>
        <form action="processa_compra.php" method="post">
            <fieldset>
                <legend>Dades de la compra</legend>

                <p><strong>Indica tipus de client:</strong></p>
                <label for="tipus_client">Tipus de client:</label>
                <select id="tipus_client" name="tipus_client">
                    <option value="client">Client estàndard</option>
                    <option value="client_premium">Client premium</option>
                </select>
            </fieldset>

            <br>

            <fieldset>
                <legend>Catàleg de productes</legend>

                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <th>Producte</th>
                        <th>Categoria</th>
                        <th>Preu unitari</th>
                        <th>Quantitat</th>
                    </tr>

                    <?php foreach ($productes as $index => $producte) { 
                        if (!$producte['disponible']) {
                                // Si el producte no està disponible, el salto i no el mostro a la taula.
                            continue;
                            } 
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producte['nom']); ?></td>
                            <td><?php echo htmlspecialchars($producte['categoria']); ?></td>
                            <td><?php echo formatar_preu($producte['preu']); ?></td>
                            <td>
                                <!-- Guardo la quantitat amb l'índex del producte per poder recuperar-ho després. -->
                                <input type="number"
                                       name="quantitats[<?php echo $index; ?>]"
                                       min="0"
                                       value="0">
                            </td>
                        </tr>
                    <?php } 
                    ?>
                </table>
            </fieldset>

            <br>
            <input type="submit" value="Calcular total de la compra">
        </form>

        <p><a href="index.php">Tornar a l'inici</a></p>
    </main>

</body>
</html>