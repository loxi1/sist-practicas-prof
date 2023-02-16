<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plandepractica;
use App\Models\Estudiante;
use App\Models\Practicaestudiantes;
use Illuminate\Support\Facades\Auth;

class MispracticasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $estud = Estudiante::where('personas_id',Auth::user()->personas_id)->first();
        $mispr = [];
        if(!empty($estud['id']))
        {
            $misp = Practicaestudiantes::leftJoin('plandepracticas','practicaestudiantes.plandepracticas_id','=','plandepracticas.id')
                                ->leftJoin('practicas','plandepracticas.practicas_id','=','practicas.id')
                                ->leftJoin('especialiadads','practicas.carreras_id','=','especialiadads.id')
                                ->leftJoin('ciclos','practicas.ciclos_id','=','ciclos.id')
                                ->leftJoin('evaluacions','practicaestudiantes.id','=','evaluacions.practicaestudiantes_id')
                                ->selectRaw('practicaestudiantes.id,ciclos,especialidades,titulo,evaluacions.id as idevaluacion,practicaestudiantes.observacion,practicaestudiantes.fecha_ingreso,practicaestudiantes.fecha_salida,evaluacion_tutor,(select CONCAT_WS(", " ,personas.apellidos,personas.nombres) from docentetutors LEFT JOIN personas on docentetutors.personas_id=personas.id where docentetutors.id=practicas.docentetutores_id limit 1) as complnombres')
                                ->where('practicas.estudiantes_id',$estud['id'])
                                ->where('practicas.estado','<>',3)
                                ->orderByDesc('practicaestudiantes.created_at')
                                ->get()->toArray();
        }        
        return view('backend.mipractica.index',compact('mispr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
