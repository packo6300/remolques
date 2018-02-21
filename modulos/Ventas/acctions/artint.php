<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $idart=$_POST['idart'];
    $precio=$_POST['precio'];
    $costo=$_POST['costo'];
    $ut=$_POST['ut'];
    $folio=$_POST['idrent'];
    $cant=$_POST['cnt'];
    $sql="insert into ovpropiedad values(0,$idart,$precio,$costo,$ut,$folio,$cant);";
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
