<?php

namespace App\Modules\Challenge\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Challenge\DTOs\ChallengeCreateRequest;
use App\Modules\Challenge\DTOs\ChallengeDeleteRequest;
use App\Modules\Challenge\DTOs\ChallengeReadRequest;
use App\Modules\Challenge\DTOs\ChallengeUpdateRequest;
use App\Modules\Challenge\Services\ChallengeService;
use App\Utils\CommonResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class ChallengeController extends Controller
{
    // Propiedad privada que almacena una instancia de ChallengeService
    private ChallengeService $challengeService;

    // Constructor de la clase que inicializa el servicio de challenge
    public function __construct(ChallengeService $challengeService)
    {
        $this->challengeService = $challengeService;
    }

    /**
     * Método para crear un nuevo challenge
     * 
     * @param ChallengeCreateRequest $request - Objeto de solicitud que contiene los datos necesarios para crear un challenge
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function create(ChallengeCreateRequest $request): JsonResponse
    {
        try {
            // Llama al servicio para guardar los datos del challenge
            $this->challengeService->save($request);

            // Devuelve una respuesta JSON indicando que el desafío fue creado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Desafío creado',
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
     * Método para leer o listar challenges
     * 
     * @param ChallengeGetRequest $request - Objeto de solicitud que podría contener filtros o parámetros de búsqueda
     * @return JsonResponse - Respuesta en formato JSON con la lista de challenges o un mensaje de error
     */
    public function read(ChallengeReadRequest $request): JsonResponse
    {
        try {
            // Llama al servicio para obtener la lista de challenges
            $data = $this->challengeService->get();

            // Devuelve una respuesta JSON con la lista de challenges
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Listado de challenges',
                'data' => $data, // Incluye la lista de challenges en la respuesta
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
     * Método para actualizar un desafío existente
     * 
     * @param ChallengeUpdateRequest $request - Objeto de solicitud que contiene los datos actualizados del challenge
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function update(ChallengeUpdateRequest $request)
    {
        try {
            // Llama al servicio para actualizar los datos del challenge
            $this->challengeService->edit($request);
            
            // Devuelve una respuesta JSON indicando que el desafío fue actualizado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Desafío actualizado',
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
     * Método para eliminar un desafío existente
     * 
     * @param ChallengeDeleteRequest $request - Objeto de solicitud que contiene el ID del desafío a eliminar
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function delete(ChallengeDeleteRequest $request)
    {
        try {
            // Llama al servicio para eliminar el desafío por su ID
            $this->challengeService->remove($request->id);
            
            // Devuelve una respuesta JSON indicando que el desafío fue eliminado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Desafío eliminado',
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