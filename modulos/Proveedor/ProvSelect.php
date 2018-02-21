<!DOCTYPE html>
    <?php
$root = $_SERVER['DOCUMENT_ROOT'];
include ($root.'/lib/mysql/mysql.php');
ini_set('error_reporting', 0);
if(!isset($_SESSION)){ 
    session_start(); 
}
$tipo=$_SESSION['tipo'];

$_SESSION['tbl']="empleados";
$_SESSION['csv']="ListaUsuarios";

if ($_POST) {
        $clv=$_POST['clv'];
        $name=$_POST['name'];
        $tel=$_POST['tel'];
        $sql="SELECT * FROM proveedores where nombre_prov like '$tel%' and telefono like '$name%' order by nombre_prov;";
}
else{
    $sql="SELECT * FROM proveedores order by nombre_prov;";
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
                window.opener.document.getElementById('prov').value = idclt;
                window.opener.parent.carga(idclt);
                window.close();
            };
            function empFiltr(){
    try {
        var s = $(".user_div").serialize();
        $.ajax({type:"post",url:"ProvSelect.php",data:s}).done(function (r){
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
        <label class="noticias list-group-item btn-primary">Lista de Proveedores</label>
        <table id="emp" class="table table-striped" >
                <tr style="background-color: lightgrey;" >
                    <td style="text-align: center;"></td>
                    <td><b>Nombre</b></td> 
                    <td><b>Telefono</b></td>                    
                </tr>
                <tr>
                    <td></td>
                    <td><input name="tel"  value="<?php echo $tel; ?>" autofocus onchange="empFiltr()"></td>
                    <td><input name="name" value="<?php echo $name; ?>" onchange="empFiltr()"></td>
                </tr>
                <?php
                    $res=  consulta($sql);
                    foreach ($res as  $row) {
                        ?>
                <tr onmouseover="moui('<?php echo $row['idProveedores']; ?>')" onmouseout="mouo('<?php echo $row['idProveedores']; ?>')" class="<?php echo $row['idProveedores']; ?>" onclick='selecciona("<?php echo $row['idProveedores']; ?>")'><td><span class="glyphicon glyphicon-ok-circle"></span></td><td><?php echo $row['nombre_prov']; ?></td><td><?php echo $row['telefono']; ?></td></tr>
                    <?php
                    
                    }
                    ?>
        </table>       
        </form>        
    </body>
</html>
