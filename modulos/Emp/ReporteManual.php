<?php
header('Content-Type: text/html; charset=UTF-8');
if(!isset($_SESSION)){ 
    session_start(); 
}
$hoy = date("Y-m-d"); 
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if($_POST){
       $resp=$_POST['resp'];
       $motivo=$_POST['motivo'];
       $emp=$_POST['emp'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $sql2="SELECT * FROM reg_ent_manual where responsable like '%$resp%' and motivo like '%$motivo%' and empleado like '%$emp%' and (fecha between '$fecha1' and '$fecha2') order by fecha desc;";
   }
   else{
       $fecha2 = $hoy;
       $fecha1 = $hoy;     
       $sql2="SELECT * FROM reg_ent_manual where fecha=curdate() order by fecha desc;";
   }
?>
<script type="text/javascript">
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/ReporteManual.php",data:s
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
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span> Registro de entrada manual</label>
            </div>
            <br>
                <form id="manual">
                   <table id="tbl_info" class="table table-striped">
                       <tr  class="table-hover" >
                       <td><label>Folio</label></td>
                       <td><label>Fecha</label><br>
                           <input class="" style="line-height: 12px;max-width: 138px;" type="date" name="fecha1" value="<?php echo $fecha1; ?>" onchange="recarga();"><br>
                           <input class="" style="line-height: 12px;max-width: 138px;" type="date" name="fecha2" value="<?php echo $fecha2; ?>" onchange="recarga();">
                       </td>
                       <td><label>Hora</label></td>
                       <td><label>Responsable</label><br><input class="form-control" type="text" style="width: 101px;max-width: 86px;" value="<?php echo $resp; ?>" name="resp" onchange="recarga();"></td>
                       <td><label>Motivo</label><br><input class="form-control" style="width: 101px;" type="text" name="motivo" value="<?php echo $motivo; ?>" onchange="recarga();"></td>
                       <td><label>Empleado</label><br><input class="form-control" style="width: 101px;" type="text" name="emp" value="<?php echo $emp; ?>" onchange="recarga();"></td>
                   </tr>
                   <?php
                   
                   $r=  consulta($sql2);
                   foreach ($r as  $e) {
                   ?>
                   <tr style="border-style: solid; border-width: 1px;">
                       
                       <td style="margin-right: 2px;margin-left: 2px;"><?php echo $e['folio']; ?></td>
                       <td style="margin-right: 2px;margin-left: 2px;"><?php echo $e['fecha']; ?></td>
                       <td style="margin-right: 2px;margin-left: 2px;"><?php echo $e['hora']; ?></td>
                       <td style="margin-right: 2px;margin-left: 2px;"><?php echo $e['responsable']; ?></td>
                       <td style="margin-right: 2px;margin-left: 2px;max-width: 350px;"><?php echo $e['motivo']; ?></td>
                       <td style="margin-right: 2px;margin-left: 2px;"><?php echo utf8_encode($e['empleado']); ?></td>
                       
                   </tr>
                   <?php 
                    }
                   ?>
               </table>
                    
               </form>           
</div>  