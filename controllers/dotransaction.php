<?php
include 'db.php';
include 'utils.php';
include '../web/checkcookie.php';
// Change this to userid in the session.

$userid=$_COOKIE['TUMsession'];
if (isset($_COOKIE['TUMsession']))
{
unset($_COOKIE['TUMsession']);
setcookie("TUMsession", $userid, time() + 600, "/");
}
// Get this from session.
session_start();
$account=$_POST["account"];
$amount=$_POST["amount"];
$result = mysql_query("SELECT * from accounts where user_id=$userid");
$row = mysql_fetch_array($result);
if ($row[2]==$account) {
	mysql_close($con);
	$_SESSION['error']=2;
	header("Location: ../view/error.php");
} elseif ($amount<=0) {
	mysql_close($con);
	$_SESSION['error']=4;
	header("Location: ../view/error.php");
} elseif (!doesAccountExist($account)) {
	mysql_close($con);
	$_SESSION['error']=1;
	header("Location: ../view/error.php");
} elseif (!checkBalance($userid, $amount)) {
	mysql_close($con);
	$_SESSION['error']=5;
	header("Location: ../view/error.php");
} else {
	$_SESSION['dst_account']=$account;
	$_SESSION['amount']=$amount;
	$_SESSION['src_account']=$row[2];
}
while(true) {
	$tan_seq=rand(0,99);
	$result=mysql_query("SELECT tan,expired from tan_numbers where seq_number=$tan_seq and user_id=$userid");
	$row=mysql_fetch_array($result);
	if ($row[1]==0) {
		$_SESSION['tan']=$row[0];
		break;
	} 
}
mysql_close($con);
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../view/login.css">
</head>
   
<body>
<h4 align="center">Welcome user!</h4>
<section id="landingPage">
	<h3>TAN Entry</h3>
		<form method="post" class="minimal" action="confirmtrans.php">
			<table cellpadding="0" cellspacing="0" border="0" width="90%">
				<tr>
					<td>
						<label for="username">
							Enter your tan corresponding to the number <?php echo "$tan_seq"?>:</br>
							<input type="text" name="tan" class="landingText" id="tan" required="required" pattern="^[a-zA-Z0-9]{15}$" />
						</label>
					</td>
				</tr>
			</table>
			<button type="submit" class="btn-minimal">Send</button>
		</form>
</section>
</body>	

</html>

