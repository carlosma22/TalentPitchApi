<?php

namespace App\Modules\Challenge\Services;

use App\Modules\Challenge\DTOs\ChallengeCreateRequest;
use App\Modules\Challenge\DTOs\ChallengeUpdateRequest;
use App\Modules\Challenge\Models\Challenge;
use Exception;

class ChallengeService
{
    /**
     * Crea un challenge
     * 
     * @param ChallengeCreateRequest $request - Objeto de solicitud que contiene los datos necesarios para crear un challenge
     * @return bool - Retorna true si el challenge fue creado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la creación
     */
    public function save(ChallengeCreateRequest $request): bool
    {
        try {
            // Crea un nuevo challenge con los datos proporcionados en la solicitud
            Challenge::create($request->input());

            // Retorna true si la creación fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Lista los challenges
     * 
     * @return mixed - Retorna los challenges paginados o lanza una excepción en caso de error
     * @throws Exception - Lanza una excepción si ocurre un error durante la obtención de challenges
     */
    public function get(): mixed
    {
        try {
            // Obtiene una lista paginada de challenges, 10 por página
            return Challenge::paginate(10);
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Actualiza un challenge
     * 
     * @param ChallengeUpdateRequest $request - Objeto de solicitud que contiene los datos actualizados del challenge
     * @return bool - Retorna true si el challenge fue actualizado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la actualización
     */
    public function edit(ChallengeUpdateRequest $request): bool
    {
        try {
            // Busca el challenge por su ID y lanza una excepción si no lo encuentra
            $Challenge = Challenge::findOrFail($request->id);

            // Actualiza el challenge con los nuevos datos proporcionados
            $Challenge->update($request->input());

            // Retorna true si la actualización fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Elimina un challenge
     * 
     * @param int $id - ID del challenge a eliminar
     * @return bool - Retorna true si el challenge fue eliminado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la eliminación
     */
    public function remove(int $id): bool
    {
        try {
            // Busca el challenge por su ID y lanza una excepción si no lo encuentra
            $Challenge = Challenge::find($id);

            if ($Challenge) {
                // Elimina el challenge de la base de datos
                $Challenge->delete();
            }

            // Retorna true si la eliminación fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }
}

