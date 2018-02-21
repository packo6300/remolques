<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
   
    $idUsr=$_SESSION['idCH'];
$hoy = date("Y-m-d"); 
if($_POST){
       $resp=$_POST['nombre'];
       $motivo=$_POST['tipo'];
       $emp=$_POST['emp'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $sql="SELECT * FROM autos where nombre_completo like '%$resp%' and pago like '%$motivo%' and sucursal like '%$emp%' and (fecha between '$fecha1' and '$fecha2') order by fecha desc;";
   }
   else{
       $fecha2 = $hoy;
       $fecha1 = $hoy;     
       $sql="SELECT * FROM autos;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Autos/AutosListar.php",data:s
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
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Listado de Autos</label>
            </div>
            <a href="<?php echo $_SESSION['hpd']; ?>/lib/tocsv.php" ><img src="../../img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td>
                            <label><b>Nombre:</b></label><input value="" type="text" name="nombre" size="40" onchange="recarga()"><br>
                        </td>
                        <td colspan="3">
                            <label>Forma de pago</label><br>
                            <input type="radio" name="tipo" value="Quincena" onclick="recarga()">Quincena&nbsp; <input type="radio" name="tipo" value="Semana" onclick="recarga()" >Semana
                        </td>                    
                        <td colspan="5">
                            <b>Del:</b><input class="" style="line-height: 12px;max-width: 138px;" type="date" name="fecha1" value="<?php echo $fecha1; ?>" onchange="recarga();">
                            &nbsp;<b>Al:</b><input class="" style="line-height: 12px;max-width: 138px;" type="date" name="fecha2" value="<?php echo $fecha2; ?>" onchange="recarga();"><br>
                            <label><b>Sucursal:</b> 
                                <select  name="sucursal" onchange="recarga()">
                                    <option  value = "" >Seleccione...</option>
                                    <?php
                                    $result= consulta("SELECT nombre,id_sucursal FROM sucursal ORDER BY nombre ASC");
                                    foreach ($result as  $depto) {
                                        ?>
                                    <option  value = "<?php echo $depto['nombre']; ?>"><?php echo $depto['nombre']; ?></option>
                                        <?php 
                                    } ?>
                                </select>
                            </label>
                        </td>
                                                            
                    </tr>        
                    <tr> 
                        <td><b>Chofer</b></td>
                        <td><b>Placas</b></td>
                        <td><b>Kilometraje</b></td>
                        <td><b>Empresa</b></td>
                        <td><b>Ultima reparación</b></td>
                        <td><b>Proxima reparación</b></td>
                        <td><b>Salida a comer</b></td>
                        <td><b>Regreso de comida</b></td>
                        <td><b>Status</b></td>
                    </tr>
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                        $nombre=  utf8_encode($row["nombre_completo"]);
                        echo "<tr class='tr_con'><td>".$nombre."</td>";
                        echo "<td>" .$row["pago"]."</td>";
                        echo "<td ALIGN=CENTER>".$row["sucursal"]."</td>";
                        echo "<td>".$row["fecha"]."</td>";
                        echo "<td >".$row["dia_sem"]."</td>";
                        echo "<td ALIGN=CENTER>" .$row["entrada"]. "</td>";
                        echo "<td ALIGN=CENTER>" .$row["ir_com"]. "</td>";
                        echo "<td ALIGN=CENTER>" .$row["reg_com"]. "</td>";
                        echo "<td ALIGN=CENTER>" .$row["salida"]. "</td></tr>";
                        $numero++;
                     }
                    ?>
          </table>
          </form>
          <br>
</div>