<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    // protected $fillable = ['calificacion_1', 'calificacion_2', 'calificacion_3', 'promedio', 'id_proyecto', 'id_categoria'];

    protected $guarded = ['id'];
    
    public function proyecto(){
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
