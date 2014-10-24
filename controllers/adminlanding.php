<?php
require_once 'DbConnector.php';

$db = new DbConnector;
$valuesaccept = array();
$valuesreject = array();
$t = time();
$timestamp = date('Y-m-d H:i:s', $t);

$sqlaccept = "Update users set is_active = 1 where user_id in (";
$sql1 = "Update users set activation_date = '$timestamp' where user_id in (";

$sqlreject = "Delete from users where user_id in (";
//print_r($_POST);
foreach ($_POST as $key => $value){
    if ($_POST[$key] == "Accept")
        $valuesaccept[] = $key;
    elseif ($_POST[$key] == "Decline")
        $valuesreject[] = $key;
}

$valuesaccept = implode(',',$valuesaccept);
$valuesaccept .= ')';

$valuesreject = implode(',',$valuesreject);
$valuesreject .= ')';

$sqlaccept .= $valuesaccept;
$sqlreject .= $valuesreject;
$sql1 .= $valuesaccept;
//print_r($sql);
$db->execQuery($sqlaccept);
$db->execQuery($sqlreject);
$db->execQuery($sql1);



// mysqli_close($Conn);
//header('Location: /ScTeam11/employeelanding.php');

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="adminlanding.css">
    </head>
    <body>
        <h4 align="center">Welcome Admin!</h4>
            <section id="landingPage">
                Hello, today is <?php echo date('l, F jS, Y'); ?>.
            <table>
                <caption>Pending Employee Approvals</caption>
            <tr>
                <th>Employee ID</th><th>Name</th><th>Registration Date</th><th>Email</th><th>Accept or Decline</th>
            </tr>

<?php
//Establish the database connection

$result = $db -> execQuery("SELECT user_id,username,fullname,registration_date,email FROM users WHERE is_active = 0 and role = \"employee\"");
$numrows = mysqli_num_rows($result);
//echo $numrows;
if($numrows==0)
{
    echo "</table>";
    echo "<h4> No pending requests </h4>";
}
else
{
    ?>
        <form method="post" class="minimal" action="adminlanding.php">
            <?php
                for($i=0; $i<$numrows; ++$i) {
                     $transactions = mysqli_fetch_assoc($result);
                    ?>
                        <tr>
                            <td><?php echo $transactions['username']; ?></td>
                            <td><?php echo $transactions['fullname']; ?></td>
                            <td><?php echo $transactions['registration_date']; ?></td>
                            <td><?php echo $transactions['email']; ?></td>
                            <td><input type="radio" name=<?php echo $transactions['user_id']; ?>  value="Accept" id="accept" >Accept</input>
                            <input type="radio" name=<?php echo $transactions['user_id']; ?>  value="Decline" id= "decline" >Decline</input></td>
                        </tr>
                    <?php

                }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" value="Done">
                </td>
            </tr>
                </table>
        </form>
    <?php
}
$db -> closeConnection();
?>

</body>
</html>
