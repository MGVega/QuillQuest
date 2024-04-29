<?php
/* Smarty version 4.2.1, created on 2023-11-13 13:10:27
  from 'C:\wamp64\www\mirandilla\mirandilla\views\common\header_web.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_65521233b4bac5_60832429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3f0a6b4412022f0bcc159ab99feb42971f6a39e0' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\common\\header_web.html',
      1 => 1695204994,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65521233b4bac5_60832429 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="mailto:ayuntamiento@mirandilla.es" class="colorBlack">
                    <i class="fa-regular fa-envelope padding-right10"></i>
                    <span class="d-md-inline-block">ayuntamiento@mirandilla.es</span>
                </a>
                <span class="mx-md-2 d-inline-block"></span>
                <a href="tel:924320647" class="colorBlack">
                    <i class="fa-solid fa-phone padding-right10"></i>                            
                    <span class="d-md-inline-block">924 32 06 47</span>
                </a>
                <div class="float_right">
                    <a href="https://www.youtube.com/@aytomirandilla5877/featured" class="colorBlack" target="_blank">
                        <i class="fa-brands fa-youtube padding-right10"></i>
                        <span class="d-md-inline-block">Youtube</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['show_menu']->value) {?>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top menuPrincipalPueblo" id_menu="1">

        <a class="navbar-brand padding-left40" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
            <img src="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
images/escudoMirandilla.png" width="30" height="30" class="d-inline-block align-top" alt="logo ayuntamiento de mirandilla">
            Ayuntamiento de Mirandilla
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto padding-right40">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
ayuntamiento">Ayuntamiento</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Localidad
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
historia">Historia</a>
                        <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
fiestas">Fiestas y tradiciones</a>
                        <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
turismo">Turismo</a>
                        <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
rutas">Rutas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
ubicacion">Ubicación</a>
                    </div>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tablón digital
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
enlaces">Enlaces de interés</a>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $_smarty_tpl->tpl_vars['urlExtra']->value;?>
contacto">Contacto</a>
                </li>

            </ul>

        </div>
    </nav>
</header>
<?php }
}
}
