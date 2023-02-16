<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('logo/logo_instituto.png')}}" alt="Buenos Amigos FC" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sistema Practicas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(auth()->user()->flag=="Si")
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->            
                @switch(auth()->user()->perfil)
                @case('Estudiante')
                    <li class="nav-header">PRACTICAS</li>
                    <li class="nav-item">
                        <a href="{{ route('mispracticas.index') }}" class="nav-link{{ Request::is('mispracticas*') ? ' active' : '' }}">
                            <i class="nav-icon fas fas fa-boxes"></i> <p>Mis Practicas</p>
                        </a>
                    </li>
                @break

                @case('Docente guia')
                    <li class="nav-header">PRACTICAS</li>
                    <li class="nav-item">
                        <a href="{{ route('practicas.index') }}" class="nav-link{{ Request::is('practicas*') ? ' active' : '' }}">
                            <i class="nav-icon fas fas fa-boxes"></i> <p>Plan Practicas</p>
                        </a>
                    </li>
                    <li class="nav-header">Preguntas</li>
                    <li class="nav-item">
                        <a href="{{ route('variablevaloraciones.index') }}" class="nav-link{{ Request::is('variablevaloraciones*') ? ' active' : '' }}">
                            <i class="nav-icon fas fa-book-reader"></i> <p>Variable evaluación</p>
                        </a>
                    </li>
                @break

                @case('Docente tutor')
                    <li class="nav-header">Evaluación Practicas</li>
                    <li class="nav-item">
                        <a href="{{ route('evaluarpracticas.index') }}" class="nav-link{{ Request::is('evaluarpracticas*') ? ' active' : '' }}">
                            <i class="nav-icon fas fas fa-boxes"></i> <p>Evaluar Practicas</p>
                        </a>
                    </li>
                @break
                @endswitch
                @else
                    <h4 class="text-warning">Completar tus Datos</h4>
                @endif          
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>