<?php

function randString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function generateSessionToken() {
	return hash('sha512', randString(64));
}


function validateSession() {
	include("config.php");
	
	if (session_id() == '') {
		session_start();
	}

	if (isset($_SESSION["User.username"]) && isset($_SESSION["User.session_token"])) {
		mysql_connect($sqlserver, $sqluser, $sqlpass);
		mysql_select_db('Together');
		
		$sql = "SELECT * FROM Admin WHERE username='" . mysql_real_escape_string($_SESSION["User.username"]) . "' and session_token='" . mysql_real_escape_string($_SESSION["User.session_token"]) . "'";
		
		$result = mysql_query($sql);
		
		if (mysql_num_rows($result) != 1) { 
			header("Location: index.php");
		}
		
	} else {
		header('Location: index.php');
	}	
}

?>