<?php
	include '../controllers/db.php';
	include '../web/checkcookie.php';
	session_start();
	$account = $_SESSION['account'];
	$result = mysql_query("SELECT * FROM transactions WHERE ((source_account=$account OR destination_account=$account) AND is_approved=1) ORDER BY creation_date DESC");
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../view/fulltransactions.css">
</head>
   
<body>
<section id="loginBox">
	<h3 align="center">Transfer history</h3>
	<a href="pdfgenerator.php">Download as PDF</a>
	<table align="center">
		<tr>
			<td>Source Account</td><td>Destination Account</td><td>Amount</td><td>Date</td><td>Status</td>
		</tr>
		<?php
			if($result) {
				while($row = mysql_fetch_array($result)) {
					echo "<tr><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td>";
					switch ($row[5]){
						case 0:
							echo "<td>Pending Approval</td>";
							break;
						case 1:
							echo "<td>Approved</td>";
							break;
						case 2:
							echo "<td>Rejected</td>";
							break;
					}
					echo "</tr>";
				}
			}
			mysql_close($con)
		?>
	</table>
</section>
</body>
</html>
