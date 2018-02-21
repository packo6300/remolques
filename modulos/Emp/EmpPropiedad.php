<?php

ini_set('error_reporting', 0);
if(!isset($_SESSION)){ 
    session_start(); 
}
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if($_POST['ida']){
    $idUsr=$_POST['ida'];
    $sql="SELECT * FROM productoslistar where idprod = $idUsr;";
    $rr=  consulta($sql);
    foreach ($rr as  $r) {
        $cve=$r['cve_producto'];
        $desc=$r['descripcion'];
        $pp=$r['costo_pub'];
        $ut = $r['utilidad'];
        $c1 = $r['costosiva'];
        $ext=$r['ext'];
        $mini=$r['minimo'];
    }
    $sql2="SELECT * FROM iva limit 1;";
    $r2=  consulta($sql2);
    foreach ($r2 as  $r) {
        $iva=$r['iva'];
    }
    $c2=$c1*$iva;
    $pp=$c2*(1+($ut/100));
    ?>
<script type="text/javascript">
    
    function actualiza(){
    try{
         var s=$("#data").serialize();
         $.ajax({type: 'POST',url:"modulos/Emp/EmpPropiedad.php",data:s
         }).done(function (datos){
             $("#mensajes").html(datos);
         });
     }
     catch(err){
         console.error(err);
     }
    }
    function upfoto(){
    try{
         var s=$("#img").serialize();
         $.ajax({type: 'POST',url:"modulos/Emp/idup.php",data:s
         }).done(function (datos){
             $("#mensajes").html(datos);
         });
     }
     catch(err){
         console.error(err);
     }        
    }
    function calcula(){
        var c=$("input[name='c1']").val();
        var iva='<?php echo $iva; ?>';
        var c2=c*iva;
        c2=c2.toFixed(2);
        $("input[name='c2']").val(c2);
        var u=$("input[name='ut']").val();
        var pp=c2*(1+(u/100));
        pp=pp.toFixed(2);
        $("input[name='pp']").val(pp);
    }
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Emp/Emp.php');"></span>Detalle Articulo</label>
</div>
    <div class="panel-body">        
        <form id="data">
            <div class="col-sm-12">
                <input type="button" class="btn btn-danger navbar-right" value="Cancelar" onclick="$('#pant').load('modulos/Emp/Emp.php');">
                <input type="button" class="btn btn-success navbar-right" value="Guardar" onclick="actualiza();">
                <div id="mensajes" class="navbar-left"></div>
            </div>
            <div class="col-xs-6">
                <input type="hidden" name="nemp" value="<?php echo $idUsr ?>" >
                <label>Clave:</label><input type="text" class="form-control" name="cve" value="<?php echo $cve;?>">
                <label>Descripción:</label><input type="text" class="form-control" name="desc"  value="<?php echo $desc;?>">
                <label>Costo s/iva:</label><input type="number" class="form-control" onchange="calcula()" name="c1" value="<?php echo $c1;?>">
                <label>Costo:</label><input type="number"  readonly="" class="form-control" name="c2" value="<?php echo $c2;?>">
            </div>
            <div class="col-xs-6">
                <label>Utilidad:</label><input type="number" class="form-control" onchange="calcula()" name="ut" value="<?php echo $ut;?>">
                <label>Precio Publico:</label><input type="number" readonly="" class="form-control" name="pp" value="<?php echo $pp;?>">
                <label>Exitencia actual:</label><input type="number"  class="form-control" name="ext" value="<?php echo $ext;?>">
                <label>Existencia minima:</label><input type="number"  class="form-control" name="mini" value="<?php echo $mini;?>">
            </div>           
        </form>
    </div>
<?php 
}
elseif ($_POST['nemp']){
    $nemp=$_POST['nemp'];
    $cve=$_POST['cve'];
    $desc=$_POST['desc'];
    $c1=$_POST['c1'];
    $c2=$_POST['c2'];
    $ut=$_POST['ut'];
    $pp=$_POST['pp'];
    $ext=$_POST['ext'];
    $mini=$_POST['mini'];
    if($c1==''){
      echo '<div class="alert alert-danger"><strong>¡Algo Va Mal!</strong>Falta Costo</div>';
    }
    elseif($ut==''){
        echo '<div class="alert alert-danger"><strong>¡Algo Va Mal!</strong>Falta Utilidad</div>';
    }
    else{
        $sql="UPDATE productos  SET cve_producto='$cve',descripcion='$desc',costosiva=$c1,costo=$c2,utilidad=$ut,costo_pub=$pp where idprod=$nemp;";
        insert($sql);
        $sql2="UPDATE existencia SET minimo=$mini , cantidad=$ext where idprod=$nemp;";
        insert($sql2);
        echo '<div class="alert alert-success"><strong>¡Bien!</strong>Cambios Guardados</div>';
    }    
}