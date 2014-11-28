<?php
include 'DBconnections.php';
#include 'cookieutils.php';
include 'sessionutils.php';

$db = new DBconnections ();
$username = $_POST ["username"];
$pass = $_POST ["password"];
$select = $_POST ["typeselect"];
$hashpass = hash ( "md5", $pass );
//echo $select;
$result = $db->login( $username, $hashpass, $select );
echo $result;
if ($result == 'fail') {
	deleteSession();
	echo "<html>
    <script>
	    alert(\"Login failed! Incorrect username or password.\");
		window.history.back();
	</script>
</html>";
	die();
} elseif ($result == 'roleerror') {
	deleteSession();
	echo "<html>
            <script>
	       alert(\"Login failed! Please check the role.\");
		      window.history.back();
	       </script>
        </html>";
	die();
} elseif ($result == 'userlogin') {
	$_SESSION['lastActivity']=time();
	$_SESSION['role']='customer';
	echo "  <html>
    <script>
    	window.top.location.href = '../controllers/user-landing.php';
	</script>
</html>	";
} elseif ($result == 'employeelogin') {
	$_SESSION['role']='employee';
	$_SESSION['lastActivity']=time();
	echo "  <html>  <script> window.top.location.href = '../controllers/employeelanding.php';
	               </script>
                   </html>	";
} else {
	$_SESSION['role']='admin';
	$_SESSION['lastActivity']=time();
	echo "  <html>
    <script>
        window.top.location.href = '../controllers/adminlanding.php';
	    
	</script>
</html>	";
}
?>
