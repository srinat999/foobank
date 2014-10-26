<?php
include 'db.php';
include 'utils.php';
checkEmployee($_COOKIE['TUMsession']);
$account=$_POST['accno'];
$result = mysql_query("SELECT * FROM accounts WHERE account_num=$account");
session_start();
if (!$result) {
	mysql_close($con);
	$_SESSION['error']=7;
	header("Location: ../view/error.php");
} 
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../view/login.css">
<title>TUMonline Bank</title>
</head>
<body>
<section id="landingPage">
		<form method="post" class="minimal"
			action="../controllers/deletecookie.php">
			<button type="submit" class="btn-minimal" style="float: right;">Logout</button>
		</form>
		<h3 align="center">Search result</h3>

		<table align="center"
			style="width: 100%; border-spacing: 10px; padding: 20px; text-align: center">
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Account</th>
				<th>Balance</th>
				<th>Transactions</th>
			</tr>
		<?php
		session_start();
		$result = mysql_query ( "SELECT username, email, account_num, balance FROM users, accounts WHERE users.user_id = accounts.user_id AND accounts.account_num =$account" );
		$row = mysql_fetch_array ( $result );
		$_SESSION ['account'] = $row[2];
		if ($result) {
			echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td><a href=\"fulltransactions.php\">View</a></td></tr>";
		}
		?>
		</table>
		<a href="employeelanding.php">Back</a>
</section>
</body>
</html>