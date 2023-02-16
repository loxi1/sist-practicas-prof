@extends('plantilla.app')
@section('css_contenido')
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mis Practicas</h1>
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
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_mispracticas" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ciclo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Cantidad Horas</th>
                                    <th>Nota</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($mispr as $kk=>$item)
                                    <tr>
                                        <td>{{$kk+1}}</td>
                                        <td>{{$item['ciclos']}}</td>
                                        <td>{{$item['fecha_inicio']}}</td>
                                        <td>{{$item['fecha_fin']}}</td>
                                        <td>{{$item['cantidad_horas']}}</td>
                                        <td>{{$item['calificacion']}}</td>
                                        <td>{{$item['estadopractica']}}</td>
                                        <th>
                                    @if($item['estadopractica'] == "Terminado")
                                            <a class="btn btn-sm btn-default"><i class="fas fa-eye"></i> Sessión Aprendizaje</a>   
                                    @else
                                            <a href="{{route('mispracticas.show',$item['id'])}}" class="btn btn-sm btn-primary"><i class="fas fa-file"></i> Sessión Aprendizaje</a>
                                    @endif     
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Ciclo</th>
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
<!-- Page specific script -->
<script>
    $("#tb_mispracticas").DataTable({
        "responsive": true, 
        "lengthChange": false, 
        "autoWidth": false,
        language: {url: "{{asset('backend/pages/tables/es.json')}}"},
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tb_mispracticas_wrapper .col-md-6:eq(0)');
</script>
@endsection