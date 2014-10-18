<?php
//Checks if the cookie is present
function checkcookie(){ 
if (!isset($_COOKIE['TUMsession']))
{
	//If the cookie has expired, direct to the login page
	header('Location: http://localhost/ScTeam11/login.html');
}
?>
