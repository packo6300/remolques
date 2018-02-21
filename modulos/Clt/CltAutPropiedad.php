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
        $marca=$_POST['marca'];
        $modelo=$_POST['modelo'];        
        $color = $_POST['color'];
        $placa = $_POST['placa'];
        $estado= $_POST['estado'];
        //////////////////////
        if($idpar=="new"){
            $sql="insert into cltauto values(0,$idclt,'$marca','$modelo','$color','$placa','$estado');";
            insert($sql);
            echo '<div class="alert alert-success"><strong>¡Bien!</strong>Auto Asignado</div>'; 
        }
        else{
            $sql="update cltauto set estado='$estado',marca='$marca',modelo='$modelo',color='$color',placa='$placa' where idcltauto=$idpar";
            insert($sql);
            echo '<div class="alert alert-success"><strong>¡Bien!</strong>Cambios Guardados</div>';  
        }
}
else{
$idref=$_POST['idaut'];
    if($idref>0){
       $_SESSION['']=$idref;
       $pgn="Editar automovil";
       $edit="readonly='' ";
       $sql="select * from cltauto where idcltauto=$idref";
       $res=consulta($sql);
        foreach ($res as  $row) {
            $estado= $row['estado'];
            $marca=$row['marca'];
            $modelo=$row['modelo'];        
            $color = $row['color'];
            $placa = $row['placa'];
            $idclt= $row['idclt'];
        } 
    }
    else{
        $idref="new";
        $pgn="Nuevo automovil";
        $edit="";
    }
   
    
     ?>
    <script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Clt/CltAutPropiedad.php",data:s,
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
                <label>Marca</label><input type="text" class="form-control" name="marca" value="<?php echo $marca;?>">
                <label>Modelo</label><input type="text" class="form-control" name="modelo"  value="<?php echo $modelo;?>">
                <label>Color</label><input type="text" class="form-control" name="color" value="<?php echo $color;?>">
                <label>Placa</label><input type="text" class="form-control" name="placa"  value="<?php echo $placa;?>">
                <label>Estado</label><input type="text" class="form-control" name="estado"  value="<?php echo $estado;?>">
                <input type="hidden" name="idpar" value="<?php echo $idref;?>">                
                <input type="hidden" name="idclt" value="<?php echo $idclt;?>">
            </div>        
        </form>
    </div>
<?php    
}