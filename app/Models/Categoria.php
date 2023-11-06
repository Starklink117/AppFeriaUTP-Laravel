<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','id_division'];

    public function division(){
        return $this->belongsTo(Division::class, 'id_division');
    }

    public function proyectos(){
        return $this->hasMany(Proyecto::class, 'id');
    }

    public function preguntas(){
        return $this->belongsToMany(Pregunta::class);
    }
}
