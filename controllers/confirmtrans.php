<?php
include 'db.php';
include 'utils.php';
include 'sessionutils.php';

if(!isSessionActive() || !enforceRBAC('customer')) {
	header("Location: ../view/login.html");
	die();
}
$userid=$_SESSION['uid'];
$src_account=$_SESSION['src_account'];
$dst_account=$_SESSION['dst_account'];
$amount=$_SESSION['amount'];
$dst_userid=$_SESSION['dst_userid'];
$description=$_SESSION['description'];

$tan=$_POST["tan"];
$tanInSession=$_SESSION['tan'];
$clientPIN = $_SESSION['clientPIN'];
if (($_SESSION['tranauth']=='email') && ($tanInSession!=$tan)) {
	mysql_close($con);
	$_SESSION['error']=3;
	header("Location: ../view/error.php");
	die();
} elseif ($_SESSION['tranauth']=='scs') {
	$result = shell_exec("java -jar ../securToken/securToken.jar $clientPIN $amount $dst_account $tan");
	if ($result=='false') {
		mysql_close($con);
		$_SESSION['error']=3;
		header("Location: ../view/error.php");
		die();
	}
} else {
	
}

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
