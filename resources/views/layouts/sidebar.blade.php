<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/dashboard" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/dashboard" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            {{-- @role('admin') --}}
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>{{ __('Menu') }}</span></li>
                <li class="nav-item">{{-- Perfil  --}}
                    <a class="nav-link menu-link" href="#perfil" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="perfil">
                        <i class="mdi mdi-account"></i><span>{{ __('Profile') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="perfil">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="perfil" class="nav-link">{{ __('Listado de perfiles') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="perfil" class="nav-link">{{ __('Crear nuevo perfil') }}</a>
                            </li>                            
                            <li class="nav-item">
                                <a href="perfil" class="nav-link">{{ __('Editar perfil') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Roles  --}}
                    <a class="nav-link menu-link" href="#roles" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="roles">
                        <i class="mdi mdi-server-security"></i><span>{{ __('Roles') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="roles">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">{{ __('Listado de roles') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permisos.index') }}" class="nav-link">{{ __('Listado de permisos') }}</a>
                            </li>                            
                            <li class="nav-item">
                                <a href="{{ route('asignar.index') }}" class="nav-link">{{ __('Listado de usuarios') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- clientes  --}}
                    <a class="nav-link menu-link" href="#usuario" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="usuario">
                        <i class="mdi mdi-folder-account"></i><span>{{ __('User') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="usuario">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('usuario.index') }}" class="nav-link">{{ __('Listado de usuarios') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('usuario.create') }}" class="nav-link">{{ __('Crear nuevo usuario') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a href="{{ route('mapa.index') }}" class="nav-link">{{ __('Mapas') }}</a>
                </li>
                <li class="nav-item">{{-- negocio  --}}
                    <a class="nav-link menu-link" href="#negocio" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="negocio">
                        <i class="mdi mdi-store"></i><span>{{ __('Business') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="negocio">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('negocio.index') }}" class="nav-link">{{ __('Listado de negocios') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('negocio.create') }}" class="nav-link">{{ __('Crear nuevo negocio') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- pedidos  --}}
                    <a class="nav-link menu-link" href="#pedido" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pedido">
                        <i class="mdi mdi-package"></i><span>{{ __('Pedidos') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="pedido">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('pedido.index') }}" class="nav-link">{{ __('Listado de pedido') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pedido.create') }}" class="nav-link">{{ __('Crear nuevo pedido') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pedido.xcargamasiva') }}" class="nav-link">{{ __('Pedidos masivos') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('coordinador.incidencias') }}" class="nav-link">{{ __('Incidencias pedidos') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- recojo  --}}
                    <a class="nav-link menu-link" href="#recojo" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="recojo">
                        <i class="mdi mdi-inbox-arrow-down"></i><span>{{ __('Recojo') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="recojo">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="recojo" class="nav-link">{{ __('Listado de recojo') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="recojo" class="nav-link">{{ __('Crear nuevo recojo') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Motorizado  --}}
                    <a class="nav-link menu-link" href="#motorizado" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="motorizado">
                        <i class="mdi mdi-motorbike"></i><span>{{ __('Motorizado') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="motorizado">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('moto.index') }}" class="nav-link">{{ __('Listado de motorizados') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moto.create') }}" class="nav-link">{{ __('Crear nuevo motorizado') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moto.pedidos') }}" class="nav-link">{{ __('Pedidos Motorizado') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moto.index') }}" class="nav-link">{{ __('Recojos Motorizado') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moto.index') }}" class="nav-link">{{ __('Devoluciones Motorizado') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('moto.index') }}" class="nav-link">{{ __('Reportes Motorizado') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Ruta  --}}
                    <a href="{{ route('ruta.index')}}" class="nav-link"> <i class="mdi mdi-routes"></i> {{ __('Rutas') }}</a>
                </li>
                <li class="nav-item">{{-- Calculadora  --}}
                    <a class="nav-link menu-link" href="#calculadora" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="calculadora">
                        <i class="mdi mdi-calculator"></i><span>{{ __('Calculadora') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="calculadora">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="calculadora" class="nav-link">{{ __('Calculadora') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Recepción  --}}
                    <a class="nav-link menu-link" href="#recepcion" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="recepcion">
                        <i class="mdi mdi-package-variant-closed-plus"></i><span>{{ __('Recepción') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="recepcion">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="recepcion" class="nav-link">{{ __('Listado de recepcion') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="recepcion" class="nav-link">{{ __('Crear nuevo recepcion') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Devolución  --}}
                    <a class="nav-link menu-link" href="#devolucion" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="devolucion">
                        <i class="mdi mdi-package-variant-remove"></i><span>{{ __('Devolución') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="devolucion">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="devolucion" class="nav-link">{{ __('Listado de devolucion') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="devolucion" class="nav-link">{{ __('Crear nuevo devolucion') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Traslado  --}}
                    <a class="nav-link menu-link" href="#traslado" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="traslado">
                        <i class="mdi mdi-transfer"></i><span>{{ __('Traslado') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="traslado">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="traslado" class="nav-link">{{ __('Listado de traslado') }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="traslado" class="nav-link">{{ __('Crear nuevo traslado') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Pagos  --}}
                    <a class="nav-link menu-link" href="#pago" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pago">
                        <i class="mdi mdi-cash-fast"></i><span>{{ __('Pago') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="pago">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="pago" class="nav-link">{{ __('Listado de pago') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Cobros  --}}
                    <a class="nav-link menu-link" href="#cobro" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="cobro">
                        <i class="mdi mdi-account-cash"></i><span>{{ __('Cobro') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="cobro">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="cobro" class="nav-link">{{ __('Listado de cobro') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">{{-- Configuración  --}}
                    <a class="nav-link menu-link" href="#configuracion" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="configuracion">
                        <i class="mdi mdi-cogs"></i><span>{{ __('Configuración') }} </span>
                    </a>
                    <div class="collapse menu-dropdown" id="configuracion">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="configuracion" class="nav-link">{{ __('Listado de configuracion') }}</a>
                            </li>
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
            </ul>
            {{-- @endrole --}}
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
