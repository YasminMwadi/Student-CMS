<?php 
	$obj = new base_class;

	if(isset($_POST['add-incubatee'])) {
		//echo "<script>alert('The button is clicked')</script>";
		//set all the variable status. 
		$reg_num_status= $comp_name_status = $direct_surname_status = $direct_name_status = $email_status = $contact_status = $services_status = $location_status =  $job_created_status  =  $incub_stage_status = 1;

		//Sanitize all the input fields. 
		
		$reg_num= $obj->security($_POST['reg_num']);
		$comp_name = $obj->security($_POST['comp_name']);
		$direct_surname = $obj->security($_POST['direct_surname']);
		$direct_name = $obj->security($_POST['direct_name']);
		$email = strtolower($obj->security($_POST['email_address']));

		$contact = $obj->security($_POST['phone']);
		$services = $obj->security($_POST['services']);
		$location = $obj->security($_POST['location']);
		$job_created = $obj->security($_POST['job_created']);
		$incub_stage = $obj->security($_POST['incub_stage']);


		
		//==========================

		$date = date("Y-m-d H:i:s"); //Get the date of the user addition in the system
		$status = 'active';
		$user = 'yasmine@admin.com';

		//check for the fields if empty. 
		
		if (empty($reg_num)) {
			$reg_num_error = "Registration Number cannot be empty";
			$reg_num_status = ""; 
		} 
		if (empty($comp_name)) {
			$comp_name_error = "Company name cannot be empty";
			$comp_name_status = "";
		} 

		if (empty($direct_surname)) {
			$direct_surname_error = "Dirctor surname cannot be empty";
			$direct_surname_status = "";
		} 

		if (empty($direct_name)) {
			$direct_name_error = "Director name cannot be empty";
			$direct_name_status = "";
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

		if (empty($services)) {
			$services_error = "Services cannot be empty";
			$services_status = "";
		} 

		if (empty($location)) {
			$location_error = "Business location cannot be empty";
			$location_status = "";
		} 
		if (empty($job_created)) {
			$job_created_error = "Job Created cannot be empty, use 0 where is no job";
			$job_created_status = "";
		} 
		if (empty($incub_stage)) {
			$incub_stage_error = "Incubation stage cannot be empty";
			$incub_stage_status = "";
		} 


// ---------------------------------------------

		if (!empty($reg_num_status) && !empty($comp_name_status) && !empty($direct_surname_status) && !empty($direct_name_status)&& !empty($email_status) && !empty($contact_status)  && !empty($services_status)  && !empty($location_status) && !empty($job_created_status) && !empty($incub_stage_status)) {
			
			//echo "<script>alert('All fields entered properly')</script>";

			//Check if the registration number already registered
			$reg_num_check = $obj->Normal_Query("SELECT * FROM client WHERE reg_num = ?", [$reg_num]);

				if ($obj->count_Rows() > 0) {
					$reg_num_error = "Registration number already registered in the system.";

				} else {
					try {
						$insertQuery = $obj->Normal_Query("INSERT INTO client VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?)", [NULL, $reg_num, $comp_name, $direct_surname, $direct_name, $email, $contact, $services, $location,$job_created,$incub_stage, $date, $user]);

						if ($insertQuery) {
							$reg_num= $comp_name= $direct_surname = $direct_name = $email = $contact= $services  = $location = $job_created  = $incub_stage = "";
							echo "<script>alert('Data Inserted successfully into the system')</script>";
						} else {
							echo "<script>alert('Unable to add data')</script>";
						}
						
					} catch (Exception $e) {
						echo $e;
						
					}
				}
			
		}

		//header("Location: client.php" );
	}
?>