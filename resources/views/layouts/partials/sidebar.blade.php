  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link text-decoration-none">
          <img src="{{ asset('assets/img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle">
          <span class="brand-text font-weight-bolder ml-4">OroMed</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 mb-3 d-flex justify-content-center">
            {{-- <div class="image">
                    <img src="{{ asset('assets/img/favicon.png') }}" class="img-circle elevation-2" alt="User Image">
            </div> --}}

              <div class="info">
                  @if (Auth::user()->person)
                      <p class="text-white fs-6">
                          Hola, <span class="fw-bold">
                                    {{ Auth::user()->person->nombres . ' ' . Auth::user()->person->apellidos }}
                                </span>
                      </p>
                      <p class="text-center">
                        @foreach (Auth::user()->roles as $role)
                            <span class="badge badge-info">{{ $role->name }}</span>                
                        @endforeach  
                      </p>
                  @else
                      <p class="text-warning fs-5">
                          Hola, <span class="fw-bold">
                                {{ Auth::user()->username }}
                                </span> 
                          </br>(Información incompleta).
                      </p>
                  @endif
              </div>

          </div>



          <!-- SidebarSearch Form -->
          <div class="form-inline pb-2">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Buscar"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">

                  @can('modulo-reportes')

                      <li class="nav-item menu-open">

                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa-regular fa-newspaper"></i>
                              <p>
                                  Reportes de Pacientes
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.patient.data') }}" class="nav-link @if (request()->routeIs('gerente.patient.data')) active @endif">
                                      <i class="fa-solid fa-chart-pie nav-icon"></i>
                                      <p>Edad, género y ciudad</p>
                                  </a>
                              </li>
                          </ul>

                      </li>

                      <li class="nav-item menu-open">

                          <a href="#" class="nav-link active">
                              <i class="fa-solid fa-scroll"></i>
                              <p>
                                  Reportes de Citas
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.especialidad.cita') }}" class="nav-link @if (request()->routeIs('gerente.especialidad.cita')) active @endif">
                                      <i class="fa-solid fa-file-circle-check"></i>
                                      <p>Especialidad - Citas</p>
                                  </a>
                              </li>
                          </ul>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.doctor.cita') }}" class="nav-link @if (request()->routeIs('gerente.doctor.cita')) active @endif">
                                      <i class="fa-solid fa-file-circle-check"></i>
                                      <p>Medico - Citas</p>
                                  </a>
                              </li>
                          </ul>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.mes.cita') }}" class="nav-link @if (request()->routeIs('gerente.mes.cita')) active @endif">
                                      <i class="fa-solid fa-file-circle-check"></i>
                                      <p>Mes - Citas</p>
                                  </a>
                              </li>
                          </ul>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.ano.cita') }}" class="nav-link @if (request()->routeIs('gerente.ano.cita')) active @endif">
                                      <i class="fa-solid fa-file-circle-check"></i>
                                      <p>Año - Citas</p>
                                  </a>
                              </li>
                          </ul>

                      </li>



                      <li class="nav-item menu-open">

                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa-regular fa-newspaper"></i>
                              <p>
                                  Reportes de Enfermedades
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.enfermedades') }}" class="nav-link @if (request()->routeIs('gerente.enfermedades')) active @endif">
                                      <i class="fa-solid fa-chart-pie nav-icon"></i>
                                      <p>Total por año</p>
                                  </a>
                              </li>
                          </ul>
                      </li>

                      <li class="nav-item menu-open">

                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa-regular fa-newspaper"></i>
                              <p>
                                  Reportes de COVID-19
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.covid.cases.year') }}" class="nav-link @if (request()->routeIs('gerente.covid.cases.year')) active @endif">
                                      <i class="fa-solid fa-chart-pie nav-icon"></i>
                                      <p>Casos por mes y año</p>
                                  </a>
                              </li>
                          </ul>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.covid.cases.city') }}" class="nav-link @if (request()->routeIs('gerente.covid.cases.city')) active @endif">
                                      <i class="fa-solid fa-chart-pie nav-icon"></i>
                                      <p>Casos por ciudad</p>
                                  </a>
                              </li>
                          </ul>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.covid.cases.common.symptoms') }}" class="nav-link @if (request()->routeIs('gerente.covid.cases.common.symptoms')) active @endif">
                                      <i class="fa-solid fa-chart-pie nav-icon"></i>
                                      <p>Sintomas más comunes</p>
                                  </a>
                              </li>
                          </ul>

                      </li>

                      <li class="nav-item menu-open">

                          <a href="#" class="nav-link active">
                              <i class="nav-icon fa-regular fa-newspaper"></i>
                              <p>
                                  Reportes de Calificaciones
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('gerente.best.doctors') }}" class="nav-link @if (request()->routeIs('gerente.best.doctors')) active @endif">
                                      <i class="fa-solid fa-chart-pie nav-icon"></i>
                                      <p>Mejores Médicos</p>
                                    </a>
                                </li>
                            </ul>
                            
                            {{-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('gerente.doctors.calification') }}" class="nav-link @if (request()->routeIs('gerente.doctors.calification')) active @endif">
                                        <i class="fa-solid fa-chart-pie nav-icon"></i>
                                        <p>Calificación de Médicos</p>
                                  </a>
                              </li>
                          </ul>

                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="route('gerente.satisfaction.puntuation')" class="nav-link @if (request()->routeIs('gerente.satisfaction.puntuation')) active @endif">
                                      <i class="fa-solid fa-chart-pie nav-icon"></i>
                                      <p>Satisfacción general</p>
                                  </a>
                              </li>
                          </ul> --}}

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
                                      <a href="{{ route('admin.roles.index') }}" class="nav-link @if (request()->routeIs('admin.roles.index')) active @endif ">  
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Gestión de Roles</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan

                          @can('user-list')
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('admin.users.index') }}" class="nav-link @if (request()->routeIs('admin.users.index')) active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Gestión de Usuarios</p>
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

                          @can('especialidad-list')
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('admin.specialities.index') }}" class="nav-link @if (request()->routeIs('admin.specialities.index')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Listar Especialidades</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan
                      </li>
                  @endcan


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
                                  @hasanyrole(['admin', 'gerente'])
                                  <li class="nav-item">
                                        <a href="{{ route('admin.appointments.create') }}"
                                           class="nav-link @if(request()->routeIs('admin.appointments.create')) active @endif">
                                            <i class="fa fa-user nav-icon"></i>
                                            <p>Agendar Cita (a)</p>
                                        </a>
                                  </li>
                                  @endhasanyrole
                              </ul>
                          @endcan

                          @can('appointment-list')
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                        <a href="{{ route('admin.appointments.index') }}"
                                                    class="nav-link @if (request()->routeIs('admin.appointments.index')) active @endif">
                                            <i class="fa fa-user nav-icon"></i>
                                            <p>Consulta de Citas</p>
                                        </a>
                                  </li>
                              </ul>
                          @endcan

                          {{-- @can('appointment-delete') --}}
                            {{-- <ul class="nav nav-treeview">
                                <li class="nav-item">
                                      @hasrole('paciente')
                                      <a href="{{ route('paciente.cancelarCitasPaciente') }}"
                                                class="nav-link @if (request()->routeIs('paciente.cancelarCitasPaciente')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Cancelar Citas</p>
                                      </a>
                                      @endhasrole      
                                </li>
                            </ul> --}}
                          {{-- @endcan --}}

    

                          {{-- @can('appointment-reprogramar')
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="#" class="nav-link ">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Reprogramar Cita</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan --}}

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
                                      <a href="{{ route('secretaria.pacientes.create') }}" class="nav-link botonActivo @if (request()->routeIs('secretaria.pacientes.create')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Registrar Paciente</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan

                          @can('paciente-list')
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('secretaria.pacientes.index') }}" class="nav-link @if (request()->routeIs('secretaria.pacientes.index')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Listar Pacientes</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan

                      </li>
                  @endhasrole

                  @hasrole('paciente')
                    <li class="nav-item menu-open">
                          <a href="#" class="nav-link active">
                              <i class="fa-solid fa-hospital-user"></i>
                              <p>
                                  Agendamiento de Citas Médicas
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                          @can('appointment-create')
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">                          
                                      <a href="{{ route('paciente.citas.create') }}" 
                                                class="nav-link @if (request()->routeIs('paciente.citas.create')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Agendar Citas</p>
                                      </a>
                                    </li>
                              </ul>
                          @endcan

                          @can('appointment-list')
                              <ul class="nav nav-treeview">          
                                  <li class="nav-item">
                                      <a href="{{ route('paciente.citas.index') }}"
                                                class="nav-link @if (request()->routeIs('paciente.citas.index')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Consulta de Citas</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan

                          @can('appointment-delete')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                      <a href="{{ route('paciente.cancelarCitasPaciente') }}"
                                                class="nav-link @if (request()->routeIs('paciente.cancelarCitasPaciente')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Cancelación de Citas</p>
                                      </a>  
                                </li>
                            </ul>
                          @endcan
                      </li>
                  @endrole


                  @hasrole('doctor')
                    <li class="nav-item menu-open">
                          <a href="#" class="nav-link active">
                              <i class="fa-solid fa-hospital-user"></i>
                              <p>
                                  Gestión de Citas, Consultas e Historias
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>

                          @can('appointment-list')
                              <ul class="nav nav-treeview">          
                                  <li class="nav-item">
                                      <a href="{{ route('doctor.appointments.index') }}"
                                                class="nav-link @if(request()->routeIs('doctor.appointments.index')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Revisar Agenda</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan

                          {{-- @can('diagnostico-list')
                              <ul class="nav nav-treeview">          
                                  <li class="nav-item">
                                      <a href="#"
                                                class="nav-link @if(request()->routeIs('#')) active @endif">
                                          <i class="fa fa-user nav-icon"></i>
                                          <p>Historias Médicas</p>
                                      </a>
                                  </li>
                              </ul>
                          @endcan --}}

                      </li>
                  @endhasrole



              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
