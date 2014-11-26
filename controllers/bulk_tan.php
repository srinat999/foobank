<?php
include 'db.php';
include 'utils.php';
include 'sessionutils.php';

if(!isSessionActive() || !enforceRBAC('customer')) {
	header("Location: ../view/login.html");
	die();
}
$userid=$_SESSION['uid'];
move_uploaded_file($_FILES["batchfile"]["tmp_name"], "/tmp/batchfile.txt");
while(true) {
	$tan_seq=rand(0,99);
	$result=mysql_query("SELECT tan,expired from tan_numbers where seq_number=$tan_seq and user_id=$userid");
	$row=mysql_fetch_array($result);
	if ($row[1]==0) {
		$_SESSION['tan']=$row[0];
		break;
	} 
}
mysql_close($con);
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../view/login.css">
</head>
   
<body>
<h4 align="center">Welcome user!</h4>
<section id="landingPage">
	<h3>Single Transfer</h3>
		<form method="post" class="minimal" action="fileupload.php">
			<table cellpadding="0" cellspacing="0" border="0" width="90%">
				<tr>
					<td>
						<label for="username">
							Enter your tan corresponding to the number <?php echo "$tan_seq"?>:</br>
							<input type="text" name="tan" class="landingText" id="tan" required="required" />
						</label>
					</td>
				</tr>
			</table>
			<button type="submit" class="btn-minimal">Send</button>
		</form>
</section>
</body>	

</html>

