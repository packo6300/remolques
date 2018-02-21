<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>pruebas</title>
        <style>
        body {
             padding-top: 50px;
             padding-bottom: 20px;
             background-color: #F9FFED;
        }
        </style>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="icon" type="image/png" href="../img/reloj.png">
        <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link href="../css/carousel.css" rel="stylesheet">
        <link href="../css/style-reloj.css" rel="stylesheet" />
        <script src="../js/vendor/jquery-1.11.0.js"></script>
        <script src="../js/vendor/bootstrap.min.js"></script>
        <script src="../js/main.js"></script>
        <!--<script src="js/jquery-barcode.min.js"></script>-->
        <!--<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
        <script src="../js/jquery/jquery.min.js"></script>
       <!-- <script src="js/jquery/moment.min.js"></script>-->
	<!--<script src="js/reloj.js"></script>-->
        <script src="../js/ie10-viewport-bug-workaround.js"></script>
        <script type="text/javascript">
            function peticion(id,url){
                window.open("output2pdf.php?id="+id+"&url="+url);
            }
        </script>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <div id="inicio" class="col-xs-6">
            <input type="button" class="btn btn-danger" value="pdf" onclick="peticion('2','pdf.php')">
        </div>
        <div id="pant" class="col-xs-6">
            <input type="button" class="btn btn-danger" value="pdf" onclick="peticion('2','pdf_1.php')">
        </div>
    </body>
</html>
