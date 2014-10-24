<?php
	function tan_mail($TANList,$email,$accountNo){
	$email_subject = "Your TAN List";
	$email_address = $email;
	$email_message = "Dear Customer,". "\n\n" ."We have activated your account. Please find your Account Number and TAN List below.\n";
	$email_message .= "\n Account Number : " . $accountNo . "\nYour Tan List:\n"; 
	for($i=0;$i<100;$i++)
	{
		$email_message .= $i+1 . "->" . $TANList[$i]. "\n";        //The TAN list
	}	
	$email_message .= "\n\n Thank You for banking with us.";
	mail($email_address,$email_subject,$email_message,'From: securebankingcode@gmail.com');
	}
?>
