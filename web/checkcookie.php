<?php
//Checks if the cookie is present
if (!isset($_COOKIE['TUMsession']))
{
	//If the cookie has expired, direct to the login page
	header('Location: ../view/login.html');
}
?>
