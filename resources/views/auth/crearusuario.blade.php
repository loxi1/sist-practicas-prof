<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buenos Amigos | Registrar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition register-page">
    <div class="row" style="height: 20px;"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <h1>Registrarte</h1>
                </div>
                <div class="card-body">
                    <form id="crearusuario" method="POST" class="g-3 needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <select class="form-control" name="perfil" id="perfil">
                                        <option value="1">Estudiante</option>
                                        <option value="2">Docente guia</option>
                                        <option value="3">Docente tutor</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="name" placeholder="Nombres" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <select class="form-control" name="tipo_documentos_id" id="tipo_documentos_id">
                                        <option value="1">DNI</option>
                                        <option value="2">CARNET EXT.</option>
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-id-card"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="numero_documento" placeholder="Número Documento" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-wallet"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Correo" name="email" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="password" id="clave" class="form-control" placeholder="Clave" name="password" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6"> 
                                <div class="input-group mb-3">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir Clave" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>                        
                            </div>
                        </div>                
                        <div class="row">
                            <div class="col-6">
                                <div class="icheck-primary">
                                    <input type="checkbox" value="1" class="form-check-input" id="agreeTerms" name="terms" value="agree" required>
                                    <label class="form-check-label" for="agreeTerms">
                                    Aceptar los <a href="#">terminos</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <button type="buttom" class="btn btn-primary btn-block">Registrarte</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <div class="row post">
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                        <p class="mb-1 text-center">
                            <a href="{{ route('login') }}">Ya estoy Registrado</a>
                        </p>
                        </div>
                    </div>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
    </div>

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    /*(function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            else
            {
                event.preventDefault();
                event.stopPropagation();
                console.log("ENTRO")
            }
            form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();*/
    $(document).ready(function() {
        $("#crearusuario").validate(
            {
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    apellidos: {
                        required: true,
                        minlength: 3
                    },
                    numero_documento: {
                        required: true,
                        min:1
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        minlength: 8,
                        equalTo: "#clave"
                    },
                    terms: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Nombres",
                        minlength: "Min 3 digitos"
                    },
                    apellidos: {
                        required: "Nombres",
                        minlength: "Min 3 digitos"
                    },
                    numero_documento: {
                        required: "Numero",
                        min:1
                    },
                    email: {
                        required: "Ingrese email",
                        email: "No es un email"
                    },
                    password: {
                        required: 'Clave',
                        minlength: "Minimo 8 digitos"
                    },
                    password_confirmation: {
                        required: 'Clave',
                        minlength: "Minimo 8 digitos",
                        equalTo: "Clave distintas"
                    },
                    terms: {
                        required: "Aceptar terminos"
                    }               
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                },
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                errorPlacement: function(error, element) {
                    if (element.parent('.icheck-primary').length) {
                        error.insertAfter(element.parent().find('label'));
                    }
                    else
                    {
                        error.insertAfter(element.parent().find('.input-group-append'));
                    }
                },
                submitHandler: function() {
                    console.log("Atos correctos")
                }
            }
        );
    });
</script>
</body>
</html>
