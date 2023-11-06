<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    // protected $fillable = ['nombre', 'descripcion', 'impacto', 'objetivo', 'metodologia', 'patente', 'id_categoria', 'id_grupo', 'id_usuario'];

    protected $guarded = ['id'];
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function grupo(){
        return $this->belongsTo(Grupo::class, 'id_grupo');
    }

    public function participantes(){
        return $this->hasMany(Participante::class, 'id');
    }

    public function caificacion(){
        return $this->hasOne(Calificacion::class, 'id');
    }

    public function jurados(){
        return $this->belongsToMany(Jurado::class);
    }
    
}
