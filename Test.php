<?php
	if($_GET["B1"]) echo "a";
	if($_GET["B2"]) echo "b";
	
?>
<form action = "Test.php" method = "GET">
	<input type = "submit" value = "Echo1" name = "B1"> <br><br>
</form>
<form action = "Test.php" method = "GET">
	<input type = "submit" value = "Echo2" name = "B2">
</form>