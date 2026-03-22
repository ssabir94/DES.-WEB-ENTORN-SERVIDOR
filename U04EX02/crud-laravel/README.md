# CRUD de Tasques amb Categories (Laravel)

## 📌 Descripció

Aquest projecte és una ampliació d’un CRUD de tasques desenvolupat amb Laravel.  
S’ha afegit la funcionalitat de categories, permetent associar cada tasca a una categoria.

L’objectiu és treballar amb relacions entre taules, models amb Eloquent i millorar un CRUD existent.

---

## 🎯 Funcionalitats

L’aplicació permet:

### Tasques
- Crear tasques  
- Editar tasques  
- Eliminar tasques  
- Visualitzar tasques  

### Categories
- Crear categories  
- Editar categories  
- Eliminar categories  
- Visualitzar categories  

### Relació
- Assignar una categoria a cada tasca  
- Editar la categoria d’una tasca  
- Mostrar la categoria a la llista de tasques  
- Mostrar "Sense categoria" si no n’hi ha  

---

## 🗄️ Base de dades

S’han utilitzat dues taules:

### Taula `categorias`
- id  
- nom  
- timestamps  

### Taula `tasques`
- id  
- title  
- description  
- categoria_id (nullable)  

La relació entre taules es fa amb una clau forana.  
Si s’elimina una categoria, les tasques associades passen a tenir categoria nul·la.

---

## 🔗 Relacions Eloquent

- Una categoria té moltes tasques  
- Una tasca pertany a una categoria  

Això permet accedir a les dades relacionades de forma directa des dels models.

---

## 🧩 Modificacions del CRUD de tasques

S’han fet les següents millores:

- Afegit un selector de categories als formularis de crear i editar  
- Guardar el camp `categoria_id`  
- Mantenir la categoria seleccionada en cas d’error  
- Mostrar la categoria al llistat de tasques  

---

## 🧪 Validació

S’han aplicat validacions als formularis:

- `title` és obligatori  
- `categoria_id` és opcional però ha de ser vàlid si s’envia  

---

## 🧭 Rutes

S’han utilitzat rutes de tipus resource per definir els CRUD:

- tasques  
- categories  

---

## 🖥️ Estructura del projecte

Les vistes estan organitzades en carpetes separades:

- `resources/views/tasques`  
- `resources/views/categories`  

Això permet mantenir el projecte ordenat i fàcil de mantenir.

---

## ✅ Resultat final

L’aplicació permet gestionar tasques i categories amb relacions entre elles, utilitzant Eloquent i sense fer consultes SQL manuals.