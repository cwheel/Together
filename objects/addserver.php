<?php
	include("../util/config.php");
	include("../util/session_mgr.php");
	
	$name = $_POST["name"]; 
	$path = $_POST["path"]; 
	$port = $_POST["port"]; 
	$startCmd = $_POST["startCmd"]; 
	$endCmd = $_POST["endCmd"]; 
	
	validateSession();
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');

	mysql_query('INSERT INTO Servers (name, path, port, startCmd, endCmd) VALUES("' . mysql_real_escape_string($name) . '","' . mysql_real_escape_string($path) . '","' . mysql_real_escape_string($port) .  '","' . mysql_real_escape_string($startCmd) . '","' . mysql_real_escape_string($endCmd)'")');
	
	header("Location: ../dashboard.php");
?>