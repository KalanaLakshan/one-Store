<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

	 <link rel="stylesheet" type="text/css" href="./CSS/signUp.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

  	<?php include_once("./assests/navbar.php"); ?>
    
  	<!--Body Content Starts-->
    
  		<div class="container">

  			<!--User Login Starts-->
  			<div class="row vh-100 justify-content-center" id="userLogin">

  				<div class="col-md my-auto">

							    <div class="row lineShadow bg-success">

							    	<!--Left Side Strats-->
							    	<div class="col-lg-6 justify-content-center my-auto text-center bg-success">
							    		<img src="./Images/logo.png" style="width: 300px">
							    		<h1 class="text-light text-center">One Store</h1>
							    		<h3 class="text-light text-center">(Inventory and Billing Management System)</h3>
							    	</div>
							    	<!--Left Side Ends-->

							    	<!--Right Side-->
						    		<div class="col-lg-6 justify-content-center text-center bg-light">
						    			<!--User Login Starts-->
						    			<h1 class="text-dark mt-5 mb-3">Sign Up</h1>
							    		 <div id="successStatement" class="text-center text-light mb-3 p-2 boxRadious">  </div>

							    		 <form id="signUp-form" onsubmit="return false;">
							    		 	<div class="input-group mb-3 input-group-lg"> 
											  <input type="text" class="form-control" placeholder="Organization Name" id="orgName" name="orgName">
											</div>
											<p class="text-danger orgName_error fw-bold text-start"></p>

							    		 	<div class="input-group mb-3 input-group-lg">
											  <input type="text" class="form-control" placeholder="Username" id="username" name="username">
											</div>
											<p class="text-danger username_error fw-bold text-start"></p>

											<div class="input-group mb-3 input-group-lg">
											  <input type="text" class="form-control" placeholder="Email" id="email" name="email">
											</div>
											<p class="text-danger email_error fw-bold text-start"></p>

											<div class="input-group mb-3 input-group-lg">
											  <input type="number" class="form-control" placeholder="Phone Number" id="phone" name="phone">
											</div>
											<p class="text-danger phone_error fw-bold text-start"></p>

											<div class="input-group mb-3 input-group-lg">
											  <input type="password" class="form-control" placeholder="Password" id="password" name="password">
											</div>
											<p class="text-danger password_error fw-bold text-start"></p>

											<div class="input-group mb-3 input-group-lg">
											  <input type="password" class="form-control" placeholder="Confirm Password" id="cPassword" name="cPassword">
											</div>
											<p class="text-danger cPassword_error fw-bold text-start"></p>

											 <div class="text-center mt-4 mb-4">
												<button type="button" class="btn btn-outline-success btn-lg w-50" id="signUpBtn">Sign Up</button>
											 </div>						    		 
							    		 </form>

							    		 <!--User Login Ends-->




							    	</div>
							    	<!--Right Side Ends-->
							</div>
  				</div>

  			</div>
  			<!--User Login Ends-->

  		</div>


	<!--Body Content Ends-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="./assests/jquery-3.6.0.min.js"> </script>


    <script src="./JS/signUp.js" type="text/javascript"> </script>

  </body>
</html>