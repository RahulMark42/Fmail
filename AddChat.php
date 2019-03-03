<?php
	session_start();
		
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	echo "<br>";
	
	$loggedUser = $_SESSION["LoggedUser"];
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$databasename = "Chat";
	
	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d h:i:s ', time());
	echo $date;
	
	$conn = mysqli_connect($servername,$username,$password,$databasename);
	
	if(!$conn) die("Connection Failed");
	else{
		if(isset($_GET['Contact'])){
			$loggedUserFull = $loggedUser."@Fmail.com";
			$toUser = $_GET['Contact'];
			$toUserFull = $toUser."@Fmail.com";
			$tableName =  $loggedUser.".".$toUser;
			echo $tableName;
		    $query1 = "CREATE TABLE `$tableName`(
				`ChatSender` varchar(100),
				`ChatBody` varchar(250),
				`ChatTime` datetime
				);";
			$query2 = "Insert into `'$tableName'` Values ('$loggedUserFull' , 'Please Be My Friend' , '$date');";
			if($conn -> query($query1) == TRUE){
				echo '1';
				echo "<br>";
				if($conn -> query($query2) == TRUE)
					echo "Succesfully Updated contact list";
				echo "<br>";
			}
			else{
				echo "Something went wrong please try again";
				echo "<br>";
			}
		}	
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<form action = "AddChat.php" method = "GET">
	<hr>
	Add Contact : <input type = "text" name = "Contact">
	<input type = "submit" value = "Add" id = "Add">
</form>
</body>
</html>