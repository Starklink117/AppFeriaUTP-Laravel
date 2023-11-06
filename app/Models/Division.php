<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function categorias(){
        return $this->hasMany(Categoria::class, 'id');
        //una division tiene muchas carreras
    }

    public function usuarios()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function participantes(){
        return $this->hasMany(Participante::class, 'id');
    }
}
