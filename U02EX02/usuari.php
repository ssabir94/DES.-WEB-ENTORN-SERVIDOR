<?php

//1. Definició de variables. Començaré declararant i definint:
$nom = "Laura";
$edat = 22;
$saldo = 134.75;
$nivell_usuari = "premium"; // pot ser "bàsic", "premium" o "admin"
$connectat = true;
$oferta_activada = false;
$missatge = "Benvinguda";

//2. Interpolació i concatenació. Ús de cometes dobles i també de (.):
//Haig de recordar que l'espai l'haig d'afegir jo abans de tancar les cometes, sino surt enganxat.
echo "<h2>$missatge, $nom!</h2>";
echo "<p>El teu saldo actual és de " . $saldo . " €.</p>";

//3. Condicions segons l'edat (if/else..):
//Per descart, no cal que al "else" especifiqui que sigui major de 65. 
if ($edat < 18) {
    echo "<p>Accés restringit: cal ser major d’edat.</p>";
} elseif ($edat >= 18 && $edat < 65) {
    echo "<p>Accés complet a totes les funcions.</p>";
} else {
    echo "<p>Mode sènior activat.</p>";
}

//4. Switch per nivell d'usuari: 
//He de tenir en compte el break per evitar que s'executin altres casos un cop es compleixi un.

switch ($nivell_usuari) {
    case "bàsic":
    echo "Tens accés limitat al contingut.";
    break;
    case "premium":
    echo "Gaudeix del contingut exclusiu Premium!";
    break;
    case "admin":
    echo "Accés total al panell d'administració." ;
    break;
    default:
    echo "Nivell desconegut";
    }
    //*Volia fer un copy-paste de l'exercici, pero no detecta les cometes de la mateixa manera -_- */

//5. Operadors lògics i ternari. 
//Aqui s'han de complir dues condicions per complir l'oferta activada: 
$oferta_activada = ($saldo > 100 && $connectat);
//Hem de tenir en conte que haviem declarat oferta_activada com a false, i volem que canvii a true si es compleixen les condicions.
echo $oferta_activada ? "<p>Oferta especial activada!</p>" : "<p>Sense ofertes disponibles.</p>"; 

//6. Funció i àmbit de variables.
//Si uso la variable global dins de la funció, podré utilitzar $nom. Sino, no. 
function mostrarSalutacio() {
 global $nom;
 echo "<p>Hola de nou, $nom!</p>";
} 
mostrarSalutacio();
//Aquí la puc cridar. De no ser pel global de dintre, no hi hauría resposta.

//7. Conversio de tipus.
//var_dump mostra valor i tipus. Crec que és el més útil per fer diverses comprovacions.
//Pel que demanes a l'exercici, el que hem de fer és convertir un string (el ús de doble cometes...) a int (enter) i a decimal.

$text_numerico = "50.99";

$valor_int = (int)$text_numerico;
$valor_float = (float)$text_numerico; 
//ara començem amb el que vull que mostri:

echo '<p>Valor original: "' . $text_numerico . '"</p>';
//Aquest l'he possat així perque sino sortia string(5)...
echo "<p>Com a int: $valor_int</p>";
echo "<p>Com a float: $valor_float</p>";
//Crec que el resultat no arrodonira, sino que simplement tallarà la part decimal... 


//IMPORTANT: He volgut posar el var_dump pero sortia un xurru. Així que t'ho posso comentat, per a que vegis com sortia el que demanaves:
// echo "Valor original: ";
// var_dump($text_numerico);  //string(5) "50.99"

// echo "Com a int: ";
// var_dump($valor_int);      //int(50)

// echo "Com a float: ";
// var_dump($valor_float);    //float(50.99)

?>