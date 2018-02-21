<?php /* Smarty version 3.1.26, created on 2015-12-29 18:35:45
         compiled from "C:\xampp\htdocs\modulos\Ventas\templates\OvPdfTicket.html" */ ?>
<?php
/*%%SmartyHeaderCode:813556830ac1e32f84_32419615%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82caa7b09e4410591c037192f5225f570bdb1ef3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\modulos\\Ventas\\templates\\OvPdfTicket.html',
      1 => 1451428541,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '813556830ac1e32f84_32419615',
  'variables' => 
  array (
    'folio' => 0,
    'dia' => 0,
    'mes' => 0,
    'year' => 0,
    'hora' => 0,
    'nombre' => 0,
    'saldo' => 0,
    'total' => 0,
    'productos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.26',
  'unifunc' => 'content_56830ac1f09075_51229582',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56830ac1f09075_51229582')) {
function content_56830ac1f09075_51229582 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\htdocs\\dom\\smarty\\libs\\plugins\\modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '813556830ac1e32f84_32419615';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
    </head>
    <body>
        <br><br>
        <table width="40%">
            <tr>
                <td valign="middle">  
                    <center>
                        <img src="http://localhost:81/img/logopng.png" style="width: 150px;" ><br>
                        <b>Remolques Aeropuerto</b><br>
                        <b>Nota de Venta</b><br>
                        <b>Folio:<?php echo $_smarty_tpl->tpl_vars['folio']->value;?>
</b><br>
                    </center>
                        <?php echo $_smarty_tpl->tpl_vars['dia']->value;?>
 de <?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
 del <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['hora']->value,"%I:%M %p");?>

                </td>
                <td></td>
            </tr>   
        </table>
<br><br><br>
<table width="40%" border="1" cellpadding="2" cellspacing="1">
<tr>
    <th bgcolor="#F0F0F0">Cliente:</th>
    <td ><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</td>
</tr><tr>
    <th bgcolor="#F0F0F0">Saldo:</th>
    <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['saldo']->value);?>
</td>
</tr><tr>
    <th bgcolor="#F0F0F0">Total:</th>
    <td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total']->value);?>
</td>
</tr>
</table>
<br><br><br>

<table width="40%" border="0" cellpadding="2" cellspacing="0">
<tr bgcolor="#F0F0F0">
	<th colspan="2" bgcolor="#F0F0F0" >Descripción</th>
	<th bgcolor="#F0F0F0" >Cant.</th>
	<th bgcolor="#F0F0F0" >Precio</th>
</tr>
<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['productos']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
<tr>
	<td colspan="2" align="center"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['descr'];?>
</td>
	<td align="right"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['cant'];?>
</td>
	<td align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['precio']);?>
</td>
</tr>
<?php endfor; endif; ?>
<tr>
    <td colspan="2"></td>
	<th  align="left" bgcolor="#F0F0F0">Total:</th>
	<td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total']->value);?>
</b></td>
</tr>
</table>
    </body>
</html>
<?php }
}
?>