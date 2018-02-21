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
       $sql="SELECT * FROM ocdetalle where foliooc=$idref order by idpoc";
       $res=consulta($sql);    
     ?>
<script type="text/javascript">
    function cOC2(id){
     $.ajax({type: 'POST',url:"modulos/Compras/ComPropiedad.php",data:{id:id}
                    }).done(function (datos){
                        $("#pant").html(datos);
                    });
}
function elimina(id){
    $.ajax({
            type: "POST",url:"modulos/Compras/acctions/ocArtDel.php",data:{code:id},
            }).done(function() {
            cOC2(<?php echo $idref;?>);
            });           
}
</script>
<table id="tbl_info" class="table table-striped">
    <tr>
        <td colspan="2">
           <label>Producto:</label>
        </td>
        <td>
            <label>Descripción:</label>
        </td>
        <td>
            <label>Precio:</label>
        </td>
        <td>
            <label>Cantidad:</label>
        </td>
        <td>
            <label>Subtotal:</label>
        </td>
    </tr>
    <?php 
    foreach ($res as  $row) {
    ?>
    <tr>
        <td>
            <button type="button" onclick="elimina(<?php echo $row['idpoc']; ?>);"><span class="glyphicon glyphicon-trash"></span></button>
        </td>
    <?php
        echo "<td>" .$row["art"]."</td>";                        
        echo "<td>".$row["descr"]."</td>";
        echo "<td>" .$row["costo"]."</td>";
        echo "<td>" .$row["cant"]."</td>";
        $total1=$row["costo"]*$row["cant"];
        $subtotal=$subtotal+$total1;
        echo "<td>".$total1."</td>";
    ?>
    </tr>
    <?php
}
?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><label>Subtotal:</label></td>
        <td><?php echo $subtotal; ?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><label>Iva:</label></td>
        <td><?php echo $subtotal*0.16; ?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><label>Total:</label></td>
        <td><input type="text" readonly="" value="<?php echo $subtotal*1.16; ?>" name="total"></td>
    </tr>
</table>            