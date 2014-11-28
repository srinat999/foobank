<?php
require_once('DbConnector.php');
require_once('../lib/PHPMailer/PHPMailerAutoload.php');
if(isset($_POST['submit'])) 
{       //echo "1";   
		$username = $_POST['username']; 
		$email = $_POST['email'];
		$db = new DbConnector;
		$query = "SELECT user_id, email FROM users where username='$username'";
        $result = $db->execQuery($query); 
        $numrows = mysqli_num_rows($result);
        //print_r($numrows);
		if($numrows!=0)
		{	
				$row = mysqli_fetch_assoc($result);
				print_r($row);
				$db_email = $row['email']; 
				$userid = $row['user_id']; 
				if($email == $db_email)
				{	
					//$code = md5(90*13+$Results['userid']);
					$code = md5(rand(999, 99999)+$Results['userid']);
					$mail = new PHPMailer();
					$mail->SetFrom('securebankingcode@gmail.com', 'TUM International Bank');
					$address = $email;
					$mail->AddAddress($address);
					$mail->Subject = "Forget Password";
					$body = "<p><br>Click here to reset your password https://localhost/foobank/controllers/reset.php?c=$code </p>";
					$mail->MsgHTML($body);
					$mail->Send();
/*					if(!$mail->Send()) {
						   echo "Mailer Error: " . $mail->ErrorInfo;
						 } else {
					   echo "Message sent!";
						 }
*/						 
					$db->execQuery("Update users SET passreset = '$code' WHERE username = '$username'");	
					
					 echo " 
						<html>
							<script>
								alert(\"Your password reset link sent to your e-mail address\");
								window.location.href = '../view/forgotpassword.html';
							</script>
						</html>	
				";	
				}
				else
				{
	
						
						
					echo "
					<html> 
						<script>
						 		alert(\"Incorrect email\");
								window.location.href = '../view/forgotpassword.html';  
							</script>
							 
						 </html> 
					";
				}
				
			
		}
		else
		{
			  
		echo "	
		<html>
					<script>
					alert(\"Username does not exists\");
					window.location.href = 'forgotpassword.html';
				</script>
			</html>	
		";
		}

}
   
?>
