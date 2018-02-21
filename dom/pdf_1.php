<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$id=$_SESSION['iddoc'];
$inst="/";
$hospedaje = "http://".$_SERVER['HTTP_HOST'].$inst;
$root = $_SERVER['DOCUMENT_ROOT'].$inst;
include_once($root.'dom/smarty/libs/Smarty.class.php');

$categorias[0]["nombre"]="packo";
$categorias[0]["pais"]="mexico";
$categorias[0]["puesto"]="obrero";
$clase=$id;
$t= new Smarty;
$t->assign("clase",$clase);
$t->assign("categorias",$categorias);
$t->display($root.'dom/templates/index.html');
