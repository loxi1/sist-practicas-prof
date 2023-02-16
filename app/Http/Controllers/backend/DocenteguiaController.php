<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Docenteguia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DocenteguiaController extends Controller
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
     * Guardar Dococente guia
     */
    public function guardar(Request $request, $id)
    {
        $rq = $request->all();
        $idpers = Auth::user()->personas_id;
        $rta = ['estado'=>0,'msn'];
        if(!empty($rq['_idcarrera']) && !empty($idpers))
        {
            $estu = Docenteguia::select('id')->where('personas_id',$idpers)->first();
            $upd['especialidades_id'] = $rq['_idcarrera'];
            if(!empty($estu['id']))
            {
                $estado = Docenteguia::where('id', $estu['id'])->update($upd);
                if($estado)
                    $rta = ['estado'=>1,'mensaje'=>'Actualizo Ok'];
                else
                    $rta['mensaje'] = "No Edito";
            }
            else
            {
                $upd['personas_id'] = $idpers;
                $data = Docenteguia::create($upd);
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
                $user_id = Auth::id();
                User::where('id',$user_id)->update(['flag'=>2]);
            }
        }
        return response()->json($rta);
    }
}
