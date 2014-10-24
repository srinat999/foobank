<?php
	include '../controllers/db.php';
	include '../web/checkcookie.php';
	session_start();
	$account = $_SESSION['account'];
	$result = mysql_query("SELECT * FROM transactions WHERE ((source_account=$account OR destination_account=$account) AND is_approved=1) ORDER BY creation_date DESC");
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="fulltransactions.css">
</head>
   
<body>
<section id="loginBox">
	<h3 align="center">Transfer history</h3>
	<table align="center">
		<tr>
			<td>Source Account</td><td>Destination Account</td><td>Amount</td><td>Date</td>
		</tr>
		<?php
			if($result) {
				while($row = mysql_fetch_array($result)) {
					echo "<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
				}
			}
			mysql_close($con)
		?>
	</table>
</section>
</body>
</html>
