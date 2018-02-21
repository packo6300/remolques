<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if ($_POST['usr']){
    $usr=$_POST['usr'];
    $nombre=$_POST['nombre'];
    if($nombre==''){
        echo 'Favor de llenar campo nombre';
    }
    else{
        if($_POST['pass1']!=''){
            $pass1=  md5($_POST['pass1']);
        }
        $pass2=  md5($_POST['pass2']);
        if($pass1==$pass2){
           $sql=" insert into administrador values('$pass1',0,'$usr','$nombre');";
           insert($sql);
          echo 'guardado';    
        }
        else{
            echo 'contraseñas diferentes';
        }
    }    
}
else{
?>
<script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Config/UsrNew.php",data:s
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
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Config/UsuariosListar.php');"></span>Nuevo Administrador</label>
</div>
    <div class="panel-body">
        <form id="data">
            <label>Usuario:</label><input type="text" class="form-control" name="usr" value="<?php echo $us;?>">
            <label>Nombre:</label><input type="text" class="form-control" name="nombre"  value="<?php echo $nombre;?>">
            <label>Contraseña:</label><input type="password" class="form-control" name="pass1" value="<?php echo $pass;?>">
            <label>Repetir contraseña:</label><input type="password" class="form-control" name="pass2" value="<?php echo $pass;?>">
            <input type="button" class="btn btn-success" value="Guardar cambios" onclick="actualiza();">            
        </form><br>
        <div id="mensajes">
            
        </div>
    </div>
<?php }