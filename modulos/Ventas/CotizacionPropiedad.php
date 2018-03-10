<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$idref=$_POST['id'];
    if($idref>0){
       $pgn="Editar Cotizacion";
       $edit="style='display: none;'";
       $sql="select * from cotizacion where idcotizacion=$idref";
       $res=consulta($sql);
        foreach ($res as  $row) {
            $nombre=$row['cliente'];           
        }
    }
    else{
        $idref="new";
        $pgn="Cotización";
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
        $( document ).ready(function() {
            loadart('<?php echo $idref ; ?>');
        });
function carga(id){
    $.ajax({
            type: "POST",url:"modulos/Clt/CltDatos.php",data:{code:id},
            dataType: "json"
            }).done(function(datos) {
            $('#nclt').html("<label>&nbsp;&nbsp;"+datos.nombre+"</label>");
            $('input[name="prov"]').val(datos.id);
            $('#dir').html("<label>&nbsp;&nbsp;"+datos.dir+"</label>");
            $('#tel').html("<label>&nbsp;&nbsp;"+datos.tel+"</label>");
            });
            var prov =$('#clt').val();
            $('#slct').hide();
            cOC(prov);            
}
function cOC(id){
    var n=$('#idrent').val();
    if(n=='new'){
        $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/cotizacionNueva.php",data:{code:id},
            dataType: "json"
        }).done(function(datos) {
            $.ajax({type: 'POST',url:"modulos/Ventas/CotizacionPropiedad.php",data:{id:datos.folio}
                }).done(function (datos){
                    $("#pant").html(datos);
                });
        });
    }    
}
function cOC2(id){
     $.ajax({type: 'POST',url:"modulos/Ventas/CotizacionPropiedad.php",data:{id:id}
                    }).done(function (datos){
                        $("#pant").html(datos);
                    });
}
function agrega(){
    var s=$("#data").serialize();
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/cotint.php",data:s,
            dataType: 'json'
            }).done(function(data) {
                cOC2('<?php echo $idref;?>');
            });
}
function loadart(id){
    $.ajax({
            type: "POST",url:"modulos/Ventas/CotizacionPropiedadArts.php",data:{code:id},
            }).done(function(datos) {
                $("#arts").html(datos);
            });
}
function gdr(){
    var re=$('input[name="total"]').val();
    var id='<?php echo $idref ; ?>';
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/cotizacionGdr.php",data:{id:id,t:re},
            success: function (data, textStatus, jqXHR) {
                    alert(data);
                    $.ajax({type: 'POST',url:"modulos/Ventas/CotizacionPropiedad.php",data:{id:id}
                    }).done(function (datos){
                        $("#pant").html(datos);
                    });
                    },
            error: function (jqXHR, textStatus, errorThrown) {
                        alert('Ocurrio un error, verifique datos e intentede nuevo');
                    }
            });
}
function b(id){
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/cotizacionDel.php",data:{code:id}
            }).done(function(datos) {
               alert(datos);
               $('#pant').load('modulos/Ventas/Cotizacion.php');
            });
}
function ocVer(id){
window.open("dom/output2pdf.php?id="+id+"&url=Ventas/CotizacionPDF.php");
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Ventas/Ov.php');"></span><?php echo $pgn;?></label>
</div>
<div class="panel panel-primary">
    <div class="panel-body">
        <form id="data">
            <table id="tbl_info" class="table table-bordered">
                <tr>
                    <td colspan="3" style="min-width: 50em;">
                        <label>Cliente:</label>
                        <input type="text" class="form-control" id="clt" value="<?php echo $nombre;?>" onchange="cOC(this.value)">
                    </td>
                    <td colspan="1" >
                        <div class="pull-right">
                            <label >Folio:</label>
                            <input type="hidden" id="idrent" name="idrent" value="<?php echo $idref; ?>">
                            <input type="text" style="min-width: 35px;" disabled="" value="<?php echo $idref;?>">
                            <br>
                            <input type="button" class="btn btn-success" value="Guardar" onclick="gdr();">
                            <?php if($idref != "new"){ ?>
                            <input type="button" class="btn btn-danger" value="Descartar" onclick="b('<?php echo $idref; ?>')">
                            <input type="button" class="btn btn-default" value="Imprimir" onclick="ocVer('<?php echo $idref; ?>')">
                            <?php } ?>
                            <input type="button" class="btn btn-info" value="Regresar" onclick="$('#pant').load('modulos/Ventas/Ov.php');">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <label>Descripción:</label><textarea class="form-control" value="" name="desc"></textarea>                      
                    </td>
                    <td>
                        <input type="hidden" name="costo" value="">
                        <input type="hidden" name="ut" value="">
                        <label>Precio:</label><input style="color: blue;max-width: 95px;" type="number" name="precio" value="">
                        <label>Cantidad:</label><input style="color: blue;max-width: 95px;" type="number" name="cnt" value="">
                        <button onclick="agrega()" type="button"><span class="glyphicon glyphicon-shopping-cart"></span></button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div id="arts" class="panel-body">
        
    </div>
</div>                 
<div id="mensajes"></div>
            