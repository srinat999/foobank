<?php
// Connect to the database
$con = mysql_connect("localhost","root","samurai");
// Make sure we connected succesfully
if(! $con)
{
die('Connection Failed'.mysql_error());
}
// Select the database to use
mysql_select_db("foobank",$con);
?>