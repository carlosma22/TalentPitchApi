<?php

namespace App\Modules\User\Models;

use App\Modules\Challenge\Models\Challenge;
use App\Modules\Video\Models\Video;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Clase User
 *
 * Representa un usuario en la aplicación y maneja la autenticación, 
 * las notificaciones, y las relaciones con otros modelos.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Atributos que se pueden asignar en masa.
     * 
     * Define qué atributos del modelo se pueden asignar mediante asignación masiva.
     * Esto ayuda a prevenir vulnerabilidades como la asignación masiva no intencionada.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'imagePath',
    ];

    /**
     * Mutador para establecer el valor de 'image_path'.
     *
     * Este mutador permite modificar el valor del atributo 'image_path' 
     * antes de guardarlo en la base de datos. Por ejemplo, podrías modificar 
     * la ruta de la imagen o aplicar alguna transformación antes de almacenarla.
     * 
     * @param mixed $value - El valor que se va a asignar al atributo 'image_path'
     * @return void
     */
    public function setImagePathAttribute(mixed $value): void {
        $this->attributes['image_path'] = $value;
    }

    /**
     * Accesor para obtener el valor de 'image_path'.
     *
     * Este accesor permite modificar el valor del atributo 'image_path' 
     * después de recuperarlo de la base de datos. Por ejemplo, podrías agregar 
     * un prefijo a la URL de la imagen o manejar valores nulos de una forma específica.
     * 
     * @return string|null - El valor del atributo 'image_path' o null si no está definido
     */
    public function getImagePathAttribute(): string|null {
        return $this->attributes['image_path'];
    }

    /**
     * Relación uno a muchos con el modelo Challenge.
     *
     * Esta relación indica que un usuario puede tener muchos desafíos (challenges).
     * Permite acceder a los desafíos asociados a un usuario a través de esta relación.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }

    /**
     * Relación uno a muchos con el modelo Video.
     *
     * Esta relación indica que un usuario puede tener muchos videos.
     * Permite acceder a los videos asociados a un usuario a través de esta relación.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}