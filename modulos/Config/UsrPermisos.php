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
if($_POST['ida']){
       $adm=$_POST['ida'];
       $resp=$_POST['nombre'];
       $motivo=$_POST['usr'];
       $sql="CALL permisos_ver($adm);";
   }
   
?>
<script type="text/javascript">
    function desasignar(id){
        try{
            var r = confirm("Desea eliminar el permiso al usuario?");
            if (r == true) {
            $.ajax({type: 'POST',url:"modulos/Config/UsrPermisoBorrar.php",data:{ida:id}
            }).done(function (datos){
            $("#pant").html(datos);
            });
            roles(<?php echo $adm ?>);
            }
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
   function nvo(s){
   try{
        $.ajax({type: 'POST',url:"modulos/Config/UsrPermisoNuevo.php",data:{emp:s}
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}

</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Permisos asignados</label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 4px;left: 12%;" onclick="nvo( <?php echo $adm;?> )"></span></td>
                        <td><label><b>Permiso</b></label></td>
                        <td><label><b>Sección</b></label></td>
                    </tr> 
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    foreach ($resul as  $row) {
                        $nombre=  $row["cabeza"];                        
                        ?>
                        <tr>
                            <td style="width: 12%;">
                                <span class="glyphicon glyphicon-trash" onclick="desasignar(<?php echo $row["id"]; ?>)"></span>
                        </td>
                        <?php
                        echo "<td>".$row["permiso"]. "</td>";
                        echo "<td >".$nombre."</td></tr>";
                        $numero++;
                     }
                    ?>
          </table>
            </form>
          <br>
</div>