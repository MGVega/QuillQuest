<?php
/* Smarty version 4.2.1, created on 2023-11-15 11:22:02
  from 'C:\wamp64\www\mirandilla\mirandilla\views\panel\usuarios\crearUsuario.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_65549bca461787_69787964',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2aeaca2979471b517d729d4a735b398251c64c82' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\panel\\usuarios\\crearUsuario.html',
      1 => 1700043719,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65549bca461787_69787964 (Smarty_Internal_Template $_smarty_tpl) {
?><h3>Crear usuario</h3>

<div class="row margin-top20">
    
    <div class="col-md-6">
        <label for="nombre_usuario"><strong>Nombre:</strong></label>
        <input type="text" class="form-control form-control-inline" id="nombre_usuario" required>
    </div>
    
    <div class="col-md-6">
        <label for="apellidos_usuario"><strong>Apellidos:</strong></label>
        <input type="text" class="form-control form-control-inline" id="apellidos_usuario" required>
    </div>
</div>

<div class="row margin-top20">
    
    <div class="col-md-6">
        <label for="email_usuario"><strong>Email:</strong></label>
        <input type="text" class="form-control form-control-inline" id="email_usuario" required>
    </div>
    
</div>

<div class="row margin-top20">
    
    <div class="col-md-6">

        <div class="input-group">
            <div>
                <label for="newPassword"><strong>Contraseña:</strong></label>
                <input type="password" class="form-control form-control-inline" id="newPassword" required>
            </div>
            <div class="padding-left10 padding-top40">
                <span onclick="showPassword(1);" id="eyePassword"><i class="fas fa-eye-slash cursor_pointer color7"></i></span>

            </div>

        </div>
    </div>
    
  </div>  
<div class="row margin-top20">    

    <div class="col-md-6">

        <div class="input-group">
            <div>
                <label for="confirmPassword"><strong>Confirmar contraseña:</strong></label>
                <input type="password" class="form-control form-control-inline" id="confirmPassword" required>
            </div>

        </div>

    </div>
</div>

<div class="row margin-top20">
    <div class="col-md-12">

        <strong>La contraseña debe contener:</strong>

        <ul class="margin-top20">
            <li>
                Longitud entre <strong>6</strong> y <strong>15</strong> caracteres.
            </li>
            <li>
                Una letra mayúscula.
            </li>
            <li>
                Una letra minúscula.
            </li>
            <li>
                Un dígito.
            </li>
            <li>
                Alguno de los siguientes caracteres <strong>@#-_$%&+=!?</strong>
            </li>
        </ul>

    </div>
</div>


<div class="row margin-top20">
    <div class="col-md-12">
        <button class="btn background_color1 colorWhite" onclick="userRequest('save',0)">Guardar</button>
    </div>
</div><?php }
}
