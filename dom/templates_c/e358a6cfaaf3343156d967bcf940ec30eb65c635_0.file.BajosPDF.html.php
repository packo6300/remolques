<?php /* Smarty version 3.1.26, created on 2016-01-28 11:06:39
         compiled from "C:\xampp\htdocs\modulos\Inv\templates\BajosPDF.html" */ ?>
<?php
/*%%SmartyHeaderCode:710256aa58afd666b3_58022270%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e358a6cfaaf3343156d967bcf940ec30eb65c635' => 
    array (
      0 => 'C:\\xampp\\htdocs\\modulos\\Inv\\templates\\BajosPDF.html',
      1 => 1454003513,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '710256aa58afd666b3_58022270',
  'variables' => 
  array (
    'titulo' => 0,
    'productos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.26',
  'unifunc' => 'content_56aa58afe523a8_33810918',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56aa58afe523a8_33810918')) {
function content_56aa58afe523a8_33810918 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '710256aa58afd666b3_58022270';
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
                <td valign="middle">
                    <BR><label style="font-size: x-small;">www.remolquesaeropuerto.com</label>
		</td>
            </tr>
        </table>
        <br><br><br>
        <table width="100%" border="0">
        <tr>
                <td align="center" width="10%" bgcolor="#F0F0F0"><b><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</b></td>
        </tr>
        </table>
        <br><br>
        <table width="100%" border="0" style='page-break-after:always;'>
        <tr bgcolor="#F0F0F0" style='page-break-after:always;'>
            <td bgcolor="#F0F0F0" align="center"><b>Clave</b></td>
            <td bgcolor="#F0F0F0" ><b>Descripción</b></td>
            <td bgcolor="#F0F0F0" align="center"><b>Minimo</b></td>	
            <td bgcolor="#F0F0F0" align="center"><b>Cant. Actual</b></td>
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
            <td style="width: 120px;"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['clave'];?>
</td>
            <td style="width: 120px;"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['descr'];?>
</td>
            <td style="width: 120px;" align="right"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['minimo'];?>
</td>
            <td style="width: 120px;" align="right"><?php echo $_smarty_tpl->tpl_vars['productos']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['cantidad'];?>
</td>
        </tr>
        <?php endfor; endif; ?>
        </table>
    </body>
</html>
<?php }
}
?>