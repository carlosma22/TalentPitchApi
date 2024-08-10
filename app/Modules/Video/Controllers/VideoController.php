<?php

namespace App\Modules\Video\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Video\DTOs\VideoCreateRequest;
use App\Modules\Video\DTOs\VideoDeleteRequest;
use App\Modules\Video\DTOs\VideoReadRequest;
use App\Modules\Video\DTOs\VideoUpdateRequest;
use App\Modules\Video\Services\VideoService;
use App\Utils\CommonResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class VideoController extends Controller
{
    // Propiedad privada que almacena una instancia de VideoService
    private VideoService $videoService;

    // Constructor de la clase que inicializa el servicio de video
    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
     * Método para crear un nuevo Video
     * 
     * @param VideoCreateRequest $request - Objeto de solicitud que contiene los datos necesarios para crear un Video
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function create(VideoCreateRequest $request): JsonResponse
    {
        try {
            // Llama al servicio para guardar los datos del Video
            $this->videoService->save($request);

            // Devuelve una respuesta JSON indicando que el Video fue creado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Video creado',
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
     * Método para leer o listar Videos
     * 
     * @param VideoGetRequest $request - Objeto de solicitud que podría contener filtros o parámetros de búsqueda
     * @return JsonResponse - Respuesta en formato JSON con la lista de Videos o un mensaje de error
     */
    public function read(VideoReadRequest $request): JsonResponse
    {
        try {
            // Llama al servicio para obtener la lista de Videos
            $data = $this->videoService->get();

            // Devuelve una respuesta JSON con la lista de Videos
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Listado de videos',
                'data' => $data, // Incluye la lista de Videos en la respuesta
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
     * Método para actualizar un Video existente
     * 
     * @param VideoUpdateRequest $request - Objeto de solicitud que contiene los datos actualizados del Video
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function update(VideoUpdateRequest $request)
    {
        try {
            // Llama al servicio para actualizar los datos del Video
            $this->videoService->edit($request);
            
            // Devuelve una respuesta JSON indicando que el Video fue actualizado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Video actualizado',
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
     * Método para eliminar un Video existente
     * 
     * @param VideoDeleteRequest $request - Objeto de solicitud que contiene el ID del Video a eliminar
     * @return JsonResponse - Respuesta en formato JSON indicando el éxito o el error de la operación
     */
    public function delete(VideoDeleteRequest $request)
    {
        try {
            // Llama al servicio para eliminar el Video por su ID            
            $this->videoService->remove($request->id);
            
            // Devuelve una respuesta JSON indicando que el Video fue eliminado exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Video eliminado',
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