<?php
	session_start();
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	$LoggedUser = $_SESSION["LoggedUser"]."@Fmail.com";
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$databasename = "Mail";

	date_default_timezone_set("Asia/Kolkata");
	$dateTime = date('Y-m-d h:i:s ', time());


	$conn = mysqli_connect($servername,$username,$password,$databasename);
	if(!$conn){
		die("Connection Failed");
	}
	if((isset($_POST['To'])) && (isset($_POST['Compose'])) && (isset($_POST['Subject']))){
		$to = $_POST['To'];
		$subject = $_POST['Subject'];
		$compose = $_POST['Compose'];
		if(!empty($to)){
			if($_POST["Send"]){
				$query1 = "INSERT INTO ALLINBOXEMAIL VALUES ('$LoggedUser' , '$to' , '$subject' , '$compose' , '$dateTime')";
				$query2 = "INSERT INTO ALLISENTEMAIL VALUES ('$to' , '$LoggedUser' , '$subject' , '$compose' , '$dateTime')";
			
				if($conn -> query($query1) == TRUE){
					$conn -> query($query2);
					echo "<br>";
					echo "Mail was sent Successfully to ".$to;
					$_POST['To'] = "";
					$_POST['Subject'] = "";
					$_POST['Compose'] = "";
				}
				else{
					echo "Mail was not sent Successfully";
					echo "<br>";
				}
			}
			if($_POST["Draft"]){
				$query = "INSERT INTO ALLDRAFTMAIL VALUES ('$LoggedUser' , '$to' , '$subject' , '$compose')";
				if($conn -> query($query) == TRUE){
					echo "Mail was save to your Drafts";
					echo "<br>";
					$_POST['To'] = "";
					$_POST['Subject'] = "";
					$_POST['Compose'] = "";
				}
				else{
					echo "Mail was not saved to Drafts";
					echo "<br>";
				}
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
<form action = "Compose.php" method = "POST" >
<h1><u>FMail.com</u></h1>
<h3><u><i>Welcome to FMail!</i></u></h3><hr>
<h4><u><b><i>Compose</i></b></u></h4>
From: &nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "From" value = <?php echo $_SESSION["LoggedUser"]."@Fmail.com"; ?>>
<br><br>
To: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type = "text" name = "To">
<br><br>
Subject: &nbsp;<input type = "text" name = "Subject"> <br><br>
Compose: <br><br>
<textarea rows = "10" cols = "75" name = "Compose">
</textarea>
<br><br>
<input type = "submit" value = "Send" name = "Send"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<input type = "submit" value = "Save in drafts" name = "Draft"> 
</form>	
</body>
</html>