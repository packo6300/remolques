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
       $pgn="Editar Orden de Venta";
       $edit="style='display: none;'";
       $sql="select * from ov where folio=$idref";
       $res=consulta($sql);
        foreach ($res as  $row) {
            $idprov=$row['idclt'];
           
        } 
        //carga datos de cliente
       $sql2="select * from clientes2 where idclt=$idprov;";
        $res2=consulta($sql2);
        foreach ($res2 as  $row2) {
            $nombre=$row2['nombre'];
            $direccion=$row2['direccion'];
            $tel=$row2['telefono'];
            $descuento=$row2['descuento'];
        }
        ///fin de la carga de datos de compra
    }
    else{
        $idref="new";
        $pgn="Orden de Venta";
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
function cargaArt(id){
    $.ajax({
            type: "POST",url:"modulos/Art/ArtDatos.php",data:{code:id},
            dataType: "json",
            success: function (datos, textStatus, jqXHR) {
            $('input[name="idart"]').val(datos.id);
            $('input[name="precio"]').val(datos.precio);
            $('textarea[name="desc"]').val(datos.desc);
            $('input[name="costo"]').val(datos.costo);
            $('input[name="ut"]').val(datos.ut);
            $('input[name="cve"]').val(datos.cve);
            }
            });
}
function cOC(id){
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/ovnueva.php",data:{code:id},
            dataType: "json"
            }).done(function(datos) {
                $.ajax({type: 'POST',url:"modulos/Ventas/OvPropiedad.php",data:{id:datos.folio}
                    }).done(function (datos){
                        $("#pant").html(datos);
                    });
            });
}
function cOC2(id){
     $.ajax({type: 'POST',url:"modulos/Ventas/OvPropiedad.php",data:{id:id}
                    }).done(function (datos){
                        $("#pant").html(datos);
                    });
}
function Sel(url){
         var miPopup;
         miPopup=window.open(url, 'popup', 'left=290, top=200, width=812, height=341,titlebar=0,location=0,toolbar=0, resizable=1');
}
function agrega(){
    var s=$("#data").serialize();
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/artint.php",data:s,
            dataType: 'json'
            }).done(function(data) {
                cOC2('<?php echo $idref;?>');
            });
}
function loadart(id){
    $.ajax({
            type: "POST",url:"modulos/Ventas/OvPropiedadArts.php",data:{code:id},
            }).done(function(datos) {
                $("#arts").html(datos);
            });
}
function gdr(){
    var re=$('input[name="total"]').val();
    var id='<?php echo $idref ; ?>';
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/ovGdr.php",data:{id:id,t:re},
            success: function (data, textStatus, jqXHR) {
                    alert(data);
                    $.ajax({type: 'POST',url:"modulos/Ventas/OvPropiedad.php",data:{id:id}
                    }).done(function (datos){
                        $("#pant").html(datos);
                    });
                    //$('#pant').load('modulos/Ventas/Ov.php');
                    },
            error: function (jqXHR, textStatus, errorThrown) {
                        alert('Ocurrio un error, verifique datos e intentede nuevo');
                    }
            });
}
function b(id){
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/ovDel.php",data:{code:id}
            }).done(function(datos) {
               alert(datos);
               $('#pant').load('modulos/Ventas/Ov.php');
            });
}
function ocVer(id){
window.open("dom/output2pdf.php?id="+id+"&url=Ventas/OvPDF.php");
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
                    <td colspan="3">
                        <label style="color: blue;">Cliente</label><br>
                        <button id="slct" <?php echo $edit;?>  type="button" class="btn btn-default" onclick="Sel('modulos/Clt/CltSelect.php')"><span class="glyphicon glyphicon-search"></span></button>
                        <input type="hidden" name="prov" value="<?php echo $idprov;?>">
                        <label>Clave:</label>
                        <input type="text" style="max-width: 35px;" disabled="" onchange="carga()"  id="clt" value="<?php echo $idprov;?>">
                        <label></label><label id="nclt" style="color:blue;">&nbsp;&nbsp;<?php echo $nombre;?></label>
                        <br><label>Dirección:</label><label style="color: blue;" id="dir">&nbsp;&nbsp;<?php echo $direccion;?></label>
                        <br><label>Telefono:</label><label style="color: blue;" id="tel">&nbsp;&nbsp;<?php echo $tel;?></label>
                    </td>
                    <td colspan="1">
                        <label style="color: blue;">Folio:</label><br>
                        <input type="hidden" name="idrent" value="<?php echo $idref; ?>">
                        <input type="text" style="min-width: 35px;" disabled="" value="<?php echo $idref;?>"><br><br>
                        <input type="button" class="btn btn-success" value="Guardar" onclick="gdr();">
                        <?php if($idref != "new"){ ?>
                        <input type="button" class="btn btn-danger" value="Descartar" onclick="b('<?php echo $idref; ?>')">
                        <input type="button" class="btn btn-default" value="Imprimir" onclick="ocVer('<?php echo $idref; ?>')">
                        <?php } ?>
                        <input type="button" class="btn btn-info" value="Regresar" onclick="$('#pant').load('modulos/Ventas/Ov.php');">
                    </td>
                </tr>
                <tr>
                    <th colspan="4" align="center">
                        <label>Articulos:</label>
                    </th>
                </tr>
                <tr>
                    <td style="max-width: 250px;">
                        <label >Articulo</label><br>
                        <button type="button" class="btn btn-default" onclick="Sel('modulos/Art/ArtSelect.php')"><span class="glyphicon glyphicon-search"></span></button>
                        <input type="hidden" name="idart" value="">
                        <input type="text" onchange="cargaArt(this.value)" style=" color: blue;max-width: 94px;"  name="cve" id="art" value="">
                    </td>
                    <td colspan="2" style="min-width: 300px;">
                        <label>Descripción:</label><textarea style="color: blue;margin: 0px;width: 551px; height: 62px;" value="" name="desc" readonly=""></textarea>                      
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
            