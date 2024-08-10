<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Modules\User\Controllers\UserController;
use App\Modules\User\DTOs\UserCreateRequest;
use App\Modules\User\DTOs\UserDeleteRequest;
use App\Modules\User\DTOs\UserReadRequest;
use App\Modules\User\DTOs\UserUpdateRequest;
use App\Modules\User\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;

class UserControllerTest extends TestCase
{
  protected mixed $userServiceMock;
  protected $userController;

  protected function setUp(): void
  {
    parent::setUp();

    // Crear un mock de UserService
    $this->userServiceMock = Mockery::mock(UserService::class);

    // Inyectar el mock en el UserController
    $this->userController = new UserController($this->userServiceMock);
  }

  protected function tearDown(): void
  {
    Mockery::close(); // Asegura que Mockery cierre correctamente
    parent::tearDown(); // Llama al tearDown del padre para limpiar otros recursos
  }

  public function testCreateUserSuccess()
  {
    // Crear un mock de UserCreateRequest
    $request = Mockery::mock(UserCreateRequest::class);

    // Simular el método save en UserService
    $this->userServiceMock->shouldReceive('save')->once()->with($request)->andReturn(true);

    // Ejecutar el método create
    $response = $this->userController->create($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Usuario creado', $response->getData()->message);
  }

  public function testCreateUserFailure()
  {
    // Crear un mock de UserCreateRequest
    $request = Mockery::mock(UserCreateRequest::class);

    // Simular una excepción en el método save
    $this->userServiceMock->shouldReceive('save')->once()->with($request)->andThrow(new Exception('Error creating user'));

    // Ejecutar el método create
    $response = $this->userController->create($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error creating user', $response->getData()->message);
  }

  public function testReadUsersSuccess()
  {
    // Crear un mock de UserReadRequest
    $request = Mockery::mock(UserReadRequest::class);

    // Simular el método get en UserService
    $this->userServiceMock->shouldReceive('get')->once()->andReturn(['user1', 'user2']);

    // Ejecutar el método read
    $response = $this->userController->read($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Listado de usuarios', $response->getData()->message);
    $this->assertEquals(['user1', 'user2'], $response->getData()->data);
  }

  public function testReadUsersFailure()
  {
    // Crear un mock de UserReadRequest
    $request = Mockery::mock(UserReadRequest::class);

    // Simular una excepción en el método get
    $this->userServiceMock->shouldReceive('get')->once()->andThrow(new Exception('Error reading users'));

    // Ejecutar el método read
    $response = $this->userController->read($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error reading users', $response->getData()->message);
  }

  public function testUpdateUserSuccess()
  {
    // Crear un mock de UserUpdateRequest
    $request = Mockery::mock(UserUpdateRequest::class);

    // Simular el método edit en UserService
    $this->userServiceMock->shouldReceive('edit')->once()->with($request)->andReturn(true);

    // Ejecutar el método update
    $response = $this->userController->update($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Usuario actualizado', $response->getData()->message);
  }

  public function testUpdateUserFailure()
  {
    // Crear un mock de UserUpdateRequest
    $request = Mockery::mock(UserUpdateRequest::class);

    // Simular una excepción en el método edit
    $this->userServiceMock->shouldReceive('edit')->once()->with($request)->andThrow(new Exception('Error updating user'));

    // Ejecutar el método update
    $response = $this->userController->update($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error updating user', $response->getData()->message);
  }

  public function testDeleteUserSuccess()
  {
    // Crear un mock de UserDeleteRequest
    $request = Mockery::mock(UserDeleteRequest::class);
    $request->id = 1;

    // Simular el método remove en UserService
    $this->userServiceMock->shouldReceive('remove')->once()->with($request->id)->andReturn(true);

    // Ejecutar el método delete
    $response = $this->userController->delete($request);

    // Afirmar que la respuesta es un JsonResponse con un código 201
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(201, $response->getStatusCode());
    $this->assertEquals(true, $response->getData()->status);
    $this->assertEquals('Usuario eliminado', $response->getData()->message);
  }

  public function testDeleteUserFailure()
  {
    // Crear un mock de UserDeleteRequest
    $request = Mockery::mock(UserDeleteRequest::class);
    $request->id = 1;

    // Simular una excepción en el método remove
    $this->userServiceMock->shouldReceive('remove')->once()->with($request->id)->andThrow(new Exception('Error deleting user'));

    // Ejecutar el método delete
    $response = $this->userController->delete($request);

    // Afirmar que la respuesta es un JsonResponse con un código 500
    $this->assertInstanceOf(JsonResponse::class, $response);
    $this->assertEquals(500, $response->getStatusCode());
    $this->assertEquals(false, $response->getData()->status);
    $this->assertEquals('Error deleting user', $response->getData()->message);
  }
}
