<?php

namespace App\Modules\User\DTOs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UserUpdateRequest
 *
 * Esta clase se utiliza para validar los datos de la solicitud cuando se intenta actualizar un usuario.
 * Extiende `FormRequest` de Laravel, lo que permite aplicar reglas de validación específicas y definir
 * mensajes de error personalizados.
 */
class UserUpdateRequest extends FormRequest
{
    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * Este método define las reglas de validación para los datos de la solicitud, asegurando que todos los
     * campos necesarios para actualizar un usuario sean válidos antes de que se procese la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // El campo 'id' es requerido, debe ser un número entero y debe ser mayor o igual a 1
            'id' => 'required|integer|min:1',

            // El campo 'name' es requerido, debe ser una cadena de texto y no puede exceder 255 caracteres
            'name' => 'required|string|max:255',

            // El campo 'email' es requerido, debe ser una cadena de texto con formato de correo electrónico válido,
            // y no puede exceder 255 caracteres
            'email' => 'required|string|email|max:255',

            // El campo 'imagePath' es opcional, pero si se proporciona, debe ser una cadena de texto
            // y no puede exceder 255 caracteres
            'imagePath' => 'string|max:255',
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

            // Mensajes personalizados para las reglas de validación del campo 'name'
            'name.required' => 'El campo name es requerido',
            'name.string' => 'El campo name debe ser alfanumérico',
            'name.max' => 'El campo name debe tener máximo 255 caracteres',

            // Mensajes personalizados para las reglas de validación del campo 'email'
            'email.required' => 'El campo email es requerido',
            'email.string' => 'El campo email debe ser alfanumérico',
            'email.email' => 'El campo email no tiene el formato correcto',
            'email.max' => 'El campo email debe tener máximo 255 caracteres',

            // Mensajes personalizados para las reglas de validación del campo 'imagePath'
            'imagePath.string' => 'El campo imagePath debe ser alfanumérico',
            'imagePath.max' => 'El campo imagePath debe tener máximo 255 caracteres',
        ];
    }
}