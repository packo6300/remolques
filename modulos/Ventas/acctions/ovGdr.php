<?php

try {
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $id=$_POST['id'];
    $total=$_POST['t'];
    $sql="UPDATE ov SET saldo=$total,total=$total where folio=$id;";
     $r=insert($sql);
    echo 'guardado';
}
else {
    echo 'Error de sql';    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
