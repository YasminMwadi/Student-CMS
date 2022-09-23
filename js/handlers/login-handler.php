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

		// $user_stat= $obj->security($_POST['user_stat']);
		$username = $obj->security($_POST['username']);
		$password = $obj->security($_POST['password']);


		//check if the fields if empty.
		// if (empty($user_stat)) 
		// {
		// 	$user_stat_error = "This field cannot be empty";
		// 	$user_stat_number_status = ""; 
		// }
		
		if (empty($username)) {
			$username_error = "Username cannot be empty";
			$username_status = ""; 
		} 
		else if (! $username)
		{
			$username_error = "Provide a valid username";
			$username_status = ""; 
		}
		if (empty($password)) {
			$password_error = "Password cannot be empty";
			$password_status = "";
		} 
		
		if (!empty($username_status) && !empty($password_status))
		
	    {
			$access = "";

			// if ($user_stat == "student")
			// {
				$queryStudent = $obj->Normal_Query("SELECT A.std_nbr, B.`status`, C.password FROM student AS A INNER JOIN 
													student_activation AS B ON A.std_nbr = B.std_nbr INNER JOIN credentials 
													AS C ON A.std_nbr = C.std_nbr WHERE B.`status`='active' AND B.std_nbr=?", [$username]);

				if ($obj->count_Rows() > 0) {
					//echo "<script>alert('User Activated and registered')</script>";
					$rowStudent = $obj->Single_Result();

					if (password_verify($password, $rowStudent->password)) {
						$obj->Create_Session("username", $username);
						$obj->Create_Session("access", "student");

					
						$access = "student";

						$obj->Normal_Query("INSERT INTO activity_logs VALUES (?, ?, ?, ?, ?, ?)", [NULL, $username, $access, $activity, $ip, $login_date]);

						header("Location:student.php");
					}

					else {
						
						//$error = "Incorrect username or password. Account will be blocked after 3 failed attempts";
						$obj->Normal_Query("INSERT INTO login_attempts VALUES (?, ?, ?, ?)", [NULL, $username, $ip, $login_date]);

						$obj->Normal_Query("SELECT * FROM login_attempts WHERE username = ? AND login_time <= NOW() AND login_time >= NOW() - INTERVAL 15 MINUTE", [$username]);

						$count = $obj->count_Rows();

						if ($count > 5) {
							$status = 'inactive';
							$obj->Normal_Query("UPDATE student_activation SET status = ?, deactivation_date = ? WHERE std_nbr = ?", [$status, $login_date, $username]);

							$error = "Your account has been blocked. Please contact Admin";
						}
						else {
							$error = "Incorrect username or password. Account will be blocked after 5 failed attempts. Attempts left: " . (5 - $count);
							//header("Location:sign-in.php");
						}
					}
				}
				else {
					echo "<script>alert('Userdoes not exist in the system. Please create an account)</script>";
				}
			// }
			//  ----------------------------------------------------
		   
	   }
	  
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

  // Encrypt cookie
function encryptCookie( $value ) {

	$key = hex2bin(openssl_random_pseudo_bytes(4));
 
	$cipher = "aes-256-cbc";
	$ivlen = openssl_cipher_iv_length($cipher);
	$iv = openssl_random_pseudo_bytes($ivlen);
 
	$ciphertext = openssl_encrypt($value, $cipher, $key, 0, $iv);
 
	return( base64_encode($ciphertext . '::' . $iv. '::' .$key) );
 }
 
 // Decrypt cookie
 function decryptCookie( $ciphertext ) {
 
	$cipher = "aes-256-cbc";
 
	list($encrypted_data, $iv,$key) = explode('::', base64_decode($ciphertext));
	return openssl_decrypt($encrypted_data, $cipher, $key, 0, $iv);
 
 }

?>