<?php
	include '../controllers/db.php';
	include '../web/checkcookie.php';
$userid=$_COOKIE['TUMsession'];    
if (isset($_COOKIE['TUMsession']))
{
unset($_COOKIE['TUMsession']);
setcookie("TUMsession", $userid, time() + 600, "/");
}
	session_start();
	$account = $_SESSION['account'];
	$result = mysql_query("SELECT * FROM transactions WHERE ((source_account=$account OR destination_account=$account)) ORDER BY creation_date DESC");
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../view/fulltransactions.css">
</head>
   
<body>
<section id="loginBox">
	<h2 align="center">Transfer history</h2>
	
    
    <form method="post" class="minimal" action="../controllers/pdfgenerator.php">
        <input type="hidden" name="PDF" value="<?php echo $account; ?>"> 
        <button type="submit" class="btn-minimal" >Download PDF</button>
    </form>
	
    <table align="center">
		<tr>
			<th>Source Account</th><th>Destination Account</th><th>Amount</th><th>Date</th><th>Status</th>
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
