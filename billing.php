<?php include_once("./assests/sessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/billing.css?version=3">
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
     <div class="btn btn-lg btn-success mx-5" id="startBilling"><i class="fas fa-hashtag"></i> Add Reference No</div>  
          <div class="container-fluid px-5" id="billingContainer">
                <div class="input-group mb-3 input-group-lg"> 
                      <input type="text" class="form-control" placeholder="orgID" id="orgID" name="orgID" value="<?php echo $orgID; ?>" style="display: none">
                </div>
          	<div class="row">
          		<div class="col-md-2">
                    <div class="input-group">
                      <span class="input-group-text" id="basic-addon1">Ref No</span> 
                      <input type="text" class="form-control" placeholder="Add Ref No" id="refNo" name="refNo" disabled>
                    </div>
                      <p class="text-danger refNo_error fw-bold text-start"></p>
                </div>
          		<div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">Customer Name</span> 
          			 <input type="text" class="form-control" id="cusName" placeholder="Enter the Customer Name">
                </div>
          			 <p class="text-danger cusName_error fw-bold text-start"></p>
          		</div>
          		<div class="col-md-4">
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">Billing Date</span> 
          			 <input type="date" class="form-control" id="billDate" placeholder="Date" value="<?php echo date('Y-m-d');?>">
                </div>
          		</div>
          	</div>

            <form id="billProductForm">
          	<div class="row mt-4">
              
                <div class="col-md-2">
                	<div id="billProduct">
<!--                       <select id="selectBillProduct" class="form-select form-select">
                        <option selected value="0">Select the Product</option>
                        <option value="1">I Phone 6s</option>
                        <option value="2">Samsung M01 Core</option>
                        <option value="3">I Phone 14+</option>
                      </select>
                      <p class="text-danger billProduct_error fw-bold text-start"></p> -->
                    </div>
                </div>
<!--                 <div class="col-md-1" style="display: none;">
                   <input type="text" class="form-control" placeholder="bpID" id="bpID" name="bpID" disabled>
                </div> -->
                <div class="col-md-2">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Available</span> 
                    <input type="text" class="form-control" placeholder="0" id="aQty" name="aQty" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Quantity</span> 
                    <input type="text" class="form-control" placeholder="0" id="qty" name="qty">
                  </div>
                   <p class="text-danger qty_error fw-bold text-start"></p>
                </div>

                <div class="col-md-2">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Price</span> 
                   <input type="text" class="form-control" placeholder="0.00" id="price" name="price" disabled>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Total</span> 
                   <input type="text" class="form-control" placeholder="0.00" id="pTotal" name="pTotal" disabled>
                  </div>
                </div>
                <!-- start of ADD button -->
                <div class="col-md-2"> 
                  <button type="button" class="btn btn-primary" id="addBillProduct"><i class="fa fa-plus"></i> Add Product</button>
<!--                   <button type="button" class="btn btn-success" id="updateBillProduct"><i class="fa fa-plus"></i> Update Product</button> -->
                 </div>
                <!-- End of ADD button -->         		

          	</div>
            </form>

          	<div class="row mt-5 justify-content-center">          
          	<!-- start of table -->
          			<div id="billProductsTable">
		          		<!-- <table class="table" style="width:100%;">
		                <thead>
		                  <tr>
		                    <th scope="col">#No</th>
		                    <th scope="col">Product</th>
		                    <th scope="col">Quantity</th>
		                    <th scope="col">Price</th>
		                    <th scope="col">Total</th>
		                    <th scope="col">Edit</th>
		                    <th scope="col">Delete</th>
		                  </tr>
		                </thead>
		                <tbody class="table-group-divider">
		                  <tr>
		                    <th>1</th>
		                    <td>I Phone 6s</td>
		                    <td>10</td>
		                    <td>1500.00</td>
		                    <td>15000.00</td>
		                    <td><button type="button" class="btn btnEditBillProduct btn-warning"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
		                    <td><button type="button" class="btn btnDeleteBillProduct btn-danger"><i class="fa fa-trash"></i>&nbsp Remove</button></td>
		                  </tr>
		                  <tr>
		                    <th>2</th>
		                    <td>Samsung M01 Core</td>
		                    <td>5</td>
		                    <td>10000.00</td>
		                    <td>50000.00</td>
		                    <td><button type="button" class="btn btnEditBillProduct btn-warning"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
		                    <td><button type="button" class="btn btnDeleteBillProduct btn-danger"><i class="fa fa-trash"></i>&nbsp Remove</button></td>
		                  </tr>
		                  <tr>
		                    <th>3</th>
		                    <td>I Phone 14+</td>
		                    <td>10</td>
		                    <td>100000.00</td>
		                    <td>1000000.00</td>
		                    <td><button type="button" class="btn btnEditBillProduct btn-warning"><i class="fa fa-edit"></i>&nbsp Edit</button></td>
		                    <td><button type="button" class="btn btnDeleteBillProduct btn-danger"><i class="fa fa-trash"></i>&nbsp Remove</button></td>
		                  </tr>
		                </tbody>
		              </table> -->
		        </div>
		              <!-- end of table -->
          </div>

        <!-- start price display -->
        <div class="row mt-4 justify-content-center"> 
              <div class="col-md-6">
                <form id="transactionForm">
                   <table class="table">
                      <tr>
                        <td>Sub Total</td>
                        <td>                
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rs.</span> 
                            <input type="number" class="form-control" id="subTotal" name="subTotal" disabled>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Service Charge</td>
                        <td>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rs.</span> 
                            <input type="number" class="form-control" id="serviceCharge" name="serviceCharge">
                          </div>
                        </td>
                      </tr>
                       <tr>
                        <td>Discount</td>
                        <td>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rs.</span> 
                            <input type="number" class="form-control" id="discount" name="discount">
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td>
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rs.</span> 
                            <input type="number" class="form-control" id="total" name="total" disabled>
                          </div>
                        </td>
                      </tr>
                  </table>
                </form>
              </div>
      </div>

      <div class="text-center mt-3">
        <div class="btn btn-lg btn-danger" id="resetOrder"><i class="fas fa-undo-alt"></i> Reset Order</div>      
        <div class="btn btn-lg btn-success" id="finishOrder"><i class="fas fa-check-square"></i> Finish Order</div>
      </div>
        <!-- end price display -->
          <!-- Your HTML Codes Ends -->


      </div><!-- Content of the Page Endss -->
    </div>

    <script src="./JS/billing.js" type="text/javascript"> </script>
    <script src="./JS/setNotifications.js" type="text/javascript"> </script>
    <script src="./JS/userLogout.js" type="text/javascript"> </script>

  </body>
</html>