<?php
	session_start();
	echo "Logged in as : ";
	echo $_SESSION["LoggedUser"]."@Fmail.com";
	echo "<br>";?>
	<h1><u>FMail.com</u></h1>
	<h3><u><i>Welcome to FMail!</i></u></h3><hr>
	<h2><u><i>Your Contacts</i></u></h2>
	<table>
		<tr>
			<td align = "left"><h3>Contacts</h3></td>
			<td align = "right"><h3>Messages</h3></td>
		</tr>
	</table>
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
	if(!$conn) die("Connection Failed");
	$loggedUserFull = $loggedUser."@Fmail.com";
	$query1 = mysqli_query($conn,"SELECT * FROM CHATLOG WHERE FromUser = '$loggedUserFull' ORDER BY ChatTime DESC;");
	$query2 = mysqli_query($conn,"SELECT * FROM CHATLOG WHERE ToUser = '$loggedUserFull' ORDER BY ChatTime DESC;");
?>
	<table>
		<?php
	if(mysqli_num_rows($query1) > 0):
			$check1 = "";
			while($row = mysqli_fetch_assoc($query1)):
		?>
		<tr>
			<td align = "left"><?php
									$_SESSION["toUser"] = $row['ToUser'];
									if($_SESSION["toUser"] != $check1):
										echo $_SESSION["toUser"]; 
									else:
										$check1 = $_SESSION["toUser"];
									endif;
								?> </td>
			<td align = "right"> <a href = "CreateChatWindow.php"
									target = "popup";
								    onclick = "window.open('CreateChatWindow.php','popup', 'width = 800 , height = 600'); return false"> <?php 
				if($row['ChatBody'] == ""){
					echo "Start new chat";
				}
				else{
					echo $row['ChatBody']; 
				}?> </a> 
				</td>
		</tr>
		<?php endwhile;
	
		if(mysqli_num_rows($query2) > 0):
			$check2 = "";
			while($row = mysqli_fetch_assoc($query2)):
		?>
		<tr>
			<td align = "left"><?php
									$_SESSION["toUser"] = $row['FromUser'];
									if($_SESSION["toUser"] != $check2):
										echo $_SESSION["toUser"];
									else:
										$check2 = $_SESSION["toUser"];
									endif;?> </td>
			<td align = "right"> <a href = "CreateChatWindow.php"
									target = "popup";
								    onclick = "window.open('CreateChatWindow.php','popup', 'width = 800 , height = 600'); return false"> <?php 
				if($row['ChatBody'] == ""){
					echo "Start new chat";
				}
				else{
					echo $row['ChatBody']; 
				}?> </a> 
				</td>
		</tr>
		<?php 
		endwhile;endif; ?>
	</table>
<?php
	else:?>
		<h3>No records found</h3>
<?php endif; ?>
	

<form action = "Chat.php" method = "POST">
	<br>
	<input type = "submit" value = "Add new contact" name = "contactAdd">
</form>