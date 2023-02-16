<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docenteguia extends Model
{
    use HasFactory;
    protected $fillable = ['especialidades_id','personas_id','estado'];
}
