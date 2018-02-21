<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$id=$_SESSION['iddoc'];
$inst="/";
$hospedaje = "http://".$_SERVER['HTTP_HOST'].$inst;
$root = $_SERVER['DOCUMENT_ROOT'].$inst;
include_once($root.'lib/mysql/mysql.php');
include_once($root.'dom/smarty/libs/Smarty.class.php');


$categorias[0]["nombre"]="packo";
$categorias[1]["nombre"]="mexico";
$categorias[2]["nombre"]="obrero";
$clase=$id;
$t= new Smarty;
$t->assign("clase",$clase);
$t->assign("categorias",$categorias);
$t->display($root.'dom/templates/index.html');
