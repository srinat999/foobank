<?php

require_once 'DbConnector.php';
include 'tan.php';
$db = new DbConnector;
$values = array();
$values1= array();
$valuesx= array();
$t = time();
$timestamp = date('Y-m-d H:i:s', $t);

$sql = "Update users set is_active = 1   where user_id in (";
$sql1 = "Update users set activation_date = '$timestamp' where user_id in (";
$sqldelete = "Delete from users where user_id in (";


print_r($_POST);
foreach ($_POST as $key => $value){
    if ($_POST[$key] == "Accept")
    {   
        $values[] = $key;
    //echo $key;
    }
    elseif ($_POST[$key] == "Decline")
    {
           $values1[] = $key;
    
    }
}
$values = implode(',',$values);
$values .= ')';

$values1 = implode(',',$values1);
$values1 .= ')';

$sql .= $values;
$sql1 .= $values;
$sqldelete .=$values1;

//print_r($sqldelete);
//print_r($sql1);

$db->execQuery($sql); 
$db->execQuery($sql1);
$db->execQuery($sqldelete);
// Create a user account with balance 0 and send mail to user.
echo "i am here";

foreach ($_POST as $key => $value){
    if ($_POST[$key] == "Accept")
    {   
      $createaccount = "Insert INTO accounts(user_id,balance) VALUES('$key',0);";
        $db->execQuery($createaccount);
        
        $acc = "Select account_num from accounts where user_id = '$key';";
        $emailid = "Select email from users where user_id = '$key';";
        $accno = $db->execQuery($acc);
        $email = $db->execQuery($emailid);
        echo mysql_num_rows($accno);
        while(($retaccno = mysqli_fetch_array($accno)) && ( $em = mysqli_fetch_array($email)))
        {
            //echo $retaccno[0];
            //echo $em[0];
            genTAN($key,$retaccno[0],$em[0]);
            
        }
        
    }
              
}


$db -> closeConnection();
header('Location: employeelanding.php');
    

    
?>