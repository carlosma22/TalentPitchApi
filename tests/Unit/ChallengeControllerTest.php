<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Modules\Challenge\Controllers\ChallengeController;
use App\Modules\Challenge\DTOs\ChallengeCreateRequest;
use App\Modules\Challenge\DTOs\ChallengeDeleteRequest;
use App\Modules\Challenge\DTOs\ChallengeReadRequest;
use App\Modules\Challenge\DTOs\ChallengeUpdateRequest;
use App\Modules\Challenge\Services\ChallengeService;
use Exception;
use Illuminate\Http\JsonResponse;

class ChallengeControllerTest extends TestCase
{
  protected mixed $challengeServiceMock;
  protected $challengeController;

  protected function setUp(): void
  {
    parent::setUp();

    // Crear un mock de ChallengeService
    $this->challengeServiceMock = Mockery::mock(ChallengeService::class);

    // Inyectar el mock en el ChallengeController
    $this->challengeController = new ChallengeController($this->challengeServiceMock);
  }

  protected function tearDown(): void
  {
    Mockery::close(); // Asegura que Mockery cierre correctamente
    parent::tearDown(); // Llama al tearDown del padre para limpiar otros recursos
  }

  public function testCreateChallengeSuccess()
  {
    // Crear un mock de ChallengeCreateRequest
    $request = Mockery::mock(ChallengeCreateRequest::class);

    // Simular el método save en ChallengeService
    $this->challengeServiceMock->shouldReceive('save')->once()->with($request)->andReturn(true);

    // Ejecutar el método create
    $response = $this->challengeController->create($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Desafío creado', $response->getData()->message);
  }

  public function testCreateChallengeFailure()
  {
    // Crear un mock de ChallengeCreateRequest
    $request = Mockery::mock(ChallengeCreateRequest::class);

    // Simular una excepción en el método save
    $this->challengeServiceMock->shouldReceive('save')->once()->with($request)->andThrow(new Exception('Error creating challenge'));

    // Ejecutar el método create
    $response = $this->challengeController->create($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error creating challenge', $response->getData()->message);
  }

  public function testReadChallengesSuccess()
  {
    // Crear un mock de ChallengeReadRequest
    $request = Mockery::mock(ChallengeReadRequest::class);

    // Simular el método get en ChallengeService
    $this->challengeServiceMock->shouldReceive('get')->once()->andReturn(['challenge1', 'challenge2']);

    // Ejecutar el método read
    $response = $this->challengeController->read($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Listado de challenges', $response->getData()->message);
    $this->assertEquals(['challenge1', 'challenge2'], $response->getData()->data);
  }

  public function testReadChallengesFailure()
  {
    // Crear un mock de ChallengeReadRequest
    $request = Mockery::mock(ChallengeReadRequest::class);

    // Simular una excepción en el método get
    $this->challengeServiceMock->shouldReceive('get')->once()->andThrow(new Exception('Error reading challenges'));

    // Ejecutar el método read
    $response = $this->challengeController->read($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error reading challenges', $response->getData()->message);
  }

  public function testUpdateChallengeSuccess()
  {
    // Crear un mock de ChallengeUpdateRequest
    $request = Mockery::mock(ChallengeUpdateRequest::class);

    // Simular el método edit en ChallengeService
    $this->challengeServiceMock->shouldReceive('edit')->once()->with($request)->andReturn(true);

    // Ejecutar el método update
    $response = $this->challengeController->update($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Desafío actualizado', $response->getData()->message);
  }

  public function testUpdateChallengeFailure()
  {
    // Crear un mock de ChallengeUpdateRequest
    $request = Mockery::mock(ChallengeUpdateRequest::class);

    // Simular una excepción en el método edit
    $this->challengeServiceMock->shouldReceive('edit')->once()->with($request)->andThrow(new Exception('Error updating challenge'));

    // Ejecutar el método update
    $response = $this->challengeController->update($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error updating challenge', $response->getData()->message);
  }

  public function testDeleteChallengeSuccess()
  {
    // Crear un mock de ChallengeDeleteRequest
    $request = Mockery::mock(ChallengeDeleteRequest::class);
    $request->id = 1;

    // Simular el método remove en ChallengeService
    $this->challengeServiceMock->shouldReceive('remove')->once()->with($request->id)->andReturn(true);

    // Ejecutar el método delete
    $response = $this->challengeController->delete($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Desafío eliminado', $response->getData()->message);
  }

  public function testDeleteChallengeFailure()
  {
    // Crear un mock de ChallengeDeleteRequest
    $request = Mockery::mock(ChallengeDeleteRequest::class);
    $request->id = 1;

    // Simular una excepción en el método remove
    $this->challengeServiceMock->shouldReceive('remove')->once()->with($request->id)->andThrow(new Exception('Error deleting challenge'));

    // Ejecutar el método delete
    $response = $this->challengeController->delete($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error deleting challenge', $response->getData()->message);
  }
}
