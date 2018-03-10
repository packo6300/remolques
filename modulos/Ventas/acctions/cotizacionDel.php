<?php

try {
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$idprov=$_POST['code'];
    $sql="delete from cotizacion where idcotizacion=$idprov;";
    insert($sql);
    $sql2="delete from cotizaciondetail where idcotizacion=$idprov;";
    insert($sql2);
    echo "Cotización descartada";    
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
