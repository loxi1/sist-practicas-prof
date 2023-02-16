<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Docentetutor;
use App\Models\Evaluacion;
use App\Models\Evaluaciondetalle;
use App\Models\Plandepractica;
use App\Models\Practicaestudiantes;
use App\Models\Valoracioncolaborativa;
use App\Models\Variablevaloracione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluarpracticasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessapre = [];
        $docente = Docentetutor::where('personas_id',Auth::user()->personas_id)->first();
        if(!empty($docente['id']))
        {
            $sessapre = $misp = Practicaestudiantes::leftJoin('plandepracticas','practicaestudiantes.plandepracticas_id','=','plandepracticas.id')
                                ->leftJoin('practicas','plandepracticas.practicas_id','=','practicas.id')
                                ->leftJoin('especialiadads','practicas.carreras_id','=','especialiadads.id')
                                ->leftJoin('ciclos','practicas.ciclos_id','=','ciclos.id')
                                ->leftJoin('evaluacions','practicaestudiantes.id','=','evaluacions.practicaestudiantes_id')
                                ->selectRaw('practicaestudiantes.id,ciclos,especialidades,titulo,evaluacions.id as idevaluacion,practicaestudiantes.observacion,practicaestudiantes.fecha_ingreso,practicaestudiantes.fecha_salida,evaluacion_tutor,(select CONCAT_WS(", " ,personas.apellidos,personas.nombres) from docentetutors LEFT JOIN personas on docentetutors.personas_id=personas.id where docentetutors.id=practicas.docentetutores_id limit 1) as complnombres')
                                ->where('practicas.docentetutores_id',$docente['id'])
                                ->where('practicas.estado','<>',3)
                                ->orderByDesc('practicaestudiantes.created_at')
                                ->get()->toArray();
        } 
        return view('backend.practicaevaluar.index',compact('sessapre'));
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
     * Registrar evaluación alumno.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rq = $request->all();
        if(!empty($rq['rta'] && !empty($rq['idpracticaestudiante'])))
        {
            $ins['practicaestudiantes_id'] = $rq['idpracticaestudiante'];
            $data = Evaluacion::create($ins);
            $ideva = !empty($data->id) ? $data->id : false;
            if($ideva)
            {
                $ins = array();
                $ins['evaluaciones_id'] = $ideva;
                foreach($rq['rta'] as $preg=>$valor)
                {
                    $inse = $ins;
                    $inse['valoracioncolaborativas_id'] = $valor;
                    $inse['variablevaloraciones_id'] = $preg;
                    $data = Evaluaciondetalle::create($inse);
                }
            }
            
            if(!empty($data->id))
            {
                $upd['tutor_user_id'] = Auth::user()->id;
                $upd['evaluacion_tutor'] = 2;
                $upd['fecha_evaluacion_tutor'] = date("Y-m-d H:i:s");
                $estado = Practicaestudiantes::where('id', $rq['idpracticaestudiante'])->update($upd);
            }
        }
        if(!empty($ideva))
            return redirect()->route('evaluarpracticas.show',$ideva)->with('mensaje','Registro de manera Correcta');
        
        return redirect()->route('evaluarpracticas.show',$rq['idpracticaestudiante'])->with('mensaje','Registro de manera Correcta');
    }

    /**
     * Ver evaluación estudiante.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $valoraciones = Valoracioncolaborativa::pluck('valoracion','id')->toArray();
        $txtvaloracion = '';
        if(!empty($valoraciones))
        {
            foreach ($valoraciones as $vv) {
                $txtvaloracion .= '<td>'.$vv.'</td>';
            }
        }
        $varibales = Variablevaloracione::where('estado','Activo')
                                        ->where("perfil", Auth::user()->perfil)
                                        ->select('id','creterios_evaluacion','perfil','preguntas','estado')
                                        ->orderBy('creterios_evaluacion')
                                        ->orderBy('preguntas')
                                        ->get()->toArray();
        
        $preguntas = [];
        if(!empty($varibales[0]['id']))
        {
            foreach($varibales as $ky=>$vv)
            {
                $preguntas[$vv['creterios_evaluacion']][$vv['id']] = $vv['preguntas'];
            }
        }

        $detall = Evaluaciondetalle::where('evaluaciones_id',$id)->get()->toArray();
        $detalle = [];
        if(!empty($detall[0]['id']))
        {
            foreach($detall as $vv)
            {
                $detalle[$vv['variablevaloraciones_id']][$vv['valoracioncolaborativas_id']] = $vv['id'];
            }
        }
       // dd($detalle)                ;
        return view('backend.practicaevaluar.ver',compact('valoraciones','preguntas','txtvaloracion','detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valoraciones = Valoracioncolaborativa::pluck('valoracion','id')->toArray();
        $txtvaloracion = '';
        if(!empty($valoraciones))
        {
            foreach ($valoraciones as $vv) {
                $txtvaloracion .= '<td>'.$vv.'</td>';
            }
        }
        $varibales = Variablevaloracione::where('estado','Activo')
                                        ->where("perfil", Auth::user()->perfil)
                                        ->select('id','creterios_evaluacion','perfil','preguntas','estado')
                                        ->orderBy('creterios_evaluacion')
                                        ->orderBy('preguntas')
                                        ->get()->toArray();
        
        $preguntas = [];
        if(!empty($varibales[0]['id']))
        {
            foreach($varibales as $ky=>$vv)
            {
                $preguntas[$vv['creterios_evaluacion']][$vv['id']] = $vv['preguntas'];
            }
        }
                            
        return view('backend.practicaevaluar.editar',compact('valoraciones','preguntas','txtvaloracion','id'));
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
