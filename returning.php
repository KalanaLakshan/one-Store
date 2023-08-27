<?php include_once("./assests/sessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/returning.css?version=3">
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
          <div class="container-fluid p-5">
                <div class="input-group mb-3 input-group-lg"> 
                      <input type="text" class="form-control" placeholder="orgID" id="orgID" name="orgID" value="<?php echo $orgID; ?>" style="display: none">
                </div>
            <div class="row">
              <div class="col-md-6">
                 <input type="text" class="form-control" id="returnRefNo" placeholder="Reference No">
              </div>
              <div class="col-md-6">
                 <input type="date" class="form-control" id="billDate" placeholder="Date" value="<?php echo date('Y-m-d');?>" disabled>
              </div>
            </div>

                  <div class="text-center mt-3">     
                    <div class="btn btn-lg btn-warning"><i class="fas fa-search"></i> Find</div>
                    <p class="text-danger returnProduct_error fw-bold text-center mt-3 h3"></p>
                  </div>

            <form id="returnProductForm">
            <div class="row mt-4">
              
                <div class="col-md-3">
                      <select id="selectReturnProduct" class="form-select form-select">
                        <option selected value="0">Select the Producty</option>
                        <option value="1">I Phone 6s</option>
                        <option value="2">Samsung M01 Core</option>
                        <option value="3">I Phone 14+</option>
                      </select>
                      <p class="text-danger returnProduct_error fw-bold text-start"></p>
                </div>
                <div class="col-md-1">
                   <input type="text" class="form-control" placeholder="Solded Qunatity" value="15" disabled>
                </div>
                <div class="col-md-1">
                   <input type="text" class="form-control" placeholder="Quantity">
                </div>
                <div class="col-md-2">
                   <input type="text" class="form-control" placeholder="Price" value="1500.00" disabled>
                </div>
                <div class="col-md-2">
                   <input type="text" class="form-control" placeholder="Total" value="15000.00" disabled>
                </div>
                <!-- start of ADD button -->
                <div class="col-md-3"> 
                  <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Return Product</button>
                  </div>
                <!-- End of ADD button -->
              
              

            </div>
            </form>

            <div class="row mt-5 justify-content-center">          
            <!-- start of table -->
              <table class="table" style="width:80%;">
                <thead>
                  <tr>
                    <th scope="col">#No</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <tr>
                    <th>1</th>
                    <td>I Phone 6s</td>
                    <td>10</td>
                    <td>1500.00</td>
                    <td>15000.00</td>
                  </tr>
                  <tr>
                    <th>2</th>
                    <td>Samsung M01 Core</td>
                    <td>5</td>
                    <td>10000.00</td>
                    <td>50000.00</td>
                  </tr>
                  <tr>
                    <th>3</th>
                    <td>I Phone 14+</td>
                    <td>10</td>
                    <td>100000.00</td>
                    <td>1000000.00</td>
                  </tr>
                </tbody>
              </table>
              <!-- end of table -->
          </div>

        <!-- start price display -->
        <div class="row mt-4 justify-content-center"> 
              <div class="col-md-6">
                <form id="returnTransactionForm">
                   <table class="table">
                      <tr>
                        <td>Sub Total</td>
                        <td><input type="number" class="form-control" value="1065000.00" disabled></td>
                      </tr>
                      <tr>
                        <td>Service Charge</td>
                        <td><input type="number" class="form-control"></td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td><input type="number" class="form-control" value="1000000" disabled></td>
                      </tr>
                  </table>
                </form>
              </div>
      </div>

      <div class="text-center mt-3">
        <div class="btn btn-lg btn-danger"><i class="fas fa-undo-alt"></i> Reset Return</div>      
        <div class="btn btn-lg btn-success"><i class="fas fa-check-square"></i> Return Order</div>
      </div>
        <!-- end price display -->
          <!-- Your HTML Codes Ends -->


      </div><!-- Content of the Page Endss -->
    </div>

    <script src="./JS/returning.js" type="text/javascript"> </script>
    <script src="./JS/setNotifications.js" type="text/javascript"> </script>
    <script src="./JS/userLogout.js" type="text/javascript"> </script>

  </body>
</html>