<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Balotariopreguntas;
use App\Models\Cuestionario;
use App\Models\Cuestionariodetalle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $balo = Balotariopreguntas::where('estado',1)->get()->toArray();
        $cali = [1,2,3,4,5];
        $preguntas = [];
        if(!empty($balo))
        {
            foreach($balo as $vv)
            {
                $preguntas[$vv['variable']][$vv['dimension']][$vv['indicadores']][$vv['id']] = $vv['preguntas'];
            }
        }

        $i = 2;
        while($i<46)
        {
            $sql = "INSERT INTO cuestionariodetalles (variable, dimension, indicadores, cuestionarios_id, preguntas_id, rta) SELECT variablex, dimensionx, indicadoresx, ".$i.",preguntas_idx,rtax FROM pruebadetalle";
                    $rta = DB::select( DB::raw($sql) );
            $i++;
        }
        
        return view('backend.curestionario.index',compact('preguntas','cali'));
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
        if(!empty($rq['rta']))
        {
            $rtas = $rq['rta'];
            $data = Cuestionario::create();
            
            if(!empty($data->id))
            {
                $ideva = $data->id;
                $ins['cuestionarios_id'] = $data->id;
                foreach($rtas as $vari=>$datavari)
                {
                    foreach($datavari as $dime=>$datadime)
                    {
                        foreach($datadime as $indi=>$dataindi)
                        {
                            foreach($dataindi as $idpregu=>$valo)
                            {
                                $inse = $ins;
                                $inse['variable'] = $vari;
                                $inse['dimension'] = $dime;
                                $inse['indicadores'] = $indi;
                                $inse['preguntas_id'] = $idpregu;
                                $inse['rta'] = $valo;
                                $gua = Cuestionariodetalle::create($inse);
                            }
                        }
                        
                    }
                }
            }    
        }

        if(!empty($ideva) && !empty($gua->id))
            return redirect()->route('cuestionarios.show',$ideva)->with('mensaje','Registro de manera Correcta');
    
        return redirect()->route('cuestionarios.index')->with('mensaje','No guardao');
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
