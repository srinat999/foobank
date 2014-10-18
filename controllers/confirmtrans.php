<?php
if ($_SESSION['tan']!=$tan) {
	alert("You have entered an invalid TAN");
	header("Location: user-landing.php");
	die();
}

include 'db.php';
if ($_SESSION['account']>10000) {
	mysql_query("INSERT INTO transactions (user_id, source_account, destination_account, amount) values ($_SESSION['userid'], $[])")
} else {

}
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
