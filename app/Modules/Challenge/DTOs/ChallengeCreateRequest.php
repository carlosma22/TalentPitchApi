<?php

namespace App\Modules\Challenge\DTOs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChallengeCreateRequest
 *
 * Esta clase se encarga de validar los datos de la solicitud cuando se crea un nuevo challenge.
 * Extiende `FormRequest` de Laravel, lo que permite aplicar reglas de validación específicas
 * y definir mensajes de error personalizados.
 */
class ChallengeCreateRequest extends FormRequest
{
    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * Este método define las reglas de validación para los campos de la solicitud.
     * Estas reglas aseguran que los datos proporcionados cumplan con los requisitos
     * antes de ser procesados.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'difficulty' => 'required|integer|min:1',
            'userId' => 'required|integer|min:1',
        ];
    }

    /**
     * Obtiene los mensajes de error para las reglas de validación definidas.
     *
     * Este método permite personalizar los mensajes de error que se mostrarán si los datos
     * no cumplen con las reglas de validación definidas en el método `rules`.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'El campo title es requerido',
            'title.string' => 'El campo title debe ser alfanumérico',
            'title.max' => 'El campo title debe tener máximo 255 caracteres',

            'description.required' => 'El campo description es requerido',

            'difficulty.required' => 'El campo difficulty es requerido',
            'difficulty.integer' => 'El campo difficulty debe ser entero',
            'difficulty.min' => 'El campo difficulty debe ser mayor o igual a 1',
            
            'userId.required' => 'El campo userId es requerido',
            'userId.integer' => 'El campo userId debe ser entero',
            'userId.min' => 'El campo userId debe ser mayor o igual a 1',
        ];
    }
}

