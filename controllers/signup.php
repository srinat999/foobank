<?php
include 'genuserid.php';
include 'db.php';

// Grab User submitted information
$uid = $_POST ["username"];
$pass = $_POST ["password"];
$email = $_POST ["email"];
$fullname = $_POST ["fullname"];
$account = $_POST ["account"];
$repasswd = $_POST ["repassword"];
$role = $_POST ["typeselect"];
$tranauth = $_POST["tranauth"];

$t = time ();
$timestamp = date ( 'Y-m-d H:i:s', $t );

$hashpass = hash ( 'md5', $pass );

// Make sure we connected succesfully
if (! $con) {
	die ( 'Connection Failed' . mysql_error () );
}

$result = mysql_query ( "select * from users where username = '$uid'" );
if (mysql_num_rows ( $result ) > 0) {
	echo "  <html>
    <script>
	    alert(\"Username Already exist! Please try another user name\");
		window.history.back();
	</script>
</html>	";
} 

else {
	
	$user_id = genUserid ();
	if (! mysql_query ( "INSERT INTO users(username,fullname,password,email,role,registration_date,is_active,user_id,tranauth) VALUES ( '$uid' , '$fullname' , '$hashpass', '$email' , '$role','$timestamp',0,$user_id,'$tranauth') ;" )) {
		die ( 'Error: ' . mysql_error ( $con ) );
	} else {
		
		echo "  <html>
        <script>
            alert(\"Signup Successful! Please login now.\");
            window.location.href = '../view/login.html';
        </script>
    </html>	";
		// header('Location: ScTeam11/login.html');
	}
}
mysql_close ( $con );

?>