<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="clientes";
$_SESSION['tbl']="clientes2"; 
$idclt=$_SESSION['clt'];
$hoy = date("Y-m-d");

if($_GET){
    $nu=$_GET['n'];
    $di=$_GET['doc'];
    if($nu=="nuevo"){
        $my="select max(idclt)as nu from clientes2;";
        $myr=  consulta($my);
        foreach ($myr as  $res) {
            $di=$res['nu'];
        }
    $sql="SELECT * FROM clientes2 where idclt=$di;";
    }
    elseif($di!=""){
        $sql="SELECT * FROM clientes2 where idclt=$di;";
    }
    else{
     $sql="SELECT * FROM clientes2 order by nombre;";   
    }
}
elseif($_POST){
       $nemp=$_POST['tel'];
       $resp=$_POST['nombre'];
       $cel=$_POST['cel'];
       $sql="SELECT * FROM clientes2 where telefono like '%$nemp%' and nombre like '$resp%' and celular like '%$cel%'  order by nombre;";
   }
else{
       $sql="SELECT * FROM clientes2 order by nombre;";
}
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Clt/Clientes.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Clt/CltEditar.php",data:{idclt:id},
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
function nvo(){
    try{
        $("#pant").load("modulos/Clt/CltNew.php");
    }
    catch(err){
        console.error(err);
    }
}
function ref(id){
    try{
        $.ajax({type: 'POST',url:"modulos/Clt/CltRef.php",data:{idclt:id},
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
function eli(id){
     try{
        $.ajax({type: 'POST',url:"modulos/Clt/CltEliminar.php",data:{idclt:id},
           success: function(data){
                alert(data);
                $('#pant').load('modulos/Clt/Clientes.php');
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
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Cartera de clientes</label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a>
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
                            <label>Comentarios</label>
                        </td> 
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                        $nombre=  $row["nombre"];
                        ?>
                        <tr class='tr_con'>
                        <td>
                            <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu info">
                                      <li><a onclick="eli(<?php echo $row['idclt']; ?>);"><span class="glyphicon glyphicon-trash"></span>  Eliminar</a></li>
                                       <li><a onclick="mod(<?php echo $row['idclt']; ?>);"><span class="glyphicon glyphicon-edit"></span>  Editar</a></li>
                                       <li><a onclick="ref(<?php echo $row['idclt']; ?>);"><span class="glyphicon glyphicon-user"></span>  Referencias</a></li>
                                       <li><a onclick="car(<?php echo $row['idclt']; ?>);"><img class="glyphicons" src="../../img/glyphicons-cars.png">  Automoviles</a></li>
                                  </ul>
                            </div>
                            </td>
                        <?php
                        echo "<td>".$row["telefono"]."</td>";
                        echo "<td>" .$nombre."</td>";
                        echo "<td>" .$row["direccion"]."</td>";
                        echo "<td>".$row["celular"]."</td>";
                        echo "<td>".$row["rfc"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
        </form>
</div>