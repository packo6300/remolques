<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $id=$_POST['id'];
    $total=$_POST['t'];
    $fact=$_POST['fac'];
    $ffact=$_POST['ffact'];
    $sql="UPDATE oc SET saldo=$total,total=$total,fact='$fact',ffact='$ffact' where folio=$id;";
    insert($sql);
    echo 'guardado';
}
else {
    echo 'Error de sql';    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
