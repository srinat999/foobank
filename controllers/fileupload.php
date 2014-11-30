<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'utils.php';
include 'db.php';
include 'sessionutils.php';

if(!isSessionActive() || !enforceRBAC('customer')) {
	header("Location: ../view/login.html");
	die();
}

$userid=$_SESSION['uid'];
$tan=$_POST["tan"];
$tanInSession=$_SESSION['tan'];
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

$batchstring=shell_exec("../exec/parsing /tmp/batchfile.txt");
$jsonobj=json_decode($batchstring);

if (!$jsonobj) {
	mysql_close($con);
	$_SESSION['error']=6;
	header("Location: ../view/error.php");
}
$invalidaccounts=array();
if (checkBalance($userid, $jsonobj->sum)) {
	foreach ($jsonobj->transactions as $transaction) {
		if (!doesAccountExist($transaction->destacc) || $transaction->amount<=0) {
			array_push($invalidaccounts, $transaction->destacc);
		} else {
			submitTrans(getAccountNumber($userid), $transaction->destacc, $transaction->amount, $userid);
		}
	}
	if (count($invalidaccounts)>0) {
		mysql_close($con);
		$_SESSION['invalid_acc']=$invalidaccounts;
		header("Location: ../view/error_numbers.php");
	} else {
		mysql_close($con);
		$_SESSION['message']=1;
		header("Location: ../view/succes.php");
	}
} else {
	mysql_close($con);
	$_SESSION['error']=5;
	header("Location: ../view/error.php");
}
?>
