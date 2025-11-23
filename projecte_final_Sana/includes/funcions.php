<?php

// Netejo una dada de text eliminant espais i escapant HTML.
function netejar_dada($dada)
{
    // Treu espais al principi i al final.
    $dada_neta = trim($dada);

    // Converteixo caràcters especials perquè no s'executi cap HTML estrany...
    $dada_neta = htmlspecialchars($dada_neta, ENT_QUOTES, 'UTF-8');

    return $dada_neta;
}

// Comprovo si un text no està buit (després de treure espais).
function es_text_no_buit($text)
{
    return trim($text) !== "";
}

// Valido un correu electrònic amb filter_var.
function es_email_valid($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Converteixo un preu a text amb dos decimals i el símbol d'euro.
function formatar_preu($preu)
{
    // Faig servir number_format per tenir sempre dos decimals.
    return number_format($preu, 2, ",", ".") . " €";
}

// Converteixo el booleà de disponibilitat en un text.
function obtenir_text_disponibilitat($disponible)
{
    if ($disponible) {
        return "Disponible";
    } else {
        return "No disponible";
    }
}

// Converteixo el tipus d'usuari intern en un text més entenedor per mostrar-lo a la taula.
function obtenir_text_tipus_usuari($tipus)
{
    if ($tipus === "client") {
        return "Client estàndard";
    } elseif ($tipus === "client_premium") {
        return "Client premium";
    } elseif ($tipus === "administrador") {
        return "Administrador"; //Aviam, aquesta no l'he afegit al desplegable perque se suposa que nomès som dos admin...
    } else {
        // Si arriba algun altre valor, el mostro tal qual per no perdre informació.
        return $tipus;
    }
}


// Mostro una taula HTML amb el llistat d'usuaris.
function mostrar_taula_usuaris($usuaris)
{
    echo "<h2>Llistat d'usuaris registrats</h2>";

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Nom</th><th>Email</th><th>Tipus</th></tr>";

    foreach ($usuaris as $usuari) {
        $tipus_mostrar = obtenir_text_tipus_usuari($usuari['tipus']);
        
        echo "<tr>";
        echo "<td>" . htmlspecialchars($usuari['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($usuari['email']) . "</td>";
        echo "<td>" . htmlspecialchars($tipus_mostrar) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

// Mostro una taula HTML amb el catàleg de productes per a gats.
function mostrar_taula_productes($productes)
{
    echo "<h2>Catàleg de productes per a gats</h2>";

    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>Nom</th>
            <th>Categoria</th>
            <th>Tipus</th>
            <th>Descripció</th>
            <th>Preu</th>
            <th>Disponibilitat</th>
          </tr>";

    foreach ($productes as $producte) {

        // Agafo les dades del producte i les preparo per mostrar-les.
        $nom        = htmlspecialchars($producte['nom']);
        $categoria  = htmlspecialchars($producte['categoria']);
        $tipus      = htmlspecialchars($producte['tipus']);
        $descripcio = htmlspecialchars($producte['descripcio']);
        $preu       = formatar_preu($producte['preu']);
        $estat      = obtenir_text_disponibilitat($producte['disponible']);

        echo "<tr>";
        echo "<td>$nom</td>";
        echo "<td>$categoria</td>";
        echo "<td>$tipus</td>";
        echo "<td>$descripcio</td>";
        echo "<td>$preu</td>";
        echo "<td>$estat</td>";
        echo "</tr>";
    }

    echo "</table>";
}
