<?php
 if(!isset($_SESSION)) { 
    session_start(); 
}
ini_set('error_reporting', 0);
$root = $_SESSION['ruta'];
$hospedaje=$_SESSION['hpd'];
include ($root."/lib/mysql/mysql.php");
    $motivo=$resp="";
    $idUsr=$_SESSION['idCH'];
    $_SESSION['pg']="productos";
    $_SESSION['tbl']="productos";
if($_POST){
       $resp=$_POST['nombre'];
       $motivo=$_POST['cve'];
       $emp=$_POST['sucursal'];
       $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
       $st=$_POST['st'];
       $sql="SELECT * FROM productoslistar where descripcion like '$resp%' and cve_producto like '$motivo%' order by descripcion;";
   }
   else{
       $sql="SELECT * FROM productoslistar order by descripcion;";
   }
    
?>
 <script src="<?php echo $hospedaje; ?>/js/jquery-barcode.min.js"></script>
<script type="text/javascript">
    var settings = {
            output:"css",
            bgColor: "#FFFFFF",
            color: "#000000",
            barWidth: "1.5",
            barHeight: "30"
           // moduleSize: $("#moduleSize").val(),
           // addQuietZone: $("#quietZoneSize").val()
        };
    function recarga(){
   try{
        var s=$("#manual").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/Emp.php",data:s
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
function nvo(){
    try{
        $("#pant").load("modulos/Emp/EmpNew.php");
    }
    catch(err){
        console.error(err);
    }
}
function mod(id){
    try{
       $.ajax({type: 'POST',url:"modulos/Emp/EmpPropiedad.php",data:{ida:id}
        }).done(function (datos){
            $("#pant").html(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
function eli(id){
    try{
        c=confirm("¿Desea eliminar completamente el producto?");
        if(c==true){
            $.ajax({type: 'POST',url:"modulos/Art/ArtEliminar.php",data:{ida:id}
            }).done(function (datos){
                alert(datos);
                $("#pant").load("modulos/Emp/Emp.php");
            });
        }
    }
    catch(err){
        console.error(err);
    }
}
function actCodigo(){
    try{
        var s=$("#coder").serialize();
        $.ajax({type: 'POST',url:"modulos/Emp/EmpBarras.php",data:s
        }).done(function (datos){
            alert(datos);
        });
    }
    catch(err){
        console.error(err);
    }
}
</script>
        <div class="row">
            <div>
                <label class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span>Lista de Productos</label>
            </div>
            <a href="lib/tocsv.php" ><img src="img/IconExcel.gif" alt="Exportar a excel"></a>
            <br>
            <form id="manual">
                <table id="tbl_info" class="table table-striped">
                    <tr class="table table-hover">
                        <td><span class="glyphicon glyphicon-plus-sign" style="top: 18px;left: 11px;" onclick="nvo()"></span></td>
                        <td><label><b>Clave</b></label><br><input value="<?php echo $motivo; ?>" type="text" name="cve" onchange="recarga()"></td>
                        <td><label><b>Descripcion:</b></label><br><input value="<?php echo $resp; ?>" type="text" name="nombre" size="40" onchange="recarga()"><br></td>
                        <td><b>Ext.</b></td>
			<td><b>costo s/iva</b></td>
                        <td><b>Costo</b></td>                    
                        <td><b>Utilidad</b></td>
                        <td><b>Precio Público</b></td>                                
                    </tr> 
                    <?php
                    $_SESSION['query'] = $sql;
                    $resul = consulta($sql);
                    foreach ($resul as  $row) {
                        ?>
                        <tr>
                            <td>
                                <div class="btn-group">
                                  <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                      <span class="glyphicon glyphicon-list"></span>
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a onclick="mod(<?php echo $row['idprod']; ?>);"><span class="glyphicon glyphicon-edit"></span> Modificar</a></li>
                                      <li><a onclick="eli(<?php echo $row['idprod']; ?>);"><span class="glyphicon glyphicon-trash"></span> Eliminar</a></li>
                                  </ul>
                                </div>
                            </td>
                        <?php
                        echo "<td>".$row['cve_producto']."</td>";
                        echo "<td>".$row["descripcion"]."</td>";
                        echo "<td >".$row["ext"]."</td>";
                        echo "<td >".$row["costosiva"]."</td>";
                        echo "<td>".$row["costo"]."</td>";
                        echo "<td>".$row["utilidad"]."</td>";
                        echo "<td>".$row["costo_pub"]."</td>";
                        echo "</tr>";                        
                     }
                    ?>
          </table>
        </form>
          <br>
          
</div>