<?php
	include("util/config.php");
	
	if (session_id() == '') {
		session_start();
	}
	
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
	<script type="text/javascript" src="background.js"></script>
	<link rel="stylesheet" type="text/css" href="style/main.css">
	
	<title><?php include("config.php"); echo $partyName; ?></title>
</head>

<div id="topBar">
	<div id="partyTitle"><?php include("config.php"); echo $partyName; ?></div>
	<div id="loginForm">
		<form action="objects/auth.php" method="post">
			<input name="username" type="text" size="20" placeholder="Username" autofocus>
			<input name="password" type="password" size="20" placeholder="Password">
			<input type="submit" value="Login" class="hidden">
		</form>
	</div>
</div>

<body onload="genbg();">

<div id="currentGameBoxHolder">
	<div id="currentGameBox">
		<div id="currentGame"></div> 
		<div id="currentGameDescription"></div>
	</div>
</div>

<div id="pollsBoxHolder">
	<div id="pollsBox"></div>
</div>

<div id="serversBoxHolder">
	<div id="serversBox"></div>
</div>

<div id="alertHolder">
	<div id="alert" onclick="hideAlert();"></div>
</div>

<audio name="media" id="noteSound"><source src="src/notification.mp3" type="audio/mpeg" id="player"></audio>
</div>

<div id="bg"></div>

</body>