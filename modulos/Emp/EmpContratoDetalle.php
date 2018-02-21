<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if($_POST['ida']){
    $idUsr=$_POST['ida'];
    $sql="SELECT * FROM empcon where idhuella = $idUsr;";
}
else{
    echo "nada para mostrar";
}