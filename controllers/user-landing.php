<?php
	include '../controllers/db.php';
	//include '../web/checkcookie.php';
	// Change this to userid in the session.
	$result = mysql_query("SELECT * FROM transactions WHERE (user_id=1 & is_approved=1) ORDER BY creation_date DESC");
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../view/login.css">
</head>
   
<body>
<h4 align="center">Welcome user!</h4>
<section id="landingPage">
	<h3 align="center">Transfer history</h3>
	<table align="center" style="width: 100%; border-spacing: 10px; padding: 20px; text-align: center">
		<tr>
			<td>Account</td><td>Amount</td><td>Date</td>
		</tr>
		<?php
			if($result) {
				$i=0;
				while(($row = mysql_fetch_array($result)) && ($i<3)) {
					echo "<tr><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
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
