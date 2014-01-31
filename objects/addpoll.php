<?php
	include("../util/config.php");
	include("../util/session_mgr.php");
	
	$question = $_POST["question"]; 
	$mode = $_POST["mode"]; 
	$options = $_POST["options"]; 
	
	validateSession();
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');

	mysql_query('INSERT INTO Polls (question, type, options) VALUES("' . mysql_real_escape_string($question) . '","' . mysql_real_escape_string($mode) . '","' . mysql_real_escape_string($options) . '")');
	
	header("Location: ../dashboard.php");
?>