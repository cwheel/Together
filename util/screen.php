<?php  
ini_set ("display_errors", "1");
error_reporting(E_ALL);
	function startScreenWithNameAndCmd($name, $cmd, $dir) {
		if (isset($dir)) {
			exec('cd ' . $dir . '; screen -S ' . $name . ' -d -m ' . $cmd);
		} else {
			exec('screen -S ' . $name . ' -d -m ' . $cmd);
		}
	}
	
	function sendCmdToScreen($screen, $cmd) {
		exec('screen -S ' . $screen . ' -p 0 -X stuff "' . $cmd . '`echo -ne \'\\015\'`"');	
	}
?>