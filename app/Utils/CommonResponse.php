<?php

namespace App\Utils;

/**
 * Clase CommonResponse
 *
 * Esta clase se utiliza para estructurar una respuesta común que puede ser retornada 
 * en las solicitudes HTTP. Es una forma de encapsular el estado, el mensaje y los 
 * datos que se devuelven al cliente, lo que facilita la estandarización de las respuestas.
 */
class CommonResponse
{
    /**
     * Estado de la respuesta.
     * 
     * Indica si la operación fue exitosa (true) o si hubo un error (false).
     *
     * @var bool
     */
    public bool $status;

    /**
     * Mensaje de la respuesta.
     * 
     * Proporciona información adicional sobre el resultado de la operación, como 
     * "Usuario creado" o un mensaje de error en caso de fallo.
     *
     * @var string
     */
    public string $message;

    /**
     * Datos adicionales de la respuesta.
     * 
     * Contiene cualquier dato adicional que se quiera retornar al cliente, como 
     * un objeto de usuario, una lista de elementos, etc. Puede ser nulo si no hay 
     * datos adicionales que devolver.
     *
     * @var mixed
     */
    public mixed $data;

    /**
     * Constructor de la clase CommonResponse.
     *
     * Inicializa una nueva instancia de CommonResponse con los argumentos proporcionados.
     *
     * @param mixed $args - Un array asociativo que contiene 'status', 'message' y opcionalmente 'data'.
     */
    public function __construct(mixed $args)
    {
        // Asigna el estado de la respuesta (true o false)
        $this->status = $args['status'];

        // Asigna el mensaje de la respuesta
        $this->message = $args['message'];

        // Asigna los datos adicionales si están presentes, de lo contrario se establece como null
        $this->data = $args['data'] ?? null;
    }
}

