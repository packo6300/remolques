<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="referencias";
$_SESSION['tbl']="cltrefe"; 

$hoy = date("Y-m-d"); 
if($_POST['idclt']){
       $idclt=$_POST['idclt'];
       $sql="SELECT * FROM cltauto where idclt=$idclt  order by marca;";
       $_SESSION['clt'] = $idclt;
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Clt/CltAut.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Clt/CltAutPropiedad.php",data:{idaut:id},
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
function car(id){
    try{
        $.ajax({type: 'POST',url:"modulos/Clt/CltAut.php",data:{idclt:id},
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
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }   
}
function del(id){
     try{
        $.ajax({type: 'POST',url:"modulos/Clt/CltAutoEliminar.php",data:{idcltauto:id},
            success: function(data){
                alert(data);
                car('<?php echo $idclt ?>');
            },
            error: function(){
                   alert('ERROR Favor de volver a intentar');
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
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Automoviles de cliente</label>
            </div>
            <a href="<?php echo $_SESSION['hpd']; ?>/lib/tocsv.php" ><img src="../../img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 5px;left: 11px;" onclick="mod('0')"></span></td>
                        <td>
                            <label>Placas</label><br>
                            <!--<input value="<?php //echo $resp; ?>" type="text" name="nombre"  onchange="recarga()">-->
                        </td>
                        <td>
                            <label>Marca</label><br>
                        </td>
                        <td>
                            <label>Modelo</label><br>
                        </td>
                        <td>
                            <label>Color</label><br>
                        </td>     
                        <td>
                            <label>Estado</label><br>
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
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu info">
                                      <li><a onclick="mod(<?php echo $row['idcltauto']; ?>);"><span class="glyphicon glyphicon-edit"></span>  Editar</a></li>
                                      <li><a onclick="del(<?php echo $row['idcltauto']; ?>);"><span class="glyphicon glyphicon-trash"></span>  Borrar</a></li>
                                  </ul>
                            </div>
                            </td>
                        <?php
                        echo "<td>" .$row["placa"]."</td>";
                        echo "<td>".$row["marca"]."</td>";
                        echo "<td>" .$row["modelo"]."</td>";
                        echo "<td>".$row["color"]."</td>";
                        echo "<td>".$row["estado"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
            </form>
          <br>
</div>
<?php
   }
   else{
       header("HTTP/1.0 404 Not Found");
   }