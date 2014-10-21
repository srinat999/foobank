<?php
include 'db.php';
include 'utils.php';

$tan=$_POST["tan"];
session_start();
$tanInSession=$_SESSION['tan'];
if ($tanInSession!=$tan) {
	header("Location: ../view/user-landing.php");
	mysql_close($con);
	die();
}

$src_account=$_SESSION['src_account'];
$dst_account=$_SESSION['dst_account'];
$amount=$_SESSION['amount'];
// Get this from session
$userid=1;
mysql_query("UPDATE tan_numbers SET expired=1 WHERE tan='$tan'");
submitTrans($src_account, $dst_account, $amount, $userid);
mysql_close($con);
if ($account>10000) {
	header("Location: ../view/invalid_account.html");
	die();
} else {
	header("Location: ../view/no_balance_error.html");
	die();
}
?>
