<?php

try {
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $idart=$_POST['idart'];
    $precio=$_POST['precio'];
    $costo=$_POST['costo'];
    $ut=$_POST['ut'];
    $folio=$_POST['idrent'];
    $cant=$_POST['cnt'];
    $ivaResulset= consulta("select iva from iva;");
    $precio=$precio/$ivaResulset[0]['iva'];
    $sql="insert into ovpropiedad values(0,$idart,$precio,$costo,$ut,$folio,$cant);";
    $r=insert($sql);
    echo json_encode(array("folio" =>$folio,"res"=>$r));    
}
else {
    echo json_encode(array("nombre" => "Falta cliente","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
