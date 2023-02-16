<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buenos Amigos FC | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h1>Prácticas <b>Profesionales</b></h1>
    </div>
    <div class="card-body">

      <form method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" id="correo" value="{{ old('email') }}" placeholder="Correo electrónico" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" id="clave" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </form>
        <div class="row  mb-3">
          <div class="col-12">
            <button type="buttom" class="btn btn-primary btn-block login">Iniciar sessión</button>
          </div>
          <!-- /.col -->
        </div>
      <div class="row post">
        <div class="col-12">
          <p class="mb-1 text-center">
            <a href="{{ route('password.request') }}">¿Has olvidado la contraseña?</a>
          </p>
        </div>
      </div>
      <div class="row post mb-3">
        <div class="col-12">
          <p class="mb-0 text-center">
            <a href="{{ route('register') }}" class="btn btn-danger text-center">Crear cuenta nueva</a>
          </p>
        </div>
      </div>
      
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.min.js')}}"></script>
<script>
    $(document).on('click','.login', function() {
        var _correo = $('#correo').val()
        var _clave = $('#clave').val()
        if($.trim(_correo) != '' && $.trim(_clave) != '')
        {
            var $post = {};
            $post._token = $('input[name=_token]').val();
            $post.email = _correo
            $post.password = _clave

            $.ajax({
                type: "POST",
                data: $post,
                url: '/accesos/1/acceder',
                success: function (response) {
                    
                }
            });
        }
        else
            alert('Verificar Datos')
        
    });
</script>
</body>
</html>