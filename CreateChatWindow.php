<?php
	session_start();
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	echo "<br>";
	$toUser = $_SESSION["toUser"];
	$loggedUser = $_SESSION["LoggedUser"];
	$loggedUserFull = $loggedUser."@FMail.com";
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$databasename = "Chat";
	$conn = mysqli_connect($servername,$username,$password,$databasename);
	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d h:i:s ', time());
	echo $date;
	if(!$conn) die("Connection Failed");		
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitChat'])):
		if(isset($_POST['inputChat']) && $_POST['inputChat'] != ""):	
			$chatBody = $_POST['inputChat'];
			$query = "INSERT INTO `chatlog`(`FromUser`, `ToUser`, `ChatBody`, `ChatTime`) VALUES ('$loggedUserFull' , '$toUser' , '$chatBody','$date' );";
			//$query = "INSERT INTO CHATLOG VALUES '$loggedUserFull','$toUser','$chatBody','$date';";
			if($conn -> query($query) == TRUE) echo "Succesfully added";
			else echo "Failed";
		else: echo "Couldn't add";
		endif;
	endif;
		
	?>
<form action = "CreateChatWindow.php" method = "POST">
<h1><u>FMail.com</u></h1>	
<h3><u><i>Chat with <?php echo $toUser; ?></i></u></h3>
<hr>
<input type = "text" name = "inputChat">
<input type = "submit" value = "Send" name = "submitChat">
</form>

