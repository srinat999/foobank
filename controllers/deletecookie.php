<?php
if(isset($_COOKIE['TUMsession'])) {
	unset($_COOKIE['TUMsession']);
	setcookie('TUMsession', null, -1, '/');
	header("Location: ../view/login.html");
}
?>