<?php
/* Smarty version 4.2.1, created on 2023-11-15 11:06:19
  from 'C:\wamp64\www\mirandilla\mirandilla\views\panel\encuestas\listadoPreguntas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6554981b764244_38107278',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6eb18f3b488a17553e66d6d064e50d542c916c48' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\panel\\encuestas\\listadoPreguntas.html',
      1 => 1695204978,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6554981b764244_38107278 (Smarty_Internal_Template $_smarty_tpl) {
?><h3>Listado de preguntas creadas</h3>

<div class="row margin-top20">
    
    <div class="col-md-12">
        
        <table class="datatable width100" id="listadoPreguntas">
            <thead>
                <tr>
                    <th class="text-left">Id</th>
                    <th class="text-center">Título</th>
                    <th class="text-center">Tipo de pregunta</th>
                    <th class="text-center">Visible</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['preguntas']->value, 'pregunta');
$_smarty_tpl->tpl_vars['pregunta']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pregunta']->value) {
$_smarty_tpl->tpl_vars['pregunta']->do_else = false;
?>
                <tr>
                    <td class="text-left color5"><strong><?php echo $_smarty_tpl->tpl_vars['pregunta']->value->pregunta_id;?>
</strong></td>
                    <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['pregunta']->value->titulo;?>
</td>
                    <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['pregunta']->value->nombre_tipo;?>
</td>
                    <td class="text-center">
                        <?php if ($_smarty_tpl->tpl_vars['pregunta']->value->visible == 1) {?>
                        <a href="#" class="text-success" onclick="preguntaRequest('deactivate',<?php echo $_smarty_tpl->tpl_vars['pregunta']->value->pregunta_id;?>
)">
                            <i class="fas fa-toggle-on" title="Desactivar pregunta"></i>
                        </a>
                        <?php } else { ?>
                        <a href="#" class="text-secondary" onclick="preguntaRequest('activate',<?php echo $_smarty_tpl->tpl_vars['pregunta']->value->pregunta_id;?>
)">
                            <i class="fas fa-toggle-off" title="Activar pregunta"></i>
                        </a>
                        <?php }?>
                    </td>
                    <td class="text-center">
                        
                        <div class="row">
                            <div class="col-md-12 color1">
                                <i class="fas fa-pencil-alt cursor_pointer" onclick="verPreguntaPage(<?php echo $_smarty_tpl->tpl_vars['pregunta']->value->pregunta_id;?>
);" title="Modificar pregunta"></i>
                            </div>                            
                        </div>
                        
                    </td>

                </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
        
    </div>
</div><?php }
}
