<?php
	include("../util/config.php");
		
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	//Yes, REMOTE_ADDR is a terrible method for preventing double voting but it'll do for now
	$dvt = mysql_query("SELECT * FROM Votes WHERE voterID='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "' and pollID='" . mysql_real_escape_string($_POST['pollID']) . "'");
		
	if (mysql_num_rows($dvt) < 1) { 
		mysql_query('INSERT INTO Votes (voterID, vote, pollID) VALUES("' . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . '","' . mysql_real_escape_string($_POST['opt']) . '","' . mysql_real_escape_string($_POST['pollID']) . '")');
		
		header("Location: ../index.php");
	} else {
		echo "Error: You already voted in this poll.";
	}	
?>