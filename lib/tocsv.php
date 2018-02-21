<?php
ini_set('error_reporting', 0);
try {
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$sql=$_SESSION['query'];

if(isset($_SESSION['pg'])){
    $nombre_fichero=$_SESSION['pg'];
    $db_tabla = $_SESSION['tbl'];
}
else{
    $nombre_fichero = 'reporte_asistencia';
    $db_tabla = 'exel_2';
}
$queEmp = "SHOW COLUMNS FROM ".$db_tabla."";
          $result = consulta($queEmp);
$i = 0;
if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
		$salida_cvs .= $row['Field'].",";
		$i++;
	}
}
$salida_cvs .= "\n";
$values = consulta($sql);
while ($rowr = mysql_fetch_row($values)) {
	for ($j=0;$j<$i;$j++) {
		$salida_cvs .= $rowr[$j].",";
	}
	$salida_cvs .= "\n";
}

header("Content-type: application/vnd.ms-excel");
header( "Content-Disposition: attachment; filename=".$nombre_fichero.".csv");
print $salida_cvs;
exit;    
} catch (Exception $ex) {
    
}
