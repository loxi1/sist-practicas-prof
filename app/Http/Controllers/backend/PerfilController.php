<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Persona;
use App\Models\Tipo_documento;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Ciclo;
use App\Models\Intitucioneducativa;
use App\Models\Estudiante;
use App\Models\Docenteguia;
use App\Models\Docentetutor;
use App\Models\Especialiadad;

class PerfilController extends Controller
{
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
        $adicional = [];
        if(!empty($usuario['personas_id']))
        {
            $persona = Persona::where('id',$usuario['personas_id'])->first();
            
            switch(Auth::perfil())
            {
                case 'Estudiante':
                    $adicional['all_escuela'] = Intitucioneducativa::pluck('nombre','id')->toArray();
                    $adicional['all_ciclo'] = Ciclo::pluck('ciclos','id')->toArray();
                    $adicional['all_especialidad'] = Especialiadad::pluck('especialidad','id')->toArray();
                    $adicional['estudiante'] = Estudiante::select('especialidades_id', 'id')->where('personas_id',$usuario['personas_id']);
                    break;
                case 'Docente tutor':
                    $adicional['all_escuela'] = Intitucioneducativa::pluck('nombre','id')->toArray();
                    $adicional['docentetutor'] = Docentetutor::select('id','institucioneducativa_id')->where('personas_id',$usuario['personas_id']);
                    break;
                case 'Docente guia':
                    $adicional['docenteguia'] = Docenteguia::select('id','especialidades_id')->where('personas_id',$usuario['personas_id']);
                    $adicional['all_especialidad'] = Especialiadad::pluck('especialidad','id')->toArray();
                    break;
            }
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
         
         return view('backend.persona.edit',compact('persona','documentos','digitos','departamentos','provincias','distritos'));   
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
        $request->validate(
            ['nombres'=>'required',
            'apellidos'=>'required']
        );
        $persona = Persona::create($request->all());
        return redirect()->route('perfil.edit',$persona)->with('mensaje','Registro de manera Correcta');
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
    public function update(Request $request, Persona $persona)
    {
        //Lllevar a la vista
        $request->validate(
            ['nombres'=>'required',
            'apellidos'=>'required']
        );
        $persona->update($request->all());

        return redirect()->route('perfil.index',$persona)->with('mensaje','Actualizo de manera Correcta');
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

    public function obtenerprovincia($id)
    {
        $provincias = Provincia::where('departamentos_id',$id)->get();
        return response()->json(['rta'=>$provincias]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function obtenerdistrito($id)
    {
        $distritos = Distrito::where('provincias_id',$id)->get();
        return response()->json(['rta'=>$distritos]);
    }
}
