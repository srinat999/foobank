<?php
	include '../controllers/db.php';
	include '../web/checkcookie.php';
	// Change this to userid in the session.
	$userid=$_COOKIE['TUMsession'];
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../view/login.css">
</head>
   
<body>
<h4 align="center">Welcome user!</h4>
<section id="landingPage">
	<h3 align="center">Account status</h3>
	<table align="center" style="width: 100%; border-spacing: 10px; padding: 20px; text-align: center">
		<tr>
			<td>Account</td><td>Amount</td>
		</tr>
		<?php
			session_start();
			$result = mysql_query("SELECT balance,account_num FROM accounts WHERE user_id=$userid");
			$row = mysql_fetch_array($result);
			$account = $row[1];
			$_SESSION['account']=$account;
			if($result) {
				echo "<tr><td>$row[1]</td><td>$row[0]</td></tr>";
			}
		?>
	</table>
</section>
<section id="landingPage">
	<h3 align="center">Transfer history</h3>
	<table align="center" style="width: 100%; border-spacing: 10px; padding: 20px; text-align: center">
		<tr>
			<td>Source Account</td><td>Destination Account</td><td>Amount</td><td>Date</td>
		</tr>
		<?php
			$result = mysql_query("SELECT * FROM transactions WHERE ((source_account=$account OR destination_account=$account) AND is_approved=1) ORDER BY creation_date DESC");
			if($result) {
				$i=0;
				while(($row = mysql_fetch_array($result)) && ($i<3)) {
					echo "<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
					$i++;
				}
			}
			mysql_close($con)
		?>
	</table>
	<a href="fulltransactions.php">More</a>
</section>
<section id="landingPage">
	<h3>Single Transfer</h3>
		<form method="post" class="minimal" action="../controllers/dotransaction.php">
			<table cellpadding="0" cellspacing="0" border="0" width="90%">
				<tr>
					<td>
						<label for="username">
							Account No.:</br>
							<input type="text" name="account" class="landingText" id="account" required="required" />
						</label>
					</td>
					<td>
						<label for="password">
							Amount:</br>
							<input type="text" name="amount" class="landingText" id="amount" required="required"/>
						</label>
					</td>
				</tr>
			</table>
			<button type="submit" class="btn-minimal">Send</button>
		</form>
</section>	
<section id="landingPage">
	<h3>Bulk Transfer</h3>
	<form method="post" class="minimal" action="../controllers/bulk_tan.php" enctype="multipart/form-data">
			<table cellpadding="0" cellspacing="0" border="0" width="90%">
				<tr>
					<td>
						<label for="username">
							File:</br>
							<input type="file" name="batchfile" class="landingText" id="batchfile" />
						</label>
					</td>
				</tr>
			</table>
			<button type="submit" class="btn-minimal">Send</button>
		</form>
</section>
</body>	

</html>
