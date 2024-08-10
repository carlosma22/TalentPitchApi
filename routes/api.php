<?php

use Illuminate\Support\Facades\Route;
use App\Modules\User\Controllers\UserController;
use App\Modules\Challenge\Controllers\ChallengeController;
use App\Modules\OpenAI\Controllers\OpenAIController;
use App\Modules\Video\Controllers\VideoController;

// Ruta para crear un nuevo usuario
// Método HTTP: POST
// URL: /users
// Acción: Llama al método 'create' del 'UserController'
// Descripción: Esta ruta maneja la creación de un nuevo usuario. 
// Cuando se hace una solicitud POST a /users, se ejecuta el método 'create' del 'UserController'.
Route::post('/users', [UserController::class, 'create']);

// Ruta para leer (listar) usuarios
// Método HTTP: GET
// URL: /users
// Acción: Llama al método 'read' del 'UserController'
// Descripción: Esta ruta maneja la obtención de una lista de usuarios. 
// Cuando se hace una solicitud GET a /users, se ejecuta el método 'read' del 'UserController'.
Route::get('/users', [UserController::class, 'read']);

// Ruta para actualizar un usuario existente
// Método HTTP: PUT
// URL: /users
// Acción: Llama al método 'update' del 'UserController'
// Descripción: Esta ruta maneja la actualización de un usuario existente. 
// Cuando se hace una solicitud PUT a /users, se ejecuta el método 'update' del 'UserController'.
Route::put('/users', [UserController::class, 'update']);

// Ruta para eliminar un usuario
// Método HTTP: DELETE
// URL: /users
// Acción: Llama al método 'delete' del 'UserController'
// Descripción: Esta ruta maneja la eliminación de un usuario. 
// Cuando se hace una solicitud DELETE a /users, se ejecuta el método 'delete' del 'UserController'.
Route::delete('/users', [UserController::class, 'delete']);


Route::post('/challenges', [ChallengeController::class, 'create']);
Route::get('/challenges', [ChallengeController::class, 'read']);
Route::put('/challenges', [ChallengeController::class, 'update']);
Route::delete('/challenges', [ChallengeController::class, 'delete']);

Route::post('/videos', [VideoController::class, 'create']);
Route::get('/videos', [VideoController::class, 'read']);
Route::put('/videos', [VideoController::class, 'update']);
Route::delete('/videos', [VideoController::class, 'delete']);

Route::post('/openAI', [OpenAIController::class, 'create']);