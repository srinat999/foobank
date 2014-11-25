<?php
include 'db.php';
include 'utils.php';

$tan=$_POST["tan"];
session_start();
$tanInSession=$_SESSION['tan'];
if ($tanInSession!=$tan) {
	mysql_close($con);
	$_SESSION['error']=3;
	header("Location: ../view/error.php");
	die();
}

$src_account=$_SESSION['src_account'];
$dst_account=$_SESSION['dst_account'];
$amount=$_SESSION['amount'];
$dst_userid=$_SESSION['dst_userid'];
$description=$_SESSION['description'];
// Get this from session
$userid=$_COOKIE['TUMsession'];
mysql_query("UPDATE tan_numbers SET expired=1 WHERE tan='$tan'");
submitTrans($src_account, $dst_account, $amount, $userid, $dst_userid, $description);
mysql_close($con);
if ($account>10000) {
	mysql_close($con);
	$_SESSION['message']=2;
	header("Location: ../view/succes.php");
} else {
	mysql_close($con);
	$_SESSION['message']=1;
	header("Location: ../view/succes.php");
}
?>
