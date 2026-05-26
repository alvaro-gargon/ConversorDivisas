<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisasFavUsuario extends Model
{
    protected $table      = 'DivisaFavUsuario';
    protected $fillable   = ['id_usuario', 'id_divisa'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}