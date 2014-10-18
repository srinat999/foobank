<?php

include 'db.php';
$result = mysql_query("SELECT * from accounts where account_num=$account");
$row = mysql_fetch_array($result);

if(!$row) {
	alert("No account with that number exists");
	header("Location: user-landing.php");
	die();
} elseif($row[0]<$amount) {
	alert("You dont have sufficient balance for this transaction");
	header("Location: user-landing.php");
	die();
} else {
	$_SESSION['account']=$account;
	$_SESSION['amount']=$amount;
}
$userid=$_SESSION['userid'];
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
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
   
<body>
<h4 align="center">Welcome user!</h4>
<section id="landingPage">
	<h3>Single Transfer</h3>
		<form method="post" class="minimal" action="confirmtrans.php">
			<table cellpadding="0" cellspacing="0" border="0" width="90%">
				<tr>
					<td>
						<label for="username">
							Enter your tan corresponding to the number <?php echo "$tan_seq"?>:</br>
							<input type="text" name="tan" class="landingText" id="tan" required="required" />
						</label>
					</td>
				</tr>
			</table>
			<button type="submit" class="btn-minimal">Send</button>
		</form>
</section>
</body>	

</html>

