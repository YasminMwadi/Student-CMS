<?php 
	include 'inc/signupHeader.php'; 
	include 'handlers/login-handler.php';; 
?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-6 d-none d-lg-block login-image"></div> -->
                    <div class="col-lg-9 m-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user"  method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" 
                                        id="exampleInputEmail" aria-describedby="emailHelp"
                                        placeholder="Enter Student Number...">
                                        <div class="errormsg">
											<?php if (isset($username_error)) echo $username_error; ?>
										</div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password"
                                        id="exampleInputPassword" placeholder="Password">
                                        <div class="errormsg">
											<?php if (isset($password_error)) echo $password_error; ?>
										</div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox"  name="cc" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" name="rememberme" value="1" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                                </form>
                                <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                             </div>
                               
                            <div class="text-center">
                                <a class="small" href="register.php">Create an Account!</a>
                            </div>
                        </div>
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