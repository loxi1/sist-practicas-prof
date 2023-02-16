@extends('plantilla.app')
@section('css_contenido')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('backend/plugins/daterangepicker/daterangepicker.css')}}">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="{{asset('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Evaluar Alumno</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
                @if (session('mensaje'))
                <div class="alert alert-success">
                    <div class="alert alert-success">
                        <strong>{{session('mensaje')}}</strong>
                    </div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="display: inline">Lista de Cuestionario</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['route'=>'cuestionarios.store']) !!}
                            <div class="table-responsive">
                                <table id="tb_cuestionarios" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center" colspan="6"><h3>Lea las indicaciónes</h3></th>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <ol>
                                                <li>Crear Usuario</li>
                                                <li>Ingresar todo los datos del formulario (Recuerda tu perfil es estudiante)</li>
                                                <li>Al guardar direcciona al login</li>
                                                <li>Colocar su usuario y clave</li>
                                                <li>Direcciona a la vista del home</li>
                                                <li>Click en el boton <b>Información adicional</b> </li>
                                                <li>Ingresar los campos rqueridos</li>
                                                <li>Al guardar Cierra la sessión</li>
                                                <li>Vuela a ingresar su usuario y password</li>
                                                <li>Muestra mensaje de exito si todo los datos estan correcto</li>
                                                <li>Ir al menu Mis practicas</li>
                                                <li>Se listan las practicas</li>
                                                <li>Click en el boton editar</li>
                                                <li>Direciona al detalle para agregar Sesiones de aprendizaje</li>
                                                <li>Boton evaluar</li>
                                                <li>La auto evaluación de la sessión de aprendizaje</li>
                                                <li></li>
                                            </ol>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $va = 1;
                                        $de = 0.1;
                                    @endphp
                                    @foreach($preguntas as $variable=>$datadime)
                                        <tr>
                                            <td class="text-center" style="width: 60%;"><h4>{{$variable}}</h4></td>
                                            @foreach($cali as $valo)                                        
                                                <td>{{ $valo }}</td>
                                            @endforeach
                                        </tr>
                                        @foreach($datadime as $dime=>$valordime)
                                            <tr>
                                                <td colspan="6"><h5 class="text-center">{{$va}}.- {{$dime}}</h5></td> 
                                            </tr>
                                            @php
                                                $most = $de+$va;
                                            @endphp
                                            @foreach($valordime as $indi=>$valorindicador)
                                                <tr>
                                                    <td colspan="6"><b>{{$most}}.- {{$indi}}</b></td> 
                                                </tr>
                                                @foreach($valorindicador as $idpre=>$pregu)
                                                    <tr>
                                                        <td>{{$pregu}}</td>
                                                        @foreach($cali as $nume)                                            
                                                            <td class="text-center"><input type="radio" name="rta[{{$variable}}][{{$dime}}][{{$indi}}][{{$idpre}}]" value="{{$nume}}"></td>                                            
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                                @php
                                                    $most += $de;
                                                @endphp
                                            @endforeach
                                            @php
                                                $va++;
                                            @endphp
                                        @endforeach
                                        
                                    @endforeach
                                    </tbody>
                                    <tfoot>                                
                                    </tfoot>
                                </table>
                            </div>
                            {!! Form::submit('Guardar Cuestionario',['class'=>'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
</div>
@endsection
@section('js_contenido')
<!-- DataTables  & Plugins -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Page specific script -->
<script src="{{asset('js/main/main.js')}}"></script>
<script>    
    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    })        
</script>
@endsection