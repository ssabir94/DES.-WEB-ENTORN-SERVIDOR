# API REST Segura amb Laravel

## Descripció del projecte

Aquest projecte consisteix en el desenvolupament d’una API REST segura utilitzant Laravel i MySQL. L’objectiu principal ha estat crear un sistema de gestió de tasques on cada usuari pugui registrar-se, iniciar sessió i administrar exclusivament les seves pròpies tasques mitjançant autenticació amb token.

L’aplicació s’ha desenvolupat sense interfície web ni vistes Blade, ja que totes les proves i interaccions s’han realitzat amb Postman, treballant exclusivament amb respostes en format JSON.

Per gestionar l’autenticació s’ha utilitzat Laravel Sanctum, que permet generar tokens personals per protegir les rutes de l’API. Això garanteix que només els usuaris autenticats puguin accedir als endpoints protegits.

La funcionalitat principal del projecte és el CRUD de tasques:
- crear tasques
- llistar tasques
- consultar una tasca concreta
- actualitzar tasques
- eliminar tasques

Cada tasca queda vinculada a l’usuari autenticat mitjançant el camp `user_id`, implementant així un control d’accés segur perquè cada usuari només pugui veure i modificar les seves pròpies dades.

A més, s’ha implementat un sistema de categories en una taula pròpia relacionada amb les tasques mitjançant `category_id`. Aquesta relació permet organitzar les tasques i afegeix una estructura més professional a la base de dades.

Com a funcionalitats extra del nivell excel·lent, el projecte incorpora:
- filtratge de tasques per categoria
- ordenació ascendent i descendent
- paginació de resultats

Durant el desenvolupament també s’han implementat validacions de dades i proves de seguretat amb Postman, comprovant casos com:
- accés sense token
- intents de modificar dades d’un altre usuari
- validacions de camps obligatoris

---

# Tecnologies utilitzades

- Laravel
- Laravel Sanctum
- PHP
- MySQL
- Postman
- Composer

---

# Instal·lació del projecte

## 1. Clonar projecte

```bash
git clone URL_DEL_PROJECTE
```

## 2. Entrar a la carpeta

```bash
cd api-tasques
```

## 3. Instal·lar dependències

```bash
composer install
```

## 4. Configurar arxiu `.env`

Modificar:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_tasques
DB_USERNAME=root
DB_PASSWORD=
```

---

# Crear base de dades

Crear manualment la base de dades a MySQL:

```sql
CREATE DATABASE api_tasques;
```

---

# Executar migracions

```bash
php artisan migrate
```

---

# Executar servidor Laravel

```bash
php artisan serve
```

Servidor:

```txt
http://127.0.0.1:8000
```

---

# Autenticació amb token

Per accedir a les rutes protegides és necessari utilitzar un token Bearer:

```txt
Authorization: Bearer TOKEN
```

El token s’obté fent login a:

```txt
POST /api/login
```

---

# Endpoints implementats

| Mètode | Endpoint | Funció |
|---|---|---|
| POST | `/api/register` | Registrar usuari |
| POST | `/api/login` | Login i obtenció de token |
| GET | `/api/categories` | Llistar categories |
| POST | `/api/categories` | Crear categoria |
| DELETE | `/api/categories/{id}` | Eliminar categoria |
| GET | `/api/tasks` | Llistar tasques |
| POST | `/api/tasks` | Crear tasca |
| GET | `/api/tasks/{id}` | Veure una tasca |
| PUT | `/api/tasks/{id}` | Actualitzar tasca |
| DELETE | `/api/tasks/{id}` | Eliminar tasca |
| GET | `/api/tasks?categoria=ID` | Filtrar per categoria |
| GET | `/api/tasks?order=asc` | Ordenació ascendent |
| GET | `/api/tasks?order=desc` | Ordenació descendent |
| GET | `/api/tasks?page=1` | Paginació |

---

# Format JSON

Exemple resposta correcta:

```json
{
  "success": true,
  "data": {}
}
```

Exemple resposta error:

```json
{
  "success": false,
  "message": "Error"
}
```

---

# Validacions implementades

## Usuaris
- email obligatori
- format correcte email
- email únic
- password mínima de 6 caràcters

## Tasques
- nom obligatori
- comentari obligatori
- category_id obligatori
- comprovació de categoria existent

---

# Seguretat implementada

- Protecció de rutes amb `auth:sanctum`
- Tokens Bearer
- Filtrat per `user_id`
- Control d’accés entre usuaris
- Respostes JSON amb codis HTTP correctes

---

# Proves amb Postman

El projecte inclou:
- col·lecció exportada de Postman
- proves CRUD completes
- proves d’autenticació
- proves de seguretat
- proves de filtres, ordenació i paginació

---