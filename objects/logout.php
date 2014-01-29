<?php 
	include("../util/config.php");

	if (session_id() == '') {
		session_start();
	}
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	mysql_query("UPDATE Admin SET session_token='' WHERE username='" . mysql_real_escape_string($_SESSION['User.username']) . "' and session_token='" . mysql_real_escape_string($_SESSION['User.session_token']) . "'");
	
	session_destroy();
	
	header("Location: ../index.php");
?>