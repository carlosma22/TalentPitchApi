<?php

namespace App\Modules\User\Services;

use App\Modules\User\DTOs\UserCreateRequest;
use App\Modules\User\DTOs\UserUpdateRequest;
use App\Modules\User\Models\User;
use Exception;

class UserService
{
    /**
     * Crea un usuario
     * 
     * @param UserCreateRequest $request - Objeto de solicitud que contiene los datos necesarios para crear un usuario
     * @return bool - Retorna true si el usuario fue creado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la creación
     */
    public function save(UserCreateRequest $request): bool
    {
        try {
            // Crea un nuevo usuario con los datos proporcionados en la solicitud
            User::create($request->input());

            // Retorna true si la creación fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Lista los usuarios
     * 
     * @return mixed - Retorna los usuarios paginados o lanza una excepción en caso de error
     * @throws Exception - Lanza una excepción si ocurre un error durante la obtención de usuarios
     */
    public function get(): mixed
    {
        try {
            // Obtiene una lista paginada de usuarios, 10 por página
            return User::paginate(10);
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Actualiza un usuario
     * 
     * @param UserUpdateRequest $request - Objeto de solicitud que contiene los datos actualizados del usuario
     * @return bool - Retorna true si el usuario fue actualizado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la actualización
     */
    public function edit(UserUpdateRequest $request): bool
    {
        try {
            // Busca el usuario por su ID y lanza una excepción si no lo encuentra
            $user = User::findOrFail($request->id);

            // Actualiza el usuario con los nuevos datos proporcionados
            $user->update($request->input());

            // Retorna true si la actualización fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Elimina un usuario
     * 
     * @param int $id - ID del usuario a eliminar
     * @return bool - Retorna true si el usuario fue eliminado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la eliminación
     */
    public function remove(int $id): bool
    {
        try {
            // Busca el usuario por su ID y lanza una excepción si no lo encuentra
            $user = User::find($id);

            if ($user) {
                // Elimina el usuario de la base de datos
                $user->delete();
            }

            // Retorna true si la eliminación fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }
}

