<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if($_POST['ida']){
$idUsr=$_POST['ida'];
echo "id";
}
else{ echo "no se recibio ningun dato"; }
