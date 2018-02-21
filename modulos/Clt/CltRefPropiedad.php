<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$idclt =$_SESSION['clt'];
if ($_POST['idpar']){
        $idpar=$_POST['idpar'];
        //////////////////////
        $nombre=$_POST['nombre'];
        $pare=$_POST['pare'];        
        $tel = $_POST['tel'];
        $dir = $_POST['dir'];
        $empresa = $_POST['empresa'];
        $trabdir = $_POST['trabdir'];
        //////////////////////
        if($idpar=="new"){
            $sql="insert into cltrefe values(0,$idclt,'$nombre','$pare','$tel','$empresa','$dir','$trabdir');";
            insert($sql);
            echo 'Referencia creada'; 
        }
        else{
            $sql="update cltrefe set nombre='$nombre',parentesco='$pare',tel='$tel',empresa='$empresa',dir='$dir',trabdir='$trabdir' where idcltrefe=$idpar";
            insert($sql);
            echo 'Cambios guardados';  
        }
}
else{
$idref=$_POST['idclt'];
    if($idref>0){
       $pgn="Editar referencia";
       $edit="readonly='' ";
       $sql="select * from cltrefe where idcltrefe=$idref";
       $res=consulta($sql);
        foreach ($res as  $row) {
            $nombre=$row['nombre'];
            $pare=$row['parentesco'];        
            $tel = $row['tel'];
            $dir = $row['dir'];
            $empresa = $row['empresa'];            
            $trabdir = $row['trabdir'];
            $idclt= $row['idclt'];
        } 
    }
    else{
        $idref="new";
        $pgn="Nueva referencia";
        $edit="";
    }
   
    
     ?>
    <script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Clt/CltRefPropiedad.php",data:s,
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
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Clt/Clientes.php?doc=<?php echo $idclt;?>&v=nuevo');"></span><?php echo $pgn;?></label>
</div>
    <div class="panel-body">
        <form id="data">
            <div class="col-sm-12">
                <input type="button" class="btn btn-danger navbar-right" value="Cancelar" onclick="$('#pant').load('modulos/Clt/Clientes.php?doc=<?php echo $idclt;?>&v=nuevo');">
                <input type="button" class="btn btn-success navbar-right" value="Guardar" onclick="actualiza();">
                <div id="mensajes" class="navbar-left"></div>
            </div>
            <div class="col-xs-12">
                <label>Nombre:</label><input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>">
                <label>Parentesco:</label><input type="text" class="form-control" name="pare"  value="<?php echo $pare;?>">
                <label>Telefono:</label><input type="number" class="form-control" <?php echo $edit; ?> name="tel" value="<?php echo $tel;?>">
                <label>Dirección:</label><input type="text" class="form-control" name="dir"  value="<?php echo $dir;?>">
                <label>Empresa:</label><input type="text" class="form-control" name="empresa" value="<?php echo $empresa;?>">
                <label>Dirección empresa:</label><input type="text" class="form-control" name="trabdir" value="<?php echo $trabdir;?>">
                <input type="hidden" name="idpar" value="<?php echo $idref;?>">
                <input type="hidden" name="idclt" value="<?php echo $idclt;?>">
            </div>
        </form><br>
    </div>
<?php    
}