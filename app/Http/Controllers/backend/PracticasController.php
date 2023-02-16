<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;
use App\Models\Docenteguia;
use App\Models\Especialiadad;
use App\Models\Plandepractica;
use App\Models\Practica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PracticasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $docente = Docenteguia::where('personas_id',Auth::user()->personas_id)->first();
        $data['carreras'] = Especialiadad::pluck('especialidades','id')->toArray();
        $data['ciclos'] = Ciclo::pluck('ciclos','id')->toArray();
        $data['practicas'] = Practica::leftJoin('especialiadads','practicas.carreras_id','=','especialiadads.id')
                                ->leftJoin('ciclos','practicas.ciclos_id','=','ciclos.id')
                                ->leftJoin('docentetutors','practicas.docentetutores_id','=','docentetutors.id')
                                ->leftJoin('estudiantes','practicas.estudiantes_id','=','estudiantes.id')
                                ->selectRaw('practicas.id,ciclos,especialidades,calificacion,practicas.cantidad_horas,fecha_inicio,fecha_fin,estadopractica, (select concat_ws(", ",personas.apellidos,personas.nombres) nombrestudiante from personas where personas.id = estudiantes.personas_id limit 1) as complestud, (select concat_ws(", ",personas.apellidos,personas.nombres) nombrestudiante from personas where personas.id = docentetutors.personas_id limit 1) as compltutor')
                                ->where('practicas.docenteguias_id',$docente['id'])
                                ->where('practicas.estado',1)
                                ->orderByDesc('practicas.created_at')
                                ->get()->toArray();
        
        return view('backend.practicas.index',compact('data'));
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

    /**
     * Guardar Practicas
     */

    public function savepracticas(Request $request, $id)
    {
        $rq = $request->all();
        $rta = ['estado'=>0,'msn'];
        $docente = Docenteguia::where('personas_id',Auth::user()->personas_id)->first();

        $pract = Practica::select('id')
                            ->where('estado',1)
                            ->where('estudiantes_id',$rq['_estudiantes_id'])
                            ->where('docentetutores_id',$rq['_docentetutores_id'])
                            ->where('carreras_id',$rq['_carreras_id'])
                            ->where('ciclos_id',$rq['_ciclos_id'])->first();
        $inse = [];
        $inse['competencia'] = $rq['_competencia'];
        $inse['estudiantes_id'] = $rq['_estudiantes_id'];
        $inse['docentetutores_id'] = $rq['_docentetutores_id'];
        $inse['carreras_id'] = $rq['_carreras_id'];
        $inse['ciclos_id'] = $rq['_ciclos_id'];
        $inse['cantidad_horas'] = $rq['_cantidad_horas'];
        $inse['fecha_inicio'] = $rq['_fechai'];
        $inse['fecha_fin'] = $rq['_fechaf'];
        $inse['docenteguias_id'] = $docente['id'];
        $inse['guias_user_id'] = Auth::user()->id;

        if(!empty($pract['id']))
        {
            $estado = Practica::where('id', $pract['id'])->update($inse);
            if($estado)
                $rta = ['estado'=>1,'mensaje'=>'Actualizo Ok'];
            else
                $rta['mensaje'] = "No Edito";
        }
        else
        {
            $data = Practica::create($inse);
            if(!empty($data->id))
            {
                $estu['id'] = $data->id;
                $rta = ['estado'=>1,'mensaje'=>'Guardo Ok'];
            }
            else
                $rta['mensaje'] = "No Guardo";
        }
        return response()->json($rta);
    }

    /**
     * Guardar Cronograma
     */

    public function savecronopracticas(Request $request, $id)
    {
        $rq = $request->all();
        $rta = ['estado'=>0,'msn'];
        if(!empty($rq['_fecha']) && !empty($rq['_idpractica']))
        {
            $in['guias_user_id'] = Auth::user()->id;
            $in['practicas_id'] = $rq['_idpractica'];
            foreach($rq['_fecha'] as $vv)
            {
                $inse = $in;
                $inse['fecha_inicio'] = $vv;
                $data = Plandepractica::create($inse);
            }

            if(!empty($data->id))
            {
                $estu['id'] = $data->id;
                $rta = ['estado'=>1,'mensaje'=>'Guardo Ok'];
            }
            else
                $rta['mensaje'] = "No Guardo";
        }
        return response()->json($rta);
    }
}
