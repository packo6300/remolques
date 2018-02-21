<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="compras";
$_SESSION['tbl']="oc"; 
$_SESSION['modulo']="Compras";
$idUsr=$_SESSION['idCH'];

$hoy = date("Y-m-d"); 
if($_POST){
       $folio=$_POST['folio'];
       $pfact=$_POST['pfact'];
       $prov=$_POST['prov'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $sta=$_POST['st'];
       $sql="SELECT * FROM oclistar where folio like '%$folio%' and nombre like '%$prov%' and fact like '$pfact%' and (fecha between '$fecha1' and '$fecha2') and estatus like '%$sta%'  order by fecha desc;";
   }
   else{
       $fecha1=$hoy;
       $fecha2=$hoy;
       $sql="SELECT * FROM oclistar where fecha between '$fecha1' and '$fecha2' order by fecha desc;;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Compras/Com.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Compras/ComPropiedad.php",data:{id:id}
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
        $("#pant").load("modulos/Compras/ComPropiedad.php");
    }
    catch(err){
        console.error(err);
    }
}
function ocSt(id,st){
    try{
        $.ajax({type: 'POST',url:"modulos/Compras/acctions/ocst.php",data:{id:id,st:st}
        }).done(function (datos){
            alert(datos);
            $('#pant').load('modulos/Compras/Com.php');
        });
    }
    catch(err){
        console.error(err);
    }  
}
function ocR(id){
    try{
        $.ajax({type: 'POST',url:"modulos/Compras/acctions/ocRecibir.php",data:{id:id}
        }).done(function (datos){
            alert(datos);
            $('#pant').load('modulos/Compras/Com.php');
        });
    }
    catch(err){
        console.error(err);
    }  
}
function ocVer(id){
window.open("dom/output2pdf.php?id="+id+"&url=Compras/OcPDF.php");
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Compras</label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a><br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="nvo()"></span></td>
                        <td>
                            <label><b>Folio</b></label><br>
                            <input value="<?php echo $folio; ?>" type="text" name="folio" onchange="recarga()" style="width: 5em;"></td>
                        <td>
                            <label><b>Folio Fact</b></label><br>
                            <input value="<?php echo $pfact; ?>" type="text" name="pfact" onchange="recarga()" style="width: 5em;"></td>
                        <td>
                            <label><b>Proveedor</b></label><br>
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
                                $sql2="SELECT * FROM ocsta order by nombre;";
                                $r2=  consulta($sql2);
                                foreach ($r2 as  $r) {
                                    if($_POST['st']== $r['nombre'] ){
                                            $seleccionado = "selected";
                                        }
                                        else{
                                            $seleccionado = "";
                                        }
                                    echo "<option value='".$r['nombre']."' ".$seleccionado.">".$r["nombre"]."</option>";
                                }
                                ?>
                            </select>
                        </td> 
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                    ?>
                        <tr class='tr_con'>
                        <td>
                            <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list "></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <?php
                                      if($row["estatus"]=="Aprobada"){
                                          echo "<li><a onclick='ocR(".$row['folio'].")'><span class='glyphicon glyphicon-edit'></span>Recibir</a></li>";
                                          echo "<li><a onclick='ocSt(".$row['folio'].",4)'><span class='glyphicon  glyphicon-remove'></span> Cancelar</a></li>";
                                          echo "<li><a onclick='ocVer(".$row['folio'].")'><span class='glyphicon  glyphicon-eye-open'></span> Ver</a></li>";
                                      }
                                      elseif($row["estatus"]=="Borrador"){
                                          echo "<li><a onclick='ocSt(".$row['folio'].",2)'><span class='glyphicon glyphicon-ok'></span> Aprobar</a></li>";
                                          echo "<li><a onclick='ocSt(".$row['folio'].",4)'><span class='glyphicon  glyphicon-remove'></span> Cancelar</a></li>";
                                          echo "<li><a onclick='mod(".$row['folio'].")'><span class='glyphicon glyphicon-edit'></span> Editar</a></li>";
                                          echo "<li><a onclick='ocVer(".$row['folio'].")'><span class='glyphicon  glyphicon-eye-open'></span> Consultar</a></li>";
                                      }
                                      elseif($row["estatus"]=="Recibida"){
                                          echo "<li><a onclick='ocVer(".$row['folio'].")'><span class='glyphicon glyphicon-eye-open'></span> Consultar</a></li>";
                                      }
                                      elseif($row["estatus"]=="Cancelada"){
                                          echo "<li><a onclick='mod(".$row['folio'].")'><span class='glyphicon glyphicon-eye-open'></span> Consultar</a></li>";
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
                        echo "<td>" .$row["fact"]."</td>";
                        echo "<td>".$row["nombre"]."</td>";
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