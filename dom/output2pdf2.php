<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
$iddoc=$_GET['id'];
$url=$_GET['url'];
$_SESSION['iddoc']=$iddoc;
$inst="/";
$hospedaje = "http://".$_SERVER['HTTP_HOST'].$inst;
$root = $_SERVER['DOCUMENT_ROOT'].$inst;
include_once($root.'dom/dompdf/dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload');
$filename="remolques".$iddoc;

$html=  file_get_contents($root.'modulos/'.$url);
$pdf=new DOMPDF;
$pdf->load_html($html);
$pdf->set_paper('A4','portrait');
$pdf->render();
$pdf->stream($filename.".pdf",array( 'Attachment' => 0 ));