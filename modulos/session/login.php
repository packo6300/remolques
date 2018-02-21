<?php
header('Content-Type: text/html; charset=UTF-8');
ini_set('error_reporting', E_ALL);
if(!isset($_SESSION)){ 
    session_start(); 
}
$host = $_SESSION['hpd'];
$root = $_SESSION['ruta'];
$_SESSION['empresa']=$_POST['empresa'];
include ($root."/lib/mysql/mysql.php");
$usuario = $_POST["usuario"];   
$password = md5($_POST["pss"]);
$sql = "CALL login_web('$usuario','$password');";
$result=  consulta($sql);
foreach ($result as  $row) {
    $id=$row["res"];
    $di=$row["resu"];
    $usuario2=$row["nom"];
}   
if($di==1){    
  $_SESSION['idCH'] = $id;
  echo $_SESSION['idCH']; 
  //$sql2 = "INSERT INTO registro VALUES(0,$id,'inicio de sesion',curdate(),curtime());";
  //$result2= consulta($sql2);
  header("location:".$host);
 }
 else{
     echo "<script>alert('usuario o contraseña incorrecta'); location.href='".$host."';</script>";
 }
//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
mysql_free_result($result);
/*Mysql_close() se usa para cerrar la conexión a la Base de datos y es 
**necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
**programar una aplicación que tendrá muchas visitas ;) .*/
mysql_close();
