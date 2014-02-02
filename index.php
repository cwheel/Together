<?php
	include("util/config.php");
	
	if (session_id() == '') {
		session_start();
	}
	
	ini_set ("display_errors", "1");
	error_reporting(E_ALL);
	
	if (isset($_SESSION["User.username"]) && isset($_SESSION["User.session_token"])) {
		mysql_connect($sqlserver, $sqluser, $sqlpass);
		mysql_select_db('Together');
		
		$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and session_token='" . mysql_real_escape_string($_SESSION["User.session_token"]) . "'";
		
		$result = mysql_query($sql);
		
		if (mysql_num_rows($result) == 1) { 
			header("Location: dashboard.php");
		}
		
	}
?>
<head>
	<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript" src="util/livedata.js"></script>
	<title><?php include("config.php"); echo $partyName; ?></title>
</head>
<form action="objects/auth.php" method="post">
	<input name="username" type="text" size="20" placeholder="Username" autofocus>
	<input name="password" type="password" size="20" placeholder="Password"><br>
	<input type="submit" value="Login">
</form>

<br><b>Current Game</b>
<img src="" id="currentGameIcon">
<div id="currentGame"></div>
<div id="currentGameDescription"></div>

<br><b>Active Polls</b>
<div id="polls"></div>

<div id="alert" onclick="hideAlert();"></div>
<audio autoplay="" name="media" id="noteSound"><source src="src/notification.mp3" type="audio/mpeg" id="player"></audio>
