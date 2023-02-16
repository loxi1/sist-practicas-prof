<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Variablevaloracione;
use Illuminate\Http\Request;

class VariablevaloracionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['perfi'] = [1=>'Estudiante',3=>'Docente tutor'];
        $data['criterio'] = [1=>'Persistencia',2=>'Satisfacción',3=>'Percepción'];
        $data['preguntas'] = Variablevaloracione::where('estado',1)->select('id','creterios_evaluacion','perfil','preguntas')->get()->toArray();
        return view('variablevaloracion.index',compact('data'));
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
        $rq = $request->all();
        $rta = ['estado'=>0,'msn'];
        if(!empty($rq))
        {
            $inse['creterios_evaluacion'] = $rq['creterios_evaluacion'];
            $inse['perfil'] = $rq['perfil'];
            $inse['preguntas'] = $rq['preguntas'];

            $id = !empty($rq['idpregunta']) ? $rq['idpregunta'] : "";
            
            if(!empty($id))
            {
                $estado = Variablevaloracione::where('id', $id)->update($inse);
                if($estado)
                    $rta = ['estado'=>1,'mensaje'=>'Actualizo Ok'];
                else
                    $rta['mensaje'] = "No Edito";
            }
            else
            {
                $data = Variablevaloracione::create($inse);
                if(!empty($data->id))
                {
                    $estu['id'] = $data->id;
                    $rta = ['estado'=>1,'mensaje'=>'Guardo Ok'];
                }
                else
                    $rta['mensaje'] = "No Guardo";
            }
        }
        return response()->json($rta);
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
