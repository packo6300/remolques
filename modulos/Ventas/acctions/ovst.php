<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $id=$_POST['id'];
    $st=$_POST['st'];
    $sql="UPDATE ov SET estatus=$st where folio=$id;";
    insert($sql);
    echo 'Movimiento realizado con exito';
}
else {
    echo 'Error de sql';    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
