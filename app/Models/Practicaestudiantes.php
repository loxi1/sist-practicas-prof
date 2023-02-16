<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practicaestudiantes extends Model
{
    use HasFactory;
    protected $fillable=['titulo','fecha_ingreso','fecha_salida','estudiantes_user_id','tutor_user_id','plandepracticas_id','plandepracticas_id','observacion','estado'];
}
