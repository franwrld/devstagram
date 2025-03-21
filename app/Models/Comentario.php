<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Comentario extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];
    // Relaciones
    // Un Comentario pertenece a un usuario
    public function user() {
        return $this->belongsTo(User::class);
    }
}
