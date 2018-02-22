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
    $sql="SELECT * FROM productos where cve_producto='".$code."' limit 1;";
    $query=  consulta($sql);
    foreach ($query as  $row) {
        $id=$row['idprod'];
        $cve=$row['cve_producto'];
        $desc=$row['descripcion'];
        $costo=$row['costo'];
        $costosiva=$row['costosiva'];
        $precio=$row['costo_pub'];
        $ut=$row['utilidad'];     
        
    }
    if($id==""){
        echo json_encode(array("desc" => "Seleccionar articulo","color" =>"red"));
    }
    else{
        echo json_encode(array("id" => $id,"costosiva" => $costosiva,"cve"=>$cve,"desc"=> $desc,"costo"=> $costo,"precio" => $precio,"ut" => $ut));
    }
}
else {
    echo json_encode(array("tipo" => "Seleccionar articulo","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
