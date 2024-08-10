<?php

namespace App\Modules\Challenge\DTOs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ChallengeUpdateRequest
 *
 * Esta clase se utiliza para validar los datos de la solicitud cuando se intenta actualizar un challenge.
 * Extiende `FormRequest` de Laravel, lo que permite aplicar reglas de validación específicas y definir
 * mensajes de error personalizados.
 */
class ChallengeUpdateRequest extends FormRequest
{
    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * Este método define las reglas de validación para los datos de la solicitud, asegurando que todos los
     * campos necesarios para actualizar un challenge sean válidos antes de que se procese la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|min:1',
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
            'id.required' => 'El campo id es requerido',
            'id.integer' => 'El campo id debe ser un número entero',
            'id.min' => 'El campo id debe ser mayor o igual a 1',

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
