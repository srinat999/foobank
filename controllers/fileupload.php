<?php
include 'utils.php';
include 'db.php';

session_start();
$tan=$_POST["tan"];
$tanInSession=$_SESSION['tan'];
if ($tanInSession!=$tan) {
	mysql_close($con);
	$_SESSION['error']=3;
	header("Location: ../view/error.php");
}

//echo shell_exec("../exec/parsing /tmp/batchfile.txt");
$batchstring="{\"transactions\":[{\"account\":56998,\"amount\":1}, {\"account\":5678,\"amount\":1}],\"sum\":2}";
$jsonobj=json_decode($batchstring);

$invalidaccounts=[];
if (checkBalance(1, $jsonobj->sum)) {
	foreach ($jsonobj->transactions as $transaction) {
		if (!doesAccountExist($transaction->account)) {
			array_push($invalidaccounts, $transaction->account);
		} else {
			submitTrans(getAccountNumber(1), $transaction->account, $transaction->amount, 1);
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
	header("Location: ../view/errors.php");
}
?>
