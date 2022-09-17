<?php 
	$obj = new base_class;

	$error = "";

	if (isset($_POST['submit'])) 
	{
		
		 $username_status= $password_status=1;
		$login_date= date("Y-m-d H:i:s");
		$activity= 'logged In';
		$ip = getIPAddress();


		//initialisation.

		//$user_stat= $obj->security($_POST['user_stat']);
		$username = $obj->security($_POST['username']);
		$pass = $obj->security($_POST['password']);


		
		if (empty($username)) {
			$username_error = "Username cannot be empty";
			$student_number_status = ""; 
		} 
		
		if (empty($pass)) {
			$password_error = "Password cannot be empty";
			$password_status = "";
		} 
		
		if (!empty($username_status) && !empty($password_status))
		
	    {

		  	$access = "";

		  	// if ($user_stat == "student")
		  	// {
		  	 	$queryUser = $obj->Normal_Query("SELECT * FROM  admin_credentials  WHERE user =?", [$username]);

		  		if ($obj->count_Rows() > 0) {
		  		//	echo "<script>alert('User Activated and registered')</script>";

		  			$rowUser = $obj->Single_Result();


		  			if( $pass == $rowUser->password) {
		  				$obj->Create_Session("username", $username);
		  				$obj->Create_Session("access", "admin");

		  				// $_SESSION['username'] = $username;
		  				// $_SESSION['access'] = "student";

		  				// if ($_SESSION['username'] = $username) {
		  					//echo "<script>alert('correct password')</script>";
		  				// }

		  				// else {
		  				// 	echo "<script>alert('Unable to create session')</script>";
		  				// }

		  				$access = "admin";


		  				 $obj->Normal_Query("INSERT INTO activity_logs VALUES (?, ?, ?, ?, ?, ?)", [NULL, $username,$access, $activity, $ip, $login_date]);

		  				header("Location:index.php");
		  			}

		  			else {
		  				
		  				
							$error = "Incorrect username or password. ";
		  					//header("Location:sign-in.php");
		  				
		  			}
		  		}
		  		else {
		  			echo "<script>alert('Oops! Something went wrong. Please try again later.')</script>";
		  		}
			}
		//   	//  ----------------------------------------------------
		 	
		
		
	}
	// ----------------------- Function to get the IP address ------------------//
	function getIPAddress()
	{
// Whether ip is from the share internet
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip= $_SERVER['HTTP_X_CLIENT_IP'];
		}
		// whether ip is from the the proxy
		else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip= $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
// whether ip is from the remote address
		else
		{
			$ip= $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

 ?>