<?php
	session_start();
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	$loggedUser = $_SESSION["LoggedUser"];
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$databasename = "Mail";
	$conn = mysqli_connect($servername,$username,$password,$databasename);
	if(!$conn) die("Connection Failed");
	else{
		$query = 'SELECT * FROM ALLINBOXEMAIL';
		$conn -> query($query);
	}
?>
<h1><u>FMail.com</u></h1>
<h3><u><i>Welcome to FMail!</i></u></h3><hr>
<h4><u><b><i>Inbox</i></b></u></h4>

