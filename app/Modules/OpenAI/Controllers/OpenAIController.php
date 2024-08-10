<?php

namespace App\Modules\OpenAI\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\OpenAI\Services\OpenAIService;
use App\Utils\CommonResponse;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Controlador para manejar las solicitudes relacionadas con OpenAI.
 * 
 * Esta clase se encarga de recibir solicitudes HTTP y gestionar la creación de registros utilizando el servicio de OpenAI.
 */
class OpenAIController extends Controller
{
    /**
     * @var OpenAIService $openAIService
     * Propiedad privada que almacena una instancia de OpenAIService.
     */
    private OpenAIService $openAIService;

    /**
     * Constructor de la clase OpenAIController.
     * 
     * Inicializa el servicio de OpenAI mediante inyección de dependencias.
     * 
     * @param OpenAIService $openAIService Servicio para interactuar con OpenAI.
     */
    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    /**
     * Maneja la creación de registros utilizando el servicio de OpenAI.
     * 
     * Este método llama al servicio para insertar datos y devuelve una respuesta JSON indicando el éxito o fallo de la operación.
     * 
     * @return JsonResponse Respuesta JSON que contiene el estado de la operación, un mensaje y los datos creados.
     */
    public function create(): JsonResponse
    {
        try {
            // Llama al servicio para guardar los datos del challenge
            $this->openAIService->insertData();

            // Devuelve una respuesta JSON indicando que los registros fueron creados exitosamente
            return response()->json(new CommonResponse([
                'status' => true,
                'message' => 'Registros creados',
            ]), 201); // Código de estado 201 indica que el recurso fue creado exitosamente
        } catch (Exception $error) {
            // En caso de error, devuelve una respuesta JSON con el mensaje de error
            return response()->json(new CommonResponse([
                'status' => false,
                'message' => $error->getMessage(), // Mensaje de error capturado
            ]), 500); // Código de estado 500 indica un error en el servidor
        }
    }
}
