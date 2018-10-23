<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/users/'.Auth::User()->idpersona).'.jpg'}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Sistema Colegio</li>
            @if(Auth::tieneAccesoMenu(1))
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Perfil</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if(Auth::tieneAccesoSubMenu(1))
                    <li><a href="/perfil/cambiarPassword">Cambiar Contraseña</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(2))
                    <li><a href="/perfil/cambiarFotoPerfil">Cambiar foto de perfil</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(3))
                    <li><a href="{{url('/perfil/skin')}}">Personalizar pagina</a></li>@endif


                </ul>
            </li>
            @endif
            @if(Auth::tieneAccesoMenu(2))
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Apertura</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  @if(Auth::tieneAccesoSubMenu(4))
                    <li><a href="/apertura/aperturaGestion">Apertura Gestion</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(5))
                    <li><a href="/apertura/gestionarGrado">Gestionar Grado</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(6))
                    <li><a href="/apertura/gestionarBloque">Gestionar Bloque</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(7))
                    <li><a href="/apertura/gestionarGradoBloque">Gestionar GradoBloque</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(8))
                    <li><a href="/apertura/gestionarMateria">Gestionar Materia</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(9))
                    <li><a href="/apertura/gestionarAula">Gestionar Aula</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(10))
                    <li><a href="/apertura/gestionarPeriodo">Gestionar Periodo</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(11))
                    <li><a href="/apertura/gestionarProgramacionMateria">Gestionar Programacion Materia</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(12))
                    <li><a href="/apertura/gestionarAdministrativo">Gestionar Personal Administrativo</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(13))
                    <li><a href="/apertura/gestionarDocente">Gestionar Docente</a></li>@endif

               </ul>
            </li>
            @endif
            @if(Auth::tieneAccesoMenu(3))
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Administracion Usuario</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if(Auth::tieneAccesoSubMenu(14))
                    <li><a href="/admUsuario/gestionarUsuario">Gestionar Usuarios</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(15))
                    <li><a href="/admUsuario/gestionarTipoUsuario">Gestionar Tipo Usuarios</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(16))
                    <li><a href="/admUsuario/gestionarPrivilegios">Asignar privilegios</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(17))
                    <li><a href="/admUsuario/bitacora">Bitácora</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(18))
                    <li><a href="/admUsuario/gestionarReporte">Reportes</a></li>@endif


               </ul>
            </li>
            @endif
            @if(Auth::tieneAccesoMenu(4))
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Academico</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    @if(Auth::tieneAccesoSubMenu(19))
                    <li><a href="/academico/gestionarInscripcion">Gestionar Inscripcion</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(20))
                    <li><a href="/academico/gestionarEstudiante">Gestionar Estudiante</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(21))
                    <li><a href="/academico/gestionarTutor">Gestionar Tutor</a></li>@endif
                    @if(Auth::tieneAccesoSubMenu(22))
                    <li><a href="/academico/gestionarCuota">Gestionar Cuota</a></li>@endif

               </ul>
            </li>
            @endif
            @if(Auth::tieneAccesoMenu(4))
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Administracion del Colegio</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  @if(Auth::tieneAccesoSubMenu(23))
                    <li><a href="/admEmpresa/gestionarEmpresa">Gestionar Pagina</a></li>@endif
                </ul>
            </li>
            @endif

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
