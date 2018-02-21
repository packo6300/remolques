<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$_SESSION['pg']="existencia";
$_SESSION['tbl']="existencia"; 

$idUsr=$_SESSION['idCH'];

$hoy = date("Y-m-d"); 
if($_POST){
       $nemp=$_POST['tel'];
       $des=$_POST['des'];
       $sql="SELECT * FROM existview where cve like '$nemp%' and descripcion like '$des%';";
   }
   else{
       $sql="SELECT * FROM existview order by cve;";
   }
    
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Inv/InvListar.php",data:s
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
        $.ajax({type: 'POST',url:"modulos/Clt/CltEditar.php",data:{tel:id}
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
        $("#pant").load("modulos/Clt/CltNew.php");
    }
    catch(err){
        console.error(err);
    }
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Existencias</label>
            </div>
            <a href="<?php echo $_SESSION['hpd']; ?>/lib/tocsv.php" ><img src="../../img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
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
                        echo "<td>" .$row["cve"]."</td>";
                        echo "<td>".$row["descripcion"]."</td>";
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