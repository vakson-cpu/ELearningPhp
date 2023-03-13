<?php
include 'Mailer/class.phpmailer.php';
include 'Mailer/class.smtp.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);

function sendmail($to, $nameto, $subject, $message, $altmess) {
    $from  = "vakson12@gmail.com";
    $namefrom = "Miljan";
    $mail = new PHPMailer();
    $mail->isSMTP();   // by SMTP
    $mail->isHTML();   // by HTML
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth   = "true";   // user and password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    $mail->Username   = $from;
    $mail->Password   = "kfagiwwklcxekxnx";
    $mail->Subject  = $subject;
    $mail->setFrom($from);   // From (origin)
    $mail->Body = $message;
    $mail->addAddress($to);
    return $mail->send();
} 
function senfVerificationMail($reciever,$Code,$NameOfUser){
$to="$reciever";
$message = "<div class='card' style=' border: 1px solid grey;width: 340px; height: 300px; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
        <div class='card_header' style='width: 100%; height: 50px; background-color: #f5ba1a; padding-left: 5px;padding-top: 2px;'>
        <div class='logo' style='margin-top: 5px; width: 85px; background-color: white; padding: 7px; border-radius: 15px;display:flex; justify-content: center;
        align-items: center;'><b><span style='color: red;'>Waha Surgery</b></div>

        </div>
        <div class='card_content' style='padding: 10px;'>
        <h4>Izvolite verifikacioni kod </h4>
        <p>'$Code'</p>
        <a href='http://localhost/WebProgramiranje/Pages/InsertCode.php?UserName=$NameOfUser'>Ovde mozete uneti kod .</a>
        </div>
    </div>";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <vakso12@gmail.com' . "\r\n";
    $headers .= 'Cc: ' . $to . '' . "\r\n";
   // mail($to, $subject, $message, $headers);
    $emailSent = sendmail($to, "Hoce", "Potvrda Naloga", $message,  $headers);
    if ($emailSent) {
     echo'<script>alert("Email successfuly sent")</script>';   
    } else {
        echo'<script>alert("Email successfuly sent")</script>';   
    }
}

function PasswordReset($reciever,$Sifra,$NameOfUser){
    $to="$reciever";
    $message = "<div class='card' style=' border: 1px solid grey;width: 340px; height: 300px; background-color: rgb(252, 252, 252); overflow: hidden; border-radius: 15px;'>
            <div class='card_header' style='width: 100%; height: 50px; background-color: #f5ba1a; padding-left: 5px;padding-top: 2px;'>
            <div class='logo' style='margin-top: 5px; width: 85px; background-color: white; padding: 7px; border-radius: 15px;display:flex; justify-content: center;
            align-items: center;'><b><span style='color: red;'>Elearning</b></div>
    
            </div>
            <div class='card_content' style='padding: 10px;'>
            <h4>Izvolite vasu novu sifru: </h4>
            <p>'$Sifra'</p>
            <a href='http://localhost/WebProgramiranje/Pages/InsertCode.php?UserName=$NameOfUser'>Postovani,uspesno ste resetovali sifru  saljemo vam novu sifru.</a>
            </div>
        </div>";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
        // More headers
        $headers .= 'From: <vakson12@gmail.com' . "\r\n";
        $headers .= 'Cc: ' . $to . '' . "\r\n";
       // mail($to, $subject, $message, $headers);
        $emailSent = sendmail($to, "Hoce", "Potvrda Naloga", $message,  $headers);
        if ($emailSent) {
         echo'<script>alert("Email successfuly sent")</script>';   
        } else {
            echo'<script>alert("Email successfuly sent")</script>';   
        }
    }
