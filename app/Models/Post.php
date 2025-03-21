<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    // Guardar info a la BD
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Crear relacion
    // Un Post pertenece a un usuario
    public function user() {
        return $this->belongsTo(User::class);
    }
    // Un post puede tener muchos comentarios
    public function comentarios() {
        return $this->hasMany(Comentario::class);
    }
}
