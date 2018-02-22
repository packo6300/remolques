<?php /* Smarty version 3.1.26, created on 2018-02-22 05:45:28
         compiled from "C:\laragon\www\remolques\modulos\Config\templates\ConfiguracionListar.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:17414021545a8e58f89108e3_93078656%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '789a3daab286148b0d552a7d24c0ee0852d4bfae' => 
    array (
      0 => 'C:\\laragon\\www\\remolques\\modulos\\Config\\templates\\ConfiguracionListar.tpl',
      1 => 1519278321,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17414021545a8e58f89108e3_93078656',
  'variables' => 
  array (
    'folioRenta' => 0,
    'iva' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.26',
  'unifunc' => 'content_5a8e58f8944906_44998724',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a8e58f8944906_44998724')) {
function content_5a8e58f8944906_44998724 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '17414021545a8e58f89108e3_93078656';
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <label>Configuraciones</label>
    </div>
    <div class="panel-body">
        <div class="col-sm-2">
            <label>Folio de Renta:</label>
            <input name="folioRenta" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['folioRenta']->value;?>
">
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save"></span> Guardar</button>
        </div>
        <div class="col-sm-2">
            <label>IVA:</label>
            <input name="iva" type="number" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['iva']->value;?>
">
            <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-save"></span> Guardar</button>
        </div>
    </div>
</div>
<?php }
}
?>