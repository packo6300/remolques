<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
$host = $_SESSION['hpd'];
include ($root."/lib/mysql/mysql.php");
if(!empty($_POST)){
    if(!empty(filter_input(INPUT_POST,'folioRenta'))){
        echo insert("UPDATE folios SET folio=".filter_input(INPUT_POST,'folioRenta')." where idfolios=1;");
    }
    if(!empty(filter_input(INPUT_POST,'iva'))){
        echo insert("UPDATE iva SET iva=".filter_input(INPUT_POST,'iva')." where idiva=1;");
    }
}