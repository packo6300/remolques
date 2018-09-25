<?php
 if(!isset($_SESSION)) { 
    session_start(); 
}
$idUsr=$_SESSION['idCH'];
if($idUsr!=''){
ini_set('error_reporting', 1);
$host = $_SESSION['hpd'];
$root = $_SESSION['ruta'];
define('ROOT', $root);
include (ROOT."/lib/mysql/mysql.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Remolques Aeropuerto</title>
        <?php
        include 'links.html';
        ?>
        
    </head>
    <body>
       <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Opciones</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href=""><?php echo $_SESSION['empresa']; ?></a>
            <form class="lo" action="session/logout.php">
                <button style="  float: right; margin-top: .5em;" type="submit" class="btn btn-success">Desconectar</button>
            </form>
        </div>
        
        <div class="navbar-collapse collapse">
            
            
            <div class="m">
            <?php
                $sql="SELECT * FROM menu where idAdmin=:user group by cabezera";
                $res=  consulta($sql,[":user"=>$idUsr]);
                foreach ($res as $k => $r) {
                    ?>
                    <ul>
                        <li onclick="$('#<?php echo $r['cabezera']; ?>').toggle();"><label class="Menu-Titulo"><?php echo $r['cabezera']; ?> </label></li> <?php
                           $sql1='SELECT * FROM menu where idAdmin='.$idUsr.' and cabezera="'.$r["cabezera"].'" order by nombre ;';
                           $res1=  consulta($sql1);
                           ?> <ul style="display: none;" id="<?php echo $r['cabezera']; ?>"> <?php
                                foreach ($res1 as  $r1) { ?>
                           <li><img src="img/puntost.gif" style="margin-top: -3px; margin-right: 2px;"><a onclick="menu('<?php echo $r1['funcion']; ?>')"><?php echo $r1['nombre']; ?></a></li>
                           <?php } ?>
                              </ul>
                    </ul>
                <?php
                }
                ?>
            </div>
          
        </div><!--/.navbar-collapse -->
      </div>
        
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    
        <div class="m2">
            <div class="col-lg-2" style=" overflow-y: auto; overflow-x: hidden; height: 100%;">
                <br>
                <?php
                $sql="SELECT * FROM menu where idAdmin=$idUsr group by cabezera";
                $res=  consulta($sql);
                foreach ($res as $k => $r) {
                    ?>
                <ul>
                    <li onclick="$('#<?php echo $r['cabezera']; ?>2').toggle();"><label class="Menu-Titulo2"><?php echo $r['cabezera']; ?> </label></li> <?php
                    $sql1 = 'SELECT * FROM menu where idAdmin=' . $idUsr . ' and cabezera="' . $r["cabezera"] . '" order by nombre ;';
                    $res1 = consulta($sql1);
                    ?> <ul  id="<?php echo $r['cabezera']; ?>2"> <?php foreach ($res1 as $z => $r1) { ?>
                            <li><img src="img/puntost.gif" style="margin-top: -3px; margin-right: 2px;"><a onclick="menu('<?php echo $r1['funcion']; ?>')"><?php echo $r1['nombre']; ?></a></li>
                        <?php } ?>
                    </ul>
                </ul>
                <?php
                }
                ?>
                
            </div>
        </div>
    <div id="pant" class="col-sm-10" style=" background-color: #ebebeb; overflow-y: auto; overflow-x: auto;border-style: dotted;border-width: 1px; height: 39em;">
    <div id="calendar"></div>
    <script type="text/javascript">
        $('#calendar').fullCalendar({
            defaultView: 'month'
        });
    </script>   
    </div>
      
    <div class="container">
        <footer style="  float: right;   margin-top: 14px;">
          &copy; MyC IT Solutions 2014
        </footer>
      </div>
    </body>
</html>
<?php
}
else{
    header("location:".$host);
    ?>
<a href="/">inicio</a>
<?php
}