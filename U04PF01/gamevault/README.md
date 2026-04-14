# GameVault

## Descripció del projecte

GameVault és una aplicació web desenvolupada amb **Laravel** que permet a cada usuari gestionar la seva pròpia biblioteca personal de videojocs.

La idea del projecte és senzilla: cada usuari pot registrar-se, iniciar sessió i administrar una llista de jocs amb informació com el títol, la plataforma, l'any de llançament, l'estat, la puntuació, les notes i el gènere.

L'aplicació està feta seguint el **patró MVC** i els requisits del projecte final: rutes, controladors, models Eloquent, migracions, relacions entre entitats, autenticació d'usuaris, validació de formularis i CRUD complet de l'entitat principal.

---

## Objectiu del treball

L'objectiu del projecte ha estat construir una aplicació funcional i coherent utilitzant Laravel de manera ordenada, aplicant els continguts treballats al tema 4.

En aquest cas, s'ha escollit una aplicació de **gestió de videojocs**, on:

* l'entitat principal és **Game**
* l'entitat relacionada és **Genre**

Això permet demostrar l'ús de relacions entre entitats, l'autenticació d'usuaris i la separació de responsabilitats dins de l'estructura MVC.

---

## Estructura general del projecte

El projecte segueix l'estructura habitual de Laravel:

* `app/Models` per als models
* `app/Http/Controllers` per als controladors
* `database/migrations` per a les migracions
* `resources/views` per a les vistes Blade
* `routes/web.php` per a les rutes web

Aquesta organització ajuda a mantenir el codi clar i separat segons la seva responsabilitat.

---

## Autenticació d'usuaris

Per gestionar l'autenticació s'ha utilitzat **Laravel Breeze**.

Això ha permès incorporar:

* registre d'usuaris
* inici de sessió
* tancament de sessió
* protecció de rutes amb middleware `auth`

D'aquesta manera, només els usuaris autenticats poden accedir a la part principal de l'aplicació.

A més, cada usuari només pot veure i gestionar les seves pròpies dades. Això s'ha controlat utilitzant `Auth::id()` dins dels controladors i comprovant la propietat dels registres abans d'editar-los o eliminar-los.

---

## Entitats del projecte

### 1. Entitat principal: Game

L'entitat `Game` representa cada videojoc guardat per l'usuari.

Els camps principals utilitzats són:

* `title`
* `platform`
* `release_year`
* `description`
* `genre_id`
* `user_id`
* `status`
* `rating`
* `notes`

Sobre aquesta entitat s'ha implementat un **CRUD complet**:

* crear videojocs
* llistar videojocs
* editar videojocs
* eliminar videojocs


### 2. Entitat relacionada: Genre

L'entitat `Genre` representa el gènere del videojoc.

Cada gènere està associat a un usuari i pot estar relacionat amb diversos jocs.

Aquesta entitat disposa de:

* model propi
* migració pròpia
* controlador propi
* vistes pròpies

Per tant, compleix el requisit d'incorporar una segona entitat relacionada.

---

## Relacions entre entitats

Les relacions s'han definit amb **Eloquent**.

### Relació entre Game i Genre

* Un **gènere** pot tenir molts jocs → `hasMany`
* Un **joc** pertany a un gènere → `belongsTo`

Això s'ha implementat als models.

### Relació entre User i Game

Cada joc també està associat a un usuari concret mitjançant el camp `user_id`.

A la pràctica, això permet que cada usuari només vegi els seus propis registres.

### Relació entre User i Genre

També s'ha afegit el camp `user_id` a la taula `genres` perquè cada gènere pertanyi a un usuari concret.

Això evita que un usuari pugui utilitzar o modificar categories d'un altre usuari.

---

## Claus foranes

El projecte utilitza **claus foranes** a la base de dades.

Això s'ha treballat amb migracions, sense crear les taules manualment amb phpMyAdmin.

Les claus foranes principals del projecte són:

* `games.genre_id` → referència a `genres.id`
* `games.user_id` → referència a `users.id`
* `genres.user_id` → referència a `users.id`

A més, recentment s'ha corregit el comportament de la relació entre `games` i `genres`.

Inicialment, en esborrar un gènere també s'esborraven els jocs relacionats perquè la clau forana de `genre_id` estava configurada amb `onDelete('cascade')`.

Això es va modificar amb una nova migració perquè el comportament correcte fos:

* si s'esborra un gènere, el joc **no s'esborra**
* el camp `genre_id` queda a `NULL`

Per aconseguir-ho, es va fer que `genre_id` fos nullable i es va aplicar `nullOnDelete()`.

Aquesta decisió és coherent amb el funcionament de l'aplicació, perquè un joc pot continuar existint encara que la seva categoria desaparegui.

---

## Formularis amb dades relacionades

