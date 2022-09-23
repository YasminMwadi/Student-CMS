<?php 
	require 'init.php';

	// echo $_SESSION['username'];

	if (!isset($_SESSION['username'])) {
		header("Location:login.php");
	}
	else {
		$access = $_SESSION['access'];

		if ($access == 'student') {
			$userLoggedIn = $_SESSION['username'];
			include 'inc/studentHeader.php';
		}
		// elseif ($access == 'staff') {
		// 	// code...
		// }
		// elseif ($access == 'incubator') {
		// 	// code...
		// }
	}
 ?>