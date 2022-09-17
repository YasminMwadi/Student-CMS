<?php 
	include 'inc/studentHeader.php'; 
	// include 'handlers/login-handler.php';; 
    require 'class/config.php';
    require 'class/base_class.php';
?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank"
        href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-money-bill"></i> Payment</a>
                    </div>
<div class="card shadow mb-4">
    
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registered students</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Student Number</th>
                        <th>Surname</th>
                        <th>name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>number of Courses</th>
                        <th>Receipt Number</th>
                        <th>Ready to Graduate?</th>
                        <th>Enrolment Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Student Number</th>
                        <th>Surname</th>
                        <th>name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>number of Courses</th>
                        <th>Receipt Number</th>
                        <th>Ready to Graduate?</th>
                        <th>Enrolment Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
                <tbody>
                <?php 
					$obj = new base_class;

					$query = $obj->Normal_Query("SELECT A.*, B.`status` FROM student AS A INNER JOIN student_activation AS B ON A.std_nbr = B.std_nbr WHERE B.`status`='active'");
					$queryOutput = $obj->fetch_all();

					foreach ($queryOutput as $row) {
						?>
							<tr>
								<td><?php echo $row->std_nbr; ?></td>
								<td><?php echo $row->surname; ?></td>
								<td><?php echo $row->name; ?></td>
								<td><?php echo $row->gender; ?></td>
								<td><?php echo $row->email; ?></td>
								<td><?php echo $row->number_courses; ?></td>
                                <td><?php echo $row->receipt_number; ?></td>
                                <td><?php echo $row->ready_to_graduate; ?></td>
                                <td><?php echo $row->enrolment_date; ?></td>
								<td><a href="student-edit.php?id=<?php echo substr(md5($row->std_nbr), 7).base64_encode('=username_profile=').urlencode(urlencode(base64_encode($row->std_nbr))); ?>"><i class="fas fa-user-edit"></i></a></td>
								<td><a href="student-delete.php?id=<?php echo substr(md5($row->std_nbr), 7).base64_encode('=username_profile=').urlencode(urlencode(base64_encode($row->std_nbr))); ?>" onclick="return confirm('This process will delete all students related data. Are you sure you want to proceed?')"><i class="fas fa-trash-alt "></i></a></td>
							</tr>
						<?php
														} //class="btn btn-primary
						 ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php 
	include 'inc/studentFooter.php'; 
?>