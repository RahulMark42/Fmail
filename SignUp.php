<?php
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$dbname = "mail";
	
	$conn = mysqli_connect($servername, $username, $password ,$dbname);
	
	if (!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
	if((isset($_POST['userName'])) && (isset($_POST['passWord'])) && (isset($_POST['rPassWord'])))
	{
		$user_Name = $_POST['userName'];
		$pass_Word = $_POST['passWord'];
		$r_PassWord = $_POST['rPassWord'];
		if(!empty($user_Name) && !empty($pass_Word) && !empty($r_PassWord))
		{
			if($pass_Word == $r_PassWord)
			{
				$query = "INSERT INTO CREDENTIALS (UserName,Password) VALUES('$user_Name','$pass_Word')";
				if($conn -> query($query) == TRUE)
				{
					echo "You have Signed Up SuccessFully";
					header('Location: Login.php');
				}					
			}
			else
			{
				echo "Please Recheck Passwords";
			}
		}
		else{
			echo "Pleas fill out all the fields";
		}
	}
?>
<h1><u>FMail.com</u></h1>
<h3><u>SignUp</u><h3>
<hr>
<form action = "SignUp.php" method = "POST">
	<i>Select Username:</i> <br>
	<input type = "text" name = "userName"><br>
	<i>Select Password:</i> <br>
	<input type = "password" name = "passWord"> <br>
	<i>Retype Password:</i><br>
	<input type = "password" name = "rPassWord"><br><br>
	<input type = "submit" value = "SignUp!"><br>
</form>
