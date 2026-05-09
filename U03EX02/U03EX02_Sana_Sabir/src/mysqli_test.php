<?php

//Començarè amb el num. 5, ja que si hi ha un error, llança mysqli_sql_exception. 
//Sé que potser es veu més clar si ho posso com a l'exemple del Powerpoint, però m'agradaria fer aquesta part tal i com ho indico :)
// 5.	Gestionar errors amb try...catch.
try {

    // 1.	Activar el mode d’excepcions:
    // 2.	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


    //---> Aquí vull establir les dades de connexió (com deia abans, en comptes de fer-ho "fora" ho faig aquí dins del try)
    $host   = 'db';        // nom del servei MySQL al docker-compose
    $dbname = 'mydb';      // nom de la base de dades
    $user   = 'user';      // usuari de la base de dades
    $pass   = 'password';  // contrasenya de l'usuari
    



// 3.	Crear la connexió amb l’objecte mysqli.
    $mysqli = new mysqli($host, $user, $pass, $dbname);

// 4.	Configurar el joc de caràcters a utf8mb4.
    $mysqli->set_charset('utf8mb4');

// 6.	Executar la mateixa consulta:
// 7.	SELECT NOW() AS data_actual
    $sql    = "SELECT NOW() AS data_actual";
    $result = $mysqli->query($sql);
    $fila = $result->fetch_assoc(); //Important, sino no podrè mostrar l'hora actual :P

// 8.	Mostrar:
// 9.	Connexió mysqli correcta. Data del servidor: XXXX
   echo "Connexió mysqli correcta. Data del servidor: " . $fila['data_actual'];

   $mysqli->close(); //És recomanable tancar la conexió (Ja sé que no ens ho indiques especificament a l'exercici, però crec que és bo fer-ho segons veig als apunts)

} catch (mysqli_sql_exception $e) {

// 10.	En cas d’error, mostrar només:
// 11.	Error de connexió amb la base de dades

   echo "Error de connexió amb la base de dades";
} 