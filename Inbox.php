<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
</body>
</html>
<?php
	session_start();
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	echo "<br>";
	$loggedUser = $_SESSION["LoggedUser"];
	$servername = "localhost";
	$username = "root";
	$password = NULL;

	date_default_timezone_set("Asia/Kolkata");
	$date = date('Y-m-d h:i:s ', time());?>
	<p> <?php echo $date;?> </p>
	<h1><u>FMail.com</u></h1>
	<h3><u><i>Welcome to FMail!</i></u></h3><hr>
	<h4><u><b><i>Inbox</i></b></u></h4>
	<table border = "2px">
		<tr>
			<th>From</th>
			<th>Subject</th>
			<th>Message</th>
			<th>Time</th>
		</tr>	
<?php
	$databasename = "Mail";
	$conn = mysqli_connect($servername,$username,$password,$databasename);
	if(!$conn) die("Connection Failed");
	else{
		$query = "SELECT * FROM ALLINBOXEMAIL WHERE `ToEmail` Like '%$loggedUser%' ORDER BY `DateTime`;";
		$result = mysqli_query($conn , $query);
		if(mysqli_num_rows($result) != 0):
			while($row = mysqli_fetch_assoc($result)):
				$_SESSION["from_email"] = $row["FromEmail"];
				$_SESSION["sub"] = $row["Subject"];
				$_SESSION["body"] = $row["Body"];
				$_SESSION["dateTime"] = $row["DateTime"];
				$fromEmail = $_SESSION["from_email"];
				$Body = $_SESSION["body"];
				$subject = $_SESSION["sub"];
				$dateTime = $_SESSION["dateTime"]; ?> 
				<tr>
					<td> <?php echo $fromEmail; ?></td>
					<td> <?php echo $subject; ?> </td>
					<td> <a href = "ShowInbox.php"
									target = "popup";
									onclick = "window.open('ShowInbox.php','popup', 'width = 800 , height = 600'); return false"><?php echo $Body; ?> </a></td>
					<td> <?php echo $dateTime; ?> </td>  
				</tr>
			</table>
<?php 		endwhile;
		else:
			?> <p> <?php echo "Nothing found here!"; ?> </p> <?php
		endif;
	}	
?>

