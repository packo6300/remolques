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
       $emp=$_POST['sucursal'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $sql="SELECT * FROM contratos where nombre like '%$resp%' order by nombre;";
   }
   else{
       $sql="SELECT * FROM contratos order by nombre;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/ContratosListar.php",data:s
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
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/ContratoNew.php",data:s
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
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left" ></span>Asistencia General</label>
            </div>
            <a href="<?php echo $_SESSION['hpd']; ?>/lib/tocsv.php" ><img src="../../img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td ><span class="glyphicon glyphicon-plus-sign" style="top: 7px;left: 11px;" onclick="nvo()"></span></td> 
                        <td colspan="5">
                            <label><b>Tipo:</b></label><input value="<?php echo $resp; ?>" type="text" name="nombre" size="40" onchange="recarga()"><br>
                        </td>                                    
                    </tr>        
                    <tr> 
                        <td><b>Tipo</b></td>
                        <td><b>Descripción</b></td>
                        <td><b>Duración</b></td>
                    </tr>
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                
                    foreach ($resul as  $row) {
                        $nombre=  utf8_encode($row["nombre"]);
                        echo "<tr class='tr_con'><td>".$nombre."</td>";
                        echo "<td>" .$row["descripcion"]."</td>";
                        $s=$row['medida'];
                        switch ($s) {
                            case 'DAY':
                                $s='Días';
                                break;
                            case 'MONTH':
                                $s='Meses';
                                break;
                            case 'YEAR':
                                $s='Años';
                                break;
                        }
                        echo "<td>" .$row["duracion"]."  ".$s. "</td></tr>";
                        
                     }
                    ?>
          </table>
            </form>
          <br>
</div>
