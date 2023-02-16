<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intitucioneducativa extends Model
{
    use HasFactory;
    protected $fillable=['nombre','numero','direccion','estado'];
}
