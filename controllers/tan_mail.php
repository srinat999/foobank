<?php
require_once('../lib/PHPMailer/PHPMailerAutoload.php');
function tan_mail($email_address)
{
    $mail = new PHPMailer(); // defaults to using php "mail()"
    
    $body = "<p>Dear Customer,<br><br> Please find your attached TAN list. The list is password protected. 
		The password is combination first four characters of your full name and 
		your userid. <br><br> Thank You for banking with us.</p>";
    
    $mail->SetFrom('securebankingcode@gmail.com', 'TUM International Bank');
    
    //$mail->AddReplyTo("name@yourdomain.com","First Last");
    
    $address = $email_address;
    $mail->AddAddress($address);
    $mail->Subject = "TAN List from TUM International Bank";
    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test		
    $mail->MsgHTML($body);
    $mail->AddAttachment("TANList.pdf"); // attachment
    
    		 if(!$mail->Send()) {
    		   echo "Mailer Error: " . $mail->ErrorInfo;
    		 } else {
   		   echo "Message sent!";
    		 }

    unlink("TANList.pdf");
}
//echo tan_mail("vikky_manit@yahoo.co.in");
?>

