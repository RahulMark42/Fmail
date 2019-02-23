<?php
	$servername = "localhost";
	$username = "root";
	$password = NULL;
	$dbname = "mail";
	
	$conn = mysqli_connect($servername, $username, $password ,$dbname);
	
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
	if(isset($_POST['userName']) && isset($_POST['passWord'])){
		$userName = $_POST['userName'];
		$passWord = $_POST['passWord'];
		
		if(!empty($userName) && !empty($passWord)){
			$query = "SELECT * FROM CREDENTIALS WHERE USERNAME = '$userName' AND PASSWORD = '$passWord'";
			$result = mysqli_query($conn,$query);
			if(mysqli_num_rows($result)!= 0){
				session_start();
				$_SESSION["LoggedUser"] = $userName;
				header("Location: WelcomePage.php");
			}
			else{
				echo "UserName or Password Incorrect.";
			}
		}
	}
	
?>
<h1><u>FMail.com</u></h1>
<h3><u><i>Login</i></u></h3>
<hr>
<form action = "Login.php" method = "POST">
	User Name: <br>
	<input type = "text" name = "userName"><br>
	Password: <br>
	<input type = "password" name = "passWord"><br> <br>
	<input type = "submit" value = "Login!"><br>
</form>
