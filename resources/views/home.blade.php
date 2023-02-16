@extends('plantilla.app')
@section('css_contenido')
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido <b>{{Auth::user()->perfil}}</b>: {{Auth::user()->name}}</div>

                <div class="card-body">
                    @if(Auth::user()->flag == "No")
                    <div class="row">
                        <div class="col-8">
                            Para completar Acceder a los menu Tiene que registrar sus datos
                        </div>
                        <div class="col-4">
                            <a href="javascript:void(0);" class="btn btn-block btn-primary" data-toggle="modal" data-target="#info_adicional">Informacion Adicional</a>
                        </div>
                    </div>                        
                    @else
                        Se logueo con exito
                    @endif                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@if(Auth::user()->flag == "No")
<div class="modal fade" id="info_adicional">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Información Adicional <b>{{Auth::user()->perfil}}</b></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_cancha">
                    <div class="row">
                        <div class="col-9">
                    @switch(Auth::user()->perfil)
                        @case('Estudiante')
                            @php
                                $carrera = !empty($adicional['especialidad']) ? $adicional['especialidad'] : [];
                            
                            @endphp
                            <div class="form-group row">
                                {!! Form::label('carrera','Carrera',['for'=>'inputCarrera','class'=>'col-sm-4'])  !!}
                                <div class="col-sm-7">
                                    {!! Form::select('carrera',$carrera,'',['class'=>'form-control']) !!}
                                </div>
                            </div>
                            @break
                        @case('Docente guia')
                            @php
                                $carrera = !empty($adicional['especialidad']) ? $adicional['especialidad'] : [];
                            
                            @endphp
                            <div class="form-group row">
                                {!! Form::label('carrera','Carrera',['for'=>'inputCarrera'])  !!}
                                <div class="col-sm-7">
                                    {!! Form::select('carrera',$carrera,'',['class'=>'form-control']) !!}
                                </div>
                            </div>
                            @break
                        @case('Docente tutor')
                            @php
                                $escuela = !empty($adicional['escuela']) ? $adicional['escuela'] : [];                        
                            @endphp
                            <div class="form-group row">
                                {!! Form::label('escuela','Escuela',['for'=>'inputEscuela'])  !!}
                                <div class="col-sm-7">
                                    {!! Form::select('escuela',$escuela,'',['class'=>'form-control']) !!}
                                </div>
                            </div>
                            @break
                    @endswitch
                        </div>
                        <div class="col-3 align-self-center">
                            <button type="button" class="btn btn-primary btn-block saveinfoadicional">Guardar</button>
                        </div>
                    </div>
                    <input type="hidden" class="hidden" value="">                                                                              
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endif
@endsection
@section('js_contenido')
<!-- SweetAlert2 -->
<script src="{{asset('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
@if(Auth::user()->flag == "No")
    @switch(Auth::user()->perfil)
        @case('Estudiante')
            <script src="{{asset('js/home/estudiante.js')}}"></script>
        @break
        @case('Docente guia')
            <script src="{{asset('js/home/docenteguia.js')}}"></script>
        @break
        @case('Docente tutor')
            <script src="{{asset('js/home/docentetutor.js')}}"></script>
        @break
    @endswitch
<!-- Page specific script -->
<script>
    $(document).on('click','.saveinfoadicional', function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        var rta = validar_adicional()
        if(rta['estado'])
        {
            var send = rta['msn']
            $.ajax({
                type: "POST",
                data: rta['msn'],
                url: '/'+rta['met']+'/1/guardar',
                success: function (response) {
                    var err = (response.estado == 1) ? "success" : "error"

                    Toast.fire({
                        icon: err,
                        title: response.mensaje
                    })

                    if(response.estado)
                        document.getElementById('logout-form').submit();
                }
            });
        }
        else
        {
            Toast.fire({
                icon: 'error',
                title: rta['msn']
            })
        }
    })
</script>    
@endif

@endsection
