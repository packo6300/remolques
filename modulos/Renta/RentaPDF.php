<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
$host = $_SESSION['hpd'];
include ($root."/lib/mysql/mysql.php");
include_once($root."/lib/mysql/ntl.php");
include_once($root.'/dom/smarty/libs/Smarty.class.php');
$t= new Smarty;
$l= new NumberToLetterConverter;
$idr=$id=$_SESSION['iddoc'];
    $sql="select * from rentas where idrentas=$idr";
       $res=consulta($sql);
        foreach ($res as  $row) {
            $t->assign("ini",$row['ini']);
            $t->assign("hini",$row['hini']);
            $t->assign("fin",$row['fin']);
            $t->assign("hfin",$row['hfin']);
            $t->assign("pordia",$row['pordia']);
            $t->assign("deposito",$row['deposito']);
            $t->assign("est",$row['est']);
            $t->assign("identif",$row['identif']);
            $t->assign("comenta",$row['comenta']);
            
            $t->assign("folio",$row['folio']);
            $t->assign("extras",$row['extras']);
            $t->assign("total",$row['total']);
            $t->assign("dias",$row['dias']);
            $idclt=$row['idclt'];
            $idrem=$row['idremolque'];        
            $idcarro=$row['idauto'];
            $idreferencia=$row['idref'];
            $total=$row['total'];
            $fini=$row['ini'];
            $ffin=$row['fin'];
        } 
        $subtotal=$total/1.16;
        $iva=$subtotal*0.16;
        $t->assign("iva",$iva);
        $t->assign("subtotal",$subtotal);
        /////inicial////
        $iniano=date("Y", strtotime($fini));
        $t->assign("iniano",$iniano);
        $f=date("m", strtotime($fini));
        if($f=="01"){$f="Enero";}
        elseif($f=="02"){$f="Febrero";}
        elseif($f=="03"){$f="Marzo";}
        elseif($f=="04"){$f="Abril";}
        elseif($f=="05"){$f="Mayo";}
        elseif($f=="06"){$f="Junio";}
        elseif($f=="07"){$f="Julio";}
        elseif($f=="08"){$f="Agosto";}
        elseif($f=="09"){$f="Septiembre";}
        elseif($f=="10"){$f="Octubre";}
        elseif($f=="11"){$f="Nobiembre";}
        elseif($f=="12"){$f="Diciembre";}
        else{
            $f="error";
        }       
        $t->assign("mes",$f);
        $t->assign("year",date("Y", strtotime($fini)));
        $t->assign("dia",date("d", strtotime($fini)));
        /////final/////
        //carga datos de cliente
        $sql2="select * from clientes2 where idclt=$idclt;";
        $res2=consulta($sql2);
        foreach ($res2 as  $row2) {
            $t->assign("nombre",$row2['nombre']);
            $t->assign("direccion",$row2['direccion']);
            $t->assign("tel",$row2['telefono']);
            $t->assign("cel",$row2['celular']);
        }
        //carga datos de Vehiculo
        $sql4="select * from cltauto where idcltauto=$idcarro;";
        $res4=consulta($sql4);
        foreach ($res4 as  $row4) {
            $t->assign("marca",$row4['marca']);
            $t->assign("modelo",$row4['modelo']);
            $t->assign("color",$row4['color']);
            $t->assign("autplaca",$row4['placa']);
            $t->assign("estado",$row4['estado']);
        }
        //carga datos de remolque
        $sql3="select * from remolques where idrem=$idrem;";
        $res3=consulta($sql3);
        foreach ($res3 as  $row3) {
            $t->assign("tipo",$row3['tipo']);
            $t->assign("placa",$row3['placa']);
            $t->assign("estructura",$row3['estructura']);
            $t->assign("rampas",$row3['rampas']);
            $t->assign("luces",$row3['luces']);
            $t->assign("conector",$row3['conector']);
            $t->assign("gato",$row3['gato']);
            $t->assign("eje",$row3['eje']);
            $t->assign("extra",$row3['extra']);
            $t->assign("valor",$row3['valor']);
            $r34=$row3['valor'];
        } 
        $miMoneda="MXN";
        $s=$l->to_word($r34, $miMoneda);
        $t->assign("s",$s);
        //carga datos de referencia-cliente
        $sql5="select * from cltrefe where idcltrefe=$idreferencia;";
        $res5=consulta($sql5);
        foreach ($res5 as  $row5) {
            $t->assign("rnombre",$row5['nombre']);
            $t->assign("rtel",$row5['tel']);
            $t->assign("rempresa",$row5['empresa']);
            $t->assign("rdir",$row5['dir']);
            $t->assign("rtrab",$row5['trabdir']);  
			$t->assign("par",$row5['parentesco']); 
        }
 $t->assign("urlimg",$host."img/logopng.png");
$t->display($root.'/modulos/Renta/templates/RentaPDF.html');
