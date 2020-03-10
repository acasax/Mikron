<?php
/**
 * Created by PhpStorm.
 * User: sax
 * Date: 10/3/2019
 * Time: 10:57
 */
define('SITE_ROOT', __DIR__);
require SITE_ROOT."/../component/vendor/autoload.php";
   require_once SITE_ROOT.'/../mailer/PHPMailer-master/class.phpmailer.php' ;
   include SITE_ROOT.'/../mailer/PHPMailer-master/class.smtp.php';


class User
{
   private $conn;

   public function __construct()
   {
   }


    function send_mail($email, $message, $subject)
    {
       $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //$mail->SMTPDebug  = 2;
        $mail->SMTPAuth = true;
      /*  $mail->SMTPSecure = "tls";  // ovo je za domen
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;*/
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->AddAddress("acasax@gmail.com"); //email unesi tvoj email
        $mail->Username = "acasax@gmail.com"; //email
        $mail->Password = "Android1234!"; //password
        $mail->SetFrom($email, 'Mikron');
        $mail->AddReplyTo($email, "Mikron");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);

        if(!$mail->Send()){
            throw new Exception("Nije moguce poslati email. Pokusajte ponovo.");
            return false;
        }else{
            return true;
        }
    }



}