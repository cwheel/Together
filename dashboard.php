<?php
	include("../config.php");
	
	session_start();
	
	if (isset($_SESSION["User.username"]) && isset($_SESSION["User.key"])) {
		echo $_SESSION["User.username"];
		mysql_connect($sqlserver, $sqluser, $sqlpass);
		mysql_select_db('Together');
		
		$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and password='" . mysql_real_escape_string($_SESSION["User.key"]) . "'";
		
		$result = mysql_query($sql);
		
		echo "here =>" . mysql_result($result, 0, 2);
		
		if (mysql_num_rows($result) == 1) { 
			echo mysql_result($result, 0, 3);
		} else {
			//header("Location: index.php");
		}
		
	} else {
		header('Location: index.php');
	}
?>

<html>
	<head>
		<title><?php include("../config.php"); echo $partyName . " Control"; ?></title>
	</head>
	<body>
		<b><?php
			mysql_connect($sqlserver, $sqluser, $sqlpass);
			mysql_select_db('Together');
			
			$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and password='" . mysql_real_escape_string($_SESSION["User.key"]) . "'";
			
			$result = mysql_query($sql);
			
			echo "Welcome " . mysql_result($result, 0, 3);
		?></b>
	</body>
</html>