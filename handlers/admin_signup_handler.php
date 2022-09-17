<?php 
	$obj = new base_class;

	if(isset($_POST['register'])) {
		// echo "<script>alert('The button is clicked')</script>";
		//set all the variable status. 
		$user_status = $email_status = $password_status = $confpassword_status =  1;

		$error_message = "";

		//Sanitize all the input fields. 
		
		
		$user = $obj->security($_POST['user']);
		$email = strtolower($obj->security($_POST['email']));

		$password = $obj->security($_POST['password']);
		$confpassword = $obj->security($_POST['conf-password']);

		//==========================

		$date = date("Y-m-d H:i:s"); //Get the date of the user addition in the system
		#$status = 'active';

		//check fof the fields if empty. 
		

		if (empty($user)) {
			$user_error = "User cannot be empty";
			$user_status = "";
		} 

		if (empty($email)) {
			$email_error = "Email cannot be empty";
			$email_status = "";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$email_error = "Invalid Email Format";
				$email_status = "";
			}
		}

		
		if (empty($password)) {
			$password_error = "Password cannot be empty";
			$password_status = "";
		}

		if (empty($confpassword)) {
			$confpassword_error = "Please confirm your password";
			$confpassword_status = "";
		}

		if ( !empty($user_status) && !empty($email_status) && !empty($password_status) && !empty($confpassword_status)) {
			//echo "<script>alert('All fields entered properly')</script>";

			$passIntegr = password_integrity($password);

			if (!empty($passIntegr)) {
				$confpassword_error = $passIntegr;
			}
			else {
				if (!empty(password_check($password, $confpassword))) {
					$confpassword_error = password_check($password, $confpassword);
				}
				else {
						
								if ($insertQuery) {
									$insertPassword = $obj->Normal_Query("INSERT INTO credentials VALUES (?,?, ?, ?, ?)", [NULL, $user, $email, password_hash($password, PASSWORD_DEFAULT), $date]);

									if ($insertPassword) {
										echo "<script>alert('Account Successfully Created. Go to the Login Page')</script>";
										header("Location:sign-in.php");

									}		
								}
								else {
									echo "<script>alert('Unable to add your account. Please try later')</script>";
								}
					
					
					
				}
			}
		}

		//header("Location: student.php" );
	}

	// function password_integrity($password) {

	// 	$error = "";

	// 	if (strlen($password) < 8) {
	// 		$error = "Password must contain at least 8 characters";
	// 	}
	// 	elseif (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {
	// 		$error = "Password must include caps, small letters, and numbers";
	// 	} 
	// 	else {
	// 		$error = "";
	// 	}

	// 	return $error;

	// }

	// function password_check($pass1, $pass2) {
	// 	$error = "";

	// 	if ($pass1 !== $pass2) {
	// 		$error = "Passwords do not match";
	// 	}
		
	// 	return $error;
	// }
?>