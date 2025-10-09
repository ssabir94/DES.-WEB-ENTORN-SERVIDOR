<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Començem! :P </title>
</head>
<body>
    <h1>Pas a pas</h1> 
    
    <p>
        <?php
        $nom= "Sana"; //Declaro la primera variable.
        $curs= "2n DAW"; //Declaro la segona variable.
        //Ara el missatge que vull que surti en pantalla.
        echo "Hola, sóc $nom, i estudio $curs.  Avui és: "; 
        //Per mostrar la data, usaré date
        echo date("d/m/Y"); //És important posar echo davant de date, ja que sino no es veu.
        ?>
    </p>

</body>
</html>