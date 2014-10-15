<?php

include 'db.php';

$result = mysql_query("SELECT * FROM transactions WHERE user_id='$userId'");

$transactions = mysql_fetch_array($result);

mysql_close($con);

?>
