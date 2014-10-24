<?php
//Checks if the cookie is present
function checkcookie(){
if (!isset($_COOKIE['TUMsession']))
{
header('Location: http://localhost/ScTeam11/login.html');
}
?>