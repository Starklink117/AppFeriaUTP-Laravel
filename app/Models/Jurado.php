<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurado extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 

    public function proyectos(){
        return $this->belongsToMany(Proyecto::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
