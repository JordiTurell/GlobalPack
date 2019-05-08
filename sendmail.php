<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);// Passing `true` enables exceptions

$input = json_decode(file_get_contents('php://input'), true);
if(!empty($input)){
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'webglobalpack@gmail.com';                 // SMTP username
        $mail->Password = 'globalpack2019';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('webglobalpack@gmail.com', 'Web Globalpack');
        $mail->addAddress('operaciones@globalpack-e.com', 'Operaciones');
        //$mail->addAddress('info@jorditurell.com', 'Jordi Turell Nebot');

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Contacto de la Web';
        $body = ' ';
        if($input["Empresa"] != ""){
            $body .= '<h3>La empresa '.$input["Empresa"].'</h3>';
        }
        if($input["Provincia"] != "" || $input["Pais"] != ""){
            $body .= '<p>Con provincia: '.$input["Provincia"].' y Pais: '.$input["Pais"].'</p>';
        }
        if($input["Nombre"] != ""){
            $body .= '<p>Email: '.$input["Email"].'</p><h3>Sr/Sra '.$input["Nombre"].'</h3><br/>'.$input["Mensaje"];
        }
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    }
    catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}