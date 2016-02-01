<?php 
	if (isset($_POST['master'])&&isset($_POST['shift'])) {
		$master = $_POST['master'];
		$shift = $_POST['shift'];
		exec("sudo python3 ./go_scipy_php.py $shift $master");
		echo "START!!!";
	}else{
		echo "WRONG";
	}
?>