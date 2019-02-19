<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer-6.0.3/src/Exception.php';
    require 'PHPMailer-6.0.3/src/PHPMailer.php';
    require 'PHPMailer-6.0.3/src/SMTP.php';

    $request["name"] = $_POST["name"];
    $request["email"] = $_POST["email"];
    $request["mobile"] = $_POST["mobile"];
    $request["about"] = $_POST["about"];

    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $about = $_POST["about"];

    $about_array = array("...?", "say hi!", "discuss something about IT!", "refresh your memory about me!", "tell you a gossip!", "pock you!", "mention it's NOTA and revert ASAP!");

    date_default_timezone_set('Asia/Singapore');

    $toAddress = $email; //To whom you are sending the mail.
    $message   = <<<EOT
        <html>
           <body>
              <p>Hi Suresh, <br/>
                 I'm $name, I just wanna $about_array[$about]. <br/>
                 Can you kindly get back to me via $email or $mobile.
              </p>
              <p>Cheers <br/>
              $name.
              </p>
           </body>
        </html>
EOT;
    //$message = "test";
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    //$mail->SMTPDebug = 2;
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
    $mail->Subject = "$name messaged you!"; // Mail subject
    $mail->Body    = $message;
    $mail->addAddress("me@imsuresh.com", "Suresh Manickam");
    $mail->addAddress("phoenix.suresh@gmail.com", "Suresh Manickam");
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