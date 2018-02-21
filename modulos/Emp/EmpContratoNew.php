<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if($_POST['id']){
    $idUsr=$_POST['id'];
    $cont=$_SESSION['nterior'];
    $sql=consulta("SELECT * FROM huella where id_usuario = $idUsr;");
    foreach ($sql as  $a) {
        $nombreEmp=$a['nombre_completo'];
        $ap=$a['apellio_p'];
        $am=$a['apellido_m'];
    }
    $nombreEmp =$nombreEmp." ".$ap." ".$am;
    ?>
<script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/EmpContratoNew.php",data:s
        }).done(function (datos){
            $("#mensajes").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
    }
    function asig(id){
    var s=confirm("¿Desea revocar el contrato? \n IMPORTANTE: \n ¡tome en cuenta que un empleado sin contrato o contrato vencido no podra checar!");  
    if(s===true){
      alert("pendiente para cerrar contrato al dia con el id del ultimo");
    }
    }
    function back(id){
    try{
       $.ajax({type: 'POST',url:"modulos/Emp/EmpContratoDetalle.php",data:{ida:id}
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
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="back(<?php echo $idUsr; ?>)"></span>Asignar contrato</label>
</div>
<br>
<form id="manual">
            <input type="hidden" name="nemp" value="<?php echo $idUsr; ?>" >
            <input type="text" class="form-control" name="nombre" readonly="" value="<?php echo $nombreEmp;?>">
            <label>Nuevo Contrato:</label>
                <select  name="contr" class="form-control">
                    <?php
                    $result= consulta("SELECT nombre,idcontratos FROM contratos ORDER BY nombre ASC");
                    foreach ($result as  $depto) {
                         if($conN == $depto['nombre'] ){
                            $seleccionado = "selected";
                        }
                        else{
                        $seleccionado = "";
                        }
                    ?>
                        <option  value = "<?php echo $depto['idcontratos']; ?>" <?php echo $seleccionado; ?> > <?php echo $depto['nombre']; ?></option>
                    <?php 
                    } ?>
                </select>
                <input type="button" class="btn btn-success" value="Guardar cambios" onclick="actualiza();">            
            <br><HR style="  border-top: 2px solid #A1A0A0;">
            <div style="overflow-y: auto; overflow-x: auto; height: 10em;">
            <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><b>Duración</b></td>
                        <td><b>Fecha inicial</b></td>
                        <td><b>Fecha de renovación</b></td>
                    </tr>
                    <?php
                    $sql2="SELECT * FROM empcon2  where emp = $idUsr;";
                        $r2=  consulta($sql2);
                       foreach ($r2 as  $rr2) {
                            echo"<tr class='tr_con'>";
                            $d=$rr2['duracion']." ".$rr2['medida'];
                            if($d=="100 YEAR"){
                            echo "<td>Planta</td>";    
                            }
                            else{
                            echo "<td>".$rr2['duracion']." ".$rr2['medida']."</td>";    
                            }
                            echo "<td>".$rr2['fecha_alta']."</td>";
                            echo "<td >".$rr2['fecha_baja']."</td></tr>";
                        }
                        ?>
            </table>
            </div>
        </form>
        <div id="mensajes">
            
        </div>   
</form>
</div>
<?php 
}
else if($_POST['nemp']){
    
}
else{
    echo "nada para mostrar";
}