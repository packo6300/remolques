<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="referencias";
$_SESSION['tbl']="remolques"; 

$_SESSION['clt'];

$hoy = date("Y-m-d"); 
$idclt= filter_input(INPUT_POST, 'tipo');
$status=$_POST['status'];
if($status==""){$status="1";}
$sql="SELECT * FROM remolques where  tipo like '$idclt%' and stat = $status  order by tipo;";
?>
<script type="text/javascript">
function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Remolque/Rem.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Remolque/RemPropiedad.php",data:{idclt:id},
        beforeSend: function(){
               $("#pant").html("<img src='img/loading.gif' style='width: 25px; margin-left: 8px; margin-top: 3px;' >");      
            },
            //una vez finalizado correctamente
            success: function(data){
                $("#pant").html(data);
            },
            //si ha ocurrido un error
            error: function(){
               $("#pant").html('<br><br><div class="alert alert-danger"><br><br><center><img src="img/bad.png" style="width: 25px; margin-left: 8px; margin-top: 3px;" ><br><br><strong>¡Error!</strong>No hay datos para extraer</center></div>');
            }
        });
    }
    catch(err){
        console.error(err);
    }   
}
function eli(id){
     try{
        $.ajax({type: 'POST',url:"modulos/Remolque/RemEliminar.php",data:{idclt:id},
           success: function(data){
                alert(data);
            }
        });
    }
    catch(err){
        console.error(err);
    }   
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Remolques</label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="mod('0')"></span></td>
                        <td>
                            <!--<label>Status</label><br>
                            <select onchange="recarga()" name="status">
                                <?php 
                                $sql2="select * from statuss;";
                                $seleccionado="";
                                $r = consulta($sql2);
                                foreach ($r as  $r2) {
                                    $nombre=$r2['nombre'];
                                    $idsts=$r2['idstatus'];
                                    $seleccionado="";
                                    if($idsts==$status){$seleccionado="selected";}                    
                                     echo '<option value="'.$idsts.'"  '.$seleccionado.'>'.$nombre.'</option>';
                                }
                                ?>
                            </select> -->
                        </td>
                        <td>
                            <label>Tipo</label><br>
                            <input value="<?php echo $idclt; ?>" type="text" name="tipo"  onchange="recarga()">
                        </td>
                        <td>
                            <label># Rentas</label>
                        </td>
                        <td>
                            <label>Placas</label>
                        </td>
                        <td>
                            <label>Estructura</label><br>
                        </td>
                        <td>
                            <label>Rampas</label><br>
                        </td>
                        <td>
                            <label>luces</label><br>
                        </td>         
                        <td>
                            <label>conector</label>
                        </td>  
                        <td>
                            <label>Gato</label>
                        </td>  
                        <td>
                            <label>Llantas</label>
                        </td>  
                        <td>
                            <label>Extra</label>
                        </td>  
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    foreach (consulta($sql) as  $row) {
                        ?>
                        <tr class='tr_con'>
                        <td>
                            <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu info">
                                      <li><a onclick="mod(<?php echo $row['idrem']; ?>);"><span class="glyphicon glyphicon-edit"></span>  Editar</a></li>
                                      <li><a onclick="eli(<?php echo $row['idrem']; ?>);"><span class="glyphicon glyphicon-trash"></span>  Eliminar</a></li>
                                  </ul>
                            </div>
                            </td>
                        <?php
                        echo "<td>" .$row["status"]."</td>";
                        echo "<td>".$row["tipo"]."</td>";
                        echo "<td>".$row["rentas"]."</td>";
                        echo "<td>" .$row["placa"]."</td>";
                        echo "<td>".$row["estructura"]."</td>";
                        echo "<td>".$row["rampas"]."</td>";
                        echo "<td>".$row["luces"]."</td>";
                        echo "<td>".$row["conector"]."</td>";
                        echo "<td>".$row["gato"]."</td>";
                        echo "<td>".$row["eje"]."</td>";
                        echo "<td>".$row["extra"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
            </form>
          <br>
</div>