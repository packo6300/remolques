<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$root=$_SESSION['ruta'];
$hospedaje=$_SESSION['hpd'];
$id=$_SESSION['idCH'];
include ($root."/checador/lib/mysql/mysql.php");
//Crear sesión
 //$sql2 = "INSERT INTO registro VALUES(0,$id,'Cerrar sesion',curdate(),curtime());";
 //$result2= consulta($sql2);
 //Vaciar sesión
 $_SESSION = array();
 //Destruir Sesión
 session_destroy();
 //Redireccionar a login
 header("location:".$hospedaje);