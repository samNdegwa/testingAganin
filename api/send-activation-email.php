<?php
include_once("../include/header.php");
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

if(isset($postdata) && !empty($postdata))
{
$user_name = mysqli_real_escape_string($mysqli, trim($request->user_name));	
$user_email = mysqli_real_escape_string($mysqli, trim($request->user_email));
//$code = rand(99999,1000000);

$mail = new PHPMailer\PHPMailer\PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = 1;                     //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'samsoftware2018@gmail.com';                     //SMTP username
    $mail->Password   = 'sam31854313';                               //SMTP password
    $mail->SMTPSecure = 'ssl';        //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('samsoftware2018@gmail.com', 'Ekas Tech');
    $mail->addAddress($user_email);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('samsoftware2018@gmail.com');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Ekasline Account Confirmation';
    $mail->Body    = '<b>Congratulations!</b> '.$name.', You have successifully created an account at Ekasline. You can now shop with us.<br><br>
        Thanks<br>
        <b>contact:</b><br>
        Ekasline <br>
        tel:+254724315581 ,+254722887028<br>
        Wangombe Waihura road, Nyeri, Kenya<br>

        web:www.ekasline.com<br>
        info@ekasline.com<br>
        technical@ekasline.com';
   

    $mail->send();
    echo json_encode(array("message" => "Message has been sent"));
} catch (Exception $e) {
    echo json_encode(array("message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));

}
}
?>