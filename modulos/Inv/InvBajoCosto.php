<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
$hoy = date("Y-m-d");
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="INVENTARIO_BAJO_".$hoy;
$_SESSION['tbl']="bajosext"; 

$idUsr=$_SESSION['idCH'];
 
if($_POST){
       $nemp=$_POST['tel'];
       $des=$_POST['des'];
       $sql="SELECT * FROM bajosextcosto where clave like '$nemp%' and descr like '$des%' order by descr limit 200;";
   }
   else{
       $sql="SELECT * FROM bajosextcosto order by descr;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Inv/InvBajoCosto.php",data:s
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
function excel(){
     try{
        location.href="lib/tocsv.php";
    }
    catch(err){
        console.error(err);
    }   
}
function peticion(){
window.open("dom/listaPDF.php?url=Inv/BajosPDFcosto.php");
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Reporte De Costo De Inventario</label>
            </div>
            <button class="btn btn-info" onclick="peticion()"><span class="glyphicon glyphicon-print"></span></button>
            <button class="btn btn-success" src="img/IconExcel.gif" onclick="excel();"><span class="glyphicon glyphicon-export"></span></button>
            
            <label>Costo Total:</label>
            <input type="text" id="totalC" readonly="">
            <label>Números De Parte:</label>
            <input type="text" id="totalA" readonly="">
            <label>Ganancia Total:</label>
            <input type="text" id="totalU" readonly="">
            <form id="manual">
                <table id="tbl_info" class="table table-condensed table-responsive">
                    <tr class="table table-hover">
                        <td>
                            <label><b>Clave:</b></label><br>
                            <input value="<?php echo $nemp; ?>" type="text" name="tel" onchange="recarga()"></td>
                        <td>
                            <label><b>Descripción:</b></label><br>
                            <input value="<?php echo $des; ?>" type="text" name="des" onchange="recarga()"></td>
                        <td>
                            <label><b>GxU:</b></label><br>
                        </td>
                        <td>
                            <label><b>GxT:</b></label><br>
                        </td>
                        <td>
                            <label><b>Existencia:</b></label><br>
                        </td>
                        <td>
                            <label>Costo:</label><br>
                        </td>   
                        <td>
                            <label>Costo Total:</label><br>
                        </td>
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $d = 0;
                    $at=0;
                    $aU=0;
                    foreach ($resul as  $row) {
                        $at++;
                        ?>
                        <tr class='tr_con'>
                        <?php
                        echo "<td>" .$row["clave"]."</td>";
                        echo "<td>".utf8_encode($row["descr"])."</td>";
                        $a=$row['precio']-$row['costo'];
                        echo "<td>".$a."</td>";
                        $b=$a*$row["cantidad"];
                        $aU=$aU+$b;
                        echo "<td>".$b."</td>";
                        echo "<td>".$row["cantidad"]."</td>";
                        echo "<td>".$row["costo"]."</td>";
                        $d=$row['cantidad'] * $row['costo'];
                        $ds=$ds+$d;
                        echo "<td>".$d."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
                     
          </table>
                <script>
                    $("#totalC").val('<?php echo $ds; ?>');
                    $("#totalA").val('<?php echo $at; ?>');
                    $("#totalU").val('<?php echo $aU; ?>');
                </script>
            </form>
          <br>
</div>