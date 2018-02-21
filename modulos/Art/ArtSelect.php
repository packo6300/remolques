<!DOCTYPE html>
    <?php
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root.'/lib/mysql/mysql.php');
ini_set('error_reporting', 0);

if ($_POST) {
        $clv=$_POST['clv'];
        $tel=$_POST['tel'];
        $sql="SELECT * FROM productoslistar where descripcion like '$tel%' and cve_producto like '$clv%' order by descripcion;";
}
else{
    $sql="SELECT * FROM productoslistar order by cve_producto;";
}
?>

<html>
    <head>
      <style>
        body {
             padding-bottom: 20px;
             background-color: #cececf;
        }
        </style>
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../../css/main.css">
        <script src="../../js/vendor/jquery-1.11.0.js"></script>
        <script src="../../js/vendor/bootstrap.min.js"></script>
        <script src="../../js/main.js"></script>
        <!--<script src="js/jquery-barcode.min.js"></script>-->
        <!--<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
        
        <script src="../../js/ie10-viewport-bug-workaround.js"></script>
        <script>
            function moui(id){
                $("."+id).css("color","green");                
            }
            function mouo(id){
                $("."+id).css("color","black");                
            }
            function selecciona(idclt) {
                window.opener.document.getElementById('art').value = idclt;
                window.opener.parent.cargaArt(idclt);
                window.close();
            };
            function empFiltr(){
                try {
                    var s = $(".user_div").serialize();
                    $.ajax({type:"post",url:"ArtSelect.php",data:s}).done(function (r){
                        $("#cont").html(r);
                    });
                }
                catch (err){
                    alert(err); 
                }
            }
        </script>
    </head>
    <body id="cont">
    
    <form class="user_div">
        <label class="noticias list-group-item btn-primary">Seleccion de Articulo</label>
        <table id="emp" class="table table-striped" >
                <tr style="background-color: lightgrey;" >
                    <td style="text-align: center;"></td>
                    <td><b>Clave</b></td>
                    <td><b>Descripción</b></td> 
                    <td><b>Existencia</b></td>                    
                </tr>
                <tr>
                    <td></td>
                    <td><input name="clv"  value="<?php echo $clv; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="tel"  value="<?php echo $tel; ?>"  onchange="empFiltr()"></td>
                    <td></td>
                </tr>
                <?php
                $res = consulta($sql);
                foreach ($res as $row) {
                    ?>
                    <tr onmouseover="moui('<?php echo $row['idprod']; ?>')" onmouseout="mouo('<?php echo $row['idprod']; ?>')" class="<?php echo $row['idprod']; ?>" onclick='selecciona("<?php echo $row['cve_producto']; ?>")'><td><span class="glyphicon glyphicon-ok-circle"></span></td><td><?php echo $row['cve_producto']; ?></td><td><?php echo $row['descripcion']; ?></td><td><?php echo $row['ext']; ?></td></tr>
                    <?php
                }
                ?>
        </table>       
        </form>        
    </body>
</html>
