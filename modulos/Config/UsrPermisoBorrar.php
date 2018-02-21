<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");

    $idUsr=$_SESSION['idCH'];
if($_POST['ida']){
        $roll= $_POST['ida'];
        
        $sql="delete from permisos where idpermiso=$roll;";
        insert($sql);
        
        echo '<script>alert("permiso eliminado")</script>';
}
else{
    echo 'no se resibio ningun dato';
 }