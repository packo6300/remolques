<?php
if(!isset($_SESSION)){session_start();}
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if(isset($_POST['idrem'])){
        $idpar=$_POST['idrem'];
        //////////////////////
            $rentas=$_POST['rentas'];
            $tipo=$_POST['tipo'];
            $estr=$_POST['estructura'];        
            $rampas= $_POST['rampas'];
            $luces = $_POST['luces'];
            $conector = $_POST['conector'];            
            $gato = $_POST['gato'];
            $eje = $_POST['eje'];
            $extra= $_POST['extra'];
            $placa= $_POST['placa'];
            $valor= $_POST['valor'];
            $status= $_POST['status'];
        //////////////////////
        if($idpar=="new"){
            $sql="insert into remolques values(0,'$tipo','$estr','$rampas','$luces','$conector','$gato','$eje','$extra','$placa','$valor',1);";
            insert($sql);
            echo '<div class="alert alert-success"><strong>¡Bien!</strong>Remolque Creado</div>'; 
        }
        else{
            $sql="update remolques set tipo='$tipo',estructura='$estr',rampas='$rampas',luces='$luces',conector='$conector',gato='$gato',eje='$eje',extra='$extra',placa='$placa',valor=$valor,stat=$status where idrem=$idpar";
            insert($sql);
            echo '<div class="alert alert-success"><strong>¡Bien!</strong>Datos actualizados</div>';  
        }
}
else{
$idrem=$_POST['idclt'];
$edit="";
    if($idrem>0){
       $pgn="Editar remolque";
       $sql="select * from remolques where idrem=$idrem";
       $res=consulta($sql);
        foreach ($res as  $row) {
            $rentas=$row['rentas'];
            $tipo=$row['tipo'];
            $estr=$row['estructura'];        
            $rampas= $row['rampas'];
            $luces = $row['luces'];
            $conector = $row['conector'];            
            $gato = $row['gato'];
            $eje = $row['eje'];
            $extra= $row['extra'];
            $placa= $row['placa'];
            $valor= $row['valor'];
            $status= $row['stat'];
        } 
    }
    else{
        $idrem="new";
        $pgn="Nuevo remolque";
        $edit="readonly=''";
        $status="1";
    }
   
    
     ?>
    <script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Remolque/RemPropiedad.php",data:s,
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
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Remolque/Rem.php');"></span><?php echo $pgn;?></label>
</div>
    <div class="panel-body">
        <form id="data">
            <div class="col-sm-12">
                <input type="hidden" name="mov" value="new">
                <input type="button" class="btn btn-danger navbar-right" value="Cancelar" onclick="$('#pant').load('modulos/Remolque/Rem.php');">
                <input type="button" class="btn btn-success navbar-right" value="Guardar" onclick="actualiza();">
                <div id="mensajes" class="navbar-left"></div>
            </div>
            <div class="col-xs-6">
                <label>Tipo:</label><input type="text" class="form-control" name="tipo" value="<?php echo $tipo;?>">
                <label>Estructura:</label><input type="text" class="form-control" name="estructura"  value="<?php echo $estr;?>">
                <label>Rampas:</label><input type="text" class="form-control" name="rampas" value="<?php echo $rampas;?>">
                <label>Luces:</label><input type="text" class="form-control" name="luces"  value="<?php echo $luces;?>">
                <label>Conector:</label><input type="text" class="form-control" name="conector" value="<?php echo $conector;?>">
                <label>Gato:</label><input type="text" class="form-control" name="gato" value="<?php echo $gato;?>">
            </div>
            <div class="col-xs-6">
                <label>Rentas:</label><input type="number" class="form-control" name="rentas" value="<?php echo $rentas; ?>">
                <label>Llantas:</label><input type="text" class="form-control" name="eje" value="<?php echo $eje;?>">
                <label>Extra:</label><input type="text" class="form-control" name="extra" value="<?php echo $extra;?>">
                <label>Placa:</label><input type="text" class="form-control" name="placa" value="<?php echo $placa;?>">
                <label>Valor:</label><input type="number" class="form-control" name="valor" value="<?php echo $valor;?>">
                <label>Estatus:</label>
                <select class="form-control" <?php echo $edit ?> hidden="" name="status">
                    <?php 
                    $sql2="select * from statuss;";
                    $seleccionado="";
                    $r = consulta($sql2);
                    foreach ($r as  $r2) {
                        $nombre=$r2['nombre'];
                        $idsts=$r2['idstatus'];
                        $seleccionado="";
                        if($idsts==$status){$seleccionado="selected";}                    
                        echo '<option value="'.$idsts.'"  '.$seleccionado.'>'.$nombre.'</option>';
                    }
                    ?>

                </select>
                <input type="hidden" name="idrem" value="<?php echo $idrem;?>">
            </div>           
        </form>
    </div>
<?php    
}