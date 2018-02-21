<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if($_POST['ida']){
    $idUsr=$_POST['ida'];
    $sql="SELECT nombre,usuario FROM administrador  WHERE id=$idUsr";
    $rr=  consulta($sql);
   foreach ($rr as  $r) {
        $nombre=$r['nombre'];
        $us=$r['usuario'];
    }
    ?>
<script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Config/UsrModificar.php",data:s
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
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Config/UsuariosListar.php');"></span>Modificar Administrador</label>
</div>
    <div class="panel-body">
        <form id="data">
            <label>Usuario:</label><input readonly="" type="text" class="form-control" name="usr" value="<?php echo $us;?>">
            <label>Nombre:</label><input type="text" class="form-control" name="nombre"  value="<?php echo $nombre;?>">
            <label>Contraseña:</label><input type="password" class="form-control" name="pass1" value="<?php echo $pass;?>">
            <label>Repetir contraseña:</label><input type="password" class="form-control" name="pass2" value="<?php echo $pass;?>">
            <input type="hidden" name="id2" value="<?php echo $idUsr;?>"><br>
            <input type="button" class="btn btn-success" value="Guardar cambios" onclick="actualiza();">            
        </form><br>
        <div id="mensajes">
            
        </div>
    </div>
<?php 
}
elseif ($_POST['id2']){
    $nombre=$_POST['nombre'];
    if($_POST['pass1']!=''){
        $pass1=  md5($_POST['pass1']);
    }
    $pass2=  md5($_POST['pass2']);
    $usr=$_POST['id2'];
    if($nombre==''){
      echo 'Favor de llenar campo nombre';
    }
    if($nombre!=''){
        $sql="UPDATE administrador SET nombre='$nombre' where id=$usr;";
            insert($sql);
            echo 'Nombre actualizado';
    }
    if($pass1!=null){
        if($pass1==$pass2){            
            $sql="UPDATE administrador  SET Clave='$pass1' where id=$usr;";
            insert($sql);
            echo 'Contraseña actualizada';
        }
        else {
            echo 'Contraseñas diferentes';
        }
    }    
}