<?php 
	$obj = new base_class;

	if(isset($_POST['add-staff'])) {
		//echo "<script>alert('The button is clicked')</script>";
		//set all the variable status. 
		$staff_number_status = $name_status = $surname_status = $gender_status = $email_status = $contact_status = $position_status = $center_status =  $image_status = 1;

		//Sanitize all the input fields. 
		
		$staff_number = $obj->security($_POST['staff_number']);
		$surname = $obj->security($_POST['surname']);
		$name = ucwords(strtolower($obj->security($_POST['name'])));
		$gender = $obj->security($_POST['gender']);
		$email = strtolower($obj->security($_POST['email']));

		$contact = $obj->security($_POST['phone']);
		$position = $obj->security($_POST['position']);
		$center = $obj->security($_POST['center']);
		
		$img_name = $_FILES['img']['name'];
		$img_tmp = $_FILES['img']['tmp_name'];
		//Handling the Image 
		$img_path = "upload/staff/";
		$extensions = ['jpg', 'jpeg', 'png','JPG', 'JPEG', 'PNG'];

		$img_ext = explode(".", $img_name);
		$img_extension = end($img_ext);



		//==========================

		$date = date("Y-m-d H:i:s"); //Get the date of the user addition in the system
		$status = 'active';
		$user = 'yasmine@admin.com'; 

		//check fof the fields if empty. 
		if (empty($staff_number)) {
			$staff_number_error = "Staff Number cannot be empty";
			$staff_number_status = ""; 
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

		if (empty($position)) {
			$position_error = "Staff position cannot be empty";
			$position_status = "";
		} 

		if (empty($center)) {
			$center_error = "Center cannot be empty";
			$center_status = "";
		} 


		if (!in_array($img_extension, $extensions)) {
			$image_error = "Invalid Image Format or Extension";
			$image_status = "";
		}



		if (!empty($staff_number_status) && !empty($name_status) && !empty($surname_status) && !empty($gender_status) && !empty($email_status) && !empty($contact_status) && !empty($position_status) && !empty($center_status) && !empty($image_status)) {
			//echo "<script>alert('All fields entered properly')</script>";

			$new_file_name = $staff_number . '.' .$img_extension;

			//Check if the student and the email already registered
			$stf_nbr_check = $obj->Normal_Query("SELECT * FROM staff WHERE stf_nbr = ?", [$staff_number]);

			if ($obj->count_Rows() > 0) {
				$staff_number_error = "Staff number already registered in the system";
			} else {
				$email_check = $obj->Normal_Query("SELECT * FROM staff WHERE email = ?", [$email]);
				

				if ($obj->count_Rows() > 0) {
					$email_error = "Email Address Already registered in the system under another student.";

				} else {
					$insertQuery = $obj->Normal_Query("INSERT INTO staff VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?,?)", [NULL, $staff_number, $surname, $name, $gender, $email, $contact, $position, $center, $new_file_name, $date, $user]);

					//echo "<script>alert('All fields entered properly')</script>";

					if ($insertQuery) {
						
						move_uploaded_file($img_tmp, "$img_path/$new_file_name");

						echo "<script>alert('Data Inserted successfully into the system')</script>";
						$staff_number = $surname = $name = $gender = $email = $contact = $position = $center = "";
			 		} else {
						echo "<script>alert('Unable to add data')</script>";
			 		}
				}
			}
		}

		//header("Location: staff.php" );
	}
?>