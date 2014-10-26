<?php
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
$con = mysql_connect("localhost","root","Shivguru096");
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

$result = mysql_query("select user_id,role from users where username = '$username' AND password = '$hashpass' AND is_active = 1");

if(mysql_num_rows($result) == 1)
    
{
	$t = mysql_fetch_array($result);
    setcookie("TUMsession", $t[0], time() + 600, "/");
   if($select == 'employee')
   {
       if($t[1] == 'employee')
       {
            echo "  <html>  <script> window.top.location.href = '../controllers/employeelanding.php';
	               </script>
                   </html>	";
       }
       else
       {
           echo "<html>
            <script>
	       alert(\"Login failed! Please check the role.\");
		      window.history.back();
	       </script>
        </html>";
       }
   }
    elseif($select == 'user')
    {
         if($t[1] == 'user')
       {
    echo "  <html>
    <script>
    	window.top.location.href = '../controllers/user-landing.php';
	</script>
</html>	";
        }
         else
       {
           echo "<html>
            <script>
	       alert(\"Login failed! Please check the role.\");
		      window.history.back();
	       </script>
        </html>";
       }
        
    
    }
    elseif($select == 'admin')
    {
         if($t[1] == 'admin')
       {
        echo "  <html>
    <script>
        window.top.location.href = '../controllers/adminlanding.php';
	    
	</script>
</html>	";
        }
         else
       {
           echo "<html>
            <script>
	       alert(\"Login failed! Please check the role.\");
		      window.history.back();
	       </script>
        </html>";
       }

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
