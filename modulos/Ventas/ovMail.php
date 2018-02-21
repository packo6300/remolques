<?php
ini_set('error_reporting', 0);
if(!isset($_SESSION)){ 
    session_start(); 
}
$filename="remolquesAeropuerto";
$url="Ventas/OvPDF.php";
$inst="/";
$root = $_SERVER['DOCUMENT_ROOT'].$inst;
include_once($root.'dom/dompdf/dompdf_config.inc.php');
require  $root."/lib/phpmail/class.phpmailer.php";
require  $root."/lib/phpmail/class.smtp.php";

if($_POST['idc']){
$iddoc=$_POST['idc'];
$m=$_POST['mail'];
$body=$_POST['cont'];
$asunto=$_POST['asunto'];
$_SESSION['iddoc']=$iddoc;
spl_autoload_register('DOMPDF_autoload');
////crear pdf//////////
$html=  file_get_contents($root.'modulos/'.$url);
$pdf=new DOMPDF;
$pdf->load_html($html);
$pdf->set_paper('A4','portrait');
$pdf->render();
file_put_contents('C:/xampp/htdocs/'.$filename.'.pdf', $pdf->output());
//adjuntar PDF y enviarlo

$correo = "remolques@checktime.com.mx";
$careta="remolquesaeropuerto@hotmail.com";
$email = new PHPMailer();
$email->IsSMTP(); 
$email->SMTPDebug=1;
$email->CharSet="UTF-8";
$email->IsHTML(TRUE);
////datos de cuenta coreo/////////
$email->SMTPAuth = true;
$email->SMTPSecure='';
$email->Username = $correo;
$email->Password = "Remolques123.";

$email->Host = "smtp.1and1.mx";
$email->Port = "587";
$email->From = $careta;
$email->FromName = "Remolques Aeropuerto";
$email->Subject = $asunto;
$email->MsgHTML($body);
$email->AddAddress($m);
$email->AddReplyTo($careta);
$email->AddAttachment('C:/xampp/htdocs/remolquesAeropuerto.pdf');
if(!$email->Send()){
    echo '<div class="alert alert-danger"><strong>¡Correo No Enviado!</strong></div>';
}
else{ 
    echo '<div class="alert alert-success"><strong>¡Correo enviado!</strong></div>';         
}
}
else if($_POST['id']){
?>
<script type="text/javascript">
    function lomin(){
        $("#mensajes").html('enviando correo porfavor espere...');
    }
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Ventas/ovMail.php",data:s,
            beforeSend: function (xhr) {
                   lomin();         
            },
            success: function (data, textStatus, jqXHR) {
                $("#mensajes").html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#mensajes").html(textStatus);           
            }
        });
    }
    catch(err){
        console.error(err);
    }
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Ventas/Ov.php');"></span>Enviar venta por Correo:</label>
</div>
<form id="data">
    <div class="col-md-12">
        <div class="col-sm-12">
                    <input type="button" class="btn btn-success navbar-right" value="Enviar" onclick="actualiza();">
                    <div id="mensajes" class="navbar-left"></div>
        </div>
        <div class="col-sm-12">
            <label >Dirección De Correo:</label><input class="form-control" type="email" name="mail" >
            <label >Asunto:</label><input class="form-control" type="email" name="asunto" >
            <label >Contenido del correo:</label><textarea rows="12" class="form-control" name="cont"></textarea>
            <input type="hidden" name="idc" value="<?php echo $_POST['id']; ?>">
        </div>
    </div>
</form>    
    <?php
}
else { echo 'no se cargo el id del documento';}
