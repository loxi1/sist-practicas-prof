<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluaciondetalle extends Model
{
    use HasFactory;
    protected $fillable=['valoracioncolaborativas_id','variablevaloraciones_id','evaluaciones_id','estado'];
}
