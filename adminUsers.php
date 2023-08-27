<?php include_once("./assests/adminSessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/adminUsers.css?version=3">

    <!-- Includings for the Project Starts -->

    	<?php include_once("./assests/includings.php") ?>

	<!-- Includings for the Project Ends -->
  
  </head>
  <body>
    
      <!--     <h1>Admin Home</h1>
    <button type="button" class="btn btn-primary" id="adminLogout">Logout</button> -->

    <div class="main-container d-flex">
      <!-- Side Nav Starts -->
      <div class="sidebar bg-dark" id="sideNav">
          <?php include_once("./assests/adminSidebar.php") ?>
      </div><!-- Side Nav Endss -->

      <!-- Content of the Page Starts -->
      <div class="content">
        <?php include_once("./assests/adminHeader.php") ?>

          <!-- Your HTML Codes Starts -->

          <div class="container-fluid p-5">
          	 <div class="card p-3 text-center" id="users" style="box-shadow: 5px 5px;">
                <!-- Users Table Fetchd Here -->
			 </div>
          </div>




          <!-- Your HTML Codes Ends -->

      </div><!-- Content of the Page Endss -->
    </div>

<!--     <script src="./assests/jquery-3.6.0.min.js"> </script>

	<script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->


    <script src="./JS/adminUsers.js" type="text/javascript"> </script>
    <script src="./JS/setAdminNotifications.js" type="text/javascript"> </script>
    <script src="./JS/adminLogout.js" type="text/javascript"> </script>

  </body>
</html>