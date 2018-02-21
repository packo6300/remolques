<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if($_POST['ida']){
        $roll= $_POST['ida'];
        $sql="delete from productos where idprod=$roll limit 1;";
        insert($sql);
        $sql2="delete from existencia where idprod=$roll limit 1;";
        insert($sql2);
        echo 'Producto Eliminado';
}
else{
    echo 'no se resibio ningun dato';
 }