<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    // protected $fillable = ['nombre', 'apellidopaterno', 'apellidomaterno', 'matricula', 'sexo', 'id_proyecto', 'id_division'];

    protected $guarded = ['id'];
    public function proyecto(){
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    public function division(){
        return $this->belongsTo(Division::class, 'id_division');
    }
}
