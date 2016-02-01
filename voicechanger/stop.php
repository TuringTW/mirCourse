<?php 
	if (isset($_POST['stop'])) {
		$myfile = fopen("stop", "w") or die("Unable to stop!");
		fclose($myfile);
		echo "STOP!!!";
	}else{
		echo "WRONG";
	}
?>