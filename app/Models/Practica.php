<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;
    protected $fillable=['competencia','fecha_inicio','fecha_fin','cantidad_horas','calificacion','carreras_id','estadopractica','ciclos_id','estudiantes_id','docenteguias_id','docentetutores_id','guias_user_id','estado'];
}
