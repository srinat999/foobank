<?php
include 'tan_mail.php';
require_once 'DbConnector.php';
function genTAN($user_id,$accountNo,$email){
echo $user_id;
echo $accountNo;
    echo $email;
//Under the string $Characters write all the characters you want to be used to randomly generate the code.
$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZabcdefghijklmnopqrstuvwxyz0123456789';
$CaracteresLen = strlen($Caracteres);
$CaracteresLen--;
$TanNo = array();
$Count = 0;

//Establish the database connection
$db = new DbConnector;

//Generate 100 Tan numbers
while($Count<100){
	$Hash=NULL;
		for($x=1;$x<=15;$x++){
			$Pos = rand(0,$CaracteresLen);
			$Hash .= substr($Caracteres,$Pos,1);
		}
		
	//Check if any duplicate Tan number exists in the database
	$result = $db->execQuery("SELECT tan FROM tan_numbers WHERE tan = '$Hash'");
	if(mysqli_num_rows($result) == 0) {
		$TanNo[$Count++] = $Hash;
	}
}

//Block insert the generated Tan numbers into the database
$values = array();
$seq = 1;
foreach($TanNo as $value){
    $values[] = '('.$user_id . ',' . $seq++ . ',"' . $value. '",' . '"2015-12-12",' . 0 . ')';
}

$query = "INSERT INTO tan_numbers (user_id,seq_number,tan,expiry_date,expired) VALUES ".implode( ',', $values );

if(!$db->execQuery($query)){
	echo "Database Error. Please try again later.";
	exit("Error Occured");
}

//mysqli_close($Conn);
$db -> closeConnection();
echo $query;
tan_mail($TanNo,$email,$accountNo);
}
//echo genTAN(2,12345,"vikkymanit@yahoo.co.in");
?>
