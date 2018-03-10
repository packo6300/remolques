<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
//ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="ventas";
$_SESSION['tbl']="ov"; 
$_SESSION['modulo']="Cotización";
$idUsr=$_SESSION['idCH'];
$hoy = date("Y-m-d"); 
if($_POST){
       $prov=$_POST['prov'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $sta=$_POST['st'];
       $sql="SELECT * FROM cotizacion where cliente like '%$prov%' and (fecha between '$fecha1' and '$fecha2') and estatus like '%$sta%'  order by cliente,fecha;";
   }
   else{
       $prov="";
       $fecha1=$hoy;
       $fecha2=$hoy;
       $sql="SELECT * FROM cotizacion where fecha between '$fecha1' and '$fecha2';";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Ventas/Cotizacion.php",data:s
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
function mod(id){
     try{
        $.ajax({type: 'POST',url:"modulos/Ventas/CotizacionPropiedad.php",data:{id:id}
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }   
}
function nvo(){
    try{
        $("#pant").html("<center><br><br><br><br><label>Cargando por favor espere...</label><br><img style='width: 100px;' src='img/loading.gif'></center>");
        $("#pant").load("modulos/Ventas/CotizacionPropiedad.php");
    }
    catch(err){
        console.error(err);
    }
}
function ocMail(id){
    try{
        $("#pant").html("<center><br><br><br><br><label>Cargando por favor espere...</label><br><img style='width: 100px;' src='img/loading.gif'></center>");
        $.ajax({type: 'POST',url:"modulos/Ventas/cotizacionMail.php",data:{id:id},
        success: function (data, textStatus, jqXHR) {
            $('#pant').html(data);
        },    
        error: function (jqXHR, textStatus, errorThrown) {
           $('#pant').html('<div class="alert alert-danger"><strong>¡'+textStatus+'!</strong></div>');             
        }
        });
    }
    catch(err){
        console.error(err);
    }
}
function ocSt(id,st){
    try{
        $.ajax({type: 'POST',url:"modulos/Ventas/acctions/ovst.php",data:{id:id,st:st}
        }).done(function (datos){
            alert(datos);
            $('#pant').load('modulos/Ventas/Ov.php');
        });
    }
    catch(err){
        console.error(err);
    }  
}
function ocR(id){
    try{
        $.ajax({type: 'POST',url:"modulos/Ventas/acctions/ovRecibir.php",data:{id:id}
        }).done(function (datos){
            alert(datos);
            $('#pant').load('modulos/Ventas/Ov.php');
        });
    }
    catch(err){
        console.error(err);
    }  
}
function ocVer(id){
window.open("dom/output2pdf.php?id="+id+"&url=Ventas/CotizacionPDF.php");
}
function ocVer2(id){
window.open("dom/output2pdf2.php?id="+id+"&url=Ventas/OvPDFTicket.php");
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span><?= $_SESSION['modulo']; ?></label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a><br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="nvo()"></span></td>
                        <td>
                            <label><b>Folio</b></label><br>
                            <input value="" type="text" name="folio" onchange="recarga()"></td>
                        <td>
                            <label><b>Cliente</b></label><br>
                            <input value="<?php echo $prov; ?>" type="text" name="prov" onchange="recarga()"></td>
                        <td>
                            <label><b>Fecha</b></label><br>
                            D:<input value="<?php echo $fecha1; ?>" style="line-height: 13px;" type="date" name="fecha1"  onchange="recarga()"><br>
                            A:<input value="<?php echo $fecha2; ?>" style="line-height: 13px;" type="date" name="fecha2"  onchange="recarga()">
                        </td>
                        <td>
                            <label>Hora</label><br>
                        </td>         
                        <td>
                            <label>Total</label><br>
                        </td>  
                        <td>
                            <label>Saldo</label>
                        </td> 
                        <td>
                            <label>Estatus</label><br>
                            <select name="st" onchange="recarga()">
                                <option value=""></option>
                                <?php 
                                $sql2="SELECT * FROM ovsta order by nombre;";
                                $re=consulta($sql2);
                                foreach ( $re as  $r) {
                                    if(filter_input(INPUT_POST, 'st')== $r['idovsta'] ){
                                        $seleccionado = "selected";
                                    }
                                    else{
                                        $seleccionado = "";
                                    }
                                    echo "<option value='".$r['idovsta']."' ".$seleccionado.">".$r["nombre"]."</option>";
                                }
                                ?>
                            </select>
                        </td> 
                    </tr>      
                    
                    <?php
                    $_SESSION['query'] = $sql;
                    $numero = 0;
                    foreach (consulta($sql) as $k=> $row) {
                        $row['folio']=$row['idcotizacion'];
                        $sql2="SELECT nombre FROM ovsta where idovsta=".$row['estatus'];
                        $re=consulta($sql2);
                        $row['estatus']=$re[0]['nombre']; 
                    ?>
                        <tr class='tr_con'>
                        <td>
                            <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list "></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <?php
                                      if($row["estatus"]=="Aplicada"){
                                          echo "<li><a onclick='ocR(".$row['folio'].")'><span class='glyphicon glyphicon-edit'></span>Pagar</a></li>";
                                          echo "<li><a onclick='ocSt(".$row['folio'].",4)'><span class='glyphicon  glyphicon-remove'></span> Cancelar</a></li>";
                                          echo "<li><a onclick='ocVer(".$row['folio'].")'><span class='glyphicon  glyphicon-eye-open'></span> Ver</a></li>";
                                          echo "<li><a onclick='ocVer2(".$row['folio'].")'><span class='glyphicon glyphicon-eye-open'></span> Ticket</a></li>";
                                      }
                                      elseif($row["estatus"]=="Cotizacion"){
                                          echo "<li><a onclick='mod(".$row['folio'].")'><span class='glyphicon glyphicon-edit'></span> Editar</a></li>";
                                          echo "<li><a onclick='ocVer(".$row['folio'].")'><span class='glyphicon  glyphicon-eye-open'></span> Ver</a></li>";
                                          echo "<li><a onclick='ocMail(".$row['folio'].")'><span class='glyphicon  glyphicon-envelope'></span> Enviar por email</a></li>";
                                      }
                                      elseif($row["estatus"]=="Pagada"){
                                          echo "<li><a onclick='ocVer(".$row['folio'].")'><span class='glyphicon glyphicon-eye-open'></span> Ver</a></li>";
                                          echo "<li><a onclick='ocVer2(".$row['folio'].")'><span class='glyphicon glyphicon-eye-open'></span> Ticket</a></li>";
                                      }
                                      elseif($row["estatus"]=="Cancelada"){
                                          echo "<li><a onclick='ocVer(".$row['folio'].")'><span class='glyphicon glyphicon-eye-open'></span> Ver</a></li>";
                                      }
                                      else{
                                          echo "<li><a onclick='ocSt(".$row['folio'].",4)'><span class='glyphicon glyphicon-edit'></span> Cancelar</a></li>";
                                      }
                                      ?>
                                  </ul>
                            </div>
                            </td>
                        <?php
                        echo "<td>" .$row["folio"]."</td>";                        
                        echo "<td>".$row["cliente"]."</td>";
                        echo "<td>" .$row["fecha"]."</td>";
                        echo "<td>" .$row["hora"]."</td>";
                        echo "<td>".$row["total"]."</td>";
                        echo "<td>".$row["saldo"]."</td>";
                        echo "<td>".$row["estatus"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
            </form>
          <br>
</div>