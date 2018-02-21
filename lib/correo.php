<?php

$root = "/var/www/html";

require  $root."/lib/phpmail/class.phpmailer.php";
require  $root."/lib/phpmail/class.smtp.php";

function enviar($mail,$name,$body,$asunto) {
            $mail2=  "jdelgado@mycsolutions.com.mx";
            $name2=  "ClockInTime";
            $email = new PHPMailer();
            $email->IsSMTP(); 
            $email->CharSet="UTF-8";
            $email->IsHTML(TRUE);
            /////datos de cuenta coreo/////////
            $email->SMTPAuth = true;
            $email->SMTPSecure='';
            $email->Host = "smtp.1and1.mx";
            $email->Port = "587";
            $email->Username = "jdelgado@mycsolutions.com.mx";
            $email->Password = "Fallenito27";
            //////////datos de envio///////////////
            $email->From = $mail2;
            $email->FromName = "Checktime.com.mx";
            $email->Subject = $asunto;
            $email->MsgHTML($body);
            $email->AddAddress($mail,$name);
            $email->AddBCC($name2);
            $email->FromName = "Checktime";
            $email->AddReplyTo($mail2,$name2);
            if(!$email->Send()){
                return FALSE;
            }
            else{ 
                return TRUE;            
            }
        }