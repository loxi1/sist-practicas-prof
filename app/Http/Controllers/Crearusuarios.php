<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Persona;
use App\Http\Requests\CrearusuariosRequest;
use Illuminate\Support\Facades\Hash;

class Crearusuarios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.usuario.crearusuario');
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
        //Para guardar los registros
        $rq = $request->all();

        if(!empty($rq['email']))
            $estado = User::where('email', $rq['email'])->first();
        if(!empty($estado['id']))
            return redirect()->route('/crearusuarios.index',$rq)->with('mensaje','Ya existe correo');
        else
        {
            $data['nombres'] = $rq['name'];
            $data['apellidos'] = $rq['apellidos'];
            $persona = Persona::create($data);
            if(!empty($persona->id))
            {
                $data = ['name'=>$rq['name'],'apellidos'=>$rq['apellidos'],'perfil'=>$rq['perfil'],'email'=>$rq['email'],'password'=>Hash::make($rq['password']),'personas_id'=>$persona->id];
                $usuario = User::create($data);
            }
        }
        
        return redirect()->route('login')->with('mensaje','Puede loguearse');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rta = ['estado'=>0,'mensaje'=>'Error'];
        if(!empty($id))
        {
            $estado = User::where('email', $id)->first();
            if($estado['id'])
                $rta['mensaje'] = "Ya existe";
            else
                $rta = ['estado'=>1,'mensaje'=>'Datos Correctos'];
        }
        return response()->json($rta);
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

    /***
     * Validar Usuario
    */
    public function validarcorreo(Request $request, $id)
    {
        $rq = $request->all();
        $rta = ['estado'=>0,'mensaje'=>'Error'];
        if(!empty($rq['_correo']))
        {
            $estado = User::where('email', $rq['_correo'])->first();
            if(!empty($estado['id']))
                $rta['mensaje'] = "Ya existe";
            else
                $rta = ['estado'=>1,'mensaje'=>'Datos Correctos'];
        }
        return response()->json($rta);

    }

    public function registrar(CrearusuariosRequest $request)
    {
        $user = User::create($request->validate());
    }
}
