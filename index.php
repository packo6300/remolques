<?php
$inst="/";
$hospedaje = "http://".$_SERVER['HTTP_HOST'].$inst;
$root = $_SERVER['DOCUMENT_ROOT'].$inst;
if(!isset($_SESSION)){ 
    session_start(); 
} 
$_SESSION['ruta']=$root;
$_SESSION['hpd']=$hospedaje;
include 'login.php';