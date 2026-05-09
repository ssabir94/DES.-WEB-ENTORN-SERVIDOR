<?php

//1.Definir les dades de connexió:
$host    = 'db';
$dbname  = 'mydb';
$user    = 'user';
$pass    = 'password';
$charset = 'utf8mb4'; //últim pero no menys important, definir el charset

//2.	Crear la cadena DSN correctament.
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
//Indica driver (mysql), host, base de dades i charset


// 3.	Configurar l’array $options amb:
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //Mode d’errors per defecte: excepcions
    //Important que m'en recordi de la coma al final!!
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  //Arrary associatiu per defecte
    PDO::ATTR_EMULATE_PREPARES   => false, //No emula sentències preparades
];




// 4.	Establir la connexió dins d’un bloc try...catch.
try {

    $pdo = new PDO($dsn, $user, $pass, $options);

// 5.	Un cop connectat, executar aquesta consulta:
// 6.	SELECT NOW() AS data_actual

    $sql  = "SELECT NOW() AS data_actual";
    $stmt = $pdo->query($sql);   // Executem la consulta
    $fila = $stmt->fetch();      // Llegim una fila de resultat

// 7.	Mostrar per pantalla:
// 8.	Connexió PDO correcta. Data del servidor: XXXX

    echo "Connexió PDO correcta. Data del servidor: " . $fila['data_actual'];

// 9.	En cas d’error:
// o	NO mostrar el missatge real de l’error.
// o	Mostrar un missatge genèric:

} catch (PDOException $e) {

// o	Error de connexió amb la base de dades

 echo "Error de connexió amb la base de dades.";
}
