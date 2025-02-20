# Proyecto de Publicaciones

Este proyecto consiste en una aplicación web que permite gestionar publicaciones. El backend está desarrollado en PHP puro y el frontend está construido con Vue.js.

## Estructura del Proyecto

- **Backend**: PHP puro
- **Frontend**: Vue.js

##Creacion de la base de datos y ejecuta el archivo script.sql que viene en raiz

### Nota
viene una coleccion para poder ejecutar las apis desde postman

## Instrucciones de Instalación

### 1. Clonar el Repositorio backend

Clona el repositorio   en tu máquina local:

```bash
git clone https://github.com/tu_usuario/tu_repositorio.git
cd tu_repositorio
composer install
y levanta el servicio con
php -S localhost:8000 -t .

```

### 2. Clonar el Repositorio Frontend

Clona el repositorio   en tu máquina local:


```bash
git clone https://github.com/tu_usuario/tu_repositorio.git
cd tu_repositorio
npm install
y levanta el servicio con
npm run serve
```

## Descripcion de las apis realizada

## 1. Obtener Publicaciones
Método: GET
Endpoint: /publicaciones
Descripción: Obtiene una lista de todas las publicaciones.

## 2. Crear Publicación
Método: POST
Endpoint: /publicaciones
Descripción: Crea una nueva publicación.

## 3. Obtener Publicación por ID
Método: GET
Endpoint: /publicaciones/{id}
Descripción: Obtiene una publicación específica por su ID.
Parámetros:
id: ID de la publicación a obtener.

## 4. Actualizar Publicación
Método: PUT
Endpoint: /publicaciones/{id}
Descripción: Actualiza una publicación existente.
Parámetros:
id: ID de la publicación a actualizar.

## 5. Eliminar Publicación
Método: DELETE
Endpoint: /publicaciones/{id}
Descripción: Elimina una publicación existente.
Parámetros:
id: ID de la publicación a eliminar.


## 6. Autenticacion
Método: DELETE
Endpoint: /login
Descripción: Autenticacion


## 7. Registro de usuarios
Método: DELETE
Endpoint: /register
Descripción: Registra usuarios