Els formularis de `Game` incorporen un camp `<select>` per seleccionar el gènere.

Això s'ha implementat tant al formulari de:

* creació (`create`)
* edició (`edit`)

A més, després de modificar la relació, també s'ha afegit l'opció **"No category"** per permetre que un joc no tingui categoria.

Per tant, els formularis no només seleccionen correctament la relació, sinó que també són coherents amb el comportament actual de la base de dades.

---

## Validació de formularis

La validació s'ha implementat al `GameController`.

S'han validat camps com:

* obligatorietat de títol i plataforma
* tipus enter a `release_year`
* valors vàlids per a `status`
* rang de `rating` entre 1 i 10
* existència del gènere si s'envia `genre_id`

Després del canvi de la relació amb categories, la validació de `genre_id` es va adaptar a:

* `nullable|exists:genres,id`

Així, el joc pot guardar-se sense categoria, però si se n'indica una, aquesta ha d'existir realment a la taula `genres`.

---

## Control d'accés i dades pròpies de cada usuari

Una part important del projecte és que cada usuari només pot gestionar les seves pròpies dades.

Això s'ha resolt de diverses maneres:

1. Filtrant els jocs per `user_id` a l'hora de llistar-los.
2. Carregant només els gèneres de l'usuari autenticat als formularis.
3. Utilitzant una comprovació de propietat abans d'editar o eliminar un joc.

Per exemple, al controlador es comprova que el registre pertanyi realment a l'usuari autenticat abans de permetre accions sensibles.

Això reforça la seguretat i compleix un dels requisits principals de l'enunciat.

---

## Separació de responsabilitats (MVC)

El projecte respecta el patró MVC.

### Models

Els models gestionen la relació amb la base de dades i defineixen les relacions Eloquent.

### Controladors

Els controladors gestionen la lògica de l'aplicació: reben les peticions, validen les dades, recuperen informació i decideixen quina vista s'ha de mostrar.

### Vistes

Les vistes Blade s'encarreguen només de la part visual: mostrar dades, formularis i missatges.

No s'ha barrejat HTML dins dels models ni SQL a les vistes, de manera que es respecta correctament la separació de responsabilitats.

---

## Rutes

Les rutes principals del projecte s'han definit a `routes/web.php`.

S'han utilitzat rutes protegides amb middleware `auth` i també rutes resource per simplificar el CRUD.

Per exemple, `games` i `genres` es gestionen amb els seus controladors corresponents.

A més, la ruta inicial `/` es redirigeix a la part principal de l'aplicació, cosa que dona una entrada més directa i professional.

---

## Interfície funcional

L'aplicació permet navegar entre les diferents pantalles i completar les operacions principals sense sortir del flux normal de treball.

L'usuari pot:

* crear jocs
* editar jocs
* eliminar jocs
* crear gèneres
* gestionar gèneres
* moure's entre la llista de jocs i la gestió de categories

També s'han revisat alguns detalls perquè les vistes no donin errors quan un joc es queda sense categoria.

Per exemple, a la llista de jocs es mostra **"No category"** si el joc no té gènere assignat.

---

## Problemes trobats i com s'han resolt

Durant el desenvolupament han aparegut alguns problemes reals que s'han anat resolent.

### 1. Categories compartides o no vinculades correctament a l'usuari

Es va detectar la necessitat que els gèneres també depenguessin de l'usuari autenticat. Per això es va afegir `user_id` a la taula `genres`.

### 2. Error en executar migracions

Una migració antiga relacionada amb `genres.user_id` va donar error perquè la columna ja existia a la base de dades.

La solució va ser revisar la migració i ajustar-la perquè només afegís la columna si encara no existia.

### 3. En esborrar una categoria s'esborraven els jocs

Això passava perquè la foreign key de `games.genre_id` tenia `cascade`.

Es va corregir amb una nova migració que:

* elimina la foreign key anterior
* converteix `genre_id` en nullable
* crea una nova foreign key amb `nullOnDelete()`

### 4. Adaptació de formularis i vistes

Després del canvi anterior, també es van adaptar:

* la validació del controlador
* el select de gèneres a create i edit
* la vista de llistat per mostrar "No category" si cal

Això demostra que no només s'ha modificat la base de dades, sinó també tota la lògica i la interfície relacionades amb aquest canvi.

---

## Conclusió

GameVault és una aplicació funcional feta amb Laravel que compleix els requisits principals del projecte final.

El projecte inclou:

* autenticació d'usuaris
* dues entitats relacionades
* CRUD complet de l'entitat principal
* relacions Eloquent
* migracions
* validació de formularis
* separació MVC
* control perquè cada usuari només gestioni les seves dades

A més, durant el desenvolupament s'han resolt problemes reals relacionats amb migracions, claus foranes i coherència entre base de dades, controladors i vistes.

---