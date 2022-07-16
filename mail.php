<?php

// Using required files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


try {
    
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    // Connecting with the sendrig server
    $mail->SMTPDebug  = 1;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.sendgrid.net";
    $mail->Username   = "apikey";
    $mail->Password   = "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";

    // Applying the recievers email and customers email
    $mail->SetFrom($receiver, $email);
    $mail->AddAddress($receiver);

    $body = "<p>".$message."</p>";
    $mail->IsHTML(true);
    $mail->Subject = $subject;
    
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);

    // Sends the email
    $mail->send();

    $message = "Message sent successfully, we'll get back to you at our earliest convenience";
}
catch (Exception $e) {
    // Error message if the email has not been sent
    $message = "Message could not be sent, try again later";
}
?>

<script type="text/javascript">
      document.body.innerHTML = '';
</script>