  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-decoration-none text-center">
      {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">SAC</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block text-decoration-none text-center">
            {{-- {{ Persona::find(Auth::user()->user_id)->nombres}} --}}
            {{-- {{ User::find(Auth::user()->id)->persona->nombres}} --}}
            {{-- {{ Auth::user()->persona->nombres}} --}}
            {{ Auth::user()->persona->nombres . ' ' . Auth::user()->persona->apellidos }}

          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DashBoard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Gestión de Usuarios</p>
                </a>
              </li>
            </ul> --}}
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-book-medical nav-icon"></i>
                  <p>Agendar Cita</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-briefcase-medical nav-icon"></i>
                  <p>Gestión de Citas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa-solid fa-clock nav-icon"></i>
                  <p>Ver mis Citas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Registrar Paciente</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-user-md"></i>
                  <p>Gestion de Especialidades</p>
                </a>
              </li>
            </ul>

          </li>



          <li class="nav-item menu-open">

            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Modulo RPU
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión de Roles</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión de Permisos</p>
                </a>
              </li>
            </ul>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gestión de Usuarios</p>
                </a>
              </li>
            </ul>

          </li>

          <li class="nav-item menu-open">

            <a href="#" class="nav-link active">
              <i class="nav-icon fa-regular fa-newspaper"></i>
              <p>
                Estadisticas
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



          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Otro enlace mas
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>