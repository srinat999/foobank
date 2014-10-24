<?php
include 'db.php';

function doesAccountExist($account) {
	$result = mysql_query("SELECT * from accounts where account_num='$account'");
	$row = mysql_fetch_array($result);
	if (!$row) {
		return false;
	} else {
		return true;
	}
}

function checkBalance($userid, $amount) {
	$result = mysql_query("SELECT * from accounts where user_id='$userid'");
	$row = mysql_fetch_array($result);
    echo "Balance is $row[0]";
    echo "Amount is $amount";
	if ($row[0]<$amount) {
		return false;
	} else {
		return true;
	}
}

function submitTrans($src_account, $dst_account, $amount, $userid) {
	if ($amount>10000) {
		mysql_query("INSERT INTO transactions (user_id, source_account, destination_account, amount) values ('$userid', '$src_account', '$dst_account', '$amount')");
	} else {
		mysql_query("INSERT INTO transactions (user_id, source_account, destination_account, amount, is_approved) values ('$userid', '$src_account', '$dst_account', '$amount', 1)");
		mysql_query("UPDATE accounts SET balance=balance-$amount where account_num=$src_account");
		mysql_query("UPDATE accounts SET balance=balance+$amount where account_num=$dst_account");
	}
}

function getAccountNumber($userid) {
	$result = mysql_query("SELECT account_num from accounts where user_id=$userid");
	$row = mysql_fetch_array($result);
	return $row[0];
}
}
?>
