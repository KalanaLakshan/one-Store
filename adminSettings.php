<?php include_once("./assests/adminSessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/adminSettings.css?version=3">
  
  <!-- Includings for the Project Starts -->

      <?php include_once("./assests/includings.php") ?>

  <!-- Includings for the Project Ends -->
  </head>
  <body>

    <div class="main-container d-flex">
      <!-- Side Nav Starts -->
      <div class="sidebar bg-dark" id="sideNav">
          <?php include_once("./assests/adminSidebar.php") ?>
      </div><!-- Side Nav Endss -->

      <!-- Content of the Page Starts -->
      <div class="content">
        <?php include_once("./assests/adminHeader.php") ?>

          <!-- Your HTML Codes Starts -->
                  <div class="container p-5">

                    <div class="card p-5">
                      <div class="card-body">
                            <h1 class="text-dark text-center mt-2 mb-3">Change Password</h1>
                            <div id="changePasswordError" class="text-center text-light bg-danger mb-3 p-2 boxRadious"> </div>
                              <form id="changePasswordForm" onsubmit="return false;">
                                <div class="input-group mb-3 input-group-lg"> 
                                  <input type="text" class="form-control" placeholder="Admin Username" id="adminUsername" name="adminUsername" value="<?php echo $adminName ?>" disabled style="display: none">
                                </div>
                                <div class="input-group input-group-lg">
                                  <span class="input-group-text" id="basic-addon1">Old Password</span>  
                                  <input type="password" class="form-control" placeholder="Enter the Old Password" id="oldPassword" name="oldPassword">
                                </div>
                              <p class="text-danger oldPasswordError fw-bold text-start"></p>

                              <div class="input-group input-group-lg">
                                <span class="input-group-text" id="basic-addon1">New Password</span> 
                                <input type="password" class="form-control" placeholder="Enter the New Password" id="newPassword" name="newPassword">
                              </div>
                              <p class="text-danger newPasswordError fw-bold text-start"></p>

                               <div class="text-center mt-4">
                                <button type="button" class="btn btn-outline-success btn-lg w-50" id="changePasswordBtn">Change Password</button>
                               </div>                    
                              </form>
                      </div>
                    </div>

                  </div>

          <!-- Your HTML Codes Ends -->

      </div><!-- Content of the Page Endss -->
    </div>







  	

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="./assests/jquery-3.6.0.min.js"> </script>

    <script src="./JS/adminSettings.js" type="text/javascript"> </script>
    <script src="./JS/setAdminNotifications.js" type="text/javascript"> </script>
    <script src="./JS/adminLogout.js" type="text/javascript"> </script>

  </body>
</html>