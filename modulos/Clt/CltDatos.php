<?php

try {
if(!isset($_SESSION)){ 
    session_start(); 
} 
$root = $_SESSION['ruta'];
include ($root."lib/mysql/mysql.php");
if($_POST){
    $idref=$rnombre=$rpar=$rtel=$rempresa=$rdir=$rtrab='';
    $code=$_POST['code'];
    $sql="SELECT * FROM clientes2 where idclt=".$code." limit 1;";
    $query=  consulta($sql);
    foreach ($query as  $row) {
        $id=$row['idclt'];
        $nombre=$row['nombre'];
        $dir=$row['direccion'];
        $tel=$row['telefono'];
        $cel=$row['celular'];        
    }
    $sql2="SELECT * FROM cltrefe where idclt=".$code." limit 1;";
    $query2=  consulta($sql2);
    foreach ($query2 as  $r) {
        $idref=$r['idcltrefe'];
        $rnombre=$r['nombre'];
        $rpar=$r['parentesco'];
        $rtel=$r['tel'];
        $rempresa=$r['empresa'];
        $rdir=$r['dir'];
        $rtrab=$r['trabdir'];
    }
    $sql2="SELECT * FROM rentasview where cliente='".$nombre."' order by idrentas desc limit 1;";
    $query2=  consulta($sql2);
    foreach ($query2 as  $r) {
        $nombre='<a onclick="peticion('.$r['idrentas'].');">'.$nombre.'</a>';
    }
    echo json_encode(array("rtrab"=>$rtrab,"rdir"=>$rdir,"rempresa"=>$rempresa,"rtel"=>$rtel,"rpar"=>$rpar,"rnombre"=>$rnombre,"idcltref"=>$idref,"nombre" => $nombre,"id" => $id,"dir"=>$dir,"tel"=> $tel,"cel"=> $cel,"color" => "black"));
}
else {
    echo json_encode(array("nombre" => "Falta cliente","color" =>"red"));    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
