<?php
	session_start();
	session_destroy();
	$_SESSION = array();
	echo "You Have been Successfully Logged out";
	include 'Mail.php';
?>