<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="proveedores";
$_SESSION['tbl']="proveedores"; 

$idUsr=$_SESSION['idCH'];

$hoy = date("Y-m-d"); 
if($_POST){
       $n=$_POST['n'];
       $d=$_POST['d'];
       $t=$_POST['t'];
       $sql="SELECT * FROM proveedores where telefono like '%$t%' and nombre_prov like '%$n%' and direccion like '%$d%' order by nombre_prov;";
   }
   else{
       $sql="SELECT * FROM proveedores order by nombre_prov;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Proveedor/ProvListar.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Proveedor/ProvEditar.php",data:{id:id},
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
        $("#pant").load("modulos/Proveedor/ProvNew.php");
    }
    catch(err){
        console.error(err);
    }
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Proveedores</label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="nvo()"></span></td>
                        <td>
                            <label><b>Nombre:</b></label><br>                           
                            <input value="<?php echo $n; ?>" type="text" name="n" onchange="recarga()"></td>
                        <td>
                            <label>Dirección</label><br>
                            <input value="<?php echo $d; ?>" type="text" name="d"  onchange="recarga()">
                        </td>
                        <td>
                            <label><b># telefono:</b></label><br>
                            <input value="<?php echo $t; ?>" type="text" name="t"  onchange="recarga()">
                        </td>         
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                        $nombre=  utf8_encode($row["nombre_prov"]);
                        ?>
                        <tr class='tr_con'>
                        <td>
                            <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a onclick="mod(<?php echo $row['idProveedores']; ?>);"><span class="glyphicon glyphicon-edit"></span> Editar</a></li>
                                  </ul>
                            </div>
                            </td>
                        <?php
                        echo "<td>" .$nombre."</td>";
                        echo "<td>" .$row["direccion"]."</td>";
                        echo "<td>".$row["telefono"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
            </form>
          <br>
</div>