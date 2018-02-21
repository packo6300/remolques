<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");

if ($_POST['nombre']){
    $nombre=$_POST['nombre'];
    $desc=$_POST['desc'];
    $dura=$_POST['dura'];
    $medi=$_POST['medi'];
    
    if($nombre==''){
        echo 'Favor de llenar campo nombre';
    }
    elseif($desc=='') {
        echo 'Favor de llenar campo descripción';
    }
    elseif($dura=='') {
        echo 'Favor de llenar campo duración';
    }
    elseif($medi=='') {
        echo 'Favor de llenar campo medida';
    }
    else{
        $sql=" insert into contratos values(0,'$nombre','$desc',$dura,'$medi');";
        insert($sql);
        echo 'guardado';    
    }    
}
else{
?>
<script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/ContratoNew.php",data:s
        }).done(function (datos){
            $("#mensajes").html();
            $("#mensajes").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Config/UsuariosListar.php');"></span>Nuevo Contrato</label>
</div>
    <div class="panel-body">
        <form id="data">
            <label>Nombre de contrato:</label><input type="text" class="form-control" name="nombre" value="<?php echo $us;?>">
            <label>Descripción:</label><input type="text" class="form-control" name="desc"  value="<?php echo $nombre;?>">
            <label>Duracion:</label><input type="number" class="form-control" name="dura" value="<?php echo $pass;?>">
            <label>Medida:</label>
            <select name="medi" class="form-control"> 
                 <option  value = "DAY" >Días</option>
                  <option  value = "MONTH" >Meses</option>
                   <option  value = "YEAR" >Años</option>
            </select><BR>   
            <input type="button" class="btn btn-success" value="Guardar" onclick="actualiza();">            
        </form><br>
        <div id="mensajes">
            
        </div>
    </div>
<?php }