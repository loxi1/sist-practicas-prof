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
                    <h1>Evaluar practicas</h1>
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
                        <h3 class="card-title" style="display: inline">Lista de evaluar practicas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_evaluarpracticas" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Carrera</th>
                                    <th>Ciclo</th>
                                    <th>Sessión Aprendizaje</th>
                                    <th>Estudiante</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Fecha Salida</th>
                                    <th>Observación</th>
                                    <th>Estado Evaluación</th>
                                    <th>Asistencia</th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($sessapre as $ky=>$vv)
                                    <tr>
                                        <td>{{$ky+1}}</td>
                                        <td>{{$vv['especialidades']}}</td>
                                        <td>{{$vv['ciclos']}}</td>
                                        <td>{{$vv['titulo']}}</td>
                                        <td>{{$vv['complnombres']}}</td>
                                        <td>{{$vv['fecha_ingreso']}}</td>
                                        <td>{{$vv['fecha_salida']}}</td>
                                        <td>{{$vv['observacion']}}</td>
                                        <td class="text-center">
                                        @if($vv['evaluacion_tutor']=="Pendiente")
                                            <a href="{{route('evaluarpracticas.edit',$vv['id'])}}" target="_blank" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> {{$vv['evaluacion_tutor']}}</a>
                                        @else 
                                            <a href="{{route('evaluarpracticas.show',$vv['idevaluacion'])}}" target="_blank" class="btn btn-sm btn-default"><i class="fas fa-eye"></i></a>
                                        @endif
                                        </td>
                                        <td class="text-center">
                                            <button data-toggle="modal" data-target="#asistenciapractica" class="btn btn-sm btn-info"><i class="fas fa-calendar"></i></button>
                                        </td>
                                    </tr>
                            @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Carrera</th>
                                    <th>Ciclo</th>
                                    <th>Sessión Aprendizaje</th>
                                    <th>Estudiante</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Fecha Salida</th>
                                    <th>Observación</th>
                                    <th>Estado Evaluación</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    
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
    @php
        $carrera = !empty($data['carreras']) ? $data['carreras'] : [];
        $ciclo = !empty($data['ciclos']) ? $data['ciclos'] : [];
    @endphp
    <!--- Crear Practica -->
    <div class="modal fade" id="asistenciapractica">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Practica</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_practica">                       
                        <div class="form-group row">
                            <label for="fechai" class="col-sm-5 col-form-label">Hora Ingreso</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker7" data-target-input="nearest">
                                        <input type="text" id="fechai" class="form-control datetimepicker-input" data-target="#datetimepicker7"/>
                                        <div class="input-group-append" data-target="#datetimepicker7" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaf" class="col-sm-5 col-form-label">Hora Salida</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker8" data-target-input="nearest">
                                        <input type="text" id="fechaf" class="form-control datetimepicker-input" data-target="#datetimepicker8"/>
                                        <div class="input-group-append" data-target="#datetimepicker8" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtestudiante" class="col-sm-5 col-form-label">Observación</label>
                            <div class="col-sm-7">
                                <textarea type="text" name="txtobjetivo" class="form-control" id="txtobjetivo" rows="3"></textarea>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <button type="button" class="btn btn-primary btn-block savepractica">Guardar</button>
                                <input type="hidden" value="" name="practica_id" id="practica_id">
                            </div>
                        </div>                                                                              
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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
    $(function () {        
        $('#datetimepicker7').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#datetimepicker8').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });        
        $("#datetimepicker7").on("change.datetimepicker", function (e) {
            $('#datetimepicker8').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker8").on("change.datetimepicker", function (e) {
            $('#datetimepicker7').datetimepicker('maxDate', e.date);
        });        
    })

    $("#tb_evaluarpracticas").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        language: {url: "{{asset('backend/pages/tables/es.json')}}"},
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tb_evaluarpracticas_wrapper .col-md-6:eq(0)');

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