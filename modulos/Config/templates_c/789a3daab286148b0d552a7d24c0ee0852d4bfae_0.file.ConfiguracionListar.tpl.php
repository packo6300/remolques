<?php /* Smarty version 3.1.26, created on 2018-02-25 19:15:57
         compiled from "C:\laragon\www\remolques\modulos\Config\templates\ConfiguracionListar.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:18287233955a930b6d006676_00563832%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '789a3daab286148b0d552a7d24c0ee0852d4bfae' => 
    array (
      0 => 'C:\\laragon\\www\\remolques\\modulos\\Config\\templates\\ConfiguracionListar.tpl',
      1 => 1519586133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18287233955a930b6d006676_00563832',
  'variables' => 
  array (
    'folioRenta' => 0,
    'iva' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.26',
  'unifunc' => 'content_5a930b6d03f6f7_57804115',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a930b6d03f6f7_57804115')) {
function content_5a930b6d03f6f7_57804115 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '18287233955a930b6d006676_00563832';
?>
<?php echo '<script'; ?>
 type="text/javascript" src="modulos/Config/js/ConfiguracionListar.js"><?php echo '</script'; ?>
>
<div class="panel panel-primary">
    <div class="panel-heading">
        <label>Configuraciones</label>
    </div>
    <div class="panel-body">
        <div class="col-sm-2">
            <form id="renta">
            <label>Folio de Renta:</label>
            <input name="folioRenta" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['folioRenta']->value;?>
">
            <button type="button" class="btn btn-default" onclick="actualizarFolio();"><span class="glyphicon glyphicon-save"></span> Guardar</button>
            </form>
        </div>
        <div class="col-sm-2">
            <form id="iva">
            <label>IVA:</label>
            <input name="iva" type="number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['iva']->value;?>
">
            <button type="button" class="btn btn-default" onclick="actualizarIVA();"><span class="glyphicon glyphicon-save"></span> Guardar</button>
            </form>
        </div>
    </div>
</div>
<?php }
}
?>