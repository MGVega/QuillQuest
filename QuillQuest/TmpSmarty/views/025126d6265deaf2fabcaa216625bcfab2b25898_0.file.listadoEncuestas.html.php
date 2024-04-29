<?php
/* Smarty version 4.2.1, created on 2023-11-15 11:09:16
  from 'C:\wamp64\www\mirandilla\mirandilla\views\panel\encuestas\listadoEncuestas.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_655498cc634327_64627742',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '025126d6265deaf2fabcaa216625bcfab2b25898' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\panel\\encuestas\\listadoEncuestas.html',
      1 => 1695204988,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655498cc634327_64627742 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\wamp64\\www\\mirandilla\\mirandilla\\vendor\\smarty\\smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>
<h3>Listado de encuestas realizadas</h3>

<div class="row margin-top20">
    
    <div class="col-md-12">
        
        <table class="datatable display width100" id="listadoPreguntas">
            <thead>
                <tr>
                    <th class="text-left">Id</th>
                    <th class="text-center">Fecha encuesta</th>
                    <th class="text-center">Total preguntas contestadas</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['encuestas']->value, 'encuesta');
$_smarty_tpl->tpl_vars['encuesta']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['encuesta']->value) {
$_smarty_tpl->tpl_vars['encuesta']->do_else = false;
?>
                <tr>
                    <td class="text-left color5"><strong><?php echo $_smarty_tpl->tpl_vars['encuesta']->value->encuesta_id;?>
</strong></td>
                    <td class="text-center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['encuesta']->value->fecha_encuesta,'%d/%m/%Y - %I:%M');?>
</td>
                    <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['encuesta']->value->total_respuestas;?>
</td>
                    <td class="text-center">
                        
                        <div class="row">
                            <div class="col-md-12 color1">
                                <i class="fas fa-eye cursor_pointer" onclick="verEncuestaPage(<?php echo $_smarty_tpl->tpl_vars['encuesta']->value->encuesta_id;?>
);" title="Ver encuesta"></i>
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
</div>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['encuestas']->value, 'pregunta');
$_smarty_tpl->tpl_vars['pregunta']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pregunta']->value) {
$_smarty_tpl->tpl_vars['pregunta']->do_else = false;
?>


<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
