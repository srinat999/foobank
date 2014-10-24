<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//#include 'logincookie.php';
// Grab User submitted information
$username = $_POST["username"];
$pass = $_POST["password"];
$select= $_POST["typeselect"];

//$username= mysql_real_escape_string($username);
//$pass= mysql_real_escape_string($pass);
$hashpass = hash("md5",$pass);
//echo $select;


// Connect to the database
$con = mysql_connect("localhost","root","samurai");
// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use 
mysql_select_db("foobank",$con);

/*
$query= 'SELECT username, password FROM user WHERE username = :username AND password = :password';
$stmt = $con->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $pass);
$stmt->execute();

*/

$result = mysql_query("select user_id from users where username = '$username' AND password = '$hashpass' AND role = '$select';");

if(mysql_num_rows($result) == 1)
    
{
	$t = mysql_fetch_array($result);
    setcookie("TUMsession", $t[0], time() + 600, "/");
   if($select == 'employee')
   {
  echo "  <html>
    <script>
		window.location.href = '/ScTeam11/employeelanding.php';
	</script>
</html>	";
   }
    elseif($select == 'user')
    {
    echo "  <html>
    <script>
    	window.location.href = '../controllers/user-landing.php';
	</script>
</html>	";
      //  echo "Welcome User";
    }
    elseif($select == 'admin')
    {
        echo "  <html>
    <script>
	    alert(\"Login Successful!.\");
        window.location.href = '../controllers/adminlanding.php';
	    
	</script>
</html>	";
        echo "Welcome Admin";
    }
 //header('Location: /ScTeam11/employeelanding.php');
}
else {

echo "<html>
    <script>
	    alert(\"Login failed! Incorrect username or password.\");
		window.history.back();
	</script>
</html>";	
}	
  mysql_close($con);
  
 ?>
