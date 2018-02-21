<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

try {
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$j=  array();
if($_GET){
    $id=$_GET['id'];
    $sql="SELECT idroles,nombre FROM roles where titular=$id order by nombre;";
    $query=  consulta($sql);
    foreach ($query as  $row) {
        $j[]=$row;
    }
    echo json_encode($j);
}
else {
    echo 'no hubo datos';
}   
} catch (ErrorException $exc) {
    $exc->getTraceAsString();
    echo '<script>window.alert("Ocurrio un error intente de nuevo:'.$exc.'");</script>';
}