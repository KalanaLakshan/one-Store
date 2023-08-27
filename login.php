<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

	 <link rel="stylesheet" type="text/css" href="./CSS/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
  </head>
  <body>

  	<?php include_once("./assests/navbar.php"); ?>
    
  	<!--Body Content Starts-->
    
  		<div class="container">

  			<!--User Login Starts-->
  			<div class="row vh-100 justify-content-center" id="userLogin">

  				<div class="col-md my-auto">

							    <div class="row lineShadow bg-danger">

							    	<!--Left Side Strats-->
							    	<div class="col-lg-6 justify-content-center my-auto text-center bg-danger">
							    		<img src="./Images/logo.png" style="width: 300px">
							    		<h1 class="text-light text-center">One Store</h1>
							    		<h3 class="text-light text-center">(Inventory and Billing Management System)</h3>
							    	</div>
							    	<!--Left Side Ends-->

							    	<!--Right Side-->
						    		<div class="col-lg-6 justify-content-center text-center bg-light">
						    			<!--User Login Starts-->
						    			<h1 class="text-dark mt-5 mb-3">User Login</h1>
							    		 <div id="userLogError" class="text-center text-light bg-danger mb-3 p-2 boxRadious"> </div>
							    		 <form id="userLoginForm" onsubmit="return false;">
							    		 	<div class="input-group mb-3 input-group-lg"> 
											  <input type="text" class="form-control" placeholder="Organization Name" id="orgName" name="orgName">
											</div>
											<p class="text-danger orgName_error fw-bold text-start"></p>

											<div class="input-group mb-3 input-group-lg">
											  <input type="password" class="form-control" placeholder="Password" id="userPassword" name="userPassword">
											</div>
											<p class="text-danger userPassword_error fw-bold text-start"></p>

											 <div class="text-center mt-4">
												<button type="button" class="btn btn-outline-danger btn-lg w-50" id="userLoginBtn">Login</button>
											 </div>						    		 
							    		 </form>

											 <div class="text-center mt-5 mb-5">
												<button type="button" class="btn btn-success btn w-50" id="gotoAdminLogin">Go to Admin Login Page</button>
											 </div>		
							    		 <!--User Login Ends-->




							    	</div>
							    	<!--Right Side Ends-->
							</div>
  				</div>

  			</div>
  			<!--User Login Ends-->


  			<!--Admin Login Starts-->
  			<div class="row vh-100 justify-content-center" id="adminLogin">

  				<div class="col-md my-auto">

							    <div class="row lineShadow bg-warning">

							    	<!--Left Side Strats-->
							    	<div class="col-lg-6 justify-content-center my-auto text-center bg-warning">
							    		<img src="./Images/logo.png" style="width: 300px">
							    		<h1 class="text-light text-center">One Store</h1>
							    		<h3 class="text-light text-center">(Inventory and Billing Management System)</h3>
							    	</div>
							    	<!--Left Side Ends-->

							    	<!--Right Side-->
						    		<div class="col-lg-6 justify-content-center text-center bg-light">
						    			<!--User Login Starts-->
						    			<h1 class="text-dark mt-5 mb-3">Admin Login</h1>
							    		 <div id="adminLogError" class="text-center text-light bg-danger mb-3 p-2 boxRadious">  </div>
							    		 <form id="adminLoginForm" onsubmit="return false;">
							    		 	<div class="input-group mb-3 input-group-lg">
											  <input type="text" class="form-control" placeholder="Username" id="username" name="username">
											</div>
											<p class="text-danger username_error fw-bold text-start"></p>

											<div class="input-group mb-3 input-group-lg">
											  <input type="password" class="form-control" placeholder="Password" id="adminPassword" name="adminPassword">
											</div>
											<p class="text-danger adminPassword_error fw-bold text-start"></p>

											 <div class="text-center mt-4">
												<button type="button" class="btn btn-outline-warning btn-lg w-50" id="adminLoginBtn">Login</button>
											 </div>						    		 
							    		 </form>

											 <div class="text-center mt-5 mb-5">
												<button type="button" class="btn btn-success btn w-50" id="gotoUserLogin">Go to User Login Page</button>
											 </div>		
							    		 <!--User Login Ends-->




							    	</div>
							    	<!--Right Side Ends-->
							</div>
  				</div>

  			</div>
  			<!--Admin Login Ends-->

  		</div>


	<!--Body Content Ends-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="./assests/jquery-3.6.0.min.js"> </script>


    <script src="./JS/login.js" type="text/javascript"> </script>

  </body>
</html>