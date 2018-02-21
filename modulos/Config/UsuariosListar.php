<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
    
    $idUsr=$_SESSION['idCH'];
    $_SESSION['pg']="Usuarios";
    $_SESSION['tbl']="admin";
if($_POST){
       $resp=$_POST['nombre'];
       $motivo=$_POST['usr'];
       $sql="SELECT id,nombre,usuario FROM administrador where nombre like '%$resp%' and usuario like '%$motivo%' order by nombre;";
   }
   else{
       $sql="SELECT id,nombre,usuario FROM administrador order by nombre;";
   }
    
?>
<script type="text/javascript">
    function editar(id){
     try{
        $.ajax({type: 'POST',url:"modulos/Config/UsrModificar.php",data:{ida:id}
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }   
    }
    function roles(id){
     try{
        $.ajax({type: 'POST',url:"modulos/Config/UsrPermisos.php",data:{ida:id}
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }   
    }
   function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Config/UsuariosListar.php",data:s
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
        $("#pant").load("modulos/Config/UsrNew.php");
    }
    catch(err){
        console.error(err);
    }
}

</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Administradores</label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="nvo()"></span></td>
                        <td>
                            <label><b>Nombre</b></label><br>
                            <input value="<?php echo $resp; ?>" type="text" name="nombre" size="40" onchange="recarga()">
                        </td>
                        <td><label><b>Usuario</b></label><br>
                        <input value="<?php echo $motivo; ?>" type="text" name="usr" size="40" onchange="recarga()">
                        </td>
                    </tr> 
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                        $nombre=  $row["nombre"];
                        
                        ?>
                        <tr>
                            <td>
                                <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a onclick="editar('<?php echo $row['id']; ?>');"><span class="glyphicon glyphicon-edit"></span> Editar</a></li>
                                      <li><a onclick="roles('<?php echo $row['id']; ?>');"><span class="glyphicon glyphicon-lock"></span> Roles</a></li>
                                  </ul>
                                </div>
                            </td>
                        <?php
                        echo "<td>" .$nombre."</td>";
                        echo "<td >".$row["usuario"]."</td></tr>";
                        $numero++;
                     }
                    ?>
          </table>
            </form>
          <br>
</div>