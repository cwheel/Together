<?php
	include("config.php");
	
	session_start();
	
	ini_set ("display_errors", "1");
	error_reporting(E_ALL);
	
	if (isset($_SESSION["User.username"]) && isset($_SESSION["User.key"])) {
		mysql_connect($sqlserver, $sqluser, $sqlpass);
		mysql_select_db('Together');
		
		$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and password='" . mysql_real_escape_string($_SESSION["User.key"]) . "'";
		
		$result = mysql_query($sql);
		
		if (mysql_num_rows($result) == 1) { 
			header("Location: dashboard.php");
		}
		
	}
?>

<form action="objects/auth.php" method="post">
	<input name="username" type="text" size="20" placeholder="Username" autofocus>
	<input name="password" type="password" size="20" placeholder="Password"><br>
	<input type="submit" value="Login">
</form>

<br><b>Active Polls</b>
<?php
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	$sql = "SELECT * FROM Polls WHERE visible='1'";
	$polls = mysql_query($sql);
	
	for ($i = 0; $i < mysql_num_rows($polls); $i++) {
		echo "<br>" . mysql_result($polls, $i, 1);
	}
?>