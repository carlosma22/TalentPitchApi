# Proyecto Laravel con Integración de OpenAI

Este proyecto es una aplicación Laravel que incluye la integración con la API de OpenAI para generar contenido dinámico. 
Los registros se crean automáticamente y manual en las tablas `users`, `challenges`, y `videos` utilizando los datos generados por OpenAI.

## Requisitos Previos

Antes de configurar y ejecutar este proyecto, asegúrate de tener lo siguiente instalado:

- PHP >= 8.2
- GIT
- Composer
- MySQL
- OpenAI API Key

## Configuración del Proyecto

### 1. Clonar el Repositorio
Clona este repositorio en tu máquina local:

git clone https://github.com/tu-usuario/nombre-del-repositorio.git
cd nombre-del-repositorio


### 2. Instalar Dependencias
Ejecuta el siguiente comando para instalar las dependencias de PHP:

composer install


### 3. Configurar Variables de Entorno
Copia el archivo de ejemplo .env:

cp .env.example .env


### 4. Generar la Clave de la Aplicación
Genera la clave de la aplicación Laravel:

php artisan key:generate


### 5. Migrar las Tablas de la Base de Datos
Ejecuta las migraciones para crear las tablas en la base de datos:

php artisan migrate


### 6. Ejecutar el Servidor de Desarrollo
Inicia el servidor de desarrollo de Laravel:

php artisan serve

Visita http://localhost:8000 en tu navegador para ver la aplicación en funcionamiento.


## Uso de la API

### 1. Crear Registros Usando OpenAI
Puedes realizar una solicitud POST a la siguiente ruta para generar y crear registros en las tablas users, challenges, y videos:

POST /api/openai/create


### 2. Crear Registros Usando RESTful
Puedes realizar una solicitud POST a la siguiente ruta para crear
POST /api/users, POST /api/challenges, POST /api/videos

Puedes realizar una solicitud GET a la siguiente ruta para listado paginado
GET /api/users, GET /api/challenges, GET /api/videos

Puedes realizar una solicitud PUT a la siguiente ruta para actualizar
PUT /api/users, PUT /api/challenges, PUT /api/videos

Puedes realizar una solicitud DELETE a la siguiente ruta para eliminar
DELETE /api/users, DELETE /api/challenges, DELETE /api/videos


## Ejecución de Pruebas
El proyecto incluye pruebas unitarias para garantizar que la lógica de negocio funcione correctamente.

Ejecutar Todas las Pruebas
Ejecuta todas las pruebas utilizando el siguiente comando:

php artisan test

Ejecutar Pruebas Específicas
Puedes ejecutar pruebas específicas utilizando el flag --filter seguido del nombre de la prueba:

php artisan test --filter=OpenAIControllerTest

# TalentPitchApi
