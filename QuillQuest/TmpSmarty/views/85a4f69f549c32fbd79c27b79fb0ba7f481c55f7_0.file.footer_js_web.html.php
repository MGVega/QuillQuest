<?php
/* Smarty version 4.2.1, created on 2023-11-13 13:10:28
  from 'C:\wamp64\www\mirandilla\mirandilla\views\common\footer_js_web.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.2.1',
  'unifunc' => 'content_655212341560b7_76550621',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '85a4f69f549c32fbd79c27b79fb0ba7f481c55f7' => 
    array (
      0 => 'C:\\wamp64\\www\\mirandilla\\mirandilla\\views\\common\\footer_js_web.html',
      1 => 1695204978,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655212341560b7_76550621 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlLib']->value;?>
components/jquery/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlLib']->value;?>
components/jqueryui/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlLib']->value;?>
twbs/bootstrap/dist/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlLib']->value;?>
fortawesome/font-awesome/js/solid.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlLib']->value;?>
fortawesome/font-awesome/js/fontawesome.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlJsConfig']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlJsComun']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlJsCntrl']->value;?>
"><?php echo '</script'; ?>
>

<?php if ($_smarty_tpl->tpl_vars['apiGoogle']->value == 1) {
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['urlJsRutas']->value;?>
"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkMtgzeaOQz8OaG4yoR_7TWAg1KuxphAk&callback=initMap&v=weekly"><?php echo '</script'; ?>
>

<?php }?>


<?php }
}
