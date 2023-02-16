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
                    <h1>Variable de valoraciones</h1>
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
                        <h3 class="card-title" style="display: inline">Lista de variables</h3>
                        <button class="btn btn-sm btn-primary float-right nuevapregunta" data-toggle="modal" data-target="#nuevapregunta"><i class="fas fa-file"></i> Nueva Pregunta</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_preguntas" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Creterios evaluación</th>
                                    <th>Perfil</th>
                                    <th>Pregunta</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($data['preguntas'] as $ky=>$vv)
                                <tr idpregunta="{{$vv['id']}}">
                                    <td>{{$ky+1}}</td>
                                    <td>{{$vv['creterios_evaluacion']}}</td>
                                    <td>{{$vv['perfil']}}</td>
                                    <td>{{$vv['preguntas']}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-default addpreguntas" data-toggle="modal" data-target="#nuevpregunta"><i class="fas fa-calendar-plus"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Creterios evaluación</th>
                                    <th>Perfil</th>
                                    <th>Pregunta</th>
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
        $perfi = !empty($data['perfi']) ? $data['perfi'] : [];
        $criterio = !empty($data['criterio']) ? $data['criterio'] : [];
    @endphp
    <!--- Crear pregunta -->
    <div class="modal fade" id="nuevapregunta">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registro variable de evaluación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_pregunta">
                        <div class="form-group row">
                            {!! Form::label('criterio','Criterio evaluación',['for'=>'inputCriterio','class'=>'col-sm-5 col-form-label'])  !!}
                            <div class="col-sm-7">
                                {!! Form::select('criterio',$criterio,'',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('perfi','Perfi',['for'=>'inputPerfi','class' => 'col-sm-5 col-form-label'])  !!}
                            <div class="col-sm-7">
                                {!! Form::select('perfi',$perfi,'',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtestudiante" class="col-sm-5 col-form-label">Pregunta</label>
                            <div class="col-sm-7">                                
                                <textarea type="text" name="txcreiterio" class="form-control" id="txcreiterio"></textarea>
                                <input type="hidden" id="idpregunta" name="idpregunta" class="hidden">
                            </div>
                        </div>                       
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <button type="button" class="btn btn-primary btn-block savepregunta">Guardar</button>
                                <input type="hidden" value="" name="pregunta_id" id="pregunta_id">
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
       
    })

    $("#tb_preguntas").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        language: {url: "{{asset('backend/pages/tables/es.json')}}"},
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tb_preguntas_wrapper .col-md-6:eq(0)');

    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });        

       
        $(document).on('click','.addpreguntas', function() {
            limpiar()
        })

        function limpiar()
        {
            $('#idpregunta').val('')
            $('#txcreiterio').val('')
            $('#perfi').val('')
            $('#criterio').val('')
        }

        $(document).on('click','.nuevapregunta', function() {
            limpiar()
            var idpregunta = parseInt($(this).parents('tr').attr('idpregunta'))
            $('#idpregunta').val(idpregunta)
        })

        $(document).on('click','.savepregunta', function() {
            var id = parseInt($('#idpregunta').val())
            var preg = $('#txcreiterio').val()
            var perfil = $('#perfi').val()
            var criterio = $('#criterio').val()
            

        })
    });
</script>
@endsection