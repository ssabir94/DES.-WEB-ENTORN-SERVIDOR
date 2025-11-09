<?php
// index.php (Fitxer base)
// --------------------------
// TODO:
// 1. Inclou els fitxers de dades i funcions.
include "dades.php";
include "funcions.php";

// 2. Crida a mostrarBenvinguda().
mostrarBenvinguda();

//OPCIONAL1: afegirAlumne($alumnes, $nom, ...$notes)
afegirAlumne($alumnes, "Lluís", 9, 9, 9);
afegirAlumne($alumnes, "Sana", 10, 9, 10);
//Al ser sequencial, hem d'afegir abans de recórrer la llista.
//Si ho posso després, no es veurà a la llista.

// 3. Recorre la llista d'alumnes i mostra la seva fitxa.
foreach ($alumnes as $a) {
    // Passem nom i array de notes com demana la funció
  mostrarFitxa($a); 
}

//OPCIONAL2: filtrarAlumnes($alumnes, $minMitjana)
// Exemple: alumnes amb mitjana > 8
// $alumnesFiltrats = filtrarAlumnes($alumnes, 8);

// Mostrem només els filtrats
// echo "<hr><h3>Alumnes amb mitjana > 8</h3>";
// foreach ($alumnesFiltrats as $a) {
//     mostrarFitxa($a);
// }


// 4. (Opcional) mostra l'informe global.
generarInforme($alumnes);

?>