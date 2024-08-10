<?php

namespace App\Modules\User\DTOs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UserDeleteRequest
 *
 * Esta clase se utiliza para validar los datos de la solicitud cuando se intenta eliminar un usuario.
 * Extiende `FormRequest` de Laravel, lo que permite aplicar reglas de validación específicas y definir
 * mensajes de error personalizados.
 */
class UserDeleteRequest extends FormRequest
{
    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * Este método define las reglas de validación para el campo `id` de la solicitud.
     * Estas reglas aseguran que el ID proporcionado sea válido antes de intentar eliminar
     * un usuario en la base de datos.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // El campo 'id' es requerido, debe ser un número entero y debe ser mayor o igual a 1
            'id' => 'required|integer|min:1',
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
            // Mensajes personalizados para las reglas de validación del campo 'id'
            'id.required' => 'El campo id es requerido',
            'id.integer' => 'El campo id debe ser un número entero',
            'id.min' => 'El campo id debe ser mayor o igual a 1',
        ];
    }
}
