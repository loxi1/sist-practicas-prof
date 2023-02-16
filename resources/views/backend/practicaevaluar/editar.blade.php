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
                        {!! Form::open(['route'=>'evaluarpracticas.store']) !!}
                            <div class="table-responsive">
                                <table id="tb_evaluarpracticas" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th class="text-center" colspan="7"><h3>Ficha de Evaluación de las practicas profesionales efectuada en el lugar de la practica</h3></th>
                                    </tr>
                                    <tr>
                                        <td colspan="7">En esta ficha se presentan distintos criterios relacionados con las actividades de la práctica profesional realizada en el lugar de práctica. La escala de valoración es cualitativa (Siempre, Casi siempre, Algunas veces, Casi Nunca, Nunca), en algún caso, el evaluador puede considerar que el criterio es "no valorable" o "no aplicable", bien porque no se haya tenido ocasión de observar esta acción o porque no sea aplicable a la realidad del lugar de práctica. En ese caso, corresponde señalar la columna N/A. De la misma forma, pueden incluirse observaciones, aclaraciones o recomendaciones generales que complementen el proceso evaluativo de pertinencia, satisfacción y percepción.</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($preguntas as $criterio=>$preg)
                                        <tr>
                                            <td class="text-center" style="width: 60%;"><h4>{{$criterio}}</h4></td>
                                            @foreach($valoraciones as $valo)                                        
                                                <td>{{ $valo }}</td>
                                            @endforeach
                                        </tr>
                                        @foreach($preg as $idpre=>$value)
                                            <tr idprec="{{$idpre}}">
                                                <td>{{ $value }}</td>
                                                @foreach($valoraciones as $idcriterio=>$valo)                                            
                                                    <td class="text-center"><input type="radio" name="rta[{{$idpre}}]" value="{{$idcriterio}}"></td>                                            
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                    <tfoot>                                
                                    </tfoot>
                                </table>
                            </div>
                            {!! Form::submit('Guardar Persona',['class'=>'btn btn-primary']) !!}
                            <input type="hidden" name="idpracticaestudiante" value="{{$id}}">
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