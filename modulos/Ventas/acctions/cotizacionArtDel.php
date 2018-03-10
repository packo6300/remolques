<?php

try {
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$idprov=$_POST['code'];
    $sql="delete from cotizaciondetail where idcotizaciondetail=$idprov limit 1;";
    insert($sql);
    echo json_encode(array("ok" =>"eliminado"));    
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
