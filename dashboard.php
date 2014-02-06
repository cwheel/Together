<?php
	include("util/config.php");
	include("util/session_mgr.php");
	
	if (session_id() == '') {
		session_start();
	}
	
	validateSession();
?>

<html>
	<head>
		<title><?php include("config.php"); echo $partyName . " Control"; ?></title>
        <link rel="stylesheet" type="text/css" href="style/style.css" /> 
	</head>
<div id "header">
    <img src="images/head.png" align="center"/>
</div>
	<body>
		<b><?php
			mysql_connect($sqlserver, $sqluser, $sqlpass);
			mysql_select_db('Together');
			
			$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and session_token='" . mysql_real_escape_string($_SESSION["User.session_token"]) . "'";
			
			$result = mysql_query($sql);
			
			echo "Welcome " . mysql_result($result, 0, 3);
		?></b>
		<a href="objects/logout.php">Logout</a>
		
<div id="main">
<b>Create a new poll</b>
		<form action="objects/addpoll.php" method="post">
			<input name="question" type="text" size="20" placeholder="Poll Question">
			<input name="mode" type="text" size="20" placeholder="Button Based (0|1)">
			<input name="options" type="text" size="20" placeholder="Options (CSV)">
			<input type="submit" value="Add Poll" class="tagbtn3">
		</form>
</div>
<div id="main">
<b>Update current game information</b>
		<form action="objects/updatevalue.php" method="post">
			<input name="value" type="text" size="20" placeholder="Current Game Name">
			<input type="hidden" name="key" value="current_game">
			<input type="submit" value="Save" class="tagbtn3">
			<input name="value" type="text" size="20" placeholder="Current Game Icon">
			<input type="hidden" name="key" value="current_game_icon">
			<input type="submit" value="Save" class="tagbtn3">
		</form>
<<<<<<< HEAD
		
		<form action="objects/addserver.php" method="post">
			<input name="name" type="text" size="20" placeholder="Server Name">
			<input name="path" type="text" size="20" placeholder="Server Path">
			<input name="port" type="text" size="20" placeholder="Server Port">
			<input name="startCmd" type="text" size="20" placeholder="Start Command">
			<input name="endCmd" type="text" size="20" placeholder="Stop Commnd">
			<input type="submit" value="Add Server">
		</form>
		
		<br>
=======
        <p>Game decriptions are pulled from Wikipedia based on the name.</p>
</div>
>>>>>>> 4b7dddc2d726e71c4c0ab6328a26c2d69f597238
		<br>
<div id="main" align="left">
		<b>Poll Results</b>
		
		<?php
			mysql_connect($sqlserver, $sqluser, $sqlpass);
			mysql_select_db('Together');

			$polls = mysql_query("SELECT * FROM Polls");
			
			for ($i = 0; $i < mysql_num_rows($polls); $i++) {
				$options = explode(",", mysql_result($polls, $i, 4));
				$allVotes = mysql_query("SELECT * FROM Votes WHERE pollID='" . mysql_real_escape_string(mysql_result($polls, $i, 0))  . "'");
				$voteCount = mysql_num_rows($allVotes);
				
				echo '<br><br><b>' . mysql_result($polls, $i, 1) . '</b>';
				echo '&nbsp;<a href="objects/deletepoll.php?pollID=' . mysql_result($polls, $i, 0) . '">Delete Poll</a>';
				
				for ($j = 0; $j < count($options); $j++) {
					$votes = mysql_query("SELECT * FROM Votes WHERE pollID='" . mysql_real_escape_string(mysql_result($polls, $i, 0)) . "' AND vote='" . $options[$j] . "'");
					
					$percent = (mysql_num_rows($votes) / $voteCount) * 100;
					echo "<br>" . $options[$j] . ": " .  round($percent, 2) . "%";
				}
			}
			$servers = mysql_query("SELECT * FROM Servers");
			echo '<br><br><b>Servers</b><br>';
			for ($i = 0; $i < mysql_num_rows($servers); $i++) {
				echo '<br>' . mysql_result($servers, $i, 1) . '&nbsp;' . mysql_result($servers, $i, 3) . '&nbsp;' . mysql_result($servers, $i, 7) . '&nbsp;';
				echo '<a href="objects/manageserver.php?action=delete&server=' . urlencode(mysql_result($servers, $i, 1)) . '">Delete</a>&nbsp;';
				echo '<a href="objects/manageserver.php?action=start&server=' . urlencode(mysql_result($servers, $i, 1)) . '">Start</a>&nbsp;';
				echo '<a href="objects/manageserver.php?action=stop&server=' . urlencode(mysql_result($servers, $i, 1)) . '">Stop</a>&nbsp;';
			}
		?>
        </div>
	</body>
</html>