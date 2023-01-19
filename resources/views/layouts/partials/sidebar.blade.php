  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link text-decoration-none text-center">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-bolder">SAC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 mb-3">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}

        <div class="text-center text-wrap">
          @if (Auth::user()->persona)       
              <p class="text-white fs-5">
                  Hola, <span class="fw-bold">{{ Auth::user()->persona->nombres . ' ' . Auth::user()->persona->apellidos }}</span>
              </p>
          @else
              <p class="text-warning fs-5">
                Hola, <span class="fw-bold">{{ Auth::user()->username }}</span> </br>(Información incompleta).
              </p>
          @endif
        </div>

      </div>



      <!-- SidebarSearch Form -->
      <div class="form-inline pb-2">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DashBoard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Prueba</p>
                </a>
              </li>
            </ul>       

          </li> --}}



          @can('modulo-estadisticas')
          <li class="nav-item menu-open">

            <a href="#" class="nav-link active">
              <i class="nav-icon fa-regular fa-newspaper"></i>
              <p>
                Gestion Estadistica
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-chart-pie nav-icon"></i>
                  <p>Ver Gráficas</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-filter nav-icon"></i>
                  <p>Filtrar Informacion</p>
                </a>
              </li>
            </ul>

          </li>
          @endcan


          @can('modulo-reportes')
          <li class="nav-item menu-open">

            <a href="#" class="nav-link active">
              <i class="fa-solid fa-scroll"></i>
              <p>
                Gestion de Reportes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.especialidad.cita') }}" class="nav-link">
                  <i class="fa-solid fa-file-circle-check"></i>
                  <p>Especialidad - Citas</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.doctor.cita') }}" class="nav-link">
                  <i class="fa-solid fa-file-circle-check"></i>
                  <p>Medico - Citas</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.mes.cita')}}" class="nav-link">
                  <i class="fa-solid fa-file-circle-check"></i>
                  <p>Mes - Citas</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.ano.cita')}}" class="nav-link">
                  <i class="fa-solid fa-file-circle-check"></i>
                  <p>Año - Citas</p>
                </a>
              </li>
            </ul>

          </li>
          @endcan


          
          @can('modulo-rpu')
          <li class="nav-item menu-open">

            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Modulo RPU
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @can('role-list')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.roles.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión de Roles</p>
                </a>
              </li>
            </ul> 
            @endcan

            {{-- @can('permission-list')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión de Permisos</p>
                </a>
              </li>
            </ul>
            @endcan --}}

            @can('user-list')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión de Usuarios</p>
                </a>
              </li>
            </ul>
            @endcan
          </li> 
          @endcan

          


          @can('modulo-personas')
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fa-solid fa-hospital-user"></i>
              <p>
                Gestión de Personas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @can('persona-create')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.personas.create') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Registrar Persona</p>
                </a>
              </li>
            </ul> 
            @endcan

            @can('persona-list')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.personas.index') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Listar Personas</p>
                </a>
              </li>
            </ul> 
            @endcan
          </li> 
          @endcan

          @can('modulo-especialidades')
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fa-solid fa-hospital-user"></i>
              <p>
                Gestión de Especialidades
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            {{-- @can('especialidad-create')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.specialities.create') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Crear Especialidad</p>
                </a>
              </li>
            </ul>
            @endcan --}}

            @can('especialidad-list')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.specialities.index') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Listar Especialidades</p>
                </a>
              </li>
            </ul>
            @endcan
          </li> 
          @endcan
          

          @hasrole('secretaria')
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fa-solid fa-hospital-user"></i>
              <p>
                Gestión de Pacientes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @can('paciente-create')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('secretaria.pacientes.create') }}" class="nav-link botonActivo">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Registrar Paciente</p>
                </a>
              </li>
            </ul>
            @endcan

            @can('paciente-list')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('secretaria.pacientes.index') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Listar Pacientes</p>
                </a>
              </li>
            </ul>
            @endcan

          </li>  
          @endhasrole


          @can('modulo-appointments')
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fa-solid fa-hospital-user"></i>
              <p>
                Gestión de Citas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @can('appointment-create')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.appointments.create') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Agendar Cita</p>
                </a>
              </li>
            </ul> 
            @endcan

            @can('appointment-list')
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.appointments.index') }}" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Consulta de Citas</p>
                </a>
              </li>
            </ul> 
            @endcan

            @if (auth()->user()->hasPermissionTo('appointment-reprogramar'))
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Reprogramar Cita</p>
                </a>
              </li>
            </ul> 
            @endif



          </li> 
          @endcan






          



          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Otro enlace mas
                <span class="right badge badge-danger">New</span> 
              </p>
            </a>
          </li> --}}

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>