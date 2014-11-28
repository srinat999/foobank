<?php
require_once('DbConnector.php');

$newpass = $_POST['newpass'];
$cnewpass = $_POST['cnewpass'];
$post_username = $_POST['username']; //print_r($post_username);
$code = $_GET['c'];

if($newpass == $cnewpass)
{
		$hashpass = hash ('md5',$newpass);
		$db = new DbConnector;
        $query = "UPDATE users SET password = '$hashpass' WHERE username='$post_username'"; //print_r($query);
        $result = $db->execQuery($query);
        $query = "UPDATE users SET passreset = 'NULL' WHERE username= '$post_username'"; //print_r($query);
        $result = $db->execQuery($query);
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
						window.location.href = 'reset.php?c=$code';
					</script>
				</html>	
"; 
}



?> 
