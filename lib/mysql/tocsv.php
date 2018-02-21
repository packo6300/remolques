<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
if($_SESSION){
try {
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root."/lib/mysql/mysql.php");
$sql=$_SESSION['sq'];
$db_tabla = $_SESSION['tbl'];
$nombre_fichero = $_SESSION['csv'];
///inicia proceso de exportacion a excel
//------------------------------------------------------------------
$queEmp = "SHOW COLUMNS FROM $db_tabla;";
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
//-----------------------------------------------------------------------------
} catch (Exception $ex) {
    
}

}//fin del post