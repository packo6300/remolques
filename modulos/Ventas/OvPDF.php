<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
include_once($root.'/dom/smarty/libs/Smarty.class.php');
$t= new Smarty;
$idr=$id=$_SESSION['iddoc'];
//carga caratula oc
$sql="SELECT * FROM ovlistar where folio=$idr";
$res=consulta($sql);
$ivaResulset= consulta("select iva from iva;");
foreach ($res as  $row) {
    $t->assign("nombre",$row['cliente']);
    $t->assign("estatus",$row['estatus']);
    $t->assign("fecha",$row['fecha']);
    $t->assign("hora",$row['hora']);
    $t->assign("saldo",$row['saldo']);
    $t->assign("total",$row['total']);
    $t->assign("direccion",$row['direccion']);
    $total=$row['total'];
    $f1=$row['fecha'];
}
////////////////////////////////////////////////
$f=date("m", strtotime($f1));
if($f=="01"){$f="Enero";}
elseif($f=="02"){$f="Febrero";}
elseif($f=="03"){$f="Marzo";}
elseif($f=="04"){$f="Abril";}
elseif($f=="05"){$f="Mayo";}
elseif($f=="06"){$f="Junio";}
elseif($f=="07"){$f="Julio";}
elseif($f=="08"){$f="Agosto";}
elseif($f=="09"){$f="Septiembre";}
elseif($f=="10"){$f="Octubre";}
elseif($f=="11"){$f="Nobiembre";}
elseif($f=="12"){$f="Diciembre";}
else{
    $f="error";
}       
$t->assign("mes",$f);
$t->assign("year",date("Y", strtotime($f1)));
$t->assign("dia",date("d", strtotime($f1)));
/////////////////////////////////////////////////
//carga detalle oc
$sql2="SELECT * FROM ovdetalle where folio=$idr;";
$res3=array();
$res2=consulta($sql2);
$suma=0;
foreach ($res2 as  $row2) {
    $suma=$suma+$row2['precio'];            
}
$subtotal=$suma*$ivaResulset[0]['iva'];
$iva=$suma*($ivaResulset[0]['iva']-1);
$t->assign("iva",$iva);
$t->assign("subtotal",$suma);
$t->assign("total",$subtotal);
$t->assign("productos",$res2);
$t->assign("folio",$idr);
$t->assign("img",$_SESSION['hpd']."/img/logopng.png");
$t->display($root.'/modulos/Ventas/templates/OvPdf.tpl');
