<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuestionariodetalle extends Model
{
    use HasFactory;
    protected $fillable = ['variable','dimension','indicadores','cuestionarios_id','preguntas_id','rta'];
}
