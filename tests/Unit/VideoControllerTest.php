<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Modules\Video\Controllers\VideoController;
use App\Modules\Video\DTOs\VideoCreateRequest;
use App\Modules\Video\DTOs\VideoDeleteRequest;
use App\Modules\Video\DTOs\VideoReadRequest;
use App\Modules\Video\DTOs\VideoUpdateRequest;
use App\Modules\Video\Services\VideoService;
use Exception;
use Illuminate\Http\JsonResponse;

class VideoControllerTest extends TestCase
{
  protected mixed $videoServiceMock;
  protected $videoController;

  protected function setUp(): void
  {
    parent::setUp();

    // Crear un mock de VideoService
    $this->videoServiceMock = Mockery::mock(VideoService::class);

    // Inyectar el mock en el VideoController    
    $this->videoController = new VideoController($this->videoServiceMock);
  }

  protected function tearDown(): void
  {
    Mockery::close(); // Asegura que Mockery cierre correctamente
    parent::tearDown(); // Llama al tearDown del padre para limpiar otros recursos
  }

  public function testCreateVideoSuccess()
  {
    // Crear un mock de VideoCreateRequest
    $request = Mockery::mock(VideoCreateRequest::class);

    // Simular el método save en VideoService
    $this->videoServiceMock->shouldReceive('save')->once()->with($request)->andReturn(true);

    // Ejecutar el método create
    $response = $this->videoController->create($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Video creado', $response->getData()->message);
  }

  public function testCreateVideoFailure()
  {
    // Crear un mock de VideoCreateRequest
    $request = Mockery::mock(VideoCreateRequest::class);

    // Simular una excepción en el método save
    $this->videoServiceMock->shouldReceive('save')->once()->with($request)->andThrow(new Exception('Error creating video'));

    // Ejecutar el método create
    $response = $this->videoController->create($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error creating video', $response->getData()->message);
  }

  public function testReadVideosSuccess()
  {
    // Crear un mock de VideoReadRequest
    $request = Mockery::mock(VideoReadRequest::class);

    // Simular el método get en VideoService
    $this->videoServiceMock->shouldReceive('get')->once()->andReturn(['video1', 'video2']);

    // Ejecutar el método read
    $response = $this->videoController->read($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Listado de videos', $response->getData()->message);
    $this->assertEquals(['video1', 'video2'], $response->getData()->data);
  }

  public function testReadVideosFailure()
  {
    // Crear un mock de VideoReadRequest
    $request = Mockery::mock(VideoReadRequest::class);

    // Simular una excepción en el método get
    $this->videoServiceMock->shouldReceive('get')->once()->andThrow(new Exception('Error reading videos'));

    // Ejecutar el método read
    $response = $this->videoController->read($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error reading videos', $response->getData()->message);
  }

  public function testUpdateVideoSuccess()
  {
    // Crear un mock de VideoUpdateRequest
    $request = Mockery::mock(VideoUpdateRequest::class);

    // Simular el método edit en VideoService
    $this->videoServiceMock->shouldReceive('edit')->once()->with($request)->andReturn(true);

    // Ejecutar el método update
    $response = $this->videoController->update($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Video actualizado', $response->getData()->message);
  }

  public function testUpdateVideoFailure()
  {
    // Crear un mock de VideoUpdateRequest
    $request = Mockery::mock(VideoUpdateRequest::class);

    // Simular una excepción en el método edit
    $this->videoServiceMock->shouldReceive('edit')->once()->with($request)->andThrow(new Exception('Error updating video'));

    // Ejecutar el método update
    $response = $this->videoController->update($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error updating video', $response->getData()->message);
  }

  public function testDeleteVideoSuccess()
  {
    // Crear un mock de VideoDeleteRequest
    $request = Mockery::mock(VideoDeleteRequest::class);
    $request->id = 1;

    // Simular el método remove en VideoService
    $this->videoServiceMock->shouldReceive('remove')->once()->with($request->id)->andReturn(true);

    // Ejecutar el método delete
    $response = $this->videoController->delete($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Video eliminado', $response->getData()->message);
  }

  public function testDeleteVideoFailure()
  {
    // Crear un mock de VideoDeleteRequest
    $request = Mockery::mock(VideoDeleteRequest::class);
    $request->id = 1;

    // Simular una excepción en el método remove
    $this->videoServiceMock->shouldReceive('remove')->once()->with($request->id)->andThrow(new Exception('Error deleting video'));

    // Ejecutar el método delete
    $response = $this->videoController->delete($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error deleting video', $response->getData()->message);
  }
}
