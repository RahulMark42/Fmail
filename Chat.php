<?php
	session_start();
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	echo "<br>";?>
	<h1><u>FMail.com</u></h1>
	<h3><u><i>Welcome to FMail!</i></u></h3><hr>
	<h2><u><i>Your Contacts</i></u></h2>
	<table border = "2px"> 
		<tr> 
			<th align = "centre">Contacts</th>
			<th align = "centre"> Messages</th> 
		</tr>
<?php	
	$loggedUser = $_SESSION["LoggedUser"];
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$databasename = "Chat";
	if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['contactAdd'])) 
		echo "<script type = 'text/javascript'> 
				window.open('AddChat.php','','width=400,height=400');
			</script>";
	$conn = mysqli_connect($servername,$username,$password,$databasename);
	if(!$conn) die("Connection Failed ");
	$query = mysqli_query($conn,"SELECT table_name FROM information_schema.tables where table_schema = 'chat' and table_name like '%$loggedUser%';");	

	if(mysqli_num_rows($query) != 0):
		while($row = mysqli_fetch_assoc($query)):
?>
			<tr> 
				<td align = "centre"> <?php $_SESSION["tableName"] = $row["table_name"];
										$str = $_SESSION["tableName"];
										$str1 = "";
										$str2 = "";
										$c = 0;
										for($i = 0; $i < strlen($str); $i++){
											if($str[$i] == '.') {
												$c = $i;
												break;
											} 
										}
										for($i = 0; $i < $c; $i++){
											$str1[$i] = $str[$i];
										}
										$j = 0;
										for($i = $c + 1; $i < strlen($str); $i++){
											$str2[$j] = $str[$i];
											$j++;
										}
										if(ucfirst($str1) == $loggedUser) echo ucfirst($str2);
										else echo ucfirst($str1);
										?> </td>
				<td align = "centre"> <a href = "CreateChatWindow.php"
									target = "popup";
									onclick = "window.open('CreateChatWindow.php','popup', 'width = 800 , height = 600'); return false"
									> <!---Continue Chatting!---><?php
										$query2 = "SELECT `ChatBody` FROM `mark.rahul` order by `ChatTime` desc limit 1";
										$result = mysqli_query($conn , $query2);
										$row = mysqli_fetch_assoc($result);
										//echo $row["ChatBody"];
										$msg = $row["ChatBody"];
										$msg1 = "";
										if(strlen($msg) >= 9){
											for($i = 0; $i < 9; $i++){
												$msg1[$i] = $msg[$i];
											}
											echo $msg1.".....";
										}
										else{
											echo $msg;
										}
									?> </a></td>
			</tr>
		</table>
<?php
		endwhile;
	else: echo "No Records found"; 
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
<form action = "Chat.php" method = "POST">
	<br>
	<input type = "submit" value = "Add new contact" name = "contactAdd">
</form>
</body>
</html>