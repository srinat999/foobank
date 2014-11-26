<?php

function isSessionActive() {
	session_start();
	$lastActivity=$_SESSION['lastActivity'];
	if ($lastActivity!=null && ($lastActivity+(10*60) > time())) {
		$_SESSION['lastActivity']=time();
		return true;	
	} else {
		deleteSession();
		return false;
	}
}

function deleteSession() {
	session_start();
	session_unset();
	session_destroy();
}

function enforceRBAC($role) {
	session_start();
	if($_SESSION['role']!=$role) {
		deleteSession();
		return false;
	} else {
		return true;
	}
}
?>