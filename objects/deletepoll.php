<?php 
	include("../util/config.php");
	include("../util/session_mgr.php");
	
	$pid = $_GET['pollID'];
	
	validateSession();
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	mysql_query("DELETE FROM Polls WHERE id='" . $pid . "'");
	mysql_query("DELETE FROM Votes WHERE pollID='" . $pid . "'");
	
	header("Location: ../dashboard.php");
?>