<?php
include 'genuserid.php';
include 'DBconnections.php';
// Grab User submitted information
$uid = $_POST["username"];
$pass = $_POST["password"];
$email = $_POST["email"];
$fullname = $_POST["fullname"];
$account = $_POST["account"];
$repasswd=$_POST["repassword"];
$select= $_POST["typeselect"];


$t = time();
$timestamp = date('Y-m-d H:i:s', $t);


$hashpass = hash ('md5',$pass);
$db=new DBconnections();
$result=$db->isUserExist($uid);
if($result=='exist')
{
	echo "  <html>
    <script>
	    alert(\"Username Already exist! Please try another user name\");
		window.history.back();
	</script>
</html>	";
}
elseif($result=='notexist')
{
	$user_id=genUserid();
	if($db->insertUser( $uid, $fullname,$hashpass,$email,$select,$timestamp,$user_id)==1)
	{
		echo "  <html>
        <script>
            alert(\"Signup Successful! Please login now.\");
            window.location.href = '../view/login.html';
        </script>
    </html>	";
	}
}
/*
// Connect to the database
$con = mysql_connect("localhost","root","secret");
// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysql_select_db("foobank",$con);

$result = mysql_query("select * from users where username = '$uid'");
if(mysql_num_rows($result) > 0)
{
     echo "  <html>
    <script>
	    alert(\"Username Already exist! Please try another user name\");
		window.history.back();
	</script>
</html>	";
    
}
 
else
{
    
    $user_id=genUserid();
    if (!mysql_query("INSERT INTO users(username,fullname,password,email,role,registration_date,is_active,user_id) VALUES ( '$uid' , '$fullname' , '$hashpass', '$email' , '$select','$timestamp',0,$user_id) ;")) {
      die('Error: ' . mysql_error($con));

    }
    else
    {

      echo "  <html>
        <script>
            alert(\"Signup Successful! Please login now.\");
            window.location.href = '../view/login.html';
        </script>
    </html>	";
        //header('Location: ScTeam11/login.html');
    }
}
mysql_close($con);
*/

?>