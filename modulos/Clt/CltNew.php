<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$rfc ='N/C';
$des = '0';
if ($_POST['nombre']){
    $nombre=$_POST['nombre'];
    $dir=$_POST['dir'];
    $tel=$_POST['tel'];
    $cel = $_POST['cel'];
    $des = $_POST['des'];
    if($nombre==''){
        echo '<div class="alert alert-info"><strong>¡Upss!</strong>Favor de llenar Nombre</div>';
    }
    elseif($dir==''){
        echo '<div class="alert alert-info"><strong>¡Upss!</strong>Favor de llenar Dirección</div>';
    }
    elseif($tel==''){
        echo '<div class="alert alert-info"><strong>¡Upss!</strong>Favor de llenar Telefono</div>';
    }
    elseif($cel==''){
        echo '<div class="alert alert-info"><strong>¡Upss!</strong>Favor de llenar Celular</div>';
    }
    elseif($des==''){
        $des='0';
    }
    else{
        $sql="INSERT INTO clientes2 VALUES(0,'$nombre','$dir','$tel','$rfc',$des,'$cel');";
        insert($sql);
        $sql2="SELECT max(idclt) as u FROM clientes2 limit 1";
        $f=  consulta($sql2);
        echo '<div class="alert alert-info"><strong>¡Bien!</strong>Guardado</div>';  
    }
}
else{
?>
<script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Clt/CltNew.php",data:s
        }).done(function (datos){
            $("#mensajes").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Clt/Clientes.php?n=nuevo');"></span>Nuevo Cliente</label>
</div>
    <div class="panel-body">
        <form id="data">
            <div class="col-sm-12">
                <input type="button" class="btn btn-danger navbar-right" value="Cancelar" onclick="$('#pant').load('modulos/Clt/Clientes.php?n=nuevo');">
                <input type="button" class="btn btn-success navbar-right" value="Guardar" onclick="actualiza();">
                <div id="mensajes" class="navbar-left"></div>
            </div>
            <div class="col-xs-6">
                <label>Nombre:</label><input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>">
                <label>Dirección:</label><input type="text" class="form-control" name="dir"  value="<?php echo $dir;?>">
                <label>Telefono:</label><input type="text" class="form-control" name="tel" value="<?php echo $tel;?>">
            </div>
            <div class="col-xs-6">
                <label>Celular:</label><input type="number" class="form-control" name="cel" value="<?php echo $cel;?>">
                <label>Descuento:</label><input type="number" class="form-control" name="des" value="<?php echo $des;?>">
            </div>                    
        </form>          
    </div>
<?php }