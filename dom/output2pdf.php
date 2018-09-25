<?php
if(!isset($_SESSION)){ 
        session_start(); 
    } 
$hospedaje = $_SESSION['hpd'];
$root = $_SESSION['ruta'];

$iddoc=$_GET['id'];
$url=$_GET['url'];
$_SESSION['iddoc']=$iddoc;

include_once($root.'dom/dompdf/dompdf_config.inc.php');
spl_autoload_register('DOMPDF_autoload');
$filename="remolques".$iddoc;

$html=  file_get_contents($root.'modulos/'.$url);
$pdf=new DOMPDF;
$pdf->load_html($html);
$pdf->set_paper('A4','portrait');
$pdf->render();
$pdf->stream($filename.".pdf",array( 'Attachment' => 0 ));