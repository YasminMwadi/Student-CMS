<?php 
	require 'init.php';

	if (isset($_GET['id'])) {

		$obj = new base_class;

		$id = $_GET['id'];
		$id = substr($id, 49);
		$id = base64_decode(urldecode(urldecode($id)));

		$status = "inactive";

		$query = $obj->Normal_Query("UPDATE student_activation SET status = ? WHERE std_nbr = ?", [$status, $id]);
		
		try {
			if ($query) {
				echo "<script>'Student Account Deleted'</script>";
				header("Location:student.php");
			}
			else {
				echo "<script>'Unable to delete the student account, please contact administrator'</script>";
				header("Location:student.php");
			}
			
		} catch (Exception $e) {
			
		}

	}
 ?>