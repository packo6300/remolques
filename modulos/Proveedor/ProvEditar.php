<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if ($_POST['id']){
    $idp=$_POST['id'];
    $sql="select * from proveedores where idProveedores=$idp";
    $res=consulta($sql);
    foreach ($res as  $row) {
        $nombre=$row['nombre_prov'];
        $dir=$row['direccion'];        
        $tel = $row['telefono'];
    }
     ?>
    <script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Proveedor/ProvEditar.php",data:s,
            beforeSend: function(){
               $("#mensajes").html("<img src='img/loading.gif' style='width: 25px; margin-left: 8px; margin-top: 3px;' >");      
            },
            //una vez finalizado correctamente
            success: function(data){
                $("#mensajes").html(data);
            },
            //si ha ocurrido un error
            error: function(){
                $("#mensajes").html('<div class="alert alert-danger"><strong>¡Error!</strong>Intentar de nuevo</div>');
            }
        });
    }
    catch(err){
        console.error(err);
    }
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Proveedor/ProvListar.php');"></span>Editar Proveedor</label>
</div>
    <div class="panel-body">
        <form id="data">
            <label>Nombre:</label><input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>">
            <label>Dirección:</label><input type="text" class="form-control" name="dir"  value="<?php echo $dir;?>">
            <label>Telefono:</label><input type="number" class="form-control" name="tel" value="<?php echo $tel;?>">
            <input type="hidden" name="idp2" value="<?php echo $idp;?>">
            <br>
            <input type="button" class="btn btn-success" value="Guardar cambios" onclick="actualiza();">            
        </form><br>
        <div id="mensajes">
            
        </div>
    </div>
<?php 
}
elseif ($_POST['idp2']){
     $tel=$_POST['tel'];
     $nombre=$_POST['nombre'];
     $dir=$_POST['dir'];        
     $idp3=$_POST['idp2'];
     
    $sql="update proveedores set nombre_prov='$nombre',direccion='$dir',telefono='$tel' where idProveedores=$idp3;";
    insert($sql);
    echo '<div class="alert alert-success"><strong>¡Actualizado!</strong></div>';
}
else{
?>

<?php }