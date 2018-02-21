<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");
if(!isset($_SESSION)){ 
    session_start(); 
}
$idadmin=$_SESSION['idCH'];
if($_POST){
    $idprov=$_POST['code'];
    $sql="insert into ov values(0,$idprov,curdate(),curtime(),0.0,0.0,0.0,0.0,$idadmin,1);";
    insert($sql);
    $sql2="select max(folio) as id from ov;";
       $res2=consulta($sql2);
        foreach ($res2 as  $row2) {
            $folio=$row2['id'];
        } 
    echo json_encode(array("folio" =>$folio));    
}
else {
    echo json_encode(array("nombre" => "Falta cliente","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
