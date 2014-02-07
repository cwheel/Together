<?php  
		include("../util/config.php");
		include("../util/session_mgr.php");
		
		$name = $_POST["name"]; 
		$amnt = $_POST["amnt"]; 
		
		validateSession();
		
		mysql_connect($sqlserver, $sqluser, $sqlpass);
		mysql_select_db('Together');
	
		mysql_query('INSERT INTO Payers (name, amount) VALUES("' . mysql_real_escape_string($name) . '","' . mysql_real_escape_string($amnt) . '")');
		
		header("Location: ../dashboard.php");
	
?>