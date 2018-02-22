<!DOCTYPE html>
    <?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
$hospedaje = $_SESSION['hpd'];
$root = $_SESSION['ruta'];
include ($root.'/lib/mysql/mysql.php');
ini_set('error_reporting', 0);

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
        <link rel="stylesheet" href="../../css/jquery.dataTables.min.css">
        <!--<script src="js/jquery-barcode.min.js"></script>-->
        <!--<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
        <script src="../../js/jquery.dataTables.min.js"></script>
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
            <thead>
                <tr>
                    <td style="text-align: center;"></td>
                    <td><b>Clave</b></td>
                    <td><b>Placas</b></td> 
                    <td><b>Modelo</b></td> 
                    <td><b>Marca</b></td> 
                </tr>
            </thead>
            <tbody>
                <?php
                $res=  consulta($sql);
                foreach ($res as  $row) {
                ?>
                <tr onmouseover="moui('<?php echo $row['idcltauto']; ?>')" onmouseout="mouo('<?php echo $row['idcltauto']; ?>')" class="<?php echo $row['idcltauto']; ?>" onclick='selecciona("<?php echo $row['idcltauto']; ?>")'><td><span class="glyphicon glyphicon-ok-circle"></span></td><td><?php echo $row['idcltauto']; ?></td><td><?php echo $row['placa']; ?></td><td><?php echo $row['modelo']; ?></td><td><?php echo $row['marca']; ?></td></tr>
                <?php } ?>
            </tbody>                
        </table>       
        </form>
        <script type="text/javascript">
            $('#emp').DataTable();
        </script>
    </body>
</html>
