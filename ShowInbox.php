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
    <h4><u><i>From : <?php  echo $_SESSION["from_email"]; ?></i></u></h4>
    <h4><u><i> Subject : <?php echo $_SESSION["sub"] ?> </i></u></h4>
    <p> <?php 
        echo $_SESSION["body"]; 
        echo "<br>";
        ?>
    </p>
    <p> <?php  echo "Sent at : ".$_SESSION["dateTime"];   ?> </p>   
    <form action = "ShowInbox.php" method = "POST">
        <input type = "submit" value = "Reply" name = "reply"> &nbsp;&nbsp;
        <input type = "submit" value = "Delete" name = "delete">
    </form> 
    <?php
        $str = $_SESSION["from_email"];
        if(isset($_POST["reply"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
            header("Location: Compose.php/To=$str");
            exit;
        }
    ?>