<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");
$idprov=$_POST['code'];
    $sql="delete from ov where folio=$idprov;";
    insert($sql);
    $sql2="delete from ovpropiedad where folio=$idprov;";
    insert($sql2);
    echo "Venta descartada";    
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
