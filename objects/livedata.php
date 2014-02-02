<?php 
	include("../util/config.php");
	
	set_time_limit(0);
	
	mysql_connect($sqlserver, $sqluser, $sqlpass);
	mysql_select_db('Together');
	
	while (true) {
		$currentldHash = mysql_result(mysql_query("CHECKSUM TABLE LiveData"), 0, 1);
		$currentpHash = mysql_result(mysql_query("CHECKSUM TABLE Polls"), 0, 1);
		
	    $ldhash = isset($_GET['ldhash']) ? $_GET['ldhash'] : null;
	    $phash = isset($_GET['phash']) ? $_GET['phash'] : null;
	
	    if ($ldhash == null || $ldhash != $currentldHash || $phash == null || $phash != $currentpHash) {
	    	$pollsHTML = "";
	    	
	    	$sql = "SELECT * FROM Polls WHERE visible='1'";
	    	$polls = mysql_query($sql);
	    	$activePolls = 0;
	    	
	    	for ($i = 0; $i < mysql_num_rows($polls); $i++) {
	    		 if (mysql_result($polls, $i, 3) == "0") {
	    		 	$opts = explode(",", mysql_result($polls, $i, 4));
	    		 	
	    		 	$dvt = mysql_query("SELECT * FROM Votes WHERE voterID='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "' and pollID='" . mysql_real_escape_string(mysql_result($polls, $i, 0)) . "'");
	    		 	
	    		 	if (mysql_num_rows($dvt) < 1) {
	    		 		$activePolls++;
	    		 		
	    		 		$pollsHTML = $pollsHTML . "<br>" . mysql_result($polls, $i, 1);
	    		 		$pollsHTML = $pollsHTML . '<form action="objects/vote.php" method="post"><select onchange="this.form.submit()" name="opt">';
	    		 		
	    		 		for ($j = 0; $j < count($opts); $j++) {
	    		 			$pollsHTML = $pollsHTML . '<option value="' . $opts[$j] . '">' . $opts[$j] . '</option>';
	    		 		}
	    		 		
	    		 		$pollsHTML = $pollsHTML . '</select>';
	    		 		$pollsHTML = $pollsHTML . '<input type="hidden" name="pollID" value="' . mysql_result($polls, $i, 0) . '">';
	    		 		$pollsHTML = $pollsHTML . '</form>';
	    		 		 
	    		 	}		 	
	    		 } else if (mysql_result($polls, $i, 3) == "1") {
	    		 	$opts = explode(",", mysql_result($polls, $i, 4));
	    		 	
	    		 	$dvt = mysql_query("SELECT * FROM Votes WHERE voterID='" . mysql_real_escape_string($_SERVER['REMOTE_ADDR']) . "' and pollID='" . mysql_real_escape_string(mysql_result($polls, $i, 0)) . "'");
	    		 	
	    		 	if (mysql_num_rows($dvt) < 1) {
	    		 		$activePolls++;
	    		 		
	    		 		$pollsHTML = $pollsHTML . "<br>" . mysql_result($polls, $i, 1);
	    			 	$pollsHTML = $pollsHTML . '<form action="objects/vote.php" method="post">';
	    			 	$pollsHTML = $pollsHTML . '<input type="hidden" name="pollID" value="' . mysql_result($polls, $i, 0) . '">';
	    			 	
	    			 	for ($j = 0; $j < count($opts); $j++) {
	    			 		$pollsHTML = $pollsHTML . '<input type="submit" value="' . $opts[$j] . '" name="opt">';
	    			 	}
	    			 	
	    			 	$pollsHTML = $pollsHTML . '</form>';
	    			}
	    		}
	    	}
	    	
	    	if ($activePolls == 0) {
	    		$pollsHTML = "None...";
	    	}
	    	
	    	$kvs = mysql_query("SELECT * FROM LiveData");
	    	
	        $jsonArray = array(
	            'phash' => $currentpHash,
	            'ldhash' => $currentldHash,
	            'polls' => $pollsHTML
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