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
	$activePolls = 0;
	
	for ($i = 0; $i < mysql_num_rows($polls); $i++) {
		 if (mysql_result($polls, $i, 3) == "0") {
		 	$opts = explode(",", mysql_result($polls, $i, 4));
		 	
		 	$dvt = mysql_query("SELECT * FROM Votes WHERE voterID='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "' and pollID='" . mysql_real_escape_string(mysql_result($polls, $i, 0)) . "'");
		 	
		 	if (mysql_num_rows($dvt) < 1) {
		 		$activePolls++;
		 		
		 		echo "<br>" . mysql_result($polls, $i, 1);
		 		echo '<form action="objects/vote.php" method="post"><select onchange="this.form.submit()" name="opt">';
		 		
		 		for ($j = 0; $j < count($opts); $j++) {
		 			echo '<option value="' . $opts[$j] . '">' . $opts[$j] . '</option>';
		 		}
		 		
		 		echo '</select>';
		 		echo '<input type="hidden" name="pollID" value="' . mysql_result($polls, $i, 0) . '">';
		 		echo '</form>';
		 		 
		 	}		 	
		 } else if (mysql_result($polls, $i, 3) == "1") {
		 	$opts = explode(",", mysql_result($polls, $i, 4));
		 	
		 	$dvt = mysql_query("SELECT * FROM Votes WHERE voterID='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "' and pollID='" . mysql_real_escape_string(mysql_result($polls, $i, 0)) . "'");
		 	
		 	if (mysql_num_rows($dvt) < 1) {
		 		$activePolls++;
		 		
		 		echo "<br>" . mysql_result($polls, $i, 1);
			 	echo '<form action="objects/vote.php" method="post">';
			 	echo '<input type="hidden" name="pollID" value="' . mysql_result($polls, $i, 0) . '">';
			 	
			 	for ($j = 0; $j < count($opts); $j++) {
			 		echo '<input type="submit" value="' . $opts[$j] . '" name="opt">';
			 	}
			 	
			 	echo '</form>';
			}
		}
	}
	
	if ($activePolls == 0) {
		echo "None...";
	}
?>