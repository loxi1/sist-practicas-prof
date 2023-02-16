<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Docenteguia;
use App\Models\Docentetutor;
use App\Models\Especialiadad;
use App\Models\Estudiante;
use App\Models\Intitucioneducativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Persona;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $adicional = [];
        if(Auth::user()->flag=="No")
        {
            $idpers = Auth::user()->personas_id;
            switch(Auth::user()->perfil)
            {
                case 'Estudiante':
                    $adicional['all_escuela'] = Intitucioneducativa::pluck('nombre','id')->toArray();
                    $adicional['all_ciclo'] = Ciclo::pluck('ciclos','id')->toArray();
                    $adicional['especialidad'] = Especialiadad::pluck('especialidades','id')->toArray();
                    $adicional['estudiante'] = Estudiante::select('especialidades_id', 'id')->where('personas_id',$idpers);
                    break;
                case 'Docente tutor':
                    $adicional['escuela'] = Intitucioneducativa::pluck('nombre','id')->toArray();
                    $adicional['docentetutor'] = Docentetutor ::select('id','institucioneducativa_id')->where('personas_id',$idpers);
                    break;
                case 'Docente guia':
                    $adicional['docenteguia'] = Docenteguia::select('id','especialidades_id')->where('personas_id',$idpers);
                    $adicional['especialidad'] = Especialiadad::pluck('especialidades','id')->toArray();
                break;
            }
        }
        return view('home',compact('adicional'));
    }
}
