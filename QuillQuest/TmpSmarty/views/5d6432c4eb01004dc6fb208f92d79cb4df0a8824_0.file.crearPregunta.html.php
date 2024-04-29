<?php
/* Smarty version 4.2.1, created on 2023-11-15 11:06:18
  from 'C:\wamp64\www\mirandilla\mirandilla\views\panel\encuestas\crearPregunta.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_6554981a1bc5a9_79708258',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d6432c4eb01004dc6fb208f92d79cb4df0a8824' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\panel\\encuestas\\crearPregunta.html',
      1 => 1695204989,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6554981a1bc5a9_79708258 (Smarty_Internal_Template $_smarty_tpl) {
?><h3>Crear nueva pregunta</h3>

<div class="row margin-top20">
    
    <div class="col-md-12">
        <label for="pregunta_titulo"><strong>Título:</strong></label>
        <input type="text" class="form-control form-control-inline" id="pregunta_titulo">
    </div>
</div>

<div class="row margin-top20">
    
    <div class="col-md-6">
        <label for="pregunta_tipo"><strong>Seleccione el tipo de pregunta:</strong></label>
        <select class="form-control eventPreguntaTipo" id="pregunta_tipo">
            <option value="0">Seleccione uno</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['preguntasTipo']->value, 'pregTipo');
$_smarty_tpl->tpl_vars['pregTipo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pregTipo']->value) {
$_smarty_tpl->tpl_vars['pregTipo']->do_else = false;
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['pregTipo']->value->pregunta_tipo_id;?>
"><?php echo $_smarty_tpl->tpl_vars['pregTipo']->value->nombre_tipo;?>
</option>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </select>
        
    </div>
</div>

<div id="divOpciones" class="row margin-top20 displayNone">

    <div class="row">

        <div class="col-md-4">
            <label for="btnAddNewResponse"><strong>Añadir nueva opción de respuesta</strong></label>
            <button class="btn background_color1" id="btnAddNewResponse"><i class="fa-solid fa-plus"></i></button>

        </div>

        <div class="col-md-4">
            <input type="checkbox" class="" id="activar_otros">
            Activar respuesta libre "otros".
            
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="addResponse" class="padding20 background_color2 margin-top20">

            </div>
        </div>
    </div>

</div>

<div id="divSelect" class="row margin-top20 displayNone clear_both">

    <div class="row">

        <div class="col-md-12">
            <strong>Marque los selects que quiera incluir en la respuesta</strong>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="allSelects" class="padding20 background_color2 margin-top20">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['selects']->value, 'sel');
$_smarty_tpl->tpl_vars['sel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sel']->value) {
$_smarty_tpl->tpl_vars['sel']->do_else = false;
?>
                <div class="row margin-top10">
                    <div class="col-md-6 border-white cursor_pointer background_color1 colorWhite border-radius5 padding10">
                        <div class="float_left">
                            <input type="checkbox" class="eventNewSelect" select_id="<?php echo $_smarty_tpl->tpl_vars['sel']->value->select_id;?>
">
                            <?php echo $_smarty_tpl->tpl_vars['sel']->value->nombre;?>

                        </div>
                        <div class="float_left padding-left10 cursor_pointer float_right">
                            <i class="fa-solid fa-sort"></i>
                        </div>
                    </div>
                </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
    </div>

</div>

<div class="row margin-top20">
    <div class="col-md-12">
        <button class="btn background_color1" onclick="preguntaRequest('save',0)">Guardar</button>
    </div>
</div><?php }
}
