<?php
	include("../config.php");
	
	ini_set ("display_errors", "1");
	error_reporting(E_ALL);
		
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		session_start();
		
		$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($user) . "' and password='" . mysql_real_escape_string(sha1($pass)) . "'";
		$result = mysql_query($sql);
				
		if (mysql_num_rows($result) == 1) { 
			$_SESSION['User.username'] = $user;
			$_SESSION['User.key'] = sha1($pass);
					
			header('Location: ../dashboard.php');
					
		} else {
			header('Location: ../index.php');
		}
	} else {
		header('Location: ../index.php');
	}
 ?>