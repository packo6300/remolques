<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="compras";
$_SESSION['tbl']="compras"; 

$idUsr=$_SESSION['idCH'];

$hoy = date("Y-m-d"); 
if($_POST){
       $nemp=$_POST['tel'];
       $resp=$_POST['nombre'];
       $cel=$_POST['cel'];
       $sql="SELECT * FROM clientes where telefono like '%$nemp%' and nombre like '%$resp%' and celular like '%$cel%'  order by nombre;";
   }
   else{
       $sql="SELECT * FROM clientes order by nombre;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Compras/ComListar.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Clt/CltEditar.php",data:{tel:id}
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
        $("#pant").load("modulos/Compras/ComNew.php");
    }
    catch(err){
        console.error(err);
    }
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Compras</label>
            </div>
            <a href="<?php echo $_SESSION['hpd']; ?>/lib/tocsv.php" ><img src="../../img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="nvo()"></span></td>
                        <td>
                            <label><b># telefono:</b></label><br>
                            <input value="<?php echo $nemp; ?>" type="text" name="tel" onchange="recarga()"></td>
                        <td>
                            <label><b>Nombre:</b></label><br>
                            <input value="<?php echo $resp; ?>" type="text" name="nombre"  onchange="recarga()">
                        </td>
                        <td>
                            <label>Dirección</label><br>
                        </td>         
                        <td>
                            <label>Celular</label><br>
                            <input value="<?php echo $cel; ?>" type="text" name="cel"  onchange="recarga()">
                        </td>  
                        <td>
                            <label>Descuento</label>
                        </td> 
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                        $nombre=  utf8_encode($row["nombre"]);
                        ?>
                        <tr class='tr_con'>
                        <td>
                            <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a onclick="mod(<?php echo $row['telefono']; ?>);"><span class="glyphicon glyphicon-edit"></span> Editar</a></li>
                                  </ul>
                            </div>
                            </td>
                        <?php
                        echo "<td>".$row["telefono"]."</td>";
                        echo "<td>" .$nombre."</td>";
                        echo "<td>" .$row["direccion"]."</td>";
                        echo "<td>".$row["celular"]."</td>";
                        echo "<td>".$row["descuento"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
            </form>
          <br>
</div>