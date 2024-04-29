<?php
/* Smarty version 4.2.1, created on 2023-11-15 10:27:39
  from 'C:\wamp64\www\mirandilla\mirandilla\views\panel\dashboard.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_65548f0b3827f7_64528512',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '964684c81176cb0a67943d09e109003fbaf75b3e' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\panel\\dashboard.html',
      1 => 1700040457,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65548f0b3827f7_64528512 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">

        Mirandilla
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="panel">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> Dashboard
            </a>
        </li>
        <li class="nav-title">OPCIONES</li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="verQR();">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
                </svg> Ver QR
            </a>
        </li>

        <li class="nav-title">ENCUESTAS</li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
                </svg> Preguntas
            </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="#" onclick="preguntaRequest('create',0);"><span class="nav-icon"></span> Crear</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="listadoPreguntas();"><span class="nav-icon"></span> Listado</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" onclick="encuestasRealizadas();">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                </svg> Realizadas
            </a>
        </li>
        
        <li class="nav-title">USUARIOS</li>

        <li class="nav-item">
            <a class="nav-link" href="#" onclick="userRequest('create',0);">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-user-follow"></use>
                </svg> Crear
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="listadoUsuarios();">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg> Listado
            </a>
        </li>
        
         <li class="nav-divider"></li>
        <li class="nav-title">RUTAS</li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="crearRuta();">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-walk"></use>
                </svg> Crear ruta
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="listadoRutas();">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-list"></use>
                </svg> Listado
            </a>
        </li>

        <li class="nav-divider"></li>
        <li class="nav-title">INFORMES</li>
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="graficos();">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-chart-pie"></use>
                </svg> Gráficos
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="documentos();">
                <svg class="nav-icon">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-description"></use>
                </svg> Documentos
            </a>
        </li>
        
       

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>


<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
        <div class="container-fluid">
            <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
                <svg class="icon icon-lg">
                <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
                </svg>
            </button><a class="header-brand d-md-none" href="#">
                <svg width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="lib/coreui/assets/brand/coreui.svg#full"></use>
                </svg></a>

            <ul class="header-nav ms-3">
                <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md"><img class="avatar-img" src="<?php echo $_smarty_tpl->tpl_vars['fotoPerfil']->value;?>
" onerror="this.onerror=null; this.src='images/avatar.png'" alt="avatar"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end pt-0">

                        <div class="dropdown-header bg-light py-2">
                            <div class="fw-semibold">Configuración</div>
                        </div>
                        <a class="dropdown-item" href="#" onclick="perfil();">
                            <svg class="icon me-2">
                            <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                            </svg> Perfil
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#" onclick="logOut();">
                            <svg class="icon me-2">
                            <use xlink:href="lib/coreui/vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                            </svg> Salir</a>
                    </div>
                </li>
            </ul>
        </div>

    </header>

    <div class="body flex-grow-1 px-3" id="container-principal">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-primary">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold"><?php echo $_smarty_tpl->tpl_vars['encuestasTotales']->value;?>
</div>
                                <div>Encuestas totales</div>
                            </div>

                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart1" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-info">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold"><?php echo $_smarty_tpl->tpl_vars['encuestasTotalesDia']->value;?>
</div>
                                <div>Encuestas del día</div>
                            </div>

                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart2" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-warning">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold"><?php echo $_smarty_tpl->tpl_vars['visitasPrincipal']->value+$_smarty_tpl->tpl_vars['visitasRutas']->value+$_smarty_tpl->tpl_vars['visitasEncuesta']->value;?>
</div>
                                <div>Visitas totales</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-start mt-2 mb-2" style="height:70px;">
                            <div style="margin-left: 16px">
                                <div>Principal: <b><?php echo $_smarty_tpl->tpl_vars['visitasPrincipal']->value;?>
</b></div>
                                <div>Rutas: <b><?php echo $_smarty_tpl->tpl_vars['visitasRutas']->value;?>
</b></div>
                                <div>Encuesta: <b><?php echo $_smarty_tpl->tpl_vars['visitasEncuesta']->value;?>
</b></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-danger">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fs-4 fw-semibold"><?php echo $_smarty_tpl->tpl_vars['rutasTotales']->value;?>
</div>
                                <div>Rutas</div>
                            </div>

                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart4" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Balance - encuestas</h4>
                            <div class="small text-medium-emphasis">Últimos 6 meses</div>
                        </div>
                    </div>
                    <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                        <canvas class="chart" id="main-chart" height="300"></canvas>
                    </div>
                </div>

            </div>

            <!-- /.row-->

        </div>
    </div>
    <?php echo $_smarty_tpl->tpl_vars['footer']->value;?>

</div>
<?php }
}
