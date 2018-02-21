<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$fecha="2015-12-20";
//setlocale(LC_TIME,"es_MX.UTF-8");
$fletras=date("m", strtotime($fecha));
echo "fecha : ".$fletras;