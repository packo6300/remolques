<?php

try {
    if(!isset($_SESSION)){ 
    session_start(); 
} 
$hospedaje = $_SESSION['hpd'];
$root = $_SESSION['ruta'];
include ($root.'/lib/mysql/mysql.php');

if($_POST){
    $code=$_POST['code'];
    $sql="SELECT * FROM cltauto where idcltauto=".$code." limit 1;";
    $query=  consulta($sql);
    foreach ($query as  $row) {
        $id=$row['idcltauto'];
        $marca=$row['marca'];
        $modelo=$row['modelo'];
        $col=$row['color'];
        $placa=$row['placa'];
        $estado=$row['estado'];
    }
    echo json_encode(array("idauto" => $id,"estado" => $estado,"marca" => $marca,"modelo"=>$modelo,"col"=> $col,"placa"=> $placa));
}
else {
    echo json_encode(array("nombre" => "Seleccione un auto","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
