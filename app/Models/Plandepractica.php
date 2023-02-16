<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plandepractica extends Model
{
    use HasFactory;
    protected $fillable=['practicas_id','fecha_inicio','fecha_fin','fecha_ingreso','fecha_salida','calificacion','evaluacion_tutor','evaluacion_estudiante','guias_user_id','tutor_user_id','observacion','estudiante_user_id','estado'];
    
    
    
    
    

}
