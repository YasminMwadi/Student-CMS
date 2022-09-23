<?php 
	$obj = new base_class;

	if(isset($_POST['register'])) {
		//echo "<script>alert('The button is clicked')</script>";
		//set all the variable status. 
		$student_number_status = $name_status = $surname_status = $gender_status
		 = $email_status = $graduation_status = $course_status = $enrolment_status= 
		 $receipt_status = $password_status = $confpassword_status =  1;

		$error_message = "";

		//Sanitize all the input fields. 
		
		$student_number = $obj->security($_POST['student-number']);
		$surname = $obj->security($_POST['surname']);
		$name = ucwords(strtolower($obj->security($_POST['name'])));
		$gender = $obj->security($_POST['gender']);
		$email = strtolower($obj->security($_POST['email']));

		$graduation = $obj->security($_POST['graduation']);
		$course = $obj->security($_POST['course']);

		$enrolment = $obj->security($_POST['enrolment']);
		$receipt = $obj->security($_POST['receipt']);
		

		$password = $obj->security($_POST['password']);
		$confpassword = $obj->security($_POST['conf-password']);

		//==========================

		$date = date("Y-m-d H:i:s"); //Get the date of the user addition in the system
		$status = 'active';

		//check fof the fields if empty. 
		if (empty($student_number)) {
			$student_number_error = "Student Number cannot be empty";
			$student_number_status = ""; 
		} 

		if (empty($name)) {
			$name_error = "Name cannot be empty";
			$name_status = "";
		} 

		if (empty($surname)) {
			$surname_error = "Surname cannot be empty";
			$surname_status = "";
		} 

		if (empty($gender)) {
			$gender_error = "Gender cannot be empty";
			$gender_status = "";
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

	
		if (empty($graduation)) {
			$graduation_error = "Graduation cannot be empty";
			$graduation_status = "";
		} 

		if (empty($course)) {
			$course_error = "Number of courses cannot be empty";
			$course_status = "";
		} 

		if (empty($enrolment)) {
			$enrolment_error = "The enrolement date cannot be empty";
			$enrolment_status = "";
		}
		
		if (empty($receipt)) {
			$receipt_error = "The receipt number cannot be empty";
			$receipt_status = "";
		} 

		if (empty($password)) {
			$password_error = "Password cannot be empty";
			$password_status = "";
		}

		if (empty($confpassword)) {
			$confpassword_error = "Please confirm your password";																					
			$confpassword_status = "";
		}

		if (!empty($student_number_status) && !empty($name_status) && !empty($surname_status) && 
		!empty($gender_status) && !empty($email_status) && !empty($graduation_status) && !empty($course_status) 
		&& !empty($enrolment_status) && !empty($receipt_status) && !empty($password_status) && !empty($confpassword_status)) {
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
					//Check if the student and the email already registered
					$std_nbr_check = $obj->Normal_Query("SELECT * FROM student WHERE std_nbr = ?", [$student_number]);

					if ($obj->count_Rows() > 0) {
						echo "<script>alert('Student number already registered in the system under another student.')</script>";

					}

					else {
						//$error_message = "Student not activated in the system";
						
						$act_result = $obj->Single_Result();

						// if ($act_result->status == 'active') {
							$email_check = $obj->Normal_Query("SELECT * FROM student WHERE email = ?", [$email]);

							if ($obj->count_Rows() > 0) {
								$email_error = "Email address already registered in the system under another student.";
							}
							else {
								$insertQuery = $obj->Normal_Query("INSERT INTO student VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [NULL, $student_number, $surname, $name, $gender, $email, $course,  $receipt, $graduation, $enrolment, $date]);

								if ($insertQuery) {
										$insertQuery = $obj->Normal_Query("INSERT INTO student_activation VALUES (?, ?, ?, ?, ?, ?)", [NULL, $student_number, $status,  $email, $date, NULL]);
									$insertPassword = $obj->Normal_Query("INSERT INTO credentials VALUES (?, ?, ?, ?)", [NULL, $student_number, password_hash($password, PASSWORD_DEFAULT), $date]);

									if ($insertPassword) {
										// echo "<script>alert('Account Successfully Created. Go to the Login Page')</script>";
										header("Location:login.php");

									}		
								}
								else {
									echo "<script>alert('Unable to add your account. Please contact Administrator')</script>";
								}
							}
						// }
						// else {
						// 	echo "<script>alert('Student Deactivated. Please contact Administrator')</script>";
						// }
					}
					
					
					}
				}
			}
		}

		//header("Location: student.php" );
		
	//  }

	function password_integrity($password) {

		$error = "";

		if (strlen($password) < 8) {
			$error = "Password must contain at least 8 characters";
		}
		elseif (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {
			$error = "Password must include caps, small letters, and numbers";
		} 
		else {
			$error = "";
		}

		return $error;

	}

	function password_check($pass1, $pass2) {
		$error = "";

		if ($pass1 !== $pass2) {
			$error = "Passwords do not match";
		}
		
		return $error;
	}

?>