<?php

namespace App\Modules\Challenge\Models;

use App\Modules\User\Models\User;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Clase Challenge
 *
 * Representa un challenge en la aplicación y maneja la autenticación, 
 * las notificaciones, y las relaciones con otros modelos.
 */
class Challenge extends Authenticatable
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
        'title',
        'description',
        'difficulty',
        'userId',
    ];

    /**
     * Mutador para establecer el valor de 'user_id'.
     *
     * Este mutador permite modificar el valor del atributo 'user_id' 
     * antes de guardarlo en la base de datos. Por ejemplo, podrías modificar 
     * la ruta de la imagen o aplicar alguna transformación antes de almacenarla.
     * 
     * @param mixed $value - El valor que se va a asignar al atributo 'user_id'
     * @return void
     */
    public function setUserIdAttribute(mixed $value): void {
        $this->attributes['user_id'] = $value;
    }

    /**
     * Accesor para obtener el valor de 'user_id'.
     *
     * Este accesor permite modificar el valor del atributo 'user_id' 
     * después de recuperarlo de la base de datos. Por ejemplo, podrías agregar 
     * un prefijo a la URL de la imagen o manejar valores nulos de una forma específica.
     * 
     * @return string|null - El valor del atributo 'user_id' o null si no está definido
     */
    public function getUserIdAttribute(): string|null {
        return $this->attributes['user_id'];
    }

    /**
     * Relación uno a muchos con el modelo Challenge.
     *
     * Esta relación indica que un challenge puede tener muchos desafíos (challenges).
     * Permite acceder a los desafíos asociados a un challenge a través de esta relación.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}