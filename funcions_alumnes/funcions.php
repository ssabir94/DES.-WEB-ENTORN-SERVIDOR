<?php
// funcions.php (Fitxer base)
// --------------------------
// TODO: Implementa aquí les funcions necessàries:
// - mostrarBenvinguda()
function mostrarBenvinguda( ) {
    //Aquí el títol:
    echo "<h2>Gestor d'Alumnes</h2>";
    //La benvinguda:
    echo "<p>Benvingut al sistema de gestió de notes.</p>";
}

// - calcularMitjana($notes)
function calcularMitjana($notes) {
    //suma de les notes:
    $suma = array_sum($notes);
    //mitjana:
    return round($suma / count($notes), 2);
}

function mostrarAlumne($nom, $notes) {
    $mitjana = calcularMitjana($notes);   // reutilitzem la funció
    echo "<p><strong>$nom</strong> - Mitjana: $mitjana</p>";
}

// - calcularExtrems($notes)
function calcularExtrems($notes) {
    //calcula la nota màxima i mínima utilitzant funcions predefinides max() i min().
    return ["max" => max($notes), "min" => min($notes)];
}

// - formatNom($nom)
function formatNom($nom) {
    // retorna el nom en majúscules amb strtoupper() (funció predefinida de cadenes).
    return strtoupper($nom);
}

// - mostrarMissatge($nom, $text = 'Bon treball!')
function mostrarMissatge($nom, $text = "Bon treball!") {
    echo "<p>$nom, $text</p>";
}

// - mostrarFitxa($alumne)
function mostrarFitxa($alumne) {
    $nom = formatNom($alumne["nom"]);
    $notes = $alumne["notes"];
    $mitjana = calcularMitjana($notes);
    $extrems = calcularExtrems($notes);
    
    echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>";
    echo "<h3>$nom</h3>";
    //implode() converteix un array en una cadena de text, unint tots els seus elements amb un separador.
    echo "Notes: " . implode(", ", $notes) . "<br>";
    echo "Mitjana: $mitjana<br>";
    echo "Nota màxima: {$extrems['max']} | Mínima: {$extrems['min']}<br>";
    mostrarMissatge($nom, "continua millorant!");
    echo "</div>";
}



// * Extensió (opcional):
//Rememberrrr funció variàdica:
//Una funció variàdica és una funció que pot rebre un nombre variable d’arguments, sense saber quants exactament.
//S’utilitza el operador de tres punts (...) davant del nom del paràmetre.


// - afegirAlumne(&$llista, $nom, ...$notes)
//En aquest cas, el paràmetre $notes té els tres punts davant, per tant és variàdic.
function afegirAlumne(&$llista, $nom, ...$notes) {
    // Crear el nou alumne amb el nom i l'array de notes
    $nouAlumne = [
        "nom" => $nom,
        "notes" => $notes
    ];

    // Afegeixo el nou alumne al final de la llista original
    $llista[] = $nouAlumne;
}


// - filtrarAlumnes($llista, $minMitjana)
function filtrarAlumnes($llista, $minMitjana) {
    $resultat = []; //Inicialitzo un array buit on guardo només els alumnes que passin el filtre.

    foreach ($llista as $alumne) {
        // Calculo la mitjana de l'alumne utilitzant la meva funció
        $mitjana = calcularMitjana($alumne['notes']);

        // Si supera el llindar, l'afegeixo al resultat
        //si volgués incloure també els iguals al llindar, seria >=
        if ($mitjana > $minMitjana) {
            $resultat[] = $alumne;
        }
    }
    //Retorno la nova llista amb només els alumnes filtrats.
    return $resultat;
}

// - generarInforme($llista)
function generarInforme($llista) {
    //si no hi ha alumnes, informem i sortim
    if (empty($llista)) {
        echo "<div style='border:1px dashed #7aa44aff; padding:10px; margin:10px;'>";
        echo "<strong>Informe del grup</strong><br>";
        echo "No hi ha alumnes per informar.";
        echo "</div>";
        return; // sortim perquè no podem calcular res més
    }

     $totalAlumnes = count($llista);// per obtenir el nombre total d'alumnes

     //Les notes del grup en un sol array
    // Bucle + array_merge: és una funció que combina diversos arrays en un de sol
    $totesNotes = []; //Aquí acumulo totes les notes
    foreach ($llista as $alumne) {
        // $alumne['notes'] és un array -> el fusiono amb el conjunt global
        //Per tal de poder aconseguir totes les notes en un sol array, ha de ser unidimensional.
        //Per això, no podem fer $totesNotes[] = $alumne['notes']; perquè això
        //afegiria un array dins d'un altre array (array multidimensional).
        $totesNotes = array_merge($totesNotes, $alumne['notes']);
    }

    if (empty($totesNotes)) {
        echo "<div style='border:1px dashed #a03838ff; padding:10px; margin:10px;'>";
        echo "<strong>Informe del grup</strong><br>";
        echo "Total d'alumnes: $totalAlumnes<br>";
        echo "No hi ha notes registrades per informar.";
        echo "</div>";
        return;
    }


    //calcularMitjana() és una funció que ja havíem creat.Per tant, si fem: 
    $mitjanaGlobal = calcularMitjana($totesNotes);
    //array_sum($totesNotes) suma totes les notes del grup.
    //count($totesNotes) compta quantes notes hi ha.
    //Es divideix.
    //round(..., 2) arrodoneix el resultat a 2 decimals.
    //La funció retorna aquest valor, i l’assigno a $mitjanaGlobal.
    //No és la mitjana de les “mitjanes individuals”, sinó de totes les notes combinades.


    
    $notaMaxima    = max($totesNotes);
    //max és predefinida, i retorna el valor més alt d’un conjunt.
    //no volem  la màxima de cada alumne, sinó la màxima de totes les notes.

    echo "<div style='border:2px solid #858b29ff; padding:12px; margin:12px; background:#f9f9f9; color:green;'>";
    echo "<h3>Informe del grup</h3>";
    echo "Total d'alumnes: $totalAlumnes<br>";
    echo "Mitjana global: $mitjanaGlobal<br>";
    echo "Nota màxima: $notaMaxima";
    echo "</div>";
}
?>