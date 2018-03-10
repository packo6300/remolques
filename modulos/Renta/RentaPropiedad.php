<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$idclt =$_SESSION['clt'];
if ($_POST['idrent']){
        $idpar=$_POST['idrent'];
        /////////Carga de datos/////////////
        $idclt=$_POST['id_clt'];
        $deposito=$_POST['deposito'];        
        $identifica = $_POST['identifica'];
        $idcltref = $_POST['id_cltref2'];
        $idauto = $_POST['id_aut'];
        $edo = $_POST['edo'];
        $idrem= $_POST['id_rem'];
        $comenta = $_POST['comenta'];
        $ini = $_POST['ini'];
        $hini = $_POST['hini'];
        $fin = $_POST['fin'];
        $hfin = $_POST['hfin'];
        $pordia=$_POST['pordia'];
        $dias = $_POST['dias'];
        $extras = $_POST['extras'];
        $total= $_POST['total'];
        //////////////////////
        if($total==""){
            echo json_encode(array("tipo" => "alert-danger","msj" =>"No se puede guardar : Falta total")); 
        }
        elseif($idcltref==""){
            echo json_encode(array("tipo" => "alert-danger","msj" =>"No se puede guardar : Cliente sin Referencia")); 
        }
        elseif($idclt==""){
            echo json_encode(array("tipo" => "alert-danger","msj" =>"No se puede guardar : Falta Cliente")); 
        }
        elseif($idrem==""){
            echo json_encode(array("tipo" => "alert-danger","msj" =>"No se puede guardar : Falta Remolque")); 
        }
        elseif($idauto==""){
            echo json_encode(array("tipo" => "alert-danger","msj" =>"No se puede guardar : Falta automovil")); 
        }
        elseif($idpar=="new"){
            $sql6="update folios set folio=folio+1";
            insert($sql6);
            $sql2="select folio from folios limit 1;";
            $row= consulta($sql2);
            foreach ($row as  $r) {
                $folio=$r['folio'];
            }
            //insert("update remolques set rentas=rentas+1 where id");
            $sql="insert into rentas values(0,$idclt,$idrem,'$ini','$hini','$fin','$hfin',$pordia,$deposito,1,'$identifica','$comenta','$edo',$idauto,$idcltref,'$folio',$dias,$extras,$total);";
            insert($sql);
            insert("update remolques set rentas=rentas+1 where idrem=$idrem;");
            $sql7="SELECT max(idrentas) as s FROM rentas;";
            $row7=  consulta($sql7);
            foreach ($row7 as  $r7) {
                $f=$r7['s'];
            }
            echo json_encode(array("tipo" => "alert-success","re" => $f,"msj" =>"ok"));   
        }
        else{
            $sql="update rentas set comenta='$comenta' where idrentas=$idpar limit 1";
            $resultQuery=insert($sql);
            echo json_encode(array("tipo" => "alert-success","resultQuery" => $resultQuery,"re" => $idpar,"msj" =>"Cambios guardados")); 
        }
}
else{
$idref=$_POST['id'];
    if($idref>0){
       $pgn="Editar Renta";
       //$edit="readonly='' ";
       $sql="select * from rentas where idrentas=$idref";
       $res=consulta($sql);
        foreach ($res as  $row) {
            $idclt=$row['idclt'];
            $idrem=$row['idremolque'];        
            $ini = $row['ini'];
            $hini = $row['hini'];
            $fin = $row['fin'];            
            $hfin = $row['hfin'];
            $pordia=$row['pordia'];
            $deposito=$row['deposito'];
            $est=['est'];
            $identif=$row['identif'];
            $comenta=$row['comenta'];            
            $idcarro=$row['idauto'];
            $idreferencia=$row['idref'];
            $folio=$row['folio'];
            $extras=$row['extras'];
            $total=$row['total'];
            $dias=$row['dias'];
        } 
        $total=$deposito+$extras+($dias*$pordia);
        //carga datos de cliente
        $sql2="select * from clientes2 where idclt=$idclt;";
        $res2=consulta($sql2);
        foreach ($res2 as  $row2) {
            $nombre=$row2['nombre'];
            $direccion=$row2['direccion'];
            $tel=$row2['telefono'];
            $cel=$row2['celular'];
        }
        //carga datos de Vehiculo
        $sql4="select * from cltauto where idcltauto=$idcarro;";
        $res4=consulta($sql4);
        foreach ($res4 as  $row4) {
            $marca=$row4['marca'];
            $modelo=$row4['modelo'];
            $color=$row4['color'];
            $autplaca=$row4['placa'];
            $estado=$row4['estado'];
        }
        //carga datos de remolque
        $sql3="select * from remolques where idrem=$idrem;";
        $res3=consulta($sql3);
        foreach ($res3 as  $row3) {
            $tipo=$row3['tipo'];
            $placa=$row3['placa'];
            $estructura=$row3['estructura'];
            $rampas=$row3['rampas'];
            $luces=$row3['luces'];
            $conector=$row3['conector'];
            $gato=$row3['gato'];
            $eje=$row3['eje'];
            $extra=$row3['extra'];
            
        } 
        //carga datos de referencia-cliente
        $sql5="select * from cltrefe where idcltrefe=$idreferencia;";
        $res5=consulta($sql5);
        foreach ($res5 as  $row5) {
            $rnombre=$row5['nombre'];
            $rtel=$row5['tel'];
            $rempresa=$row5['empresa'];
            $rdir=$row5['dir'];
            $rtrab=$row5['trabdir'];
            
        } 
     ///fin de la carga de datos de renta
    }
    else{
        $idref="new";
        $pgn="Capturar Renta";
        $edit="";
        $ini=date("Y-m-d");
        $fin=date("Y-m-d");
        $hini=date("H:i:s");
        $hfin=date("H:i:s");
        $deposito="0";
        $pordia="0";
        $extras="0";
        
    }
   
    
     ?>
    <script type="text/javascript">
    function recarga(s){
       try{       
        $.ajax({type: 'POST',url:"modulos/Renta/RentaPropiedad.php",id:s,
            success: function(data){
               $("#pant").html(data);
                
            },
            //si ha ocurrido un error
            error: function(jqXHR, textStatus, errorThrown){
              $("#mensajes").html('<div class="alert alert-danger"><strong>¡Error '+errorThrown+'!</strong></div>');
            }
        });
    }
    catch(err){
        console.error(err);
    } 
    }
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Renta/RentaPropiedad.php",data:s,
            dataType: "json",
        beforeSend: function(){
               $("#mensajes").html("<img src='img/loading.gif' style='width: 25px; margin-left: 8px; margin-top: 3px;' >");      
            },
            //una vez finalizado correctamente
            success: function(data){
                if(data.msj === "ok"){
                    $("#mensajes").html("");      
                    recarga(data.re);        
                    peticion(data.re);
                    
                }
                else{
                    $("#mensajes").html('<div class="alert '+data.tipo+'"><strong>¡'+data.msj+'!</strong></div>'); 
                }
            },
            //si ha ocurrido un error
            error: function(jqXHR, textStatus, errorThrown){
              $("#mensajes").html('<div class="alert alert-danger"><strong>¡Error '+errorThrown+'!</strong></div>');
            }
        });
    }
    catch(err){
        console.error(err);
    }
}
function carga(id){
    $.ajax({
            type: "POST",url:"modulos/Clt/CltDatos.php",data:{code:id},
            dataType: "json"
            }).done(function(datos) {
            $('#nclt').html("<label>&nbsp;&nbsp;"+datos.nombre+"</label>");
            $('input[name="id_clt"]').val(datos.id);
            $('#dir').html("<label>&nbsp;&nbsp;"+datos.dir+"</label>");
            $('#tel').html("<label>&nbsp;&nbsp;"+datos.tel+"</label>");
            $('#cel').html("<label>&nbsp;&nbsp;"+datos.cel+"</label>");
            cli(datos.id);
            $('input[name="id_cltref2"]').val(datos.idcltref);
            $('#rn').html("<label>&nbsp;&nbsp;"+datos.rnombre+"</label>");
            $('#rt').html("<label>&nbsp;&nbsp;"+datos.rtel+"</label>");
            $('#remp').html("<label>&nbsp;&nbsp;"+datos.rempresa+"</label>");
            $('#rdir').html("<label>&nbsp;&nbsp;"+datos.rdir+"</label>");
            $('#rtrab').html("<label>&nbsp;&nbsp;"+datos.rtrab+"</label>");
            });
}
function cli(id){
    $.ajax({
        type: 'POST',
        url: "modulos/Clt/cltSess.php",
        data:{id:id}
    });
}
function cargaAuto(id){
    $.ajax({
            type: "POST",url:"modulos/Clt/CltAutoDatos.php",data:{code:id},
            dataType: "json",
            success: function (datos, textStatus, jqXHR) {
            $('input[name="id_aut"]').val(datos.idauto);
            $('#marca').html("<label>&nbsp;&nbsp;"+datos.marca+"</label>");
            $('#modelo').html("<label>&nbsp;&nbsp;"+datos.modelo+"</label>");
            $('#color').html("<label>&nbsp;&nbsp;"+datos.col+"</label>");
            $('#placa').html("<label>&nbsp;&nbsp;"+datos.placa+"</label>");
            $('#estado').html("<label>&nbsp;&nbsp;"+datos.estado+"</label>");
            }
            });
}
function cargaRem(id){
    $.ajax({
            type: "POST",url:"modulos/Remolque/RemDatos.php",data:{code:id},
            dataType: "json"
            }).done(function(datos) {
            $('input[name="id_rem"]').val(datos.id);
            $('#rtipo').html("<label>&nbsp;&nbsp;"+datos.tipo+"</label>");
            $('#pl').html("<label>&nbsp;&nbsp;"+datos.placas+"</label>");
            $('#conector').html("<label>&nbsp;&nbsp;"+datos.conector+"</label>");
            $('#gato').html("<label>&nbsp;&nbsp;"+datos.gato+"</label>");
            $('#estructura').html("<label>&nbsp;&nbsp;"+datos.estructura+"</label>");
            $('#rampas').html("<label>&nbsp;&nbsp;"+datos.rampas+"</label>");
            $('#luces').html("<label>&nbsp;&nbsp;"+datos.luces+"</label>");
            $('#eje').html("<label>&nbsp;&nbsp;"+datos.eje+"</label>");
            $('#extra').html("<label>&nbsp;&nbsp;"+datos.extra+"</label>");
            
            });
}
function Sel(url){
         var miPopup;
         miPopup=window.open(url, 'popup', 'left=290, top=200, width=812, height=341,titlebar=0,location=0,toolbar=0, resizable=1');
}
function calcula(){
        var i=$("input[name='ini']").val();
        var f=$("input[name='fin']").val();
        i=i.replace(/-/g, "/");
        f=f.replace(/-/g, "/");
        var fi = new Date(i);
        var ff = new Date(f);
        var dif = ff - fi;
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
        $("input[name='dias']").val(dias);
        importe();
}
function importe(){
        var i=$("input[name='deposito']").val();
        var f=$("input[name='pordia']").val();
        var d=$("input[name='dias']").val();
        var e=$("input[name='extras']").val();
        i=parseInt(i);
        f=parseInt(f);
        d=parseFloat(d);
        e=parseInt(e);
        var total=(e+i+(f*d));
        $("input[name='total']").val(total);
}
function peticion(id){
window.open("dom/output2pdf.php?id="+id+"&url=Renta/RentaPDF.php");
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Renta/Renta.php');"></span><?php echo $pgn;?></label>
</div>
<div class="col-sm-12">
    <input type="button" class="btn btn-danger navbar-right" value="Limpiar" onclick="$('#pant').load('modulos/Renta/RentaPropiedad.php');">
    <input type="button" class="btn btn-default navbar-right" value="Regresar" onclick="$('#pant').load('modulos/Renta/Renta.php');">
    <?php
    //echo $idref;
    if($idref!="new"){
    ?>
    <input type="button" class="btn btn-primary navbar-right" value="Imprimir" onclick="peticion('<?php echo $idref;?>');">
    <?php } ?>
    <input type="button" class="btn btn-success navbar-right" value="Guardar" onclick="actualiza();">
    <div id="mensajes" class="navbar-left"></div>
</div>
<br><br>
    <div class="panel-body">                
                <div class="panel panel-primary">
                          <div class="panel-body">
                              <form id="data">
                                <table id="tbl_info" class="table table-bordered">
                                  <tr>
                                      <td colspan="3">
                                          <label style="color: blue;">Cliente</label><br>
                                          <button type="button" class="btn btn-default" onclick="Sel('modulos/Clt/CltSelect.php')"><span class="glyphicon glyphicon-search"></span></button>
                                          <input type="hidden" name="id_clt" value="<?php echo $idclt;?>">
                                          <label>Clave:</label>
                                          <input type="text" style="max-width: 35px;" disabled="" onchange="carga()" name="cve" id="clt" value="<?php echo $idclt;?>">
                                          <label>Nombre:</label><label id="nclt" style="color:blue;">&nbsp;&nbsp;<?php echo $nombre;?></label>
                                      </td>
                                      <td colspan="1">
                                          <label style="color: blue;">Folio de Renta</label><br>
                                          <input type="hidden" name="idrent" value="<?php echo $idref; ?>">
                                          <input type="text" style="min-width: 35px;" disabled=""  value="<?php echo $idref;?>">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                          <label>Dirección:</label><label style="color: blue;" id="dir">&nbsp;&nbsp;<?php echo $direccion;?></label>
                                      </td>
                                      <td>
                                          <label>Telefono:</label><label style="color: blue;" id="tel">&nbsp;&nbsp;<?php echo $tel;?></label>
                                      </td>
                                      <td>
                                          <label>Celular:</label><label style="color: blue;" id="cel">&nbsp;&nbsp;<?php echo $cel;?></label>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                          <label>Deposito:</label><input type="number" onchange="importe()" style="color: blue;" name="deposito" value="<?php echo $deposito; ?>">
                                      </td>
                                      <td colspan="2">
                                          <label>Identificacion:</label><input type="text" style="color: blue;" name="identifica" value="<?php echo $identif;?>">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="5">
                                          <label style="color: blue;">Referencias</label>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                           <input type="hidden" name="id_cltref2" value="<?php echo $idreferencia;?>">
                                          <label>Nombre:</label><label style="color: blue;" id="rn">&nbsp;&nbsp;<?php echo $rnombre; ?></label>
                                      </td>
                                      <td>
                                          <label>Telefóno:</label><label style="color: blue;" id="rt">&nbsp;&nbsp;<?php echo $rtel; ?></label>
                                      </td>
                                      <td colspan="2">
                                          <label>Empresa:</label><label style="color: blue;" id="remp">&nbsp;&nbsp;<?php echo $rempresa; ?></label>
                                      </td>                                                                            
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                          <label>Dirección</label><label style="color: blue;" id="rdir">&nbsp;&nbsp;<?php echo $rdir;?></label>
                                      </td>
                                      <td colspan="2">
                                          <label>Dirección:</label><label style="color: blue;" id="rtrab">&nbsp;&nbsp;<?php echo $rtrab;?></label>
                                      </td>                                                    
                                  </tr>
                                  <tr>
                                      <td colspan="3">
                                          <label style="color: blue;">Vehiculo</label><br>
                                          <button type="button" class="btn btn-default" onclick="Sel('modulos/Clt/CltAutoSelect.php')"><span class="glyphicon glyphicon-search"></span></button>
                                          <input type="hidden" name="id_aut" value="<?php echo $idcarro;?>">
                                          <label>Clave:</label>
                                          <input type="text" style="max-width: 35px;" disabled=""  name="cveaut" id="aut" value="<?php echo $idcarro;?>">
                                      </td>
                                      <td style="max-width: 90px;">
                                          <br><label>Estado:</label><label style="color: blue;" id="estado"><?php echo  $estado; ?></label>
                                      </td>
                                      
                                  </tr>
                                  <tr>
                                      <td>
                                          <label>Marca:</label><label style="color: blue;" id="marca"><?php echo $marca;?></label>
                                      </td>
                                      <td>
                                          <label>Modelo:</label><label style="color: blue;" id="modelo"><?php echo $modelo;?></label>
                                      </td>
                                      <td>
                                          <label>Color:</label><label style="color: blue;" id="color"><?php echo $color;?></label>
                                      </td>
                                      <td>
                                          <label>Placas:</label><label style="color: blue;" id="placa"><?php echo $autplaca;?></label>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td colspan="5">
                                          <label style="color: blue;">Remolque</label><br>
                                          <button type="button" class="btn btn-default" onclick="Sel('modulos/Remolque/RemSelect.php')"><span class="glyphicon glyphicon-search"></span></button>
                                          <input type="hidden" name="id_rem" value="<?php echo $idrem;?>">
                                          <label>Clave:</label>
                                          <input type="text" style="max-width: 35px;" disabled=""  name="cveaut" id="rem" value="<?php echo $idrem;?>">
                                          <label>Tipo:</label><label style="color: blue;" id="rtipo"><?php echo $tipo;?></label>
                                      </td>
                                      
                                  </tr>
                                  <tr>
                                      <td>
                                          <label>Placa:</label><label style="color: blue;" id="pl"><?php echo $placa;?></label>
                                      </td>
                                      <td>
                                          <label>Estructura:</label><label style="color: blue;" id="estructura"><?php echo $estructura;?></label>
                                      </td>
                                      <td>
                                          <label>Rampas:</label><label style="color: blue;" id="rampas"><?php echo $rampas;?></label>
                                      </td>
                                      <td>
                                          <label>Luces:</label><label style="color: blue;" id="luces"><?php echo $luces;?></label>
                                      </td>                                      
                                  </tr>
                                  <tr>
                                      <td>
                                          <label>Conector:</label><label style="color: blue;" id="conector"><?php echo $conector;?></label>
                                      </td>
                                      <td>
                                          <label>Gato:</label><label style="color: blue;" id="gato"><?php echo $gato;?></label>
                                      </td>
                                      <td>
                                          <label>Llantas:</label><label style="color: blue;" id="eje"><?php echo $eje;?></label>
                                      </td>
                                      <td>
                                          <label>Extra:</label><label style="color: blue;" id="extra"><?php echo $extra;?></label>
                                      </td>                                      
                                  </tr>
                                  <tr>
                                      <td colspan="4" style="max-width: 90px;">
                                          <label>Comentarios:</label><input style="color: blue;min-width: 600px;" type="text" style="color: blue;" name="comenta" value="<?php echo $comenta;?>">
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <label>Fecha de Renta:</label><input type="date" style="line-height: 16px;color: blue;" name="ini" onchange="calcula()" value="<?php echo $ini;?>">
                                      </td>
                                      <td>
                                          <label>Hora:</label><br><input type="time" style="color: blue;" name="hini" value="<?php echo $hini;?>">
                                      </td>
                                      <td>
                                          <label>Fecha entrega:</label><input type="date" style="line-height: 16px;color: blue;" name="fin" onchange="calcula()" value="<?php echo $fin;?>">
                                      </td>
                                      <td>
                                          <label>Hora:</label><br><input type="time" style="color: blue;" name="hfin" value="<?php echo $hfin;?>">
                                      </td>                                      
                                  </tr>
                                  <tr>
                                      <td>
                                          <label>Renta por Día:</label><input style="color: blue;" type="number" style="color: blue;" onchange="importe()" name="pordia" value="<?php echo $pordia;?>">
                                      </td>
                                      <td>
                                          <label>Total de dias:</label><input style="color: blue;"  type="number" style="color: blue;" onchange="importe()" name="dias" value="<?php echo $dias;?>">
                                      </td>
                                      <td>
                                          <label>Cargos extras:</label><input style="color: blue;" type="number" style="color: blue;" name="extras" onchange="importe()" value="<?php echo $extras;?>">
                                      </td>
                                      <td>
                                          <label>Total a pagar:</label><input style="color: blue;" readonly="" type="number" style="color: blue;" name="total" value="<?php echo $total;?>">
                                      </td>                                      
                                  </tr>
                              </table>
                              </form>
                              </div>
                          </div>
                </div>                 
    </div>
<?php    
}