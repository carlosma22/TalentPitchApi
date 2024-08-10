<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\OpenAI\Controllers\OpenAIController;
use App\Modules\OpenAI\Services\OpenAIService;
use Mockery;
use Illuminate\Http\JsonResponse;
use Exception;

class OpenAIControllerTest extends TestCase
{
    protected mixed $openAIServiceMock;
    protected $openAIController;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un mock de OpenAIService
        $this->openAIServiceMock = Mockery::mock(OpenAIService::class);

        // Inyectar el mock en el OpenAIController
        $this->openAIController = new OpenAIController($this->openAIServiceMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testCreateSuccess()
    {
        // Simular una llamada exitosa al servicio OpenAIService
        $this->openAIServiceMock
            ->shouldReceive('insertData')
            ->once()
            ->andReturn(true);

        // Ejecutar el método create del controlador
        $response = $this->openAIController->create();

        // Afirmar que la respuesta es un JsonResponse con un código 201
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(201, $response->getStatusCode());

        // Afirmar que los datos en la respuesta son correctos
        $responseData = $response->getData();
        $this->assertEquals(true, $responseData->status);
        $this->assertEquals('Registros creados', $responseData->message);
    }

    public function testCreateFailure()
    {
        // Simular una excepción en el método insertData del servicio OpenAIService
        $this->openAIServiceMock
            ->shouldReceive('insertData')
            ->once()
            ->andThrow(new Exception('Error creating records'));

        // Ejecutar el método create del controlador
        $response = $this->openAIController->create();

        // Afirmar que la respuesta es un JsonResponse con un código 500
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(500, $response->getStatusCode());

        // Afirmar que los datos en la respuesta son correctos
        $responseData = $response->getData();
        $this->assertEquals(false, $responseData->status);
        $this->assertEquals('Error creating records', $responseData->message);
    }
}
