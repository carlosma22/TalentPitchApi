<?php

namespace App\Modules\OpenAI\Services;

use App\Modules\Challenge\Models\Challenge;
use App\Modules\User\Models\User;
use App\Modules\Video\Models\Video;
use Illuminate\Support\Facades\Http;
use Exception;

/**
 * Servicio para interactuar con la API de OpenAI.
 * 
 * Esta clase proporciona métodos para generar contenido usando OpenAI, 
 * así como para insertar datos de usuarios, desafíos y videos en la base de datos.
 */
class OpenAIService
{
    /**
     * @var string $apiKey
     * Clave de API para autenticar las solicitudes a OpenAI.
     */
    private $apiKey;

    /**
     * @var string $apiUrl
     * URL de la API de OpenAI.
     */
    private $apiUrl;

    /**
     * @var string $apiModel
     * Modelo de OpenAI a utilizar para generar contenido.
     */
    private $apiModel;

    /**
     * Constructor de la clase OpenAIService.
     * 
     * Inicializa las propiedades de configuración utilizando variables de entorno.
     */
    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->apiUrl = env('OPENAI_API_URL');
        $this->apiModel = env('OPENAI_API_MODEL');
    }

    /**
     * Genera contenido utilizando la API de OpenAI.
     * 
     * Envía una solicitud a OpenAI con el texto proporcionado y devuelve el contenido generado.
     * 
     * @param string $text Texto de entrada para la generación de contenido.
     * @return string|null Contenido generado por OpenAI o null en caso de fallo.
     * @throws Exception Si se produce un error durante la solicitud.
     */
    public function generateContent($text)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post($this->apiUrl, [
                'model' => $this->apiModel,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $text,
                    ],
                ],
                'max_tokens' => 100,
                "top_p" => 1,
            ]);

            if ($response->successful()) {
                return $response->json('choices')[0]['message']['content'];
            }

            return null;
        } catch (Exception $error) {
            throw new Exception($error);
        }
    }

    /**
     * Inserta datos relacionados con usuarios, desafíos y videos en la base de datos.
     * 
     * Este método coordina la inserción de datos llamando a los métodos específicos de cada entidad.
     * 
     * @return mixed Los datos insertados o true si se completó la inserción.
     * @throws Exception Si se produce un error durante la inserción.
     */
    public function insertData(): bool
    {
        try {
            $user = $this->insertUser();

            if ($user) {
                $this->insertChallenge();
                $this->insertVideo();
            }

            return true;
        } catch (Exception $error) {
            throw new Exception($error);
        }
    }

    /**
     * Inserta un usuario en la base de datos generando datos aleatorios mediante OpenAI.
     * 
     * Genera un nombre, email y ruta de imagen de usuario aleatorios y los inserta en la base de datos.
     * Si ya existe un usuario con el mismo email, intenta generar otro.
     * 
     * @return mixed Los datos del usuario insertado o true si se completó la inserción.
     * @throws Exception Si se produce un error durante la inserción.
     */
    public function insertUser(): mixed
    {
        try {
            $text = '
                Generar los sgtes datos para un usuario aleatorios en formato json: 
                    un name, un email y un imagePath
            ';
            $data = $this->generateContent($text);
            
            if ($data) {
                $saveData = json_decode($data, true);
                $user = User::where('email', $saveData['email'])->first();

                if (!$user) {
                    return User::create($saveData);
                } else {
                    return $this->insertUser();
                }
            }
        } catch (Exception $error) {
            throw new Exception($error);
        }
    }

    /**
     * Inserta un desafío en la base de datos generando datos aleatorios mediante OpenAI.
     * 
     * Genera un título, descripción y nivel de dificultad aleatorios para un desafío y los inserta en la base de datos.
     * 
     * @return bool true si la inserción fue exitosa.
     * @throws Exception Si se produce un error durante la inserción.
     */
    public function insertChallenge(): bool
    {
        try {
            $text = '
                Generar los sgtes datos aleatorios para un desafío en formato json: 
                    un title, una description y una dificultad (entero)
            ';
            $data = $this->generateContent($text);

            if ($data) {
                $saveData = json_decode($data, true);
                $saveData['userId'] = User::inRandomOrder()->value('id');
                Challenge::create($saveData);
            }

            return true;
        } catch (Exception $error) {
            throw new Exception($error);
        }
    }

    /**
     * Inserta un video en la base de datos generando datos aleatorios mediante OpenAI.
     * 
     * Genera un título, descripción y URL aleatorios para un video y los inserta en la base de datos.
     * 
     * @return bool true si la inserción fue exitosa.
     * @throws Exception Si se produce un error durante la inserción.
     */
    public function insertVideo(): bool
    {
        try {
            $text = '
                Generar los sgtes datos aleatorios para un video en formato json: 
                    un title, una description y una url
            ';
            $data = $this->generateContent($text);

            if ($data) {
                $saveData = json_decode($data, true);
                $saveData['userId'] = User::inRandomOrder()->value('id');
                Video::create($saveData);
            }

            return true;
        } catch (Exception $error) {
            throw new Exception($error);
        }
    }
}