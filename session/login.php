<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('error_reporting', E_ALL ^ E_NOTICE);
if(!isset($_SESSION)) { 
        session_start(); 
    } 
$host = $_SESSION['hpd'];
$root = $_SESSION['ruta'];
$_SESSION['empresa']='remolques2';
echo $root;
include ($root."/lib/mysql/mysql.php");
$usuario = $_POST["usuario"];   
$password = md5($_POST["pss"]);
$sql = "SELECT * FROM administrador where Clave='$password' and usuario='$usuario';";
$result=  consulta($sql);
$id='';
foreach ($result as $k => $row) {
    $id=$row["id"];
    $di=$row["resu"];
    $usuario2=$row["nom"];
}   
if($id!=''){    
  $_SESSION['idCH'] = $id;
  echo "<script>location.href='".$host."home.php';</script>";
 }
 else{
     echo "<script>alert('usuario o contraseña incorrecta'); /*location.href='".$host."';*/</script>";
 }
