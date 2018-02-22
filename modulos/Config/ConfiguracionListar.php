<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
$host = $_SESSION['hpd'];
include ($root."/lib/mysql/mysql.php");
include_once($root."/lib/mysql/ntl.php");
include_once($root.'/dom/smarty/libs/Smarty.class.php');
$t= new Smarty;
$iva= consulta("SELECT iva FROM iva;");
$t->assign("iva",$iva[0]['iva']);
$iva= consulta("SELECT iva FROM iva;");
$t->assign("folioRenta",$iva[0]['iva']);
$t->display($root.'/modulos/Config/templates/ConfiguracionListar.tpl');
