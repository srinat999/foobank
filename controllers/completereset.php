<?php
require_once('DbConnector.php');
include 'validations.php';

$newpass = $_POST['newpass'];
$cnewpass = $_POST['cnewpass'];
$post_username = $_POST['username']; //print_r($post_username);
$code = $_GET['c'];

$v=new validations();
if($v->passwordMatch($newpass)!=1 || $v->passwordMatch($cnewpass)!=1)
{
	echo "<html>
			<script>
				alert(\"Please check your password.\");
				window.history.back();
			</script>
	    </html>";
		die();
}
if($v->usernameMatch($post_username)!=1)
{
	echo "<html>
			<script>
				alert(\"Password recovery failed.\");
				window.history.back();
			</script>
	    </html>";
		die();
}

if($newpass == $cnewpass)
{
		$hashpass = hash ('md5',$newpass);
		$db = new DbConnector;
		$result = $db->updatePassword($hashpass,$post_username);
        
echo "  
				<html>
					<script>
						alert(\"Your password has been reset successfully\");
						window.location.href = '../view/login.html';
					</script>
				</html>	
";
	}
else
{
echo "	  
				<html>
					<script>
						alert(\"Failed to reset password please try again\");
						
						window.history.back();
					</script>
				</html>	
"; 
}



?> 
