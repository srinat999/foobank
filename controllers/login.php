<?php

include 'db.php';

$result = mysql_query("SELECT L_ID, L_PWD FROM login WHERE L_ID = '$email';");

$row = mysql_fetch_array($result);


if($row["L_ID"]==$email && $row["L_PWD"]==$pass)
{
   
  echo "  <html>
    <script>
	    alert(\"Login Successful!.\");
		
	</script>
</html>	";

 header('Location: /Sudhi%20project/Userpage.html');
}
else {
?>
<html>
    <script>
	    alert("Login failed! Incorrect username or password.");
		window.history.back();
	</script>
</html>	
<?php	
}	
  mysql_close($con);
  
 ?>
