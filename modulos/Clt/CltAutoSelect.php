<!DOCTYPE html>
    <?php
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root.'/lib/mysql/mysql.php');
ini_set('error_reporting', 0);
if(!isset($_SESSION)){ 
    session_start(); 
}
$idclt=$_SESSION['idclt'];
if ($_POST) {
        $clv=$_POST['clv'];
        $name=$_POST['marca'];
        $tel=$_POST['modelo'];
        $sql="SELECT * FROM cltauto where idclt=$idclt and idcltauto like '$clv%' and modelo like '$tel%' and marca like '$name%' order by marca;";
}
else{
    $sql="SELECT * FROM cltauto where idclt=$idclt order by marca;";
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
                window.opener.document.getElementById('aut').value = idclt;
                window.opener.parent.cargaAuto(idclt);
                window.close();
            };
            function empFiltr(){
    try {
        var s = $(".user_div").serialize();
        $.ajax({type:"post",url:"CltAutoSelect.php",data:s}).done(function (r){
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
        <label class="noticias list-group-item btn-primary">Seleccion de Automobil</label>
        <table id="emp" class="table table-striped" >
                <tr style="background-color: lightgrey;" >
                    <td style="text-align: center;"></td>
                    <td><b>Clave</b></td>
                    <td><b>Placas</b></td> 
                    <td><b>Modelo</b></td> 
                    <td><b>Marca</b></td> 
                </tr>
                <tr>
                    <td></td>
                    <td><input name="clv"  value="<?php echo $clv; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="placa" value="<?php echo $placa; ?>" onchange="empFiltr()"></td>
                    <td><input name="tel"  value="<?php echo $tel; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="name" value="<?php echo $name; ?>" onchange="empFiltr()"></td>                     
                </tr>
                <?php
                    $res=  consulta($sql);
                    foreach ($res as  $row) {
                        ?>
                    <tr onmouseover="moui('<?php echo $row['idcltauto']; ?>')" onmouseout="mouo('<?php echo $row['idcltauto']; ?>')" class="<?php echo $row['idcltauto']; ?>" onclick='selecciona("<?php echo $row['idcltauto']; ?>")'><td><span class="glyphicon glyphicon-ok-circle"></span></td><td><?php echo $row['idcltauto']; ?></td><td><?php echo $row['placa']; ?></td><td><?php echo $row['modelo']; ?></td><td><?php echo $row['marca']; ?></td></tr>
                    <?php                    
                    }
                    ?>
        </table>       
        </form>        
    </body>
</html>
