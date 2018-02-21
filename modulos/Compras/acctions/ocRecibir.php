<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");
$sql2="SELECT * FROM iva limit 1;";
$r2=  consulta($sql2);
foreach ($r2 as  $r) {
        $iva=$r['iva'];
}
if($_POST){
    $id=$_POST['id'];
    $sql="SELECT idart,cant,costo FROM ocpropiedad where foliooc=$id;";
    $rr=  consulta($sql);
    foreach ($rr as  $r) {
        $idart=$r['idart'];
        $cant=$r['cant'];
        $costo=$r['costo'];
        $civa=$costo*$iva;
        $sql5="SELECT * FROM productos where idprod=$idart limit 1;";
            $r5=  consulta($sql5);
            foreach ($r5 as  $r) {
                $ut=$r4['utilidad'];
            }
        $pp=$civa*(1+($ut/100));
        $sql3="update existencia set cantidad=cantidad+$cant where idprod=$idart limit 1;";
        insert($sql3);
        $sql4="UPDATE productos SET costosiva=$costo,costo_pub=$pp,costo=$civa where idprod=$idart limit 1;";
        insert($sql4);
    }
    $sql5="UPDATE oc SET estatus=3 where folio=$id;";
    insert($sql5);
    echo 'Orden de Compra Recibida';
}
else {
    echo 'Error de sql';    
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
