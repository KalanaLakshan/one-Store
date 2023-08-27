<?php include_once("./assests/sessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/feedbacks.css?version=3">
    <!-- Includings for the Project Starts -->

      <?php include_once("./assests/includings.php") ?>

    <!-- Includings for the Project Ends -->
  </head>
  <body>
    
<!--     <h1>Dashboard</h1>
    <button type="button" class="btn btn-primary" id="userLogout">Logout</button> -->

      <div class="main-container d-flex">
      <!-- Side Nav Starts -->
      <div class="sidebar bg-danger" id="sideNav">
          <?php include_once("./assests/userSidebar.php") ?>
      </div><!-- Side Nav Endss -->

      <!-- Content of the Page Starts -->
      <div class="content">
        <?php include_once("./assests/header.php") ?>


          <!-- Your HTML Codes Starts -->
          <div class="container p-5">
              <div class="card p-3"> 
                  <h3 class="text-center text-light bg-success rounded-pill mb-3">Feedbacks</h3>
                  <form id="feedbackForm">
                    <div class="input-group mb-1 input-group-lg"> 
                          <input type="text" class="form-control" placeholder="orgID" id="orgID" name="orgID" value="<?php echo $orgID; ?>" style="display: none">
                    </div>
                    <div class="form-floating">
                      <textarea class="form-control" placeholder="Leave a feedback here" id="feedback" style="height: 100px"></textarea>
                      <label for="floatingTextarea2">Feedback</label>
                    </div>
                     <p class="text-danger feedback_error mt-3 fw-bold text-start"></p>
                    <button type="button" class="btn btn-primary" id="sendFeedback">Send Feedback</button>
                  </form>

              <div class="card p-3 text-center my-4" id="feedbacks" style="box-shadow: 5px 5px;">
                      <!--User Feedbacks Are Here-->
              </div>
              </div>  
          </div>
          <!-- Your HTML Codes Ends -->


      </div><!-- Content of the Page Endss -->
    </div>

    <script src="./JS/feedbacks.js" type="text/javascript"> </script>
    <script src="./JS/setNotifications.js" type="text/javascript"> </script>
    <script src="./JS/userLogout.js" type="text/javascript"> </script>

  </body>
</html>