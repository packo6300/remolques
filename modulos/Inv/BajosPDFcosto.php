<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
set_time_limit ( 40 );
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
$sql=$_SESSION['query'];
$mysql=$root."lib/mysql/mysql.php";
$smart=$root.'dom/smarty/libs/Smarty.class.php';
include ($mysql);
include_once($smart);
$url=$root.'modulos/Inv/templates/BajosPDFcosto.html';
$t= new Smarty;

$res3=array();
$res2=consulta($sql);
foreach ($res2 as  $row2) {
      $res3[]=$row2;            
}
$t->assign("productos",$res3);
$t->assign("titulo",'Lista de articulos bajos en existencia');
$t->display($url);
