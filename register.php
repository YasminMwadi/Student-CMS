<?php 
	include 'inc/signupHeader.php'; 
	require 'handlers/signup-handler.php'; 
?>
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-9 m-auto ">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" form method="POST" action="">
                                <div class="form-group row">
                                        <div  class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="student-number" class="form-control form-control-user" id="exampleFirstName"
                                                placeholder="Student Number" value="<?php if(isset($student_number)) echo $student_number; ?>">
                                                <div class="errormsg">
                                                    <?php if (isset($student_number_error)) echo $student_number_error; ?>
                                                </div>
                                            
                                        </div>

                                        <div  class="col-sm-6">
                                                <div  id="exampleFirstName" >
                                                    <select name="gender" class="form-control form-control-user">
                                                        <option value="<?php if(isset($gender)) echo $gender; ?>"> <?php if (isset($gender)) {
                                                            echo $gender;
                                                            } else echo "---Select Gender----"; ?></option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                    </select>
                                                    <div class="errormsg">
                                                        <?php if (isset($gender_error)) echo $gender_error; ?>
                                                    </div>  
                                                </div>
                                                            
                                        </div>
                                        
                                </div> <!--end student number and gender-->

                                <div class="form-group row">
                                    <div  class="col-sm-6 mb-3 mb-sm-0"> 
                                        <input type="text"  name="name" class="form-control form-control-user" id="exampleFirstName"  value="<?php if(isset($name)) echo $name; ?>"
                                        placeholder="First Name" >
                                            <div class="errormsg">
												<?php if (isset($name_error)) echo $name_error; ?>
											</div>
                                    </div>

                                    <!-- <div class="col-sm-6"> -->
                                    <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="exampleLastName"name="surname"  value="<?php if(isset($surname)) echo $surname; ?>"
                                                placeholder="Last Name">
                                                <div class="errormsg">
                                                    <?php if (isset($surname_error)) echo $surname_error; ?>
                                                </div>
                                    </div>
                                    
                                </div>
                                    <!-- end name and surname -->

                                <div class="form-group row">
											<input type="email" name="email" placeholder="Email Address" class="form-control form-control-user" id="exampleLastName" value="<?php if(isset($email)) echo $email; ?>"> 
											<div class="errormsg">
											    <?php if (isset($email_error)) echo $email_error; ?>
											</div>						
								</div><!-- end email -->

                               <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" name="course" value="<?php if(isset($course)) echo $course; ?>"
                                            placeholder="Number courses">
                                            <div class="errormsg">
												<?php if (isset($course_error)) echo $course_error; ?>
											</div>
                                    </div>
                                    
                                <div class="col-sm-6">
                                    <div  id="exampleFirstName" >
                                        <select name="graduation" class="form-control form-control-user">
                                            <option value="<?php if(isset($graduation)) echo $graduation; ?>"> <?php if (isset($graduation)) {
                                                echo $graduation;
                                                } else echo "---ready_to_graduate?----"; ?></option>
                                                <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <div class="errormsg">
                                            <?php if (isset($graduation_error)) echo $graduation_error; ?>
                                        </div>
                                    </div>
                                                    
                                </div>
                                </div>
                                <!-- end graduation and course -->

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="sn-field">
                                            <input type="text" name="receipt" placeholder="Receipt Number" class="form-control form-control-user" id="exampleLastName" value="<?php if(isset($receipt)) echo $receipt; ?>"> 
                                            <div class="errormsg">
                                                <?php if (isset($receipt_error)) echo $receipt_error; ?>
                                            </div>
                                        </div>
                                                        
                                    </div>
                                    

                                    <div  class="col-sm-6">
                                        <input type="date" class="form-control form-control-user" id="exampleFirstName" name="enrolment" value="<?php if(isset($enrolment_date)) echo $enrolment_date; ?>"
                                            placeholder="Enrolment date">
                                            <div class="errormsg">
                                                <?php if (isset($enrolment_error)) echo $enrolment_error; ?>
                                            </div>
                                    </div> 
                                </div>
                                 <!-- end receipt and enrolment -->



                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password"  name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                            <div class="errormsg">
                                                <?php if (isset($password_error)) echo $password_error; ?>
                                            </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="conf-password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                            <div class="errormsg">
                                                <?php if (isset($confpassword_error)) echo $confpassword_error; ?>
                                            </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" name="register" value="signup">Register Account</button>
                                     <!-- end password -->
                                <hr>
                                                                
                            </form>
                        </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php 
	include 'inc/signupFooter.php'; 
?>

   