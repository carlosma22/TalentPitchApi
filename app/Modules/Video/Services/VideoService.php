<?php

namespace App\Modules\Video\Services;

use App\Modules\Video\DTOs\VideoCreateRequest;
use App\Modules\Video\DTOs\VideoUpdateRequest;
use App\Modules\Video\Models\Video;
use Exception;

class VideoService
{
    /**
     * Crea un video
     * 
     * @param VideoCreateRequest $request - Objeto de solicitud que contiene los datos necesarios para crear un video
     * @return bool - Retorna true si el video fue creado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la creación
     */
    public function save(VideoCreateRequest $request): bool
    {
        try {
            // Crea un nuevo video con los datos proporcionados en la solicitud
            Video::create($request->input());

            // Retorna true si la creación fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Lista los videos
     * 
     * @return mixed - Retorna los videos paginados o lanza una excepción en caso de error
     * @throws Exception - Lanza una excepción si ocurre un error durante la obtención de videos
     */
    public function get(): mixed
    {
        try {
            // Obtiene una lista paginada de videos, 10 por página
            return Video::paginate(10);
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Actualiza un video
     * 
     * @param VideoUpdateRequest $request - Objeto de solicitud que contiene los datos actualizados del video
     * @return bool - Retorna true si el video fue actualizado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la actualización
     */
    public function edit(VideoUpdateRequest $request): bool
    {
        try {
            // Busca el video por su ID y lanza una excepción si no lo encuentra
            $Video = Video::findOrFail($request->id);

            // Actualiza el video con los nuevos datos proporcionados
            $Video->update($request->input());

            // Retorna true si la actualización fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }

    /**
     * Elimina un video
     * 
     * @param int $id - ID del video a eliminar
     * @return bool - Retorna true si el video fue eliminado exitosamente
     * @throws Exception - Lanza una excepción si ocurre un error durante la eliminación
     */
    public function remove(int $id): bool
    {
        try {
            // Busca el video por su ID y lanza una excepción si no lo encuentra
            $Video = Video::find($id);

            if ($Video) {
                // Elimina el video de la base de datos
                $Video->delete();
            }

            // Retorna true si la eliminación fue exitosa
            return true;
        } catch (Exception $error) {
            // Si ocurre un error, lanza una excepción con el mensaje de error
            throw new Exception($error);
        }
    }
}
