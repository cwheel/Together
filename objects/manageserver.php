<?php 
	include("../util/config.php");
	include("../util/screen.php");
	include("../util/session_mgr.php");
	
	$action = $_GET["action"]; 
	$server = urldecode($_GET["server"]); 
	
	validateSession();
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	$serverInfo = mysql_query("SELECT * FROM Servers WHERE name='" . $server . "'");
	
	if (mysql_num_rows($serverInfo) > 0) {
		if ($action == "start") {
			if (mysql_result($serverInfo, 0, 2) != "") {
				startScreenWithNameAndCmd(mysql_result($serverInfo, 0, 1), mysql_result($serverInfo, 0, 4), mysql_result($serverInfo, 0, 2));
			} else {
				startScreenWithNameAndCmd(mysql_result($serverInfo, 0, 1), mysql_result($serverInfo, 0, 4));
			}
			
		} else if ($action == "stop") {
			sendCmdToScreen(mysql_result($serverInfo, 0, 1), mysql_result($serverInfo, 0, 5));
		}
	}
	
	header("Location: ../dashboard.php");
?>