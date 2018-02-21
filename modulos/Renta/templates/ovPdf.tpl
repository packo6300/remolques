{* @template [com] ovPdf.tpl *}

<center><b>Orden de Venta<br>({$master.status})</b></center>
<br>
<table width="100%" border="1" cellpadding="2" cellspacing="1">
<tr>
	<th width="10%" bgcolor="#F0F0F0">Cliente:</th>
	<td width="46%">{$master.cltNombre} ({$master.cltclv})</td>
	<th width="10%" bgcolor="#F0F0F0">Folio:</th>
	<td width="34%"><b>{$master.folio|FFpad:6}</b></td>
</tr><tr>
	<th bgcolor="#F0F0F0">RFC:</th>
	<td>{$master.cltRFC}</td>
	<th bgcolor="#F0F0F0">Fecha:</th>
	<td>{$master.fecha_ov} @ {$master.hora_ov}</th>
</tr><tr>
	<th bgcolor="#F0F0F0">Dirección:</th>
	<td>{$master.cltDireccion}</td>
	<th bgcolor="#F0F0F0">Tipo:</th>
	<td>{$master.tipo}</td>
</tr><tr>
	<th bgcolor="#F0F0F0">Ciudad:</th>
	<td>{$master.ciudad}</td>
	<th bgcolor="#F0F0F0">Moneda:</th>
	<td>{$master.moneda}</td>
</tr><tr>
	<th bgcolor="#F0F0F0">O.Compra:</th>
	<td>{$master.ordenCompra}</td>
	<th bgcolor="#F0F0F0">Proyecto</th>
	<td>{$master.pjtFolio} &nbsp; {$master.pjtnom}</td>
</tr>
</table>
<br><br><br>

<table style="width:700px" border="1" cellpadding="2" cellspacing="0">
<tr bgcolor="#F0F0F0">
	<th style="width:120px">&nbsp;</th>
	<th style="width:320px">Descripción</th>
	<th style="width:60px" align="right">Cant.</th>
	<th style="width:65px" align="right">Precio</th>
	<th style="width:65px">Promoción</th>
	<th style="width:70px" align="right">SubTotal</th>
</tr>
{section name=i loop=$lista}
{assign var="imgsrc" value=$lista[i].imagen}
<tr>
	<td align="center">{if $imgsrc!=''}<img src="{$imgsrc}">{/if}</td>
	<td><b>{$lista[i].artclv} : {$lista[i].artnom} &nbsp; </b><br>
		{if $lista[i].comentario!=''}Nota: {$lista[i].comentario}{/if}
		{if $lista[i].pedimento!=''}<br />Pedimento:{$lista[i].pedimento} {/if}
		{* if $lista[i].lote!=''}<br />Lote:{$lista[i].lote} {/if *}
		{if $lista[i].tecnico!=''}<br />Técnico:{$lista[i].tecnico} {/if}
		{if $lista[i].numSerie!=''}<br />NS:{$lista[i].numSerie} {/if}
		{if $lista[i].opNombre!=''}<br />Ope.:{$lista[i].opNombre} ({$lista[i].opCodigo}) {/if}
		{if $lista[i].recibio!=''}<br />Recibio:{$lista[i].recibio} ({$lista[i].fecha_recibio}@{$lista[i].hora_recibio}) {/if}
		</td>
	<td align="right">{$lista[i].cantidadFactura}</td>
	<td align="right">{$lista[i].precio|FFprice}</td>
	<td>{$lista[i].promocion}&nbsp;</td>
	<td align="right">{$lista[i].subtotal|FFprice}</td>
</tr>
{/section}
<tr>
	<td colspan="4" rowspan="4" valign="top"><b>Nota:</b> {$master.nota}</td>
	<th align="left">Subtotal:</th>
	<td align="right"><b>{$master.subtotal|FFprice}</b></td>
</tr><tr>
	<th align="left">IVA:</th>
	<td align="right"><b>{$master.iva|FFprice}</b></td>
</tr><tr>
	<th align="left">Ret.IVA:</th>
	<td align="right"><b>{$master.retIVA|FFprice}</b></td>
</tr><tr>
	<th align="left">Total:</th>
	<td align="right"><b>{$master.importe|FFprice}</b></td>
</tr>
</table>

<br /><br /><br />
<table width="100%" border="1" cellpadding="2" cellspacing="0">
<tr bgcolor="#F0F0F0">
	<th colspan="4">Información de Entrega</th>
</tr><tr>
	<th width="12%">Quien Recibe:</th>
	<td width="38%">{$master.entregaPersona}</td>
	<th rowspan="2" valign="top" width="10%">Dirección:</th>
	<td rowspan="2" valign="top" width="40%"><pre>{$master.entregaDireccion}</pre></td>
</tr><tr>
	<th>Teléfono:</th>
	<td>{$master.entregaTelefono}</td>
</tr>
</table>
<br>
<p><font size="-1">* Una vez aplicada la cotizacion los precios pueden cambiar sin previo aviso.</font></p>