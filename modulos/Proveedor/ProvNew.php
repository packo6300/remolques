<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
$empresa=$_SESSION['rfc'];
include ($root."/lib/mysql/mysql.php");
if ($_POST){
    $nombre=$_POST['nombre'];
    $direccion=$_POST['d'];
    $tel = $_POST['tel'];
    
    if($nombre==''){
        echo '<div class="alert alert-danger"><strong>¡Faltan datos!</strong> Nombre</div>';
    }
    elseif($tel==''){
        echo '<div class="alert alert-danger"><strong>¡Faltan datos!</strong> Telefono</div>';
    }
    else{
        $sql1="select nombre_prov from proveedores where nombre_prov='$nombre' limit 1;";
        $t=consulta($sql1);
        foreach ($t as  $r) {
          $exit= $r['nombre_prov']; 
        }
        if($exit==""){
        $sql2="insert into kardex VALUES(0,".$_SESSION['idCH'].",'Alta de empleado: $nemp',curdate(),curtime());";
        //insert($sql2);
        $sql="INSERT INTO Proveedores VALUES(0,'$nombre','$direccion','$tel');";
        insert($sql);
        echo '<div class="alert alert-success"><strong>¡Guardado!</strong></div>';
        }
        else{
            echo '<div class="alert alert-danger"><strong>¡Ya Existe!</strong>Proveedor '.$exit.'</div>';
        }
    }
}
else{
?>
<script type="text/javascript">
function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({
            type: 'POST',
            url:"modulos/Proveedor/ProvNew.php",
            data:s,
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
function regresar(){
    $("#pant").html("<center><br><br><br><br><label>Cargando por favor espere...</label><br><img style='width: 100px;' src='img/loading.gif'></center>");
 $( "#pant" ).load( "modulos/Proveedor/ProvListar.php", function( response, status, xhr ) {
  if ( status == "error" ) {
    var msg = "Sorry but there was an error: ";
    $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
  }
});
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="regresar()"></span>Nuevo Proveedor</label>
</div>
    <div class="panel-body">
        <form id="data" >
          <div class="col-lg-6">
            <label>Nombre:</label><input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>">
            <label>Dirección:</label><input type="text" class="form-control" name="d"  value="<?php echo $direccion;?>">
            <label>Telefono:</label><input type="number" class="form-control" name="tel" value="<?php echo $tel;?>">
            <br>
            <input type="button" class="btn btn-success" value="Guardar" onclick="actualiza();">
            <input type="button" class="btn btn-danger" value="Cancelar" onclick="regresar();">
            <div id="mensajes"></div>
          </div>
        </form>
    </div>
    </div>
<?php }