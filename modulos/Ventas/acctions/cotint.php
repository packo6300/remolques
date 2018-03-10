<?php

try {
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $desc=$_POST['desc'];
    $precio=$_POST['precio'];
    $folio=$_POST['idrent'];
    $cant=$_POST['cnt'];
    $sql="insert into cotizaciondetail values(0,$folio,'$desc',$cant,$precio);";
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
