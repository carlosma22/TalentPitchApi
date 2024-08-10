<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\DTOs\UserCreateRequest;
use App\Modules\User\DTOs\UserDeleteRequest;
use App\Modules\User\DTOs\UserReadRequest;
use App\Modules\User\DTOs\UserUpdateRequest;
use App\Modules\User\Services\UserService;
use App\Utils\CommonResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    // Propiedad privada que almacena una instancia de UserService
    private UserService $userService;

    // Constructor de la clase que inicializa el servicio de usuario
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Método para crear un nuevo usuario
     * 
     * @param UserCreateRequest $request - Objeto de solicitud que contiene los datos necesarios para crear un usuario
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function create(UserCreateRequest $request): JsonResponse
    {
        try {
            // Llama al servicio para guardar los datos del usuario
            $this->userService->save($request);

            // Devuelve una respuesta JSON indicando que el usuario fue creado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Usuario creado',
            ]), 201); // Código de estado 201 indica que el recurso fue creado exitosamente
        } catch (Exception $error) {
            // En caso de error, devuelve una respuesta JSON con el mensaje de error
            return response()->json(new CommonResponse([
                'status' => false,
                'message' => $error->getMessage(), // Mensaje de error capturado
            ]), 500); // Código de estado 500 indica un error en el servidor
        }
    }

    /**
     * Método para leer o listar usuarios
     * 
     * @param UserGetRequest $request - Objeto de solicitud que podría contener filtros o parámetros de búsqueda
     * @return JsonResponse - Respuesta en formato JSON con la lista de usuarios o un mensaje de error
     */
    public function read(UserReadRequest $request): JsonResponse
    {
        try {
            // Llama al servicio para obtener la lista de usuarios
            $data = $this->userService->get();

            // Devuelve una respuesta JSON con la lista de usuarios
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Listado de usuarios',
                'data' => $data, // Incluye la lista de usuarios en la respuesta
            ]), 201);
        } catch (Exception $error) {
            // En caso de error, devuelve una respuesta JSON con el mensaje de error
            return response()->json(new CommonResponse([
                'status' => false,
                'message' => $error->getMessage(), // Mensaje de error capturado
            ]), 500);
        }
    }

    /**
     * Método para actualizar un usuario existente
     * 
     * @param UserUpdateRequest $request - Objeto de solicitud que contiene los datos actualizados del usuario
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function update(UserUpdateRequest $request)
    {
        try {
            // Llama al servicio para actualizar los datos del usuario
            $this->userService->edit($request);
            
            // Devuelve una respuesta JSON indicando que el usuario fue actualizado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Usuario actualizado',
            ]), 201);
        } catch (Exception $error) {
            // En caso de error, devuelve una respuesta JSON con el mensaje de error
            return response()->json(new CommonResponse([
                'status' => false,
                'message' => $error->getMessage(), // Mensaje de error capturado
            ]), 500);
        }
    }

    /**
     * Método para eliminar un usuario existente
     * 
     * @param UserDeleteRequest $request - Objeto de solicitud que contiene el ID del usuario a eliminar
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function delete(UserDeleteRequest $request)
    {
        try {
            // Llama al servicio para eliminar el usuario por su ID
            $this->userService->remove($request->id);
            
            // Devuelve una respuesta JSON indicando que el usuario fue eliminado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Usuario eliminado',
            ]), 201);
        } catch (Exception $error) {
            // En caso de error, devuelve una respuesta JSON con el mensaje de error
            return response()->json(new CommonResponse([
                'status' => false,
                'message' => $error->getMessage(), // Mensaje de error capturado
            ]), 500);
        }
    }
}