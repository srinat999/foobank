<?php
	include '../controllers/db.php';
	$result = mysql_query("SELECT * FROM transactions WHERE user_id=1");
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="login.css">
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
				while(($row = mysql_fetch_array($result)) || ($i<3)) {
					echo "<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
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
		<form method="post" class="minimal" action="login.php">
			<table cellpadding="0" cellspacing="0" border="0" width="90%">
				<tr>
					<td>
						<label for="username">
							Account No.:</br>
							<input type="text" name="username" class="landingText" id="username" placeholder="Username must be between 8 and 20 characters" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$" required="required" />
						</label>
					</td>
					<td>
					<label for="password">
						Amount:</br>
						<input type="password" name="password" class="landingText" id="password" placeholder="Password must contain 1 uppercase, lowercase and number" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
					</label>
					</td>
				</tr>
			</table>
			<button type="submit" class="btn-minimal">Send</button>
		</form>
</section>
<section id="landingPage">
	<h3>Bulk Transfer</h3>
	<form method="post" class="minimal" action="login.php">
			<table cellpadding="0" cellspacing="0" border="0" width="90%">
				<tr>
					<td>
						<label for="username">
							File:</br>
							<input type="file" name="username" class="landingText" id="username" placeholder="Username must be between 8 and 20 characters" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$" required="required" />
						</label>
					</td>
				</tr>
			</table>
			<button type="submit" class="btn-minimal">Send</button>
		</form>
</section>
</body>	

</html>