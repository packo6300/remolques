<?php /* Smarty version 3.1.26, created on 2018-03-10 18:13:34
         compiled from "C:\laragon\www\remolques\modulos\Ventas\templates\CotizacionPdf.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:5158733395aa4204ee7b9e0_16972424%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2d455d3aa62a882eba080c50e8557afca699225' => 
    array (
      0 => 'C:\\laragon\\www\\remolques\\modulos\\Ventas\\templates\\CotizacionPdf.tpl',
      1 => 1520705028,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5158733395aa4204ee7b9e0_16972424',
  'variables' => 
  array (
    'img' => 0,
    'folio' => 0,
    'nombre' => 0,
    'dia' => 0,
    'mes' => 0,
    'year' => 0,
    'hora' => 0,
    'productos' => 0,
    'subtotal' => 0,
    'iva' => 0,
    'total' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.26',
  'unifunc' => 'content_5aa4204f00a722_05953485',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5aa4204f00a722_05953485')) {
function content_5aa4204f00a722_05953485 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'C:\\laragon\\www\\remolques\\dom\\smarty\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_function_math')) require_once 'C:\\laragon\\www\\remolques\\dom\\smarty\\libs\\plugins\\function.math.php';

$_smarty_tpl->properties['nocache_hash'] = '5158733395aa4204ee7b9e0_16972424';
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
    </head>
    <body>
        <br><br>
        <table width="100%" border="0" cellpadding="2" cellspacing="1">
            <tr>
                <td valign="middle" style="width: 230px;">  
                    <center><img src="<?php echo $_smarty_tpl->tpl_vars['img']->value;?>
" style="width: 100px;" ><BR>Renta-Venta-Refacciones Reparaciones</center>
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
                <td><center><b>Cotización</b><br><br><label style="width: 4px;">Nº:</label><label style="width: 15px;"><?php echo $_smarty_tpl->tpl_vars['folio']->value;?>
</label></center>
                    <BR><label style="font-size: x-small;">www.remolquesaeropuerto.com</label>
                </td>
            </tr>
        </table>
<br><br><br>
<table width="100%" border="0">
<tr>
	<td width="10%" bgcolor="#F0F0F0"><b>Nombre:</b></td>
	<td  colspan="3" th="90%"><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</td>	
</tr>
<tr>
	<td bgcolor="#F0F0F0"><b>Fecha:</b></td>
	<td><?php echo $_smarty_tpl->tpl_vars['dia']->value;?>
 de <?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
 del <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</td>
    <th width="10%" bgcolor="#F0F0F0">Hora:</th>
	<td width="34%"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['hora']->value,"%I:%M %p");?>
</td>
</tr>
</table>
<br><br><br>

<table width="100%" border="0" cellpadding="2" cellspacing="0">
<tr bgcolor="#F0F0F0">
    <th bgcolor="#F0F0F0" style="width:60px" align="right">Cant.</th>   
    <th bgcolor="#F0F0F0" style="width:320px">Descripción</th>	
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
    <td align="right"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['cantidad'];?>
</td>
    <td><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['descripcion'];?>
</td>
    <td align="right"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['subtotal']);?>
</td>
    <td align="right"><?php echo smarty_function_math(array('equation'=>"x * y",'x'=>$_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['cantidad'],'y'=>$_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['subtotal'],'format'=>"%.2f"),$_smarty_tpl);?>
</td>
</tr>
<?php endfor; endif; ?>
<tr>
        <td colspan="2"></td>
	<th  align="left" bgcolor="#F0F0F0">Subtotal:</th>
	<td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['subtotal']->value);?>
</b></td>
</tr>
<tr>
        <td colspan="2"></td>
	<th  align="left" bgcolor="#F0F0F0">IVA:</th>
	<td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['iva']->value);?>
</b></td>
</tr>
<tr>
        <td colspan="2"></td>
	<th  align="left" bgcolor="#F0F0F0">Total:</th>
	<td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total']->value);?>
</b></td>
</tr>
</table>
    </body>
</html><?php }
}
?>