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
		    $query = "Insert into ChatLog (FromUser , ToUser , ChatBody , ChatTime) Values ('$loggedUserFull','$toUser','Please Be My Friend','$date');";
			$query1 = "Insert into ChatLog (ToUser , FromUser , ChatBody , ChatTime) Values ('$toUser','$loggedUserFull','Please Be My Friend','$date');";
			if($conn -> query($query) == TRUE){
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
<form action = "AddChat.php" method = "GET">
	<hr>
	Add Contact : <input type = "text" name = "Contact">
	<input type = "submit" value = "Add" id = "Add">
</form>