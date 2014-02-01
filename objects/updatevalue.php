<?php 
	include("../util/config.php");
	include("../util/session_mgr.php");
	
	$key = $_POST['key'];
	$value = $_POST['value'];
	
	validateSession();
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	mysql_query("UPDATE LiveData SET ld_value='" . mysql_real_escape_string($value) . "' WHERE ld_key='" . mysql_real_escape_string($key) . "'");

	header("Location: ../dashboard.php");
?>