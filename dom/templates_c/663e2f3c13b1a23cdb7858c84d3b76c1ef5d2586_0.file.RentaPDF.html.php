<?php /* Smarty version 3.1.26, created on 2015-12-29 19:13:13
         compiled from "C:\xampp\htdocs\modulos\Renta\templates\RentaPDF.html" */ ?>
<?php
/*%%SmartyHeaderCode:2231568313892740e9_12864812%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '663e2f3c13b1a23cdb7858c84d3b76c1ef5d2586' => 
    array (
      0 => 'C:\\xampp\\htdocs\\modulos\\Renta\\templates\\RentaPDF.html',
      1 => 1451430790,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2231568313892740e9_12864812',
  'variables' => 
  array (
    'folio' => 0,
    'nombre' => 0,
    'tipo' => 0,
    'direccion' => 0,
    'placa' => 0,
    'eje' => 0,
    'tel' => 0,
    'estructura' => 0,
    'extra' => 0,
    'cel' => 0,
    'rampas' => 0,
    'luces' => 0,
    'identif' => 0,
    'conector' => 0,
    'gato' => 0,
    'marca' => 0,
    'modelo' => 0,
    'autplaca' => 0,
    'estado' => 0,
    'color' => 0,
    'par' => 0,
    'rnombre' => 0,
    'rtel' => 0,
    'rdir' => 0,
    'ini' => 0,
    'hini' => 0,
    'dias' => 0,
    'fin' => 0,
    'hfin' => 0,
    'pordia' => 0,
    'comenta' => 0,
    'deposito' => 0,
    'extras' => 0,
    'total' => 0,
    'valor' => 0,
    'dia' => 0,
    'mes' => 0,
    'year' => 0,
    's' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.26',
  'unifunc' => 'content_56831389393ee5_22140643',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56831389393ee5_22140643')) {
function content_56831389393ee5_22140643 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2231568313892740e9_12864812';
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
        <table style="width: 750px;" >
            <tr>
                <td valign="middle" style="width: 230px;">  
                    <center><img src="http://localhost:81/img/logopng.png" style="width: 100px;" ><BR>Renta-Venta-Refacciones</center>
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
                <td><center><b>Contrato de Renta</b><br><br><label style="width: 4px;">Nº:</label><label style="width: 15px;"><?php echo $_smarty_tpl->tpl_vars['folio']->value;?>
</label></center>
				<BR><label style="font-size: x-small;">www.remolquesaeropuerto.com</label>
				</td>
            </tr>
        </table><br>
        <table style="width: 750px;" border="0" >
                <tr>
                    <th valign="middle" style="height: 30px;" colspan="4" width="50%" bgcolor="#F0F0F0">Cliente:</th>
                    <th valign="middle" style="height: 30px;" colspan="4" width="50%" bgcolor="#F0F0F0">Remolque:</th>
                </tr ><tr style="">
                        <th  colspan="2" width="10%" bgcolor="#F0F0F0">Nombre:</th>
                        <td colspan="2" width="46%"><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Tipo:</th>
                        <td colspan="3" width="34%"><?php echo $_smarty_tpl->tpl_vars['tipo']->value;?>
</td>
                </tr><tr style="">
                        <th colspan="2" bgcolor="#F0F0F0">Dirección:</th>
                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['direccion']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Placa:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['placa']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Llantas:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['eje']->value;?>
</td>
                </tr><tr style="">
                        <th colspan="2" bgcolor="#F0F0F0">Teléfono:</th>
                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['tel']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Estructura:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['estructura']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Extra:</th>
                        <td><?php echo $_smarty_tpl->tpl_vars['extra']->value;?>
</td>
                </tr><tr style="">
                        <th colspan="2" bgcolor="#F0F0F0">Celular:</th>
                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['cel']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Rampas:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['rampas']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Luces:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['luces']->value;?>
</td>
                </tr><tr style="">
                        <th colspan="2" bgcolor="#F0F0F0">Identificación:</th>
                        <td colspan="2"><?php echo $_smarty_tpl->tpl_vars['identif']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Conector:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['conector']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Gato:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['gato']->value;?>
</td>
                </tr><tr style="">
                        <th valign="middle" style="height: 15px;" colspan="8" bgcolor="#F0F0F0">Datos del Vehiculo:</th>
                        
                        
                </tr><tr style="">
                        <th bgcolor="#F0F0F0">Marca:</th>
                        <td><?php echo $_smarty_tpl->tpl_vars['marca']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Modelo:</th>
                        <td><?php echo $_smarty_tpl->tpl_vars['modelo']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Placas:</th>
                        <td ><?php echo $_smarty_tpl->tpl_vars['autplaca']->value;?>
</td>
                        <th bgcolor="#F0F0F0">Estado:</th>
                        <td><?php echo $_smarty_tpl->tpl_vars['estado']->value;?>
</td>
                </tr><tr>
                        
                        <th bgcolor="#F0F0F0">Color:</th>
                        <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['color']->value;?>
</td>
                </tr><tr>
                        <th colspan="4" bgcolor="#F0F0F0">Referencia:</th>
						<th bgcolor="#F0F0F0">Parentesco:</th>
						<td colspan="3"><?php echo $_smarty_tpl->tpl_vars['par']->value;?>
</td>
                </tr><tr>
                        <th bgcolor="#F0F0F0">Nombre:</th>
                        <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['rnombre']->value;?>
</td>						
                        <th bgcolor="#F0F0F0">Tel:</th>
                        <td><?php echo $_smarty_tpl->tpl_vars['rtel']->value;?>
</td>
                </tr><tr>
                    <th bgcolor="#F0F0F0">Dirección:</th>
                    <td colspan="7"><?php echo $_smarty_tpl->tpl_vars['rdir']->value;?>
</td>
                </tr>
            </table>
            <br><table style="width:700px" border="1" >
        <tr>
                <th bgcolor="#F0F0F0" style="width:150px">Fecha de Renta:</th>
                <td style="width:240px"><?php echo $_smarty_tpl->tpl_vars['ini']->value;?>
</td>
                <th bgcolor="#F0F0F0" style="width:70px">Hora:</th>
                <td style="width:70px"><?php echo $_smarty_tpl->tpl_vars['hini']->value;?>
</td>
                <th bgcolor="#F0F0F0" style="width:100px">Total de dias:</th>
                <td align="right" style="width:70px" ><b><?php echo $_smarty_tpl->tpl_vars['dias']->value;?>
</b></td>
        </tr>
        <tr>
                <th bgcolor="#F0F0F0" style="width:150px">Fecha de Entrega:</th>
                <td style="width:240px"><?php echo $_smarty_tpl->tpl_vars['fin']->value;?>
</td>
                <th bgcolor="#F0F0F0" style="width:70px">Hora:</th>
                <td style="width:70px"><?php echo $_smarty_tpl->tpl_vars['hfin']->value;?>
</td>
                <th bgcolor="#F0F0F0" style="width:110px">Renta por Día:</th>
                <td align="right" style="width:70px" ><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['pordia']->value);?>
</b></td>
        </tr>
        <tr>
                <td colspan="4" rowspan="3" valign="top"><b>Comentarios:</b> <?php echo $_smarty_tpl->tpl_vars['comenta']->value;?>
</td>
                <th align="left">Deposito:</th>
                <td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['deposito']->value);?>
</b></td>
        </tr><tr>
                <th align="left">Cargos extra:</th>
                <td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['extras']->value);?>
</b></td>
        </tr>
        <tr>
                <th align="left">Total:</th>
                <td align="right"><b><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total']->value);?>
</b></td>
        </tr>
</table>

<table style="width:750px">
    <tr bgcolor="#F0F0F0">
        <td ><b>CONDICIONES DE RENTA</b></td>
    </tr>
    <tr>
        <td>
            <ul style="font-size: x-small;">
                <li>Si usted no entrega el remolque o dolly en el lugar, dia y hora especificados en el contrato de renta se hacen cargos adicionales.</li>
                <li>Al entregar usted el remolque o dolly, se revisara detalladamente y se harán cargos por los daños encontrados.</li>
                <li>Su pago por la renta del remolque o dolly, NO incluye servicio de asistencia local y/o carreteras, por lo que se recomienda revisar el equipo antes de salir.</li>
                <li>El arrendatario sera su responsabilidad civil o penal en caso de accidente, así como la entrega del equipo en las condiciones en las que sale de la empresa.</li>
                <li>El arrendatario se compromete a pagar el remolque o dolly, en caso de perdida o descompostura parcial o total, obligandose también a cubrir la renta hasta la total reposicion del remolque.</li>
                <li>Estrictamente prohibido traspasar, subarrendar o ceder sus derechos de todo o en parte del remolque.</li>
            </ul>
            <center>_______________<br>Acepto condiciones.  </center>
        </td>
    </tr>
</table>
<br>
<center>
    --------------------------------------------------------------------------------------------------------------------------------------------------
</center>
<table style="width:750px;">
    <tr>
        <td style="width:530px;"><b>PAGARE</b></td>
        <td align="right" >BUENO POR: $</td>
        <td align="right" style="width:70px;border:1px solid black;"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['valor']->value);?>
</td>
    </tr><tr>
        <td align="right" style="font-size: x-small;" colspan="3">En Chihuahua,Chih. A <?php echo $_smarty_tpl->tpl_vars['dia']->value;?>
 DE <?php echo $_smarty_tpl->tpl_vars['mes']->value;?>
 DEL <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</td>
    </tr><tr>
        <td colspan="3"><p style="font-size: x-small;margin: auto;">Debo(emos) y pagaré(mos) incondicionalmente por este pagaré a la orden de Martha Canales Ochoa en calle 81a. y 15a.#8407 col. Aeropuerto en la ciudad de chihuahua,Chih. EL_______ DE _________ DEL 20__</p>
    </tr><tr>
        <td align="left" style="font-size: x-small;" colspan="3">la cantidad de:</td>
    </tr><tr>
        <td colspan="3" style="font-size: x-small;border:1px solid black;"><CENTER><b><?php echo $_smarty_tpl->tpl_vars['s']->value;?>
 <label>PESOS 00/100</label></b></CENTER></td>
    </tr><tr>
        <td colspan="3"><p style="font-size: x-small;margin: auto;">Valor recibido a mi(nuestra) entera satisfacción. Esta sujeto a la condicion de que, al no pagarse a su vencimiento causara intereses moratorios al tipo de_____% mensual pagadero en esta ciudad juntamente con el principal.</p>
    </tr><tr>
        <td style="font-size: x-small;"><b>Deudor:</b> <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
<br> <b>Dirección: </b> <?php echo $_smarty_tpl->tpl_vars['direccion']->value;?>
 <b>Tel:</b> <?php echo $_smarty_tpl->tpl_vars['tel']->value;?>
 <br> <b>Población:</b>_______________________________________</td>
        <td colspan="2">Acepto(amos)<br>Firma(s):_____________________</td>
    </tr>
</table>
</body>
</html>
<?php }
}
?>