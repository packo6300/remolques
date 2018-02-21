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
    $ap=$_POST['ap'];
    $am=$_POST['am'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $suc = $_POST['suc'];
    $fp = $_POST['fp'];
    $turno = $_POST['tur'];
    $puesto= $_POST['puesto'];
    $nss= $_POST['nss'];
    $hr= $_POST['hr'];
    $nemp= $_POST['nemp'];
    //////
    //foto//
    //////
    if($nombre==''){
        echo '<div class="alert alert-danger"><strong>¡Faltan datos!</strong> Nombre</div>';
    }
    elseif($ap==''){
        echo '<div class="alert alert-danger"><strong>¡Faltan datos!</strong> Apellido paterno</div>';
    }
    elseif($am==''){
        echo '<div class="alert alert-danger"><strong>¡Faltan datos!</strong> Apellido materno</div>';
    }
    elseif($nss==''){
        echo '<div class="alert alert-danger"><strong>¡Faltan datos!</strong> NSS</div>';
    }
    elseif($puesto==''){
        echo '<div class="alert alert-danger"><strong>¡Faltan datos!</strong> Puesto</div>';
    }
    else{
        $sql1="select nemp from huella where nemp='$nemp' limit 1;";
        $t=consulta($sql1);
        foreach ($t as  $r) {
          $exit= $r['nemp']; 
        }
        if($exit==""){
        $sql2="insert into kardex VALUES(0,".$_SESSION['idCH'].",'Alta de empleado: $nemp',curdate(),curtime());";
        insert($sql2);
        $sql="INSERT INTO huella VALUES(0,1,'','','$nombre',$turno,$fp,$suc,1,'$am','$ap','$tel','$mail','$nemp','$nss','$puesto',$hr,'');";
        insert($sql);
        $sql3="SELECT MAX(id_usuario) as id from huella;";
        $t3=consulta($sql3);
       foreach ($t3 as  $r3) {
          $id= $r3['id']; 
        }
        if($id==""){ $id=0; echo $id;}
        else{ 
            $codigo2=mt_rand(1000000000, 9999999999);
            $sql5="select codigo from codigos where codigo=$codigo2";
            $t5=consulta($sql5);
            foreach ($t5 as  $r5) {
                $i= $r5['codigo']; 
            }
            if($i!=''){
            $sql4="INSERT INTO codigos VALUES(0,$id,$codigo2);";
            insert($sql4);
            $_SESSION['ida']=$id;
            echo $id; 
            }
            else{
                $codigo3=mt_rand(1000000000, 9999999999);
                $sql6="INSERT INTO codigos VALUES(0,$id,$codigo3);";
                insert($sql6);
                $_SESSION['ida']=$id;
                echo $id; 
            }            
        }
        }
        else{
            echo '<div class="alert alert-danger"><strong>¡Ya Existe!</strong># Empleado</div>';
        }
    }
}
else{
?>
<script type="text/javascript">
    function msj(message){
        $("#mensajes").html(message);
    }
    function actualiza(){
   try{
        var s=$("#data").serialize();
        $.ajax({
            type: 'POST',
            url:"modulos/Emp/EmpNew.php",
            data:s,
            beforeSend: function(){
               $("#mensajes").html("<img src='img/loading.gif' style='width: 25px; margin-left: 8px; margin-top: 3px;' >");      
            },
            //una vez finalizado correctamente
            success: function(data){
                if(data!='0'){
                    etapa2();
                    $("#idn").val(data);
                }
                else{error;}
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
function etapa2(){
    $("#subir").removeAttr("disabled");
     $("#codigo").removeAttr("disabled");
}
var empresa="<?php echo $empresa."/".$_SESSION['ida']; ?>";
    //////sube fotos
    $(document).ready(function(){
 
    $(".messages").hide();
    //queremos que esta variable sea global
    var fileExtension = "";
    //función que observa los cambios del campo file y obtiene información
    $(':file').change(function()
    {
        //obtenemos un array con los datos del archivo
        var file = $("#imagen")[0].files[0];
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = file.size/1024;
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        showMessage("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" kB.</span>");
    });
 
    //al enviar el formulario
    $('#subir').click(function(){
        //información del formulario
        var formData = new FormData($(".formulario")[0]);
        var message = ""; 
        //hacemos la petición ajax  
        $.ajax({
            url: 'modulos/Emp/EmpUpFoto.php',  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                showMessage(message)        
            },
            //una vez finalizado correctamente
            success: function(data){
                message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                showMessage(message);
                if(isImage(fileExtension))
                {
                    $("#showImage").html("<img style='width: 130px;' src='files/"+empresa+"/"+data+"'>");
                }
                //setInterval("regresar()",3000);
            },
            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error'>Ha ocurrido un error.</span>");
                showMessage(message);
            }
        });
    });
});
 
//como la utilizamos demasiadas veces, creamos una función para 
//evitar repetición de código
function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}
function regresar(){
    $("#pant").html("<center><br><br><br><br><label>Cargando por favor espere...</label><br><img style='width: 100px;' src='img/loading.gif'></center>");
 $( "#pant" ).load( "modulos/Compras/Com.php", function( response, status, xhr ) {
  if ( status == "error" ) {
    var msg = "Sorry but there was an error: ";
    $( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
  }
});
}
</script>
<div>
    <label class="list-group-item"><span  class="glyphicon glyphicon-chevron-left" onclick="regresar()"></span>Agregar Orden Compra</label>
</div>
    <div class="panel-body">
        <form id="dataOC">
            <div class="panel panel-primary">
                      <div class="panel-heading">
                          <h3 class="panel-title">Datos de Proveedor</h3>
                          
                      </div>
                      <div class="panel-body">
                          <table id="tbl_info" class="table table-striped">
                              <tr class="table table-hover">
                                  <td><b>Nombre</b></td>
                                  <td><b>Dirección</b></td>
                                  <td><b>Telefono</b></td>
                              </tr>
                              <tr>
                                  <td><span class="glyphicon glyphicon-search" ></span><input  type="text" style="float: right; " class="form-control" name="nombre" value="<?php echo $nombre;?>"></td>
                                  <td></td>
                                  <td></td>
                              </tr>
                              <tr>
                                  <td colspan="3"><input type="button" class="btn btn-success" value="verificar" onclick="actualiza();"></td>
                              </tr>
                              
                          </table>
                      </div>
                  </div>
        </form>
        
            <div class="panel panel-success">
                      <div class="panel-heading">
                          <h3 class="panel-title">Partidas</h3>
                      </div>
                      <div class="panel-body">
                          <form id="ocart">
                          <table id="tbl_part" class="table table-striped">
                              <tr class="table table-hover">
                                  <td><b>Clave</b></td>
                                  <td><b>Descripción</b></td>
                                  <td><b>Cantidad</b></td>
                                  <td></td>
                                  
                              </tr>
                              <tr>
                                  <td style="max-width: 40px;"><input type="text" class="form-control" name="clve" value="<?php echo $nombre;?>"></td>
                                  <td></td>
                                  <td style="max-width: 32px;"><input type="text" class="form-control" name="cant" value="<?php echo $nombre;?>"></td> 
                                  <td style="max-width: 32px;"><input type="button" class="btn btn-success" value="Agregar" onclick="Partidas();"></td>
                              </tr>
                          </table>
                          </form>
                          <div id="partidas"></div>
                      </div>
                  </div>
            <input type="button" class="btn btn-success" value="Guardar" onclick="actualiza();">
            <input type="button" id="subir" disabled="" class="btn btn-primary" value="Descartar" >
<?php }