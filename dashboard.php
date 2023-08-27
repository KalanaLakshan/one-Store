<?php include_once("./assests/sessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/dashboard.css?version=3">
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
          <div class="container-fluid px-5 py-2">
              <div class="row">
                
                <!-- col 1 Starts -->
                <div class="col-6">
                  <div class="card">
                    <div class="card-body">
                      <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"> <h3> Organization ID:  </h3></th>
                            <td scope="col"><h3 id="orgID"> <?php echo $orgID; ?> </h3></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="col"><h3> Organization Name:  </h3></th>
                            <td scope="col"><h3 id="orgName"> <?php echo $orgName; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> User Name:  </h3></th>
                            <td scope="col"><h3 id="userName"> <?php echo $uname; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> E-mail:  </h3></th>
                            <td scope="col"><h3 id="email"> <?php echo $email; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Phone:  </h3></th>
                            <td scope="col"><h3 id="phone"> <?php echo $phone; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Registered Date:  </h3></th>
                            <td scope="col"><h3 id="regDate"> <?php echo $reg_date; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Business Registation :  </h3></th>
                            <td scope="col"><h3 id="busiRag"> <?php echo $business_reg; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Country: </h3></th>
                            <td scope="col"><h3 id="country"> <?php echo $country; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> City: </h3></th>
                            <td scope="col"><h3 id="city"> <?php echo $city; ?> </h3></td>
                          </tr>
                          <tr>
                            <th scope="col"> <h3> Province:  </h3></th>
                            <td scope="col"><h3 id="province"> <?php echo $province; ?> </h3></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!-- col 1 Ends -->

                <!-- col 2 Starts -->
                <div class="col-6">
                    <div class="row"><!--Cards row 2 Starts-->
                      <div class="col-md-6">
                                <div class="card border-danger border-2 mb-3">
                                    <div class="card-header bg-danger text-light text-center h5">Today Sales</div>
                                    <div class="card-body text-danger">
                                        <p class="display-3 fw-bolder text-center"> <?php 
                                        $countCurrentDaySales = $cuser->countCurrentDaySales($orgID)['count']; 
                                        if($countCurrentDaySales == "")
                                        {
                                            echo 0;
                                        }
                                        else
                                        {
                                          echo $countCurrentDaySales;
                                        }
                                        ?> </p>
                                    </div>
                                </div>
                      </div>

                      <div class="col-md-6">
                                <div class="card border-success border-2 mb-3">
                                    <div class="card-header bg-success text-light text-center h5">This Week Sales</div>
                                    <div class="card-body text-success">
                                        <p class="display-3 fw-bolder text-center"> <?php 
                                        $countCurrentWeekSales = $cuser->countCurrentWeekSales($orgID)['count']; 
                                        if($countCurrentWeekSales == "")
                                        {
                                            echo 0;
                                        }
                                        else
                                        {
                                           echo $countCurrentWeekSales;
                                        }
                                        ?> </p>
                                    </div>
                                </div>
                      </div>
                    </div><!--Cards row 2 Ends-->

                    <div class="row"><!--Cards row 1 Starts-->
                      <div class="col-md-6">
                                <div class="card border-primary border-2 mb-3">
                                    <div class="card-header bg-primary text-light text-center h5">Transactions</div>
                                    <div class="card-body text-primary">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cuser->countTransactions($orgID) ?> </p>
                                    </div>
                                </div>
                      </div>

                      <div class="col-md-6">
                                <div class="card border-secondary border-2 mb-3">
                                    <div class="card-header bg-secondary text-light text-center h5">Products</div>
                                    <div class="card-body text-secondary">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cuser->countProducts($orgID) ?> </p>
                                    </div>
                                </div>
                      </div>
                    </div><!--Cards row 1 Ends-->

                    <div class="row"><!--Cards row 2 Starts-->
                      <div class="col-md-6">
                                <div class="card border-success border-2 mb-3">
                                    <div class="card-header bg-success text-light text-center h5">Main Categories</div>
                                    <div class="card-body text-success">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cuser->countMainCategories($orgID) ?> </p>
                                    </div>
                                </div>
                      </div>

                      <div class="col-md-6">
                                <div class="card border-danger border-2 mb-3">
                                    <div class="card-header bg-danger text-light text-center h5">Sub Categories</div>
                                    <div class="card-body text-danger">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cuser->countSubCategories($orgID) ?> </p>
                                    </div>
                                </div>
                      </div>
                    </div><!--Cards row 2 Ends-->

                    <div class="row"><!--Cards row 3 Starts-->
                      <div class="col-md-6">
                                <div class="card border-warning border-2 mb-3">
                                    <div class="card-header bg-warning text-light text-center h5">Brands</div>
                                    <div class="card-body text-warning">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cuser->countBrands($orgID) ?> </p>
                                    </div>
                                </div>
                      </div>

                      <div class="col-md-6">
                                <div class="card border-info border-2 mb-3">
                                    <div class="card-header bg-info text-light text-center h5">Suppliers</div>
                                    <div class="card-body text-info">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cuser->countSuppliers($orgID) ?> </p>
                                    </div>
                                </div>
                      </div>
                    </div><!--Cards row 3 Ends-->
                </div><!-- col 2 Ends -->

              </div>
          </div>
          <!-- Your HTML Codes Ends -->


      </div><!-- Content of the Page Endss -->
    </div>

    <script src="./JS/dashboard.js" type="text/javascript"> </script>
    <script src="./JS/setNotifications.js" type="text/javascript"> </script>
    <script src="./JS/userLogout.js" type="text/javascript"> </script>

  </body>
</html>