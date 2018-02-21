<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if ($_POST['idclt']){
    $idclt=$_POST['idclt'];
    $sql="select * from clientes2 where idclt=$idclt";
    $res=consulta($sql);
    foreach ($res as  $row) {
        $nombre=$row['nombre'];
        $dir=$row['direccion'];        
        $cel = $row['celular'];
        $rfc = $row['rfc'];
        $des = $row['descuento'];
        $tel = $row['telefono'];
    }
     ?>
    <script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Clt/CltEditar.php",data:s,
        beforeSend: function(){
               $("#mensajes").html("<img src='img/loading.gif' style='width: 25px; margin-left: 8px; margin-top: 3px;' >");      
            },
            //una vez finalizado correctamente
            success: function(data){
                $("#mensajes").html(data);
            },
            //si ha ocurrido un error
            error: function(er){
                $("#mensajes").html('<div class="alert alert-danger"><strong>¡Error!</strong></div>');
            }
        });
    }
    catch(err){
        console.error(err);
    }
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Clt/Clientes.php');"></span>Editar Cliente</label>
</div>
    <div class="panel-body">
        <form id="data">
            <div class="col-sm-12">
                <input type="hidden" name="tel2" value="<?php echo $idclt;?>">
                <input type="button" class="btn btn-danger navbar-right" value="Cancelar" onclick="$('#pant').load('modulos/Clt/Clientes.php');">
                <input type="button" class="btn btn-success navbar-right" value="Guardar" onclick="actualiza();">
                <div id="mensajes" class="navbar-left"></div>
            </div>
            <div class="col-xs-6">
                <label>Nombre:</label><input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>">
                <label>Dirección:</label><input type="text" class="form-control" name="dir"  value="<?php echo $dir;?>">
                <label>Telefono:</label><input type="text" class="form-control"  name="tel" value="<?php echo $tel;?>">
            </div>
            <div class="col-xs-6">
                <label>Celular:</label><input type="number" class="form-control" name="cel" value="<?php echo $cel;?>">
                <label>Comentarios:</label><input type="text" class="form-control" name="rfc" value="<?php echo $rfc;?>">
                <label>Descuento:</label><input type="number" class="form-control" name="des" value="<?php echo $des;?>">
            </div>         
        </form>
    </div>
<?php 
}
elseif ($_POST['tel2']){
     $tel=$_POST['tel'];
     $nombre=$_POST['nombre'];
     $dir=$_POST['dir'];        
     $cel = $_POST['cel'];
     $rfc = $_POST['rfc'];
     $des = $_POST['des'];
     $sql="update clientes2 set nombre='$nombre',direccion='$dir',RFC='$rfc',descuento=$des,celular='$cel' where telefono='$tel'";
    insert($sql);
    echo 'Datos guardados';
}
else{
    header("HTTP/1.0 404 Not Found");
}