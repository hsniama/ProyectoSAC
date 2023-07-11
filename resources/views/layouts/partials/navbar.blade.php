  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

      <!-- Left navbar links -->
      <ul class="navbar-nav d-flex justify-center align-content-center">
          <li class="nav-item ml-2">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>


      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

          @guest
              @if (Route::has('login'))
                  <li class="nav-item d-none d-sm-inline-block">
                      <a href="{{ route('login') }}" class="nav-link">Iniciar Sesión</a>
                  </li>
              @endif

              @if (Route::has('register'))
                  <li class="nav-item d-none d-sm-inline-block">
                      <a href="{{ route('register') }}" class="nav-link">Registrarse</a>
                  </li>
              @endif
          @else
              @if (Auth::user()->person)
                  @if (!Auth::user()->person->isComplete())
                      <li class="nav-item d-none d-sm-inline-block mr-3">
                          <a href="{{ route('profile.edit', Auth::user()->username) }}" {{-- person->id --}}
                              class="text-decoration-none nav-link text-bg-warning">
                              Completa tu perfil Aqui
                          </a>
                      </li>
                  @else
                      <li class="nav-item d-none d-sm-inline-block mr-3">
                          <a href="{{ route('profile.edit', Auth::user()->username) }}"
                              class="text-decoration-none nav-link ">
                              Editar Perfil
                          </a>
                      </li>
                      <li class="nav-item d-none d-sm-inline-block mr-3">
                          <a href="{{ route('view.change.password') }}" class="text-decoration-none nav-link">
                              Cambiar contraseña
                          </a>
                      </li>
                  @endif
              @else
                  <li class="nav-item d-none d-sm-inline-block mr-3">
                      <a href="{{ route('profile.create') }}" class="text-decoration-none nav-link text-bg-warning">
                          Completa tu perfil aquí
                      </a>
                  </li>
              @endif
              </li>

              <li class="nav-item d-none d-sm-inline-block mr-3">
                  <a class="nav-link text-danger" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Cerrar Sesión') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>

              </li>
          @endguest

      </ul>
  </nav>
  <!-- /.navbar -->
