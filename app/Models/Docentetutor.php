<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docentetutor extends Model
{
    use HasFactory;
    protected $fillable = ['institucioneducativa_id','personas_id','estado'];
}
