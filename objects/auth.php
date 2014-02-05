<?php
	include("../util/config.php");
	include("../util/session_mgr.php");
		
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		if (session_id() == '') {
			session_start();
		}
		
		$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($user) . "' and password='" . mysql_real_escape_string(hash('sha512', $pass)) . "'";
		$result = mysql_query($sql);
				
		if (mysql_num_rows($result) == 1) { 
			$key = generateSessionToken();
			$_SESSION['User.username'] = $user;
			$_SESSION['User.session_token'] = $key;
			
			mysql_query("UPDATE Admin SET session_token='" . $key . "' WHERE username='" . mysql_real_escape_string($user) . "' and password='" . mysql_real_escape_string(hash('sha512', $pass)) . "'");
					
			header('Location: ../dashboard.php');
					
		} else {
			header('Location: ../index.php');
		}
	} else {
		header('Location: ../index.php');
	}
 ?>