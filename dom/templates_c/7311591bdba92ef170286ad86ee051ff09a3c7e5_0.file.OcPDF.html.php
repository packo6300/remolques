<?php /* Smarty version 3.1.26, created on 2016-01-28 11:20:13
         compiled from "C:\xampp\htdocs\modulos\Compras\templates\OcPDF.html" */ ?>
<?php
/*%%SmartyHeaderCode:1726056aa5bddea6b39_91467476%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7311591bdba92ef170286ad86ee051ff09a3c7e5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\modulos\\Compras\\templates\\OcPDF.html',
      1 => 1454005092,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1726056aa5bddea6b39_91467476',
  'variables' => 
  array (
    'folio' => 0,
    'nombre' => 0,
    'dia' => 0,
    'mes' => 0,
    'year' => 0,
    'hora' => 0,
    'saldo' => 0,
    'total' => 0,
    'productos' => 0,
    'subtotal' => 0,
    'iva' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.26',
  'unifunc' => 'content_56aa5bde085230_62679719',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56aa5bde085230_62679719')) {
function content_56aa5bde085230_62679719 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\xampp\\htdocs\\dom\\smarty\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_math')) require_once 'C:\\xampp\\htdocs\\dom\\smarty\\libs\\plugins\\function.math.php';

$_smarty_tpl->properties['nocache_hash'] = '1726056aa5bddea6b39_91467476';
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
        <br><br>
        <table width="100%" border="0" cellpadding="2" cellspacing="1">
            <tr>
                <td valign="middle" style="width: 230px;">  
                    <center><img src="http://localhost:81/img/logopng.png" style="width: 100px;" ><BR>Renta-Venta-Refacciones Reparaciones</center>
                </td>
                <td  style="width: 170px;"><br>
                    <p style="font-size: xx-small; text-align: center; ">81a y 15a Nº 8407
                        COL.AEROPUERTO CHIHUAHUA,CHIH.
                        TEL.(614)446-5109 CEL. 427-3486.</p>
                </td>
                <td  style="width: 180px; text-align: center;"><br>
                    <p style="font-size: xx-small;">MONTES URALES Nº 6725
                        FRACC. LA CUESTA JUAREZ,CHIH. <br>
                        TEL.(656)637-7348</p>
                </td>
                <td><center><b>Orden de Compra</b><br><br><label style="width: 4px;">Nº:</label><label style="width: 15px;"><?php echo $_smarty_tpl->tpl_vars['folio']->value;?>
</label></center>
				<BR><label style="font-size: x-small;">www.remolquesaeropuerto.com</label>
				</td>
            </tr>
        </table>
<br><br><br>
<table width="100%" border="1" cellpadding="2" cellspacing="1">
<tr>
	<th width="10%" bgcolor="#F0F0F0">Proveedor:</th>
	<td width="46%"><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</td>
	<th width="10%" bgcolor="#F0F0F0">Folio:</th>
	<td width="34%"><?php echo $_smarty_tpl->tpl_vars['folio']->value;?>
</td>
</tr><tr>
	<td bgcolor="#F0F0F0"><b>Fecha:</b></td>
	<td><?php echo $_smarty_tpl->tpl_vars['dia']->value;?>
 de <?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
 del <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</td>
    <th width="10%" bgcolor="#F0F0F0">Hora:</th>
	<td width="34%"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['hora']->value,"%I:%M %p");?>
</td>
</tr><tr>
	<th bgcolor="#F0F0F0">Saldo:</th>
	<td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['saldo']->value);?>
</td>
	<th bgcolor="#F0F0F0">Total:</th>
	<td><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total']->value);?>
</td>
</tr>
</table>
<br><br><br>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr bgcolor="#F0F0F0">
	<th bgcolor="#F0F0F0" style="width:120px">Codigo</th>
	<th bgcolor="#F0F0F0" style="width:320px">Descripción</th>
	<th bgcolor="#F0F0F0" style="width:60px" align="right">Cant.</th>
	<th bgcolor="#F0F0F0" style="width:65px" align="right">Precio</th>
	<th bgcolor="#F0F0F0" style="width:70px" align="right">SubTotal</th>
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
	<td align="center"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['art'];?>
</td>
	<td><b><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['descr'];?>
</b><br></td>
	<td align="right"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['cant'];?>
</td>
	<td align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['costo']);?>
</td>
        <td align="right"><?php echo smarty_function_math(array('equation'=>"x * y",'x'=>$_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['cant'],'y'=>$_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['costo'],'format'=>"%.2f"),$_smarty_tpl);?>
</td>
</tr>
<?php endfor; endif; ?>
<tr>
	<td colspan="3" rowspan="3" valign="top"></td>
	<th align="left" bgcolor="#F0F0F0">Subtotal:</th>
	<td align="right" ><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['subtotal']->value);?>
</b></td>
</tr><tr>
	<th align="left" bgcolor="#F0F0F0">IVA:</th>
	<td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['iva']->value);?>
</b></td>
</tr><tr>
	<th align="left" bgcolor="#F0F0F0">Total:</th>
	<td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total']->value);?>
</b></td>
</tr>
</table>
    </body>
</html>
<?php }
}
?>