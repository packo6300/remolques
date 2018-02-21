<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");
$idprov=$_POST['code'];
    $sql="delete from ovpropiedad where idovpropiedad=$idprov limit 1;";
    insert($sql);
    echo json_encode(array("ok" =>"eliminado"));    
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
