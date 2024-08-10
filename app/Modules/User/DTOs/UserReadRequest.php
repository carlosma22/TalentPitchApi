<?php

namespace App\Modules\User\DTOs;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase UserReadRequest
 *
 * Esta clase se utiliza para validar los datos de la solicitud cuando se intenta leer (listar) usuarios.
 * Extiende `FormRequest` de Laravel, lo que permite aplicar reglas de validación específicas y definir
 * mensajes de error personalizados.
 */
class UserReadRequest extends FormRequest
{
    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * Este método define las reglas de validación para los parámetros de la solicitud, específicamente para el campo `page`.
     * Estas reglas aseguran que el número de página proporcionado sea válido antes de intentar obtener la lista de usuarios.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // El campo 'page' es opcional, pero si se proporciona, debe ser un número entero y debe ser mayor o igual a 1
            'page' => 'integer|min:1',
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
            // Mensajes personalizados para las reglas de validación del campo 'page'
            'page.required' => 'El campo page es requerido',
            'page.integer' => 'El campo page debe ser un número entero',
            'page.min' => 'El campo page debe ser mayor o igual a 1',
        ];
    }
}

