<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $code=$_POST['code'];
    $sql="SELECT * FROM proveedores where idProveedores=".$code." limit 1;";
    $query=  consulta($sql);
    foreach ($query as  $row) {
        $id=$row['idProveedores'];
        $nombre=$row['nombre_prov'];
        $dir=$row['direccion'];
        $tel=$row['telefono'];
    }
    echo json_encode(array("id" => $id,"nombre"=>$nombre,"dir"=> $dir,"tel"=> $tel));
}
else {
    echo json_encode(array("nombre" => "Seleccionar Proveedor","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
