<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Docentetutor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DocentetutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Guardar Docente tutor
     */
    public function guardar(Request $request, $id)
    {
        $rq = $request->all();
        $idpers = Auth::user()->personas_id;
        $rta = ['estado'=>0,'msn'];
        if(!empty($rq['_idescuela']) && !empty($idpers))
        {
            $estu = Docentetutor::select('id')->where('personas_id',$idpers)->first();
            $upd['institucioneducativa_id'] = $rq['_idescuela'];
            if(!empty($estu['id']))
            {
                $estado = Docentetutor::where('id', $estu['id'])->update($upd);
                if($estado)
                    $rta = ['estado'=>1,'mensaje'=>'Actualizo Ok'];
                else
                    $rta['mensaje'] = "No Edito";
            }
            else
            {
                $upd['personas_id'] = $idpers;
                $data = Docentetutor::create($upd);
                if(!empty($data->id))
                {
                    $estu['id'] = $data->id;
                    $rta = ['estado'=>1,'mensaje'=>'Guardo Ok'];
                }
                else
                    $rta['mensaje'] = "No Guardo";
            }
            if(!empty($estu['id']))
            {
                $user_id = Auth::user()->id;;
                User::where('id',$user_id)->update(['flag'=>2]);
            }
        }
        return response()->json($rta);
    }

    public function autocompetartutor(Request $request, $id)
    {
        $rq = $request->all();
        $output = '';

        if(!empty($rq['_key']))
        {
            $sql = $rq['_key'];
            $totor = Docentetutor::leftJoin('personas','docentetutors.personas_id','=','personas.id')
                                    ->selectRaw('docentetutors.id, concat_ws(", ",apellidos, nombres) nombcompleto')
                                    ->where('docentetutors.estado','Activo')
                                    ->where(function ($query) use ($sql) {
                                        $query->where('personas.nombres', 'LIKE', "%$sql%")
                                            ->orWhere('personas.apellidos', 'LIKE', "%$sql%");
                                    })->get()->toArray();
                                    
            if(!empty($totor[0]['id']))
            {
                foreach($totor as $vv)
                {
                    $output .= '<div><a class="suggest-element" data="'.utf8_encode($vv['nombcompleto']).'" id="tutor'.$vv['id'].'" idtutor="'.$vv['id'].'">'.utf8_encode($vv['nombcompleto']).'</a></div>';
                }
            }
        }
        return response()->json(['output'=>$output]);
    }
}
