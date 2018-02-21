<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $id=$_POST['id'];
    $sql2="SELECT cantidad FROM existencia where idprod=$id;";
    $rr2=  consulta($sql2);
    foreach ($rr2 as  $r2) {
        $cantidad=$r2['cantidad'];
    }
    if($cantidad=='0'){
        echo 'Productos sin existencia, no se puede aplicar';
    }
    else {
        $sql="SELECT idart,cant FROM ovpropiedad where folio=$id;";
        $rr=  consulta($sql);
        foreach ($rr as  $r) {
            $idart=$r['idart'];
            $cant=$r['cant'];
            $sql2="update existencia set cantidad=cantidad-$cant where idprod=$idart limit 1;";
            insert($sql2);
        }
        $sql5="UPDATE ov SET estatus=3, saldo=0 where folio=$id;";
        insert($sql5);
        echo 'Orden de Venta pagada';
    }
}
else {
    echo 'Error de sql';    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
