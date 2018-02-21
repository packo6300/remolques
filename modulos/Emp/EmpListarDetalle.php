<?php
if(!isset($_SESSION)){ 
    session_start(); 
}

$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
    $idUsr=$_SESSION['idCH'];
    $_SESSION['tbl']="exel_2"; 
$hoy = date("Y-m-d"); 
if($_POST){
       $nemp=$_POST['matri'];
       $resp=$_POST['nombre'];
       $motivo=$_POST['tipo'];
       $emp=$_POST['sucursal'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $sql="SELECT * FROM exel_2 where num like '%$nemp%' and nombre like '%$resp%' and (fecha between '$fecha1' and '$fecha2') order by fecha,ent desc;";
   }
   else{
       $fecha2 = $hoy;
       $fecha1 = $hoy;     
       $sql="SELECT * FROM exel_2 where fecha=curdate() order by fecha desc;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/EmpListarDetalle.php",data:s
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
function print(){
    
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Detalle asistencia</label>
            </div>
            <a href="<?php echo $_SESSION['hpd']; ?>/lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a>
            &nbsp;&nbsp;<a href=""><img src="img/pdf.png" alt="Exportar a PDF"></a>&nbsp;&nbsp;
            <a href=""><span class="glyphicon glyphicon-print"></span></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><label><b># Empleado:</b></label><input value="<?php echo $nemp; ?>" type="text" name="matri" size="8" onchange="recarga()"></td>  
                        <td colspan="3">
                            <label><b>Nombre:</b></label><input value="<?php echo $resp; ?>" type="text" name="nombre" size="40" onchange="recarga()"><br>
                        </td>
                                          
                        <td colspan="5">
                            <b>Del:</b><input class="" style="line-height: 12px;max-width: 138px;" type="date" name="fecha1" value="<?php echo $fecha1; ?>" onchange="recarga();">
                            &nbsp;<b>Al:</b><input class="" style="line-height: 12px;max-width: 138px;" type="date" name="fecha2" value="<?php echo $fecha2; ?>" onchange="recarga();"><br>
                        </td>
                                                            
                    </tr>        
                    <tr> 
                        <td><b># Empleado</b></td>
                        <td><b>Nombre</b></td>
                        <td width="100px"><b>F/Pago</b></td>
                        <td width="100px"><b>Sucursal</b></td>
                        <td width="130px"><b>Fecha</b></td>
                        <td><b>Hora</b></td>
                        <td><b>Movimiento</b></td>
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                        $nombre=  utf8_encode($row["nombre"]);
                        echo "<tr class='tr_con'><td>".$row["num"]."</td>";
                        echo "<td>" .$nombre."</td>";
                        echo "<td>" .$row["pago"]."</td>";
                        echo "<td>".$row["sucursal"]."</td>";
                        echo "<td>".$row["fecha"]."</td>";
                        echo "<td>".$row["ent"]."</td>";
                        echo "<td>" .$row["tipo"]. "</td></tr>";
                        $numero++;
                     }
                    ?>
          </table>
            </form>
          <br>
</div>