<?php
	session_start();
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	echo "<br>";
	$loggedUser = $_SESSION["LoggedUser"];
	$loggedUserFull = $loggedUser."@FMail.com";
	$str = $_SESSION["tableName"]; 

	//To get the recepients values
	$l = strlen($str);
    for($i= 0; $i < $l ; $i++){
        if($str[$i] == '.'){
            $c = $i;
            break;  
        }
    }
    $c1 = "";
	$c2 = "";
	$toUser = "";
    for($j = 0; $j < $c; $j++){
        $c1[$j] = $str[$j];
    }
    for($k = $c + 1; $k < $l; $k++){
        $c2[$k] = $str[$k];
	}
	if($c1 == $loggedUser) $toUser = $c2;
	else $toUser = $c1;

	$toUserFull = $toUser."@Fmail.com";

	//Connection to database
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$databasename = "Chat";
	$conn = mysqli_connect($servername,$username,$password,$databasename);
	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d h:i:s ', time());
	echo $date; ?>

	<h1><u>FMail.com</u></h1>	
	<h3><u><i>Chat with <?php echo ucfirst($toUser); ?></i></u></h3>
	<hr>

	<?php
	if(!$conn) die("Connection Failed");		

	//Add ChatBody to concerned Table
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitChat'])):
		if(isset($_POST['inputChat']) && $_POST['inputChat'] != ""):	
			$chatBody = $_POST['inputChat'];
			$query = "INSERT INTO `$str`(`ChatSender`, `ChatBody`, `ChatTime`) VALUES ('$loggedUserFull' , '$chatBody','$date' );";
			if($conn -> query($query) == TRUE): header('Location: CreateChatWindow.php'); exit;
			else: echo "Not Sent";
			endif;
		else: echo "Couldn't add";
		endif;
	endif;

	//Displaying Chat
	$query1 = mysqli_query($conn , "SELECT * FROM `$str`;");
	if(mysqli_num_rows($query1) > 0):
		 //echo "Success";
		while($row = mysqli_fetch_assoc($query1)):
			if($row["ChatSender"] == $loggedUserFull):
?>				<p align = "right"> <?php echo $row["ChatBody"];
										  echo "<br>";
										  echo $row["ChatTime"];?> </p> 
	<?php 	else: ?>
				<p align = "left"> <?php echo $row["ChatBody"];
										 echo "<br>";
										 echo $row["ChatTime"];?> </p>
<?php 
			endif;
		endwhile;
	else: echo "Start Chatting!";	
	endif;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<form action = "CreateChatWindow.php" method = "POST">	
	<input type = "text" name = "inputChat" size = "60">
	<input type = "submit" value = "Send" name = "submitChat">
</form>
</body>
</html>

