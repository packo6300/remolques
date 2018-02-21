<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
    
    $idUsr=$_SESSION['idCH'];
if($_POST['emp']){
       $adm=$_POST['emp'];

   }
elseif ($_POST['roll']){
        $roll= $_POST['roll'];
        $adm= $_POST['admin'];
        $sql="insert into permisos values(0,$adm,$roll);";
        insert($sql);
        echo '<script>alert("permiso asignado")</script>';
}
else{
    echo 'no se resibio ningun dato';
 }
?>
<script type="text/javascript">
    function asignar(){
     try{
        var ad=$('#adm').val();
        var r= $("#roll").val();
        $.ajax({type: 'POST',url:"modulos/Config/UsrPermisoNuevo.php",data:{roll:r,admin:ad}
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }   
    }
    
   function selec_menu(a){
   try{
        $("#roll").empty();
        $.getJSON("modulos/Config/SubMenu.php?id="+a+"",function (data){
        $.each(data,function(index,dat){
            $("#roll").append("<option value='"+dat.idroles+"'>"+dat.nombre+"</option>");
        });
    });
    }
    catch(err){
        console.error(err);
    }
}
function nvo(){
    try{
        $("#pant").load("modulos/Config/UsrNew.php");
    }
    catch(err){
        console.error(err);
    }
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Administradores</label>
            </div>
            <form id="manual">
               <label>Modulo</label>
               <select name="secc" onchange="selec_menu(this.value)">
                   <option  value = "0" ></option>
                   <?php
                   $result3= consulta("SELECT * FROM mtitulos;");
                   foreach ($result3 as  $f) {
                   if($_POST['secc']== $f['idmti'] ){
                      $seleccionado = "selected";
                   }
                   else{
                       $seleccionado = "";
                   } 
                   ?>
                   <option  value = "<?php echo $f['idmti']; ?>" <?php echo $seleccionado; ?> > <?php echo $f['nombre']; ?></option>
                   <?php } ?>
               </select>
               <label>Permiso</label>
               <select id="roll" name="roll">
               </select>
               <input type="hidden" id="adm" value="<?php echo $adm; ?>">
               <input type="button" onclick="asignar()" value="Asignar">
            </form>
          <br>
</div>