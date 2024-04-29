<?php
/* Smarty version 4.2.1, created on 2023-11-15 11:10:42
  from 'C:\wamp64\www\mirandilla\mirandilla\views\panel\usuarios\listadoUsuarios.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_655499221a8c58_11487202',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13d9d198754b03405793bc1d5be38019974b9e84' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\panel\\usuarios\\listadoUsuarios.html',
      1 => 1700041270,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655499221a8c58_11487202 (Smarty_Internal_Template $_smarty_tpl) {
?><h3>Listado de usuarios</h3>

<div class="row margin-top20">
    
    <div class="col-md-12">
        
        <table class="datatable width100" id="listadoPreguntas">
            <thead>
                <tr>
                    <th class="text-left">Id</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Apellidos</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['usuarios']->value, 'usuario');
$_smarty_tpl->tpl_vars['usuario']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['usuario']->value) {
$_smarty_tpl->tpl_vars['usuario']->do_else = false;
?>
                <tr>
                    <td class="text-left color5"><strong><?php echo $_smarty_tpl->tpl_vars['usuario']->value->user_id;?>
</strong></td>
                    <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['usuario']->value->name;?>
</td>
                    <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['usuario']->value->lastname;?>
</td>
                    <td class="text-center">
                        <?php echo $_smarty_tpl->tpl_vars['usuario']->value->email;?>

                    </td>
                    <td class="text-center">
                        
                        <div class="row">
                            <div class="col-md-6 color1">
                                <i class="fas fa-pencil-alt cursor_pointer" onclick="verUsuarioPage(<?php echo $_smarty_tpl->tpl_vars['usuario']->value->user_id;?>
);" title="Modificar usuario"></i>
                            </div>
                            <div class="col-md-6 colorError">
                                <i class="fa-solid fa-xmark cursor_pointer" onclick="modalDeleteMore(<?php echo $_smarty_tpl->tpl_vars['usuario']->value->user_id;?>
);" title="Borrar alojamiento"></i>
                            </div>                          
                        </div>
                        
                    </td>

                </tr>

            <div id="modal_delete_<?php echo $_smarty_tpl->tpl_vars['usuario']->value->user_id;?>
" class="hidden-print modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header background_color4 text-white">
                            <h3 class="modal-title text_bold">Eliminar usuario</h3>
                        </div>
                        <div class="modal-body">
                            <p><b>¿Desea eliminar el usuario <?php echo $_smarty_tpl->tpl_vars['usuario']->value->email;?>
</b>? Los cambios no podrán deshacerse.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn backgroundGrey" data-bs-dismiss="modal" onclick="closeModal('modal_delete_<?php echo $_smarty_tpl->tpl_vars['usuario']->value->user_id;?>
');">Cancelar</button>
                            <button type="button" class="btn background_color4 colorWhite" onclick="userRequest('delete',<?php echo $_smarty_tpl->tpl_vars['usuario']->value->user_id;?>
)">Borrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
        
    </div>
</div>


<?php }
}
