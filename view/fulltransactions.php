<?php
	include '../web/checkcookie.php';
	include '../controllers/db.php';
	$result = mysql_query("SELECT * FROM transactions WHERE user_id=1");
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
			<td>Account</td><td>Amount</td><td>Date</td>
		</tr>
		<?php
			if($result) {
				while($row = mysql_fetch_array($result)) {
					echo "<tr><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td></tr>";
				}
			}
			mysql_close($con)
		?>
	</table>
</section>
</body>
</html>
