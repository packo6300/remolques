<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
if ($_POST['cve']){
    $cve=$_POST['cve'];
    $desc=$_POST['desc'];
    $c1=$_POST['c1'];
    $c2=$_POST['c2'];
    $ut=$_POST['ut'];
    $pp=$_POST['pp'];
    $ext=$_POST['ext'];
    $min=$_POST['min'];
    
    if($c1==''){
      echo 'Favor de asignar un costo';
    }
    elseif($ut==''){
        echo 'Favor de verificar utilidad';
    }
    else{
        $sql="select * from productos where cve_producto='$cve'";
        $r1= consulta($sql);
        foreach ($r1 as  $r) {
            $cve2=$r['cve_producto'];
        }
        if($cve==$cve2){
            echo 'CVE ya existe!';    
        }
        else{
        $sql2="INSERT INTO productos values('$cve','$desc',$c2,$pp,$ut,$c1,0);";
        insert($sql2);
		
        $sql4="select max(idprod) as ul from productos;";
        $r4=consulta($sql4);
		foreach ($r4 as  $c) {
            $c=$rr4['ul'];
        }
		$sql3="INSERT INTO existencia values('$c',$ext,$min,0);";
        insert($sql3);
		echo 'Datos Guardados';
        } 
    }
}
else{
    $sql2="SELECT * FROM iva limit 1;";
    $r2=  consulta($sql2);
    foreach ($r2 as  $r) {
        $iva=$r['iva'];
    }
     $ext=0;
    $min=0;
?>
<script type="text/javascript">
    
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/EmpNew.php",data:s
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
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="$('#pant').load('modulos/Emp/Emp.php');"></span>Nuevo Articulo</label>
</div>
    <div class="panel-body">
        <form id="data">
            <div class="col-sm-12">
                <input type="button" class="btn btn-danger navbar-right" value="Cancelar" onclick="$('#pant').load('modulos/Emp/Emp.php');">
                <input type="button" class="btn btn-success navbar-right" value="Guardar" onclick="actualiza();">
                <div id="mensajes" class="navbar-left"></div>
            </div>
            <div class="col-xs-6">
                <label>Clave:</label><input type="text" class="form-control" name="cve" value="<?php echo $cve;?>">
                <label>Descripción:</label><input type="text" class="form-control" name="desc"  value="<?php echo $desc;?>">
                <label>Costo s/iva:</label><input type="number" class="form-control" onchange="calcula()" name="c1" value="<?php echo $c1;?>">
                <label>Costo:</label><input type="number"  readonly="" class="form-control" name="c2" value="<?php echo $c2;?>">
            </div>
            <div class="col-xs-6">
                <label>Utilidad:</label><input type="number" onchange="calcula()" class="form-control" name="ut" value="<?php echo $ut;?>">
                <label>Precio Publico:</label><input type="number" readonly="" class="form-control" name="pp" value="<?php echo $pp;?>">
                <label>Existencia:</label><input type="number"  class="form-control" name="ext" value="<?php echo $ext;?>">
                <label>Existencia minima:</label><input type="number"  class="form-control" name="min" value="<?php echo $min;?>">
            </div>
        </form>
        <div id="mensajes"></div>
    </div>
<?php }