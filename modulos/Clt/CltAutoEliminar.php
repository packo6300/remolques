<?php

if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");

if($_POST){
    $id=$_POST['idcltauto'];
    if($id){
        $sql="delete from cltauto where idcltauto=$id limit 1;";
        insert($sql);
        echo 'Eliminado';
    }
    else{
        echo 'no se recibieron datos';
    }
}