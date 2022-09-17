<?php 
	$obj = new base_class;

	if(isset($_POST['add-supervision'])) {
		//echo "<script>alert('The button is clicked')</script>";
		//set all the variable status. 
		$student_number_status = $name_status = $surname_status =  $email_status = $qual_status = $supervisor_status = $cosupervisor_status  = 1;

		//Sanitize all the input fields. 
		
		$student_number = $obj->security($_POST['student_number']);
	    $supervisor = $obj->security($_POST['supervisor']);
	    $cosupervisor = $obj->security($_POST['cosupervisor']);

		
		//==========================

		$date = date("Y-m-d H:i:s"); //Get the date of the user addition in the system
		//$status = 'active';
		$user = 'yasmin@admin.com';

		//check fof the fields if empty. 
		if (empty($student_number)) {
			$student_number_error = "Student Number cannot be empty";
			$student_number_status = ""; 
		} 


		if (empty($supervisor)) {
			$sup_error = "Supervisor cannot be empty";
			$supervisor_status = "";
		}
		
		if (empty($cosupervisor)) {
			$cosup_error = "Co-supervisor cannot be empty";
			$cosupervisor_status = "";
		} 

		
		if (!empty($student_number_status) && !empty($supervisor_status) && !empty($cosupervisor_status)) {
			//echo "<script>alert('All fields entered properly')</script>";

			

			//Check if the student exist in the database
			//$std_nbr_check = $obj->Normal_Query("SELECT * FROM student WHERE std_nbr = ?", [$student_number]);
			$stud= $obj->Normal_Query("select * from student where std_nbr = ?", [$student_number]);

				if($stud ==$student_number)
				{


					$insertQuery1 = $obj->Normal_Query("INSERT INTO supervision VALUES (?, ?, ?, ?, ?)", [NULL, $student_number, $supervisor ,$date, $user]);
					if ($insertQuery1)

					{
						$insertQuery2 = $obj->Normal_Query("INSERT INTO cosupervision VALUES (?, ?, ?, ?, ?)", [NULL, $student_number, $cosupervisor ,$date, $user]);
					}
					else {
				echo "<script>alert('Unable to add data')</script>";
					}

				}

				else {
				echo "<script>alert('Student does not exist in the database')</script>";
					}
					
					
			
		}
		// else {
		// 		echo "<script>alert('Unable to add data')</script>";
		// 			}
				

		//header("Location: student.php" );
	}
?>