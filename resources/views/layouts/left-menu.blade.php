<div class="col-xs-1 col-sm-1 col-md-1 col-lg-2 col-xl-2 col-xxl-2 border-rt-e6 px-0">
    <div class="d-flex flex-column align-items-center align-items-sm-start ">
                <ul class="nav flex-column pt-2 w-100">
                @if(Auth::user()->rol == "student" && Auth::user()->estado == 1 || Auth::user()->rol != "student")
                    <li class="nav-item">
                        {{-- <a class="nav-link {{ request()->is('home')? 'active' : '' }}" href="{{url('home')}}"><i class="ms-auto bi bi-grid"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">{{ __('Dashboard') }}</span></a> --}}
                        <a class="nav-link" href="{{url('home')}}"><i class="ms-auto bi bi-grid"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">{{ __('Dashboard') }}</span></a>
                    </li>
                    @else
                    <div>No tiene acceso al sistema </div>
                @endif

                    @foreach(Auth::user()->roles as $role)
                        @if($role->name == "Firmador")
                            <li class="nav-item">
                                {{-- <a class="nav-link {{ request()->is('home')? 'inactive' : '' }}" href="{{route('firma.create')}}"><i class="ms-auto bi bi-grid"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">{{ __('Firmas') }}</span></a> --}}
                                <a class="nav-link" href="{{route('firma.create')}}"><i class="ms-auto bi bi-grid"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">{{ __('Firmas') }}</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex" href="{{route('keys')}}"><i class="bi bi-key me-2"></i></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Clave</span> <span class="ms-auto d-inline d-sm-none d-md-none d-xl-inline"></span></a>
                                </li>
                        @endif

                    @if($role->name !== "Estudiante" && $role->name !== "Firmador")

                    <li class="nav-item">
                    {{-- <a class="nav-link d-flex {{ request()->is('classes')? 'active' : '' }}" href="{{url('classes')}}"><i class="bi bi-book"></i></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Cursos</span> <span class="ms-auto d-inline d-sm-none d-md-none d-xl-inline"></span></a> --}}
                    <a class="nav-link d-flex" href="{{url('classes')}}"><i class="bi bi-book"></i></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Cursos</span> <span class="ms-auto d-inline d-sm-none d-md-none d-xl-inline"></span></a>
                    </li>

                    <li class="nav-item">
                        {{-- <a type="button" href="#teacher-submenu" data-bs-toggle="collapse" class="d-flex nav-link {{ request()->is('teachers*')? 'active' : '' }}"><i class="bi bi-person-lines-fill"></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Usuarios</span> --}}
                        <a type="button" href="#teacher-submenu" data-bs-toggle="collapse" class="d-flex nav-link"><i class="bi bi-person-lines-fill"></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Usuarios</span>
                            <i class="ms-auto d-inline d-sm-none d-md-none d-xl-inline bi bi-chevron-down"></i>
                        </a>
                        {{-- <ul class="nav collapse {{ request()->is('teachers*')? 'show' : 'hide' }} bg-white" id="teacher-submenu"> --}}
                        <ul class="nav collapse bg-white" id="teacher-submenu">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('teacher.list.show')}}"><i class="bi bi-person-video2 me-2"></i> Ver Usuarios</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('teacher.create.show')}}"><i class="bi bi-person-plus me-2"></i> Registrar Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('student.add')}}"><i class="bi bi-person-plus me-2"></i> Registrar Estudiantes</a>
                            </li>

                        </ul>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{route('keys')}}"><i class="bi bi-key me-2"></i> Claves</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link d-flex" href="{{route('keys')}}"><i class="bi bi-key me-2"></i></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Clave</span> <span class="ms-auto d-inline d-sm-none d-md-none d-xl-inline"></span></a>
                            </li>
                    </li>

                    <li class="nav-item">
                        {{-- <a class="nav-link {{ request()->is('informationrepor*')? 'active' : '' }}" href="{{route('informationrepor')}}"><i class="bi bi-journal-text"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">Informes y reportes</span></a> --}}
                        <a class="nav-link" href="{{route('informationrepor')}}"><i class="bi bi-journal-text"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">Informes y reportes</span></a>
                    </li>
                    @endif
                    @if($role->name !== "Estudiante")
                    <li class="nav-item border-bottom">
                        {{-- <a class="nav-link {{ request()->is('viewprocedure*')? 'active' : '' }}" href="{{route('viewprocedure')}}"><i class="bi bi-calendar4-range"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">Trámites</span></a> --}}
                        <a class="nav-link" href="{{route('viewprocedure')}}"><i class="bi bi-calendar4-range"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">Trámites</span></a>
                    </li>
                    @endif
                    @if($role->name !== "Estudiante" && $role->name !== "Firmador")
                    <li class="nav-item">
                    <a type="button" href="#admin-request" data-bs-toggle="collapse" class="d-flex nav-link"><i class="bi bi-person-lines-fill"></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Lista de solicitudes</span>
                            <i class="ms-auto d-inline d-sm-none d-md-none d-xl-inline bi bi-chevron-down"></i>
                        </a>
                        {{-- <ul class="nav collapse {{ request()->is('request*')? 'show' : 'hide' }} bg-white" id="admin-request"> --}}
                        <ul class="nav collapse bg-white" id="admin-request">
                          <li class="nav-item "><a class="nav-link" href="{{route('listrequest')}}"><i class="bi bi-person-video2 me-2"></i> Certificados</a></li>

                            <!-- <li class="nav-item"><a class="nav-link" href="{{route('procedure.create')}}"><i class="bi bi-person-plus me-2"></i> Inscripciones</a></li> -->
                            <li class="nav-item"><a class="nav-link" href="{{route('listpre')}}"><i class="bi bi-person-plus me-2"></i>Preinscripciones</a></li>

                        </ul>
                    </li>

                    <!-- roles y permisos  -->
                    <li class="nav-item">
                        <a type="button" href="#roles_admin" data-bs-toggle="collapse" class="d-flex nav-link"><i class="bi bi-shield-lock-fill"></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Roles y Permisos</span>
                            <i class="ms-auto d-inline d-sm-none d-md-none d-xl-inline bi bi-chevron-down"></i>
                        </a>
                        {{-- <ul class="nav collapse {{ request()->is('roluser*')? 'show' : 'hide' }} bg-white" id="roles_admin"> --}}
                        <ul class="nav collapse bg-white" id="roles_admin">
                            <li class="nav-item "><a class="nav-link" href="{{route('roluser.index')}}"><i class="bi bi-person-video2 me-2"></i> Roles</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="{{route('permisos.index')}}"><i class="bi bi-person-plus me-2"></i> Permisos</a></li> -->
                        </ul>
                    </li>
                    @endif


                     @if($role->name == "Estudiante")
                    <li class="nav-item">
                    <a type="button" href="#request-list" data-bs-toggle="collapse" class="d-flex nav-link"><i class="bi bi-person-lines-fill"></i> <span class="ms-2 d-inline d-sm-none d-md-none d-xl-inline">Solicitudes</span>
                            <i class="ms-auto d-inline d-sm-none d-md-none d-xl-inline bi bi-chevron-down"></i>
                        </a>
                        {{-- <ul class="nav collapse {{ request()->is('request*')? 'show' : 'hide' }} bg-white" id="request-list"> --}}
                        <ul class="nav collapse bg-white" id="request-list">
                            <li class="nav-item"><a class="nav-link" href="{{route('request.create')}}"><i class="bi bi-person-video2 me-2"></i> Certificados</a></li>

                            <!-- <li class="nav-item"><a class="nav-link" href="{{route('inscription.create')}}"><i class="bi bi-person-plus me-2"></i> Inscripciones</a></li> -->

                        </ul>
                    </li>
                    <li class="nav-item border-bottom">
                        {{-- <a class="nav-link {{ request()->is('procedure*')? 'active' : '' }}" href="{{route('procedure.index')}}"><i class="bi bi-calendar4-range"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">Tramites</span></a> --}}
                        <a class="nav-link" href="{{route('procedure.index')}}"><i class="bi bi-calendar4-range"></i> <span class="ms-1 d-inline d-sm-none d-md-none d-xl-inline">Tramites</span></a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
