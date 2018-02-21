<!DOCTYPE html>
<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
$hospedaje = $_SESSION['hpd'];
$root = $_SESSION['ruta'];
include ($root.'/lib/mysql/mysql.php');
ini_set('error_reporting', 0);
$tipo=$_SESSION['tipo'];

$_SESSION['tbl']="empleados";
$_SESSION['csv']="ListaUsuarios";

if ($_POST) {
        $clv=$_POST['clv'];
        $name=$_POST['name'];
        $tel=$_POST['tel'];
        $sql="SELECT * FROM remolques where  idrem like '$clv%' and placa like '$tel%' and tipo like '$name%' order by placa;";
}
else{
    $sql="SELECT * FROM remolques order by placa;";
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
                window.opener.document.getElementById('rem').value = idclt;
                window.opener.parent.cargaRem(idclt);
                window.close();
            };
            function empFiltr(){
    try {
        var s = $(".user_div").serialize();
        $.ajax({type:"post",url:"RemSelect.php",data:s}).done(function (r){
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
        <label class="noticias list-group-item btn-primary">Seleccion de Remolque</label>
        <table id="emp" class="table table-striped" >
                <tr style="background-color: lightgrey;" >
                    <td style="text-align: center;"></td>
                    <td><b>Clave</b></td>
                    <td><b>Placas</b></td> 
                    <td><b>Tipo</b></td>                    
                </tr>
                <tr>
                    <td></td>
                    <td><input name="clv"  value="<?php echo $clv; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="tel"  value="<?php echo $tel; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="name" value="<?php echo $name; ?>" onchange="empFiltr()"></td>
                </tr>
                <?php
                    $res=  consulta($sql);
                    foreach ($res as  $row) {
                        ?>
                <tr onmouseover="moui('<?php echo $row['idrem']; ?>')" onmouseout="mouo('<?php echo $row['idrem']; ?>')" class="<?php echo $row['idrem']; ?>" onclick='selecciona("<?php echo $row['idrem']; ?>")'><td><span class="glyphicon glyphicon-ok-circle"></span></td><td><?php echo $row['idrem']; ?></td><td><?php echo $row['placa']; ?></td><td><?php echo $row['tipo']; ?></td></tr>
                    <?php
                    
                    }
                    ?>
        </table>       
        </form>        
    </body>
</html>
