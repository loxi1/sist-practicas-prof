<?php

namespace Database\Factories;

use App\Models\Cuestionariodetalle;
use App\Models\Evaluaciondetalle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cuestionariodetalle>
 */
class CuestionariodetalleFactory extends Factory
{
    protected $model = Evaluaciondetalle::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'variable'=>'Aplicativo web',
            'dimension'=>'Software',
            'indicadores'=>'Servicios',
            'cuestionarios_id'=>'1',
            'preguntas_id'=>'',
            'rta'=>''
        ];
    }
}
