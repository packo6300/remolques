<?php
if(!isset($_SESSION)){ 
    session_start(); 
}
ini_set('error_reporting', 0);
header('Content-Type: text/html; charset=UTF-8');
$root = $_SESSION['ruta'];
include ($root."/lib/mysql/mysql.php");
$idref=$_POST['code'];
if($idref=='new'){
    $idref=0;
}
    $sql="SELECT * FROM cotizaciondetail where idcotizacion=$idref";
    $res=consulta($sql);
    $ivaResulset= consulta("select iva from iva;");
?>
<script type="text/javascript">
    function cOC2(id){
     $.ajax({type: 'POST',url:"modulos/Ventas/CotizacionPropiedad.php",data:{id:id}
    }).done(function (datos){
        $("#pant").html(datos);
    });
}
function elimina(id){
    $.ajax({
            type: "POST",url:"modulos/Ventas/acctions/cotizacionArtDel.php",data:{code:id},
            }).done(function() {
            cOC2(<?php echo $idref;?>);
            });           
}
</script>
<table id="tbl_info" class="table table-striped">
    <tr>
        <td style="min-width: 46em;">
            <label>Descripción:</label>
        </td>
        <td>
            <label>Precio:</label>
        </td>
        <td>
            <label>Cantidad:</label>
        </td>
        <td style="text-align: right;">
            <label>Subtotal:</label>
        </td>
    </tr>
    <?php 
    foreach ($res as  $row) {
    ?>
    <tr>
        <td>
            <i class="glyphicon glyphicon-trash text-danger" onclick="elimina(<?php echo $row['idcotizaciondetail']; ?>);"></i>
        
    <?php
        echo "  ".$row["descripcion"]."</td>";
        echo "<td>" .round($row["subtotal"],2)."</td>";
        echo "<td>" .$row["cantidad"]."</td>";
        $total1=$row["subtotal"]*$row["cantidad"];
        $subtotal=$subtotal+$total1;
        echo "<td style='text-align: right;'>".round($total1,2)."</td>";
    ?>
    </tr>
    <?php
}
?>
    <tr>
        <td colspan="2"></td>
        <td><label>Subtotal:</label></td>
        <td style="text-align: right;"><input style="text-align: right;" type="text" readonly="" value="$<?php echo round($subtotal,2); ?>" name="total"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td><label>IVA:</label></td>
        <td style="text-align: right;"><input style="text-align: right;" type="text" readonly="" value="$<?php echo round($subtotal*($ivaResulset['0']['iva']-1),2); ?>" name="iva"></td>
    </tr>
    <tr>
        <td colspan="2"></td>
        <td><label>Total:</label></td>
        <td style="text-align: right;"><input style="text-align: right;" type="text" readonly="" value="$<?php echo round($subtotal*($ivaResulset['0']['iva']),2) ?>" name="total"></td>
    </tr>
</table>            