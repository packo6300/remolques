<?php
if(!isset($_SESSION)) { 
        session_start(); 
} 
function getConnection(){
    try{
    $host="localhost";
    $dbu="packo";
    $dbp="fallenito";
    //$dbp="01551025";
    $db=$_SESSION['empresa'];
    $connection=new PDO( "mysql:host=".$host.";dbname=".$db,$dbu, $dbp,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));  
    return $connection;
    }
    catch(Exception $e){
       echo $e->getTrace();
       exit();
    }
}

//funcion de consulta
function consulta($sql,$args=[]){
    try{
    $connection = getConnection();
    $stmt = $connection->prepare($sql);
    if ($stmt->execute($args)) {
        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
      }else{
        return false;
      }
    }
 catch (Exception $e){
     return false;
 }
}

function insert($sql){
    try{
    $connection = getConnection();
    $stmt = $connection->prepare($sql);
    $r=$stmt->execute();
    }
    catch (PDOException $e){
    $r=$e; 
    }
    return $r;   
}

function interval_date($init,$finish){
    //formateamos las fechas a segundos tipo 1374998435
    $diferencia = strtotime($finish) - strtotime($init);
    
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
    if($diferencia < 60){
        $tiempo = floor($diferencia);
    }else if($diferencia > 60 && $diferencia < 3600){
       // $diferencia=$diferencia-3600;
        $tiempo = floor($diferencia/60);
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo = floor($diferencia/3600);
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo =floor($diferencia/86400);
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo =floor($diferencia/2592000);
    }else if($diferencia > 31104000){
        $tiempo =floor($diferencia/31104000);
    }else{
        $tiempo =0;
    }
    return $tiempo;
   
}
function dif_txt($init,$finish){
    //formateamos las fechas a segundos tipo 1374998435
    $diferencia = strtotime($finish) - strtotime($init);
    
    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
    
    if($diferencia < 60){
        $tiempo="segundos";
    }else if($diferencia > 60 && $diferencia < 3600){
        $tiempo="minutos";
    }else if($diferencia > 3600 && $diferencia < 86400){
        $tiempo="horas";
    }else if($diferencia > 86400 && $diferencia < 2592000){
        $tiempo="días";
    }else if($diferencia > 2592000 && $diferencia < 31104000){
        $tiempo="meses";
    }else if($diferencia > 31104000){
        $tiempo="años";
    }else{
        $tiempo="Error";
    }
    return $tiempo;
}
