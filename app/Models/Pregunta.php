<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion'];

    public function categorias(){
        return $this->belongsToMany(Categoria::class);
    }
}
