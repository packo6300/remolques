<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="rentas";
$_SESSION['tbl']="rentas"; 

$idUsr=$_SESSION['idCH'];

$hoy = date("Y-m-d"); 
if($_POST){
       $n=$_POST['n'];
       $d=$_POST['d'];
       $t=$_POST['t'];
       $sql="SELECT * FROM rentas where telefono like '%$t%' and nombre_prov like '%$n%' and direccion like '%$d%' order by nombre_prov;";
   }
   else{
       $sql="SELECT * FROM rentas order by ini;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Renta/Renta.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Renta/RentaPropiedad.php",data:{id:id},
            beforeSend: function(){
               $("#pant").html("<center><br><br><br><br><label>Cargando por favor espere...</label><br><img style='width: 100px;' src='img/loading.gif'></center>");      
            },
            //una vez finalizado correctamente
            success: function(data){
                $("#pant").html(data);
            },
            //si ha ocurrido un error
            error: function(){
                $("#pant").html('<center><br><br><br><br><div class="alert alert-danger"><strong>¡Error!</strong>Intentar de nuevo</div></center>');
            }
        });
    }
    catch(err){
        console.error(err);
    }   
}
function nvo(){
    try{
        $("#pant").html("<center><br><br><br><br><label>Cargando por favor espere...</label><br><img style='width: 100px;' src='img/loading.gif'></center>");
        $("#pant").load("modulos/Renta/RentaPropiedad.php");
    }
    catch(err){
        console.error(err);
    }
}
function peticion(id,url){
window.open("dom/output2pdf.php?id="+id+"&url=RentaPDF.php");
}

</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Renta</label>
            </div>
            <a href="<?php echo $_SESSION['hpd']; ?>/lib/tocsv.php" ><img src="../../img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="nvo()"></span></td>
                        <td>
                            <label><b>Cliente</b></label><br>                           
                            <input value="<?php echo $n; ?>" type="text" name="n" onchange="recarga()">
                        </td>
                        <td>
                            <label>Remolque</label><br>
                            <input value="<?php echo $d; ?>" type="text" name="d"  onchange="recarga()">
                        </td>
                        <td>
                            <label><b>Fecha Renta</b></label>
                            <input value="<?php echo $t; ?>" type="text" name="t"  onchange="recarga()"><br>
                            <label><b>Fecha Entrega</b></label>
                            <input value="<?php echo $t; ?>" type="text" name="t"  onchange="recarga()">
                        </td>
                        <td><label><b>Estatus</b></label></td>
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                   foreach ($resul as  $row) {
                        //$nombre=  utf8_encode($row["nombre_prov"]);
                        ?>
                        <tr class='tr_con'>
                        <td>
                            <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a onclick="mod(<?php echo $row['idrentas']; ?>);"><span class="glyphicon glyphicon-edit"></span> Editar</a></li>
                                      <li><a onclick="mod(<?php echo $row['idrentas']; ?>);"><span class="glyphicon glyphicon-edit"></span> Detalle</a></li>
                                      <li><a onclick="peticion('<?php echo $row['idrentas']; ?>');"><span class="glyphicon glyphicon-edit"></span> Imprimir</a></li>
                                  </ul>
                            </div>
                            </td>
                        <?php
                        echo "<td>" .$row["idclt"]."</td>";
                        echo "<td>" .$row["idremolque"]."</td>";
                        echo "<td>" .$row["deposito"]."</td>";
                        echo "<td>".$row["est"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
            </form>
          <br>
</div>