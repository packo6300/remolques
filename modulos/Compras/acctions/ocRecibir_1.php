<?php

try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");

    for ($i = 159; $i < 644; $i++) {
        $sql2="INSERT INTO existencia VALUES($i,0,0,0);";
        insert($sql2);
    }
    echo 'Orden de Existencias agregadas';
   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>console.log("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}
