<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-6.0.3/src/Exception.php';
require 'PHPMailer-6.0.3/src/PHPMailer.php';
require 'PHPMailer-6.0.3/src/SMTP.php';

$request["name"] = $_POST["name"];
$request["email"] = $_POST["email"];
$request["mobile"] = $_POST["mobile"];

$name = $_POST["name"];
$email = $_POST["email"];

date_default_timezone_set('Asia/Singapore');

$toAddress = $email; //To whom you are sending the mail.
/*$message   = <<<EOT
    <html>
       <body>
          <h>PHPMailer basic usage</h>
          <p>It is working</p>
       </body>
    </html>
EOT;*/
$message = "test";
$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->SMTPAuth    = true;
$mail->Host        = "smtp.zoho.com";
$mail->Port        = 465;
$mail->SMTPSecure = 'ssl';
/*$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);*/
$mail->isHTML(true);
$mail->Username = "me@imsuresh.com"; // your gmail address
$mail->Password = "Tom79Cat]Jery"; // password
$mail->setFrom("me@imsuresh.com", "Suresh Manickam");
$mail->Subject = "Using PHPMailer without composer"; // Mail subject
$mail->Body    = $message;
$mail->addAddress($toAddress, "Suresh Manickam");
//$mail->send();
if (!$mail->send()) {
    $request["ok"] = 0;
    $request["reply"] = 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    $request["ok"] = 1;
    $request["reply"] = "Hi $name, <br/> your email has been sent. <br/>You will receive an email back from him soon. <br/>--<br/> Robot";
}
echo json_encode($request);

?>