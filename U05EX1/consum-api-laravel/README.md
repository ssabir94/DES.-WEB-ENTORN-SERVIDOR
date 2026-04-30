# Activitat Tema 5 — Consum i Integració d’API

## Descripció

En aquesta activitat he desenvolupat una aplicació web capaç de consumir una API externa, utilitzar diferents mètodes HTTP, processar dades en format JSON i integrar aquesta informació amb una base de dades pròpia.

L’activitat es divideix en tres parts: consum d’API amb PHP (cURL), consum amb Laravel i una aplicació híbrida amb sistema de favorits.

---

## PART 1 — PHP amb cURL

S’ha creat un client en PHP per interactuar amb l’API:

https://jsonplaceholder.typicode.com/posts

S’han implementat els següents mètodes:

- **GET**: obtenir una llista de posts (mínim 5)
- **GET per ID**: obtenir un post concret
- **POST**: enviar dades en format JSON
- **PUT**: modificar un registre
- **DELETE**: eliminar un registre

El codi està estructurat de forma modular, separant la configuració, les funcions cURL i l’execució.

Les proves s’han realitzat amb Postman.

---

## PART 2 — Laravel

S’ha replicat el consum de l’API utilitzant Laravel i el client HTTP integrat (`Http::`).

Funcionalitats implementades:

- **GET**: mostrar els posts en una vista Blade
- **POST**: crear un nou post
- **PUT**: actualitzar un post
- **DELETE**: eliminar un post

També s’han creat les rutes corresponents i s’han verificat els resultats en el navegador.

---

## PART 3 — Aplicació híbrida

S’ha desenvolupat una aplicació que integra dades de l’API amb una base de dades pròpia.

### Funcionalitats

- Mostrar posts des de l’API
- Guardar posts com a favorits a la BD
- Mostrar quins posts són favorits
- Evitar duplicats comprovant abans de guardar

### Millores implementades

- Eliminar favorits
- Filtrar dades (mostrar només favorits)
- Millora visual de la interfície

---

## Base de dades

S’ha creat una taula `favorits` amb els camps:

- id  
- post_id  
- title  
- timestamps  

S’ha utilitzat Eloquent per gestionar les dades.

---

## Estructura del projecte

- **Part 1**: PHP amb cURL  
- **Part 2 i 3**: projecte Laravel  

---

## Conclusions

Amb aquesta activitat he treballat el consum d’APIs, l’ús de diferents mètodes HTTP, la manipulació de dades JSON i la integració amb una base de dades.

També he après a estructurar millor el codi i a combinar dades externes amb funcionalitats pròpies dins d’una aplicació web.