<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Usuario extends Model
{

    // protected $table='usuarios'; Esto no hace falta ponerlo porque el nombre de la clase y de la tabla son casi iguales (laravel interpreta nombreClase + s. Y en minusculas)

    protected $fillable = [
        'nombre_usuario',
        'imagen_usuario',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function divisasFavoritas()
    {
        return $this->hasMany(DivisasFavUsuario::class, 'id_usuario');
    }
}
