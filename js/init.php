<?php 
	if (!isset($_SESSION)) {
		session_start();
	}
	date_default_timezone_set('Africa/Johannesburg');
	spl_autoload_register(function($class_name) {
		include "class/$class_name.php";
	});
 ?>