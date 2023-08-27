<?php include_once("./assests/sessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/settings.css?version=3">
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
          <div class="container-fluid px-5">
                <div class="input-group mb-3 input-group-lg"> 
                      <input type="text" class="form-control" placeholder="orgID" id="orgID" name="orgID" value="<?php echo $orgID; ?>" style="display: none">
                </div>
              <div class="row">
                  <div class="col-md-7">
                    <div class="card p-3">
                        <h1 class="text-dark text-center mt-2 mb-3">Change Details</h1>
                        <div id="changeUserDetailsMsg" class="text-center text-light bg-danger mb-3 p-2 boxRadious"> </div>
                        <form id="changeSettings">
                        <table class="table">
                        <thead>

                        </thead>
                        <tbody>
<!--                           <tr>
                            <th scope="col"><h3> Organization Name:  </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="orgNameEdit" placeholder="Organization Name"></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> User Name:  </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="userNameEdit" placeholder="User Name"></td>
                          </tr> -->
                          <tr>
                            <th scope="col"> <h3> E-mail:  </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="emailEdit" placeholder="Email" value="<?php echo $email ?>"></td>
                            <p class="text-danger editEmail_error fw-bold text-start"></p>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Phone:  </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="phoneEdit" placeholder="Phone" value="<?php echo $phone ?>"></td>
                            <p class="text-danger editPhone_error fw-bold text-start"></p>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Registration Date:  </h3></th>
                            <td scope="col"><input type="date" class="form-control h3" id="regDateEdit" placeholder="Registration Date" value="<?php echo $reg_date ?>"></td>
                            <p class="text-danger editRegDate_error fw-bold text-start"></p>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Business Registration: </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="bRegNoEdit" placeholder="Business Registration" value="<?php echo $business_reg ?>"></td>
                            <p class="text-danger editBusinessReg_error fw-bold text-start"></p>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Country: </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="countryEdit" placeholder="Country" value="<?php echo $country ?>"></td>
                            <p class="text-danger editCountry_error fw-bold text-start"></p>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> City: </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="cityEdit" placeholder="City" value="<?php echo $city ?>"></td>
                            <p class="text-danger editCity_error fw-bold text-start"></p>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Province:  </h3></th>
                            <td scope="col"><input type="text" class="form-control h3" id="provinceEdit" placeholder="Province" value="<?php echo $province ?>"></td>
                            <p class="text-danger editProvince_error fw-bold text-start"></p>
                          </tr>
                        </tbody>
                      </table>
                      <div class="text-center">
                          <button type="button" class="btn btn-lg btn-primary mt-3" data-id="1" id="changeSettingsBtn"><i class="fa fa-edit"></i>&nbsp Make Changes</button>
                      </div>
                      </form>            
                    </div>
                  </div>
                  
                  <div class="col-md-5">
                      <div class="card p-3">
                            <h1 class="text-dark text-center mt-2 mb-3">Change Password</h1>
                            <div id="changeUserPasswordError" class="text-center text-light bg-danger mb-3 p-2 boxRadious"> </div>
                              <form id="changeUserPasswordForm" onsubmit="return false;">
                                <div class="input-group mb-3 input-group-lg"> 
                                  <input type="text" class="form-control" placeholder="Organization Name" id="orgName" name="orgName" value="<?php echo $orgName ?>" disabled style="display: none">
                                </div>
                                <div class="input-group input-group-lg"> 
                                  <span class="input-group-text" id="basic-addon1">Old Password</span> 
                                  <input type="password" class="form-control" placeholder="Enter the Old Password" id="userOldPassword" name="userOldPassword">
                                </div>
                              <p class="text-danger userOldPasswordError fw-bold text-start"></p>

                              <div class="input-group input-group-lg">
                                <span class="input-group-text" id="basic-addon1">New Password</span> 
                                <input type="password" class="form-control" placeholder="Enter the New Password" id="userNewPassword" name="userNewPassword">
                              </div>
                              <p class="text-danger userNewPasswordError fw-bold text-start"></p>

                               <div class="text-center mt-4">
                                <button type="button" class="btn btn-outline-success btn-lg w-50" id="changeUserPasswordBtn">Change Password</button>
                               </div>                    
                              </form>
                      </div>
                  </div>
              </div>
          </div>
          <!-- Your HTML Codes Ends -->


      </div><!-- Content of the Page Endss -->
    </div>

    <script src="./JS/settings.js" type="text/javascript"> </script>
    <script src="./JS/setNotifications.js" type="text/javascript"> </script>
    <script src="./JS/userLogout.js" type="text/javascript"> </script>

  </body>
</html>