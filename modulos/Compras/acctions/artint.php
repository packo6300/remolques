<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $idart=$_POST['idart'];
    $costo=$_POST['costosiva'];
    $folio=$_POST['idrent'];
    $cant=$_POST['cnt'];
    $sql="insert into ocpropiedad values(0,$idart,$costo,$folio,$cant);";
    insert($sql);
    echo json_encode(array("folio" =>$folio));    
}
else {
    echo json_encode(array("nombre" => "Falta cliente","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
