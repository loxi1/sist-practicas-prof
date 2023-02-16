<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tipo_documento;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\User;
use App\Models\Persona;

class Perfil extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $usuario = User::select('id','personas_id')->where('id',$user_id)->first();
        $persona = [];
        /*if(!empty($usuario['personas_id']))
        {
            $persona = Persona::where('id',$usuario['personas_id'])->first();
        }
         //Editar Registro
         $documentos = ['' => 'Tipo Documento']+Tipo_documento::pluck('tipo_documentos','tipo_documentos_id')->toArray();
         $digitos = Tipo_documento::pluck('digitos','tipo_documentos_id')->toArray();
         $departamentos = ['' => 'SELECCIONE DEPARTAMENTO']+Departamento::pluck('departamentos','id')->toArray();
         $provincias = [];
         $distritos = [];
         if(!empty($persona['departamentos_id']))
         {
             $provincias = ['' => 'SELECCIONE PROVINCIA']+Provincia::where('departamentos_id',$persona['departamentos_id'])->get()->pluck('provincias','id')->toArray();
             if(!empty($persona->provincias_id))
             {
                 $distritos = ['' => 'SELECCIONE DISTRITO']+Distrito::where('provincias_id',$persona['provincias_id'])->get()->pluck('distritos','id')->toArray();
             }
         }
         return view('backend.persona.edit',compact('persona','documentos','digitos','departamentos','provincias','distritos'));    */
         dd($usuario);
     
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
