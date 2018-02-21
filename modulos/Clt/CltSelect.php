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
        $sql="SELECT * FROM clientes2 where  idclt like '$clv%' and telefono like '$tel%' and nombre like '$name%' order by nombre;";
}
else{
    $sql="SELECT * FROM clientes2 order by nombre;";
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
                window.opener.document.getElementById('clt').value = idclt;
                window.opener.parent.carga(idclt);
                window.close();
            };
            function empFiltr(){
    try {
        var s = $(".user_div").serialize();
        $.ajax({type:"post",url:"CltSelect.php",data:s}).done(function (r){
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
        <label class="noticias list-group-item btn-primary">Seleccion de Clientes</label>
        <table id="emp" class="table table-striped" >
                <tr style="background-color: lightgrey;" >
                    <td style="text-align: center;"></td>
                    <td><b>Clave</b></td>
                    <td><b>Telefono</b></td> 
                    <td><b>Nombre</b></td>                    
                </tr>
                <tr>
                    <td></td>
                    <td><input name="clv"  value="<?php echo $clv; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="tel"  value="<?php echo $tel; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="name" value="<?php echo $name; ?>" onchange="empFiltr()"></td>
                </tr>
                <?php
                $res = consulta($sql);
                foreach ($res as $row) {
                    ?>
                    <tr onmouseover="moui('<?php echo $row['idclt']; ?>')" onmouseout="mouo('<?php echo $row['idclt']; ?>')" class="<?php echo $row['idclt']; ?>" onclick='selecciona("<?php echo $row['idclt']; ?>")'><td><span class="glyphicon glyphicon-ok-circle"></span></td><td><?php echo $row['idclt']; ?></td><td><?php echo $row['telefono']; ?></td><td><?php echo $row['nombre']; ?></td></tr>
                    <?php
                }
                ?>
        </table>       
        </form>        
    </body>
</html>
