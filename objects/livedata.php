<?php 
	include("../util/config.php");
	
	set_time_limit(0);
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	while (true) {
		$currentHash = mysql_result(mysql_query("CHECKSUM TABLE LiveData"), 0, 1);
		
	    $hash = isset($_GET['hash']) ? $_GET['hash'] : null;
	
	    if ($hash == null || $hash != $currentHash) {
	    	$kvs = mysql_query("SELECT * FROM LiveData");
	    	
	        $jsonArray = array(
	            'hash' => $currentHash
	        );
	        
	        for ($i = 0; $i < mysql_num_rows($kvs); $i++) {
	        	$jsonArray[mysql_result($kvs, $i, 1)] = mysql_result($kvs, $i, 2);
	        }
	        
	        $json = json_encode($jsonArray);
	        echo $json;
	        break;
	
	    } else {
	        sleep(1);
	        continue;
	    }
	}
?>