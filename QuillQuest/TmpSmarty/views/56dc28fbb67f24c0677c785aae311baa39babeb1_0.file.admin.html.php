<?php
/* Smarty version 4.2.1, created on 2023-11-15 10:27:12
  from 'C:\wamp64\www\mirandilla\mirandilla\views\web\admin.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_65548ef07cf305_80587126',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56dc28fbb67f24c0677c785aae311baa39babeb1' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\web\\admin.html',
      1 => 1695204986,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65548ef07cf305_80587126 (Smarty_Internal_Template $_smarty_tpl) {
?><section id="formulario">
    <!-- Aquí va el formulario que se debe enviar a un técnico del Ayuntamiento -->
    <div class="contenedor center">
        <h1 class="color3">Panel de administración</h1>
    </div>

    <div class="container">
        
        <div id="resultLogin" class="text-18">
            
        </div>

        <div class="row padding20">
            <div class="col-md-12">
                <label for="nombre" class="labelGrey">Usuario</label> 
                <input size="1" type="text" name="usuario" id="usuario" class="allWidth input_contact form-control" placeholder="Usuario" required="required" aria-required="true">
            </div>

            <div class="col-md-12 margin-top10">
                <label for="email" class="labelGrey">Contraseña</label>
                <input type="password" name="password" id="password" class="allWidth input_contact form-control" placeholder="Contraseña" required="required" aria-required="true">
            </div>

        </div>
        
        <div class="margin-top10 padding10">
            <div class="g-recaptcha" data-sitekey="<?php echo $_smarty_tpl->tpl_vars['reCaptcha']->value;?>
" data-callback="onSubmit" data-expired-callback="onExpire"></div>

        </div>


        <div class="row padding40">
            <div class="col-md-12">
                <button class="btn btnSubmitSolicitud cursor_pointer notDisplay" onclick="doLogin();" disabled id="btnLogin">
                    Entrar
                </button>
            </div>
        </div>
        


    </div>


</section><?php }
}
