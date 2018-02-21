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
       $sql="SELECT * FROM bajosext where clave like '$nemp%' and descr like '$des%' order by descr limit 200;";
   }
   else{
       $sql="SELECT * FROM bajosext order by descr;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Inv/InvBajo.php",data:s
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
window.open("dom/listaPDF.php?url=Inv/BajosPDF.php");
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Reporte de inventario con nivel bajo</label>
            </div>
            <button class="btn btn-info" onclick="peticion()"><span class="glyphicon glyphicon-print"></span></button>
            <button class="btn btn-success" src="img/IconExcel.gif" onclick="excel();"><span class="glyphicon glyphicon-export"></span></button>
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
                            <label><b>Existencia:</b></label><br>
                        </td>
                        <td>
                            <label>Minimo:</label><br>
                        </td>         
                    </tr>        
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    $numero = 0;
                    foreach ($resul as  $row) {
                        $nombre=  utf8_encode($row["nombre"]);
                        ?>
                        <tr class='tr_con'>
                        <?php
                        echo "<td>" .$row["clave"]."</td>";
                        echo "<td>".$row["descr"]."</td>";
                        echo "<td>".$row["cantidad"]."</td>";
                        echo "<td>".$row["minimo"]."</td>";
                        ?>
                        </tr>
                        <?php
                       }
                    ?>
          </table>
            </form>
          <br>
</div>