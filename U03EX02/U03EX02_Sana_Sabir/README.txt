Part C – Reflexió curta

1.	Quina diferència principal hi ha entre PDO i mysqli?

La diferència principal entre PDO i mysqli és sobretot que mysqli està pensat només per treballar amb MySQL i és més simple i directe, mentre que PDO és més complet i permet connectar-se a diferents tipus de bases de dades utilitzant la mateixa forma de programar. Amb mysqli tot és molt específic per MySQL i va bé per començar i entendre la connexió bàsica, però PDO dona més possibilitats i també gestiona millor els errors perquè treballa amb excepcions. Al final, totes dues serveixen per fer el mateix: connectar i treballar amb la base de dades, però mysqli és més “bàsic i concret” i PDO és més flexible i professional.


2.	Per què és important utilitzar try...catch?

és important perquè ens permet controlar els errors de connexió amb la base de dades d’una manera segura i ordenada. Si alguna cosa falla (per exemple, si la contrasenya no és correcta o el servidor no respon), el programa no “peta”, sinó que podem capturar l’error i decidir què fer, com mostrar un missatge adequat a l’usuari. Això fa que l’aplicació sigui més fiable, evita pantalles d’error lletges i ens dóna més control sobre què passa quan alguna cosa no funciona bé.


3.	Per què no és correcte mostrar $e->getMessage() en producció?

No és correcte mostrar $e->getMessage() en producció perquè aquest missatge pot revelar informació interna molt sensible sobre el servidor o la base de dades, com noms de taules, usuaris o detalls tècnics que un atacant podria aprofitar. En lloc d’això, és millor mostrar un missatge genèric a l’usuari i, si cal, guardar l’error real només per al desenvolupador. D’aquesta manera l’aplicació és més segura i professional.





PART D (Errors que he hagut de resoldre per fer la tasca)


Errors amb mysqli:

"Fatal error: Uncaught Error: Call to undefined function mysqli_report() in /var/www/html/mysqli_test.php:10 Stack trace: #0 {main} thrown in /var/www/html/mysqli_test.php on line 10"

Això vol dir que l’extensió mysqli NO està instal·lada/activada dins del contenidor PHP.


-->Solució? 

El que he fet ha sigu accedir al document DockerFile, i :

# Instal·lar extensions PHP necessàries per treballar amb MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

(Es a dir, he afegit "mysqli", ja que nomes tenia aixo:
RUN docker-php-ext-install pdo pdo_mysq )

--> Ara deso el fitxer i segueixo:

docker compose down
docker compose up -d --build

--> I ja està, ja puc veure la pàgina :)


