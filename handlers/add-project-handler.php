<?php 
	$obj = new base_class;

	if(isset($_POST['add-project'])) {
		//echo "<script>alert('The button is clicked')</script>";
		//set all the variable status. 
		$student_number_status = $name_status = $surname_status = $gender_status = $email_status = $contact_status = $pgs_status = $qual_status = $reg_date_status = $grad_date_status = $image_status = 1;

		//Sanitize all the input fields. 
		
		$student_number = $obj->security($_POST['student-number']);
		$surname = $obj->security($_POST['surname']);
		$name = ucwords(strtolower($obj->security($_POST['name'])));
		$gender = $obj->security($_POST['gender']);
		$email = strtolower($obj->security($_POST['email']));

		$contact = $obj->security($_POST['phone']);
		$pgs = $obj->security($_POST['pgs-level']);
		$qualification = $obj->security($_POST['qualification']);

		$reg_date = $obj->security($_POST['reg-date']);
		$grad_date = $obj->security($_POST['grad-date']);

		$img_name = $_FILES['img']['name'];
		$img_tmp = $_FILES['img']['tmp_name'];
		//Handling the Image 
		$img_path = "upload/student/";
		$extensions = ['jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'];

		$img_ext = explode(".", $img_name);
		$img_extension = end($img_ext);

		//==========================

		$date = date("Y-m-d H:i:s"); //Get the date of the user addition in the system
		$status = 'active';
		$user = 'yasmin@admin.com';

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

		if (empty($contact)) {
			$contact_error = "Contact details cannot be empty";
			$contact_status = "";
		} else {
			if(strlen($contact) != 10 || !ctype_digit($contact)) {
				$contact_error = "Invalid phone number format";
				$contact_status = "";
			}
		}

		if (empty($pgs)) {
			$pgs_error = "Post Graduate Study cannot be empty";
			$pgs_status = "";
		} 

		if (empty($qualification)) {
			$qual_error = "Qualification cannot be empty";
			$qual_status = "";
		} 

		if (empty($reg_date)) {
			$reg_date_error = "The Registration date cannot be empty";
			$reg_date_status = "";
		}
		
		if (empty($grad_date)) {
			$grad_date_error = "The graduation date cannot be empty";
			$grad_date_status = "";
		} 

		if (!in_array($img_extension, $extensions)) {
			$image_error = "Invalid Image Format or Extension";
			$image_status = "";
		}

		if (!empty($student_number_status) && !empty($name_status) && !empty($surname_status) && !empty($gender_status) && !empty($email_status) && !empty($contact_status) && !empty($pgs_status) && !empty($qual_status) && !empty($reg_date_status) && !empty($grad_date_status) && !empty($image_status)) {
			//echo "<script>alert('All fields entered properly')</script>";

			$new_file_name = $student_number . '.' .$img_extension;

			//Check if the student and the email already registered
			$std_nbr_check = $obj->Normal_Query("SELECT * FROM student WHERE std_nbr = ?", [$student_number]);

			if ($obj->count_Rows() > 0) {
				$student_number_error = "Student number already registered in the system";
			} else {
				$email_check = $obj->Normal_Query("SELECT * FROM student WHERE email = ?", [$email]);

				if ($obj->count_Rows() > 0) {
					$email_error = "Email Address Already registered in the system under another student.";

				} else {
					$insertQuery = $obj->Normal_Query("INSERT INTO student VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [NULL, $student_number, $surname, $name, $gender, $email, $contact, $pgs, $qualification, $reg_date, $grad_date, $status, $new_file_name, $date, $user]);

					if ($insertQuery) {
						
						move_uploaded_file($img_tmp, "$img_path/$new_file_name");

						echo "<script>alert('Data Inserted successfully into the system')</script>";
						$student_number = $surname = $name = $gender = $email = $contact = $pgs = $qualification = $reg_date = $grad_date = "";
					} else {
						echo "<script>alert('Unable to add data')</script>";
					}
				}
			}
		}

		//header("Location: student.php" );
	}
?>