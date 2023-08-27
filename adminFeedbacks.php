<?php include_once("./assests/adminSessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/adminFeedbacks.css?version=3">

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

                  <form id="replyFeedbackForm">
                    <div class="input-group mb-3 input-group-lg"> 
                          <input type="text" class="form-control" placeholder="orgID" id="orgID" name="orgID" style="display: none;">
                    </div>
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Leave a reply feedback here" id="replyFeedback" style="height: 100px"></textarea>
                      <label for="floatingTextarea2">Reply Feedback</label>
                    </div>
                     <p class="text-danger replyFeedback_error mt-3 fw-bold text-start"></p>
                    <button type="button" class="btn btn-success mb-3" id="sendReply">Send Reply</button>
                  </form>

             <div class="card p-3 text-center" id="adminFeedbacks" style="box-shadow: 5px 5px;">
                      <!--Admin Feedbacks Here-->
              </div>
          </div>


          <!-- Your HTML Codes Ends -->

      </div><!-- Content of the Page Endss -->
    </div>

<!--     <script src="./assests/jquery-3.6.0.min.js"> </script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->


    <script src="./JS/adminFeedbacks.js" type="text/javascript"> </script>
    <script src="./JS/setAdminNotifications.js" type="text/javascript"> </script>
    <script src="./JS/adminLogout.js" type="text/javascript"> </script>

  </body>
</html>