<?php
	session_start();
	echo "Login Successful<br>";
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<h1><u>FMail.com</u></h1>
	<h3><u><i>Welcome to FMail!</i></u></h3>
	<hr>
	<a href = 'Inbox.php'>Inbox</a> <br>
	<a href = 'Chat.php'>Chat</a> <br>
	<a href = 'Compose.php'>Compose</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href = 'Logout.php'>Logout</a> <br>
	<a href = 'Sent.php'>Sent</a> <br>
	<a href = 'Drafts.php'>Drafts</a> <br>
	<a href = 'Trash.php'>Trash</a> <br>
</body>
</html>
	
