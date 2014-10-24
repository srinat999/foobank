<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'utils.php';
include 'db.php';

session_start();
$userid=$_COOKIE['TUMsession'];
echo $userid;
echo $_SESSION['account'];
echo "<html><script>alert(\"success\");</script></html>";
$tan=$_POST["tan"];
$tanInSession=$_SESSION['tan'];
if ($tanInSession!=$tan) {
	mysql_close($con);
	$_SESSION['error']=3;
	header("Location: ../view/error.php");
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
