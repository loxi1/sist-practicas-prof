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
<style>
    .suggestions {
        box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
        height: auto;
        position: absolute;
        top: 45px;
        z-index: 9999;
        width: 206px;
    }
    
    .suggestions .suggest-element {
        background-color: #EEEEEE;
        border-top: 1px solid #d6d4d4;
        cursor: pointer;
        padding: 8px;
        width: 100%;
        float: left;
    }
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Practicas</h1>
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
                        <h3 class="card-title" style="display: inline">Lista de practicas</h3>
                        <button class="btn btn-sm btn-primary float-right nuevapractica" data-toggle="modal" data-target="#nuevapractica"><i class="fas fa-file"></i> Nueva Practica</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_practicas" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Carrera</th>
                                    <th>Ciclo</th>
                                    <th>Estudiante</th>
                                    <th>Tutor</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Cantidad Horas</th>
                                    <th>Nota</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                            @foreach($data['practicas'] as $ky=>$vv)
                                <tr idpractica="{{$vv['id']}}">
                                    <td>{{$ky+1}}</td>
                                    <td>{{$vv['especialidades']}}</td>
                                    <td>{{$vv['ciclos']}}</td>
                                    <td>{{$vv['complestud']}}</td>
                                    <td>{{$vv['compltutor']}}</td>
                                    <td>{{$vv['fecha_inicio']}}</td>
                                    <td>{{$vv['fecha_fin']}}</td>
                                    <td>{{$vv['cantidad_horas']}}</td>
                                    <td>{{$vv['calificacion']}}</td>
                                    <td>{{$vv['estadopractica']}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-default addcronograma" data-toggle="modal" data-target="#nuevocronograma"><i class="fas fa-calendar-plus"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Carrera</th>
                                    <th>Ciclo</th>
                                    <th>Estudiante</th>
                                    <th>Tutor</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Cantidad Horas</th>
                                    <th>Nota</th>
                                    <th>Estado</th>
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
    <div class="modal fade" id="nuevapractica">
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
                            <label for="txtestudiante" class="col-sm-5 col-form-label">Objetivo</label>
                            <div class="col-sm-7">
                                <input type="text" name="txtobjetivo" class="form-control" id="txtobjetivo">
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('carrera','Carrera',['for'=>'inputCarrera','class' => 'col-sm-5 col-form-label'])  !!}
                            <div class="col-sm-7">
                                {!! Form::select('carrera',$carrera,'',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!! Form::label('ciclo','Ciclo',['for'=>'inputCiclo','class' => 'col-sm-5 col-form-label'])  !!}
                            <div class="col-sm-7">
                                {!! Form::select('ciclo',$ciclo,'',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txtestudiante" class="col-sm-5 col-form-label">Estudiante</label>
                            <div class="col-sm-7">
                                <input type="text" name="txtestudiantes" class="form-control" id="txtestudiante">
                                <input type="hidden" id="estudiantes_id" name="estudiantes_id" class="hidden">
                                <div class="suggestions" id="autoestudiante"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="txttutor" class="col-sm-5 col-form-label">Tutor</label>
                            <div class="col-sm-7">
                                <input type="text" name="txttutor" class="form-control" id="txttutor">
                                <input type="hidden" id="docentetutores_id" name="docentetutores_id" class="hidden">
                                <div class="suggestions" id="autotutor"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cantidadhoras" class="col-sm-5 col-form-label">Cantidad Horas</label>
                            <div class="col-sm-7">
                                <input type="number" min="1" name="cantidad_horas" class="form-control" id="cantidadhoras">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechai" class="col-sm-5 col-form-label">Fecha Inicio</label>
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
                            <label for="fechaf" class="col-sm-5 col-form-label">Fecha Fin</label>
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

    <!-- Crear Cronograma -->
    <div class="modal fade" id="nuevocronograma">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registro cronograma entregables </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_crono">                       
                        <div class="form-group row">
                            <label for="fechai" class="col-sm-5 col-form-label">Fecha 1</label>
                            <div class="col-sm-7">
                                <input type="hidden" id="idpractica" value="0">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker9" data-target-input="nearest">
                                        <input idfec="0" type="text" id="fecha_9" class="form-control datetimepicker-input f_crono" data-target="#datetimepicker9"/>
                                        <div class="input-group-append" data-target="#datetimepicker9" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaf" class="col-sm-5 col-form-label">Fecha 2</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker10" data-target-input="nearest">
                                        <input type="text" id="fecha_10" class="form-control datetimepicker-input f_crono" data-target="#datetimepicker10"/>
                                        <div idfec="0" class="input-group-append" data-target="#datetimepicker10" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaf" class="col-sm-5 col-form-label">Fecha 3</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker11" data-target-input="nearest">
                                        <input type="text" id="fecha_11" class="form-control datetimepicker-input f_crono" data-target="#datetimepicker11"/>
                                        <div idfec="0" class="input-group-append" data-target="#datetimepicker11" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fechaf" class="col-sm-5 col-form-label">Fecha 4</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker12" data-target-input="nearest">
                                        <input idfec="0" type="text" id="fecha_12" class="form-control datetimepicker-input f_crono" data-target="#datetimepicker12"/>
                                        <div class="input-group-append" data-target="#datetimepicker12" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label for="fechaf" class="col-sm-5 col-form-label">Fecha 5</label>
                            <div class="col-sm-7">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker13" data-target-input="nearest">
                                        <input idfec="0" type="text" id="fecha_13" class="form-control datetimepicker-input f_crono" data-target="#datetimepicker13"/>
                                        <div class="input-group-append" data-target="#datetimepicker13" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <button type="button" class="btn btn-primary btn-block savecronograma">Guardar</button>
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

        $('#datetimepicker9').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#datetimepicker10').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        $('#datetimepicker11').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        $('#datetimepicker12').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });
        $('#datetimepicker13').datetimepicker({
            format: 'DD/MM/YYYY',
            useCurrent: false
        });

        $("#datetimepicker9").on("change.datetimepicker", function (e) {
            $('#datetimepicker10').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker10").on("change.datetimepicker", function (e) {
            $('#datetimepicker9').datetimepicker('maxDate', e.date);
            $('#datetimepicker11').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker11").on("change.datetimepicker", function (e) {
            $('#datetimepicker10').datetimepicker('maxDate', e.date);
            $('#datetimepicker12').datetimepicker('minDate', e.date);
        });
        $("#datetimepicker12").on("change.datetimepicker", function (e) {
            $('#datetimepicker11').datetimepicker('maxDate', e.date);
            $('#datetimepicker13').datetimepicker('minDate', e.date);
        });
        
        $("#datetimepicker13").on("change.datetimepicker", function (e) {
            $('#datetimepicker12').datetimepicker('maxDate', e.date);
        });
    })

    $("#tb_practicas").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        language: {url: "{{asset('backend/pages/tables/es.json')}}"},
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tb_practicas_wrapper .col-md-6:eq(0)');

    $(document).ready(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $(document).on('keyup','#txttutor', function() {
            var $post = {};
            $post._token = $('meta[name="csrf-token"]').attr('content');
            $post._key = $(this).val();

            $.ajax({
                type: "POST",
                url: '/docentestutores/1/autocompetartutor',
                data: $post,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#autotutor').fadeIn(1000).html(data.output);
                    //Al hacer click en alguna de las sugerencias
                    $('.suggest-element').on('click', function(){
                            //Obtenemos la id unica de la sugerencia pulsada
                            var id = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#key').val($('#'+id).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#autotutor').fadeOut(1000);
                            $('#docentetutores_id').val($('#'+id).attr('idtutor'))
                            $('#txttutor').val($('#'+id).attr('data'))
                            return false;
                    });
                }
            });
        });

        $(document).on('keyup','#txtestudiante', function() {
            var $post = {};
            $post._token = $('meta[name="csrf-token"]').attr('content');
            $post._key = $(this).val();

            $.ajax({
                type: "POST",
                url: '/estudiantes/1/autocompetarestudiante',
                data: $post,
                success: function(data) {
                    //Escribimos las sugerencias que nos manda la consulta
                    $('#autoestudiante').fadeIn(1000).html(data.output);
                    //Al hacer click en alguna de las sugerencias
                    $('.suggest-element').on('click', function(){
                            //Obtenemos la id unica de la sugerencia pulsada
                            var id = $(this).attr('id');
                            //Editamos el valor del input con data de la sugerencia pulsada
                            $('#key').val($('#'+id).attr('data'));
                            //Hacemos desaparecer el resto de sugerencias
                            $('#autoestudiante').fadeOut(1000);
                            $('#estudiantes_id').val($('#'+id).attr('idestu'))
                            $('#txtestudiante').val($('#'+id).attr('data'))
                            return false;
                    });
                }
            });
        });

        $(document).on('click','.savepractica', function() {
            var estudiantes_id = parseInt($('#estudiantes_id').val())
            var docentetutores_id = parseInt($('#docentetutores_id').val())
            var cantidad_horas = parseFloat($('#cantidadhoras').val())
            var fechai = $('#fechai').val()
            var fechaf = $('#fechaf').val()
            var objeti = $('#txtobjetivo').val()

            var msn = 'Error'
            var cod = false
            if($.trim(objeti) != '')
            {
                if(estudiantes_id>0)
                {
                    if(docentetutores_id>0)
                    {
                        if(cantidad_horas>0)
                        {
                            if($.trim(fechai) != '')
                            {
                                if($.trim(fechai) != '')
                                    cod = true
                                else
                                {
                                    msn = 'Ingrese Fecha Fin'
                                    $('#fechaf').focus()
                                }                                
                            }
                            else
                            {
                                msn = 'Ingrese Fecha Inicio'
                                $('#fechai').focus()
                            }                            
                        }
                        else
                        {
                            msn = 'Ingrese Cantidad horas'
                            $('#cantidad_horas').focus()
                        }
                    }
                    else
                    {
                        msn = 'Buscar Docente'
                        $('#docentetutores_id').focus()
                    }
                }
                else
                {
                    msn = 'Buscar Estudiante'
                    $('#estudiantes_id').focus()
                }
            }
            else
            {
                msn = 'Ingresar el Objetivo'
                $('#txtobjetivo').focus()
            }  
            
            if(cod >0)
            {
                var $post = {};
                $post._token = $('meta[name="csrf-token"]').attr('content');
                $post._fechai = datetoing(fechai)
                $post._fechaf = datetoing(fechaf)
                $post._estudiantes_id = estudiantes_id              
                $post._docentetutores_id = docentetutores_id
                $post._cantidad_horas = cantidad_horas
                $post._carreras_id = $('#carrera').val()
                $post._ciclos_id = $('#ciclo').val()
                $post._competencia = objeti

                $.ajax({
                    type: "POST",
                    data: $post,
                    url: '/practicas/1/savepracticas',
                    success: function (response) {
                        Toast.fire({
                            icon: 'error',
                            title: response.mensaje
                        })
                        if(response.estado == 1)
                        {
                            esicon = 'success'
                            window.location.reload();
                        }
                    }
                });
            }
            else
            {
                Toast.fire({
                    icon: 'error',
                    title: msn
                })
            }

        });

        $(document).on('click','.savecronograma', function() {
            var fecha = $('.f_crono').val()
            var idpractica = parseInt($('#idpractica').val())
            if($.trim(fecha) != '' && idpractica>0)
            {
                var $post = {};
                $post._token = $('meta[name="csrf-token"]').attr('content');
                $post._idpractica = idpractica
                $post._fecha = []
                var i = 0
                $.each($('.f_crono'), function(key,val) {
                    if($.trim($(this).val()) != '')
                    {
                        $post._fecha[i] =  datetoing($(this).val())
                        i++
                    }
                });

                $.ajax({
                    type: "POST",
                    data: $post,
                    url: '/practicas/1/savecronopracticas',
                    success: function (response) {
                        Toast.fire({
                            icon: 'success',
                            title: response.mensaje
                        })
                        if(response.estado == 1)
                        {
                            esicon = 'success'
                            window.location.reload();
                        }
                    }
                });
            }
            else
            {
                $('#datetimepicker9').focus()
                Toast.fire({
                    icon: 'error',
                    title: 'Agregar Fecha'
                })
                $('#fecha_9').focus()
            }
        });

        $(document).on('click','.addcronograma', function() {
            var idpractica = parseInt($(this).parents('tr').attr('idpractica'))
            $('#idpractica').val(idpractica)
        })
    });
</script>
@endsection