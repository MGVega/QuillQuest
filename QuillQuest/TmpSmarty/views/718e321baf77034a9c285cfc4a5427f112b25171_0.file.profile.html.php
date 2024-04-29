<?php
/* Smarty version 4.2.1, created on 2023-11-17 14:25:34
  from 'C:\wamp64\www\mirandilla\mirandilla\views\panel\profile.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_655769cec4b910_53074000',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '718e321baf77034a9c285cfc4a5427f112b25171' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\panel\\profile.html',
      1 => 1695204981,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655769cec4b910_53074000 (Smarty_Internal_Template $_smarty_tpl) {
?><main id="wrapper" class="active">
    <div id="container" class="margin-bottom40 perfilUsuario">
        <h3 class="margin-bottom20">Perfil de administrador</h3>
        <div class="row justify-content-around">
            <div class ="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                <div class="card mb-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Nombre: </b><br><?php echo $_smarty_tpl->tpl_vars['usuario']->value->name;?>
</li>
                        <li class="list-group-item"><b>Apellidos: </b><br><?php echo $_smarty_tpl->tpl_vars['usuario']->value->lastname;?>
</li>
                        <li class="list-group-item"><b>Email: </b><br><?php echo $_smarty_tpl->tpl_vars['usuario']->value->email;?>
</li>
                    </ul>
                </div>
                <div class="mb-4">
                    <button class="btn btn-primary" onclick="modalModif();"><i class="fas fa-pencil cursor_pointer"></i> Editar</button>
                </div>
<!-- - - - - - Modificar contraseña - - - - - -->
<div id="contraCambio" class="mb-4"><h4>Cambio de contraseña</h4>
                    <form>
                    <div>
                        <p>Su contraseña debe contener mínimo: 8 caracteres, una letra minúscula, una letra mayúscula, un número y un carácter especial</p>
                        <label for="contraNuevo">Contraseña nueva: </label>
                        <input type="password" id="contraNuevo" name="contraNuevo" minlength="8">
                    </div>
                    <div class="mt-2">
                        <label for="contraRepe">Repetir contraseña: </label>
                        <input type="password" id="contraRepe" name="contraRepe" required="required">
                    </div>
                    </form>
                    <div class="mt-2">
                        <button id="contraGuardar" class="btn btn-secondary mt-1" onclick="modificarContra(<?php echo $_smarty_tpl->tpl_vars['idUsuario']->value;?>
)"><i class="fas fa-lock cursor_pointer"></i> Cambiar contraseña</button>
                    </div>
                    <div id="contraMensaje" class="text-danger"></div>
                </div>
            </div>
<!-- - - - - - Foto - - - - - -->
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 imagenPerfil">
                <div class="card">
                    <img  class="card-img-top" src="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->photo;?>
" onerror="this.onerror=null; this.src='images/avatar.png'" alt="">
                </div>
            </div>
        </div>

        
<!-- - - - - Modal - - - - -->
        <div id="modal_modif" class="hidden-print modal fade">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="modificarUsuario">
                        <div class="text-20">
                            <strong>Editar perfil</strong>
                        </div>
                        <div class="row margin-top20">
                            <div class="col-md-12 mb-1">
                                <label for="nombreNuevo">Nombre: </label>
                                <input type="text" class="form-control form-control-inline mb-2" id="nombreNuevo" name="nombreNuevo" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->name;?>
">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="apellidoNuevo">Apellido: </label>
                                <input type="text" class="form-control form-control-inline mb-2" id="apellidoNuevo" name="apellidoNuevo" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->lastname;?>
">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="emailNuevo">Email: </label>
                                <input type="text" class="form-control form-control-inline mb-2" id="emailNuevo" name="emailNuevo" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value->email;?>
">
                            </div>
                            <div class="col-md-12 mb-1">
                                <label for="fotoNuevo">Foto de perfil: </label>
                                <input type="file" class="form-control" id="fotoNuevo" name="fotoNuevo" />
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn backgroundGrey" data-bs-dismiss="modal" onclick="closeModal('modal_modif');">Cancelar</button>
                        <button type="button" class="btn background_color1 colorWhite" onclick="modificarUsuario(<?php echo $_smarty_tpl->tpl_vars['usuario']->value->user_id;?>
)">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main><?php }
}
