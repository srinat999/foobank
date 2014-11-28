<?php
require_once('DbConnector.php');
       
    if($_GET['c'])
    {
        $get_code = $_GET['c']; 
        $db = new DbConnector;
        $query = "SELECT user_id,passreset,username FROM users where passreset='$get_code'"; //print_r($query);
        $result = $db->execQuery($query); 
        $numrows = mysqli_num_rows($result);
        //print_r($numrows);
		if($numrows == 1)
		{	
	        $Results = mysqli_fetch_assoc($result); 
			$db_code = $Results['passreset'];
			$db_username = $Results['username']; //print_r($db_username);
			if($get_code == $db_code)
			{
?>				
				  <!DOCTYPE html>
				  <html>
					    <head>
							<link rel="stylesheet" type="text/css" href="../view/login.css">
						</head>
						<body>
						<section id="loginBox">
						
						<form name='forgotpassword' class='minimal' action='completereset.php?c=$get_code' onsubmit='validateForm();' method='post'>
				  		<label for="password">
						Password:
						<input type="password" name="newpass" id="newpass" placeholder="Password must contain 1 uppercase, lowercase and number" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
						</label>
				  		<label for="password">
						Confirm Password:
						<input type="password" name="cnewpass" id="cnewpass" placeholder="Password must contain 1 uppercase, lowercase and number" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
						</label>
					<button type="submit" class="btn-minimal" name="submit">Update Password</button>
				  <input type='hidden' name='username' value='<?php echo $db_username; ?>'>
				  
				  </form> 
				  </body>
				  </section>
				  </html>
<?php				  
			}
		}
		else 
		{
			echo "
			<html>
					<script>
								alert(\"Password Recovery Failed. Please make sure you have requested for password reset.\");
								window.location.href = '../view/forgotpassword.html';
							</script>
						</html>	
			";
	 	}
    }
    
	else {
		echo "
				<html>
					<script>
								alert(\"Password Recovery Failed,\");
								window.location.href = '../view/forgotpassword.html';
							</script>
						</html>		
				";				
	 	}
	    
	    
     
?>
