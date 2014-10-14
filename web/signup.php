<?php

// Grab User submitted information
$uid = $_POST["username"];
$pass = $_POST["password"];
$comp = $_POST["company"];
$fullname = $_POST["fullname"];
$address = $_POST["address"];
$repasswd=$_POST["repassword"];

// Connect to the database
$con = mysql_connect("localhost","root","");
// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysql_select_db("sudhi",$con);
//$result = mysql_query("SELECT * FROM login WHERE L_ID = '$uid';");
//echo $result;
//if ($result) 
  //  {
    //    echo "We are sorry Username already exists";
    //}
if($pass != $repasswd)
{
    
    ?>
<html>
    <script>
	    alert("Please enter identical passwords.");
		window.history.back();
	</script>
</html>	
<?php	
}
else
{
 if (!mysql_query("INSERT INTO LOGIN VALUES ( '$uid' , '$pass' , '$fullname', '$comp' , '$address') ;")) {
  die('Error: ' . mysql_error($con));
    
}
else
{
     header('Location: /Sudhi%20project/login.html');
    //echo "sign up successful!! Please login now";
}

mysql_close($con);
}

?>