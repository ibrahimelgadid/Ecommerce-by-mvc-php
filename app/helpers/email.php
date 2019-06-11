<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function sendCode($vkey, $email){
//Load Composer's autoloader
require dirname(ROOT).'/vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'himaelgadid@gmail.com';                 // SMTP username
    $mail->Password = 'G010202396Mail25a';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    // $host = "smtp.gmail.com";
    // $port = "587";
    // $checkconn = fsockopen($host, $port, $errno, $errstr, 5);
    // if(!$checkconn){
    //     echo "($errno) $errstr";
    // } else {
    //     echo 'ok';
    // }
    //Recipients
    $mail->setFrom('himaelgadid@gmail.com', 'Hima');
    $mail->addAddress($email);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'Thank you for joining us your code :'.$vkey .
    ' '.'Now You Can Go <a href="http://localhost/projects/php/market/users/confirm/'.$vkey.'">Confirm Now</a>' ;
    $mail->AltBody = 'Thank you';

    $mail->send();
    $_SESSION['msg'] = 'Confirmtaion Message has been sent to your email';
    $_SESSION['email'] = $email;
    header('location:confirm.php');
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}}


function sendpass($email,$vkey){
    //Load Composer's autoloader
    require dirname(ROOT).'/vendor/autoload.php';
    
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'himaelgadid@gmail.com';                 // SMTP username
        $mail->Password = 'G010202396Mail25a';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
    
        // $host = "smtp.gmail.com";
        // $port = "587";
        // $checkconn = fsockopen($host, $port, $errno, $errstr, 5);
        // if(!$checkconn){
        //     echo "($errno) $errstr";
        // } else {
        //     echo 'ok';
        // }
        //Recipients
        $mail->setFrom('himaelgadid@gmail.com', 'Hima');
        $mail->addAddress($email);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        // //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    
        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'Now You Can Go <a href="http://localhost/projects/php/market/users/resetPassword/'.$vkey.'">New password</a>' ;
        $mail->AltBody = 'Thank you';
    
        $mail->send();
        $_SESSION['msg'] = 'Confirmtaion Message has been sent to your email';
        $_SESSION['email'] = $email;
        header('location:confirm.php');
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }}
    
