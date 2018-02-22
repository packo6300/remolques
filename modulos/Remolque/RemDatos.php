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
    $sql="SELECT * FROM remolques where idrem=".$code." limit 1;";
    $query=  consulta($sql);
    foreach ($query as  $row) {
        $id=$row['idrem'];
        $tipo=$row['tipo'];
        $estr=$row['estructura'];
        $rampas=$row['rampas'];
        $luces=$row['luces'];
        $conector=$row['conector'];
        $gato=$row['gato'];
        $eje=$row['eje'];
        $extra=$row['extra'];
        $placa=$row['placa'];
        
        
    }
    echo json_encode(array("tipo" => $tipo,"id" => $id,"estructura"=>$estr,"rampas"=> $rampas,"luces"=> $luces,"conector" => $conector,"gato" => $gato,"eje" => $eje,"placas"=>$placa,"extra"=>$extra));
}
else {
    echo json_encode(array("tipo" => "Seleccionar remolque","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
