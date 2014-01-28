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
		
		if (mysql_num_rows($result) != 1) { 
			header("Location: index.php");
		}
		
	} else {
		header('Location: index.php');
	}
?>

<html>
	<head>
		<title><?php include("config.php"); echo $partyName . " Control"; ?></title>
	</head>
	<body>
		<b><?php
			mysql_connect($sqlserver, $sqluser, $sqlpass);
			mysql_select_db('Together');
			
			$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and password='" . mysql_real_escape_string($_SESSION["User.key"]) . "'";
			
			$result = mysql_query($sql);
			
			echo "Welcome " . mysql_result($result, 0, 3);
		?></b>
		
		<a href="objects/logout.php">Logout</a>
		
		<form action="objects/addpoll.php" method="post">
			<input name="question" type="text" size="20" placeholder="Poll Question">
			<input name="mode" type="text" size="20" placeholder="Button Based (0|1)">
			<input name="options" type="text" size="20" placeholder="Options (CSV)">
			<input type="submit" value="Add Poll">
		</form>
	</body>
</html>