<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correo {

        function cargaCorreo($file_name){

            require 'PHPMailer/Exception.php';
            require 'PHPMailer/PHPMailer.php';
            require 'PHPMailer/SMTP.php';

            

            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'garciaquinteroga@gmail.com';
                $mail->Password   = 'llrysqpqzrpcbpwc';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = '587';
                //Recipients

                $mail->setFrom('garciaquinteroga@gmail.com', 'Reporte de Citas');
                $mail->addAddress('gabrielarturogq@ufps.edu.co', '');

            
                // Content
                $mail->isHTML(true);
                $mail->AddAttachment($file_name);
                $mail->Subject = 'Customer Details';			//Sets the Subject of the message
                $mail->Body = 'Please Find Customer details in attach PDF File.';				//An HTML or plain text message body
               // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $mail->ClearAddresses();
                header('Location: ' . constant('URL') . 'adminControl');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
                        
        }


    function cargaCorreoCita($message,$correo)
    {

        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';


        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);




        try {
            $mail->IsSMTP();
            $mail->isHTML(true);
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "tls";
            $mail->Host       = "smtp.gmail.com";
            $mail->Port       = '587';
            $mail->Username   = 'garciaquinteroga@gmail.com';
            $mail->Password   = 'llrysqpqzrpcbpwc';
            $mail->setFrom('garciaquinteroga@gmail.com', 'Cambio de agenda');
            $mail->addAddress('gabrielarturogq@ufps.edu.co', '');
            $mail->Subject = 'Customer Details';            //Asunto del mensaje
            $mail->Body    = $message;//esto es el html del metodo mensaje
            $mail->AltBody    = $message;//esto es el html del metodo mensaje

            if($mail->Send())
            {
                $msg = "<div class='alert alert-success'> Hola,<br /> 'el nombrexxxx' correo enviado a 'Enviando a tal correo:xxxxx' sin problemas</div>";
            }
        }
        catch(phpmailerException $ex)
        {
            $msg = "<div class='alert alert-warning'>".$ex->errorMessage()."</div>";
        }

        echo $msg;//mostramos el mensaje
    }



}

