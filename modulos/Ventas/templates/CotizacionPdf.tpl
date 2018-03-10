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
                    <center><img src="{$img}" style="width: 100px;" ><BR>Renta-Venta-Refacciones Reparaciones</center>
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
                <td><center><b>Cotización</b><br><br><label style="width: 4px;">Nº:</label><label style="width: 15px;">{$folio}</label></center>
                    <BR><label style="font-size: x-small;">www.remolquesaeropuerto.com</label>
                </td>
            </tr>
        </table>
<br><br><br>
<table width="100%" border="0">
<tr>
	<td width="10%" bgcolor="#F0F0F0"><b>Nombre:</b></td>
	<td  colspan="3" th="90%">{$nombre}</td>	
</tr>
<tr>
	<td bgcolor="#F0F0F0"><b>Fecha:</b></td>
	<td>{$dia} de {$mes} del {$year}</td>
    <th width="10%" bgcolor="#F0F0F0">Hora:</th>
	<td width="34%">{$hora|date_format:"%I:%M %p"}</td>
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
{section name=i loop=$productos}
<tr>
    <td align="right">{$productos[i].cantidad}</td>
    <td>{$productos[i].descripcion}</td>
    <td align="right">{$productos[i].subtotal|string_format:"%.2f"}</td>
    <td align="right">{math equation="x * y" x=$productos[i].cantidad y=$productos[i].subtotal format="%.2f"}</td>
</tr>
{/section}
<tr>
        <td colspan="2"></td>
	<th  align="left" bgcolor="#F0F0F0">Subtotal:</th>
	<td align="right"><b>{$subtotal|string_format:"%.2f"}</b></td>
</tr>
<tr>
        <td colspan="2"></td>
	<th  align="left" bgcolor="#F0F0F0">IVA:</th>
	<td align="right"><b>{$iva|string_format:"%.2f"}</b></td>
</tr>
<tr>
        <td colspan="2"></td>
	<th  align="left" bgcolor="#F0F0F0">Total:</th>
	<td align="right"><b>{$total|string_format:"%.2f"}</b></td>
</tr>
</table>
    </body>
</html>