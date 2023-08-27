
        <style>
          .fa{
            width: 20px;
          }
            .fab{
            width: 20px;
          }
          .fas{
            width: 20px;
          }
        </style>

        <?php $filename  = basename($_SERVER['PHP_SELF'], ".php"); ?>

        <div class="header-box">
          
          <h1 class="text-center mt-2 mb-4"><img src="./Images/logo.png" width="70px"><br><span class="text-light">One Store</span></h1>

          <ul class="list-unstyled px-2">
            <li class="<?php if($filename == "dashboard"){ echo "active"; } ?>"><a href="dashboard.php" class="text-decoration-none d-block p-1"><i class="fa fa-home"></i> Dashboard</a></li>
          </ul>

          <hr class="text-light">

         <ul class="list-unstyled px-2">
            <li class="<?php if($filename == "mainCategories"){ echo "active"; } ?>"><a href="mainCategories.php" class="text-decoration-none d-block p-1"><i class="fa fa-list-alt"></i> Main Categories</a></li>
            <li class="<?php if($filename == "subCategories"){ echo "active"; } ?>"><a href="subCategories.php" class="text-decoration-none d-block p-1"><i class="fa fa-list"></i> Sub Categories</a></li>
            <li class="<?php if($filename == "brands"){ echo "active"; } ?>"><a href="brands.php" class="text-decoration-none d-block p-1"><i class="fa fa-bold"></i> Brands</a></li>
            <li class="<?php if($filename == "suppliers"){ echo "active"; } ?>"><a href="suppliers.php" class="text-decoration-none d-block p-1"><i class="fa fa-truck"></i> Suppliers</a></li>
            <li class="<?php if($filename == "products"){ echo "active"; } ?>"><a href="products.php" class="text-decoration-none d-block p-1"><i class="fab fa-product-hunt "></i> Products</a></li>
          </ul>

          <hr class="text-light">

          <ul class="list-unstyled px-2">
            <li class="<?php if($filename == "billing"){ echo "active"; } ?>"><a href="billing.php" class="text-decoration-none d-block p-1"><i class="fa fa-shopping-cart"></i> Billing</a></li>
<!--             <li class="<?php if($filename == "returning"){ echo "active"; } ?>"><a href="returning.php" class="text-decoration-none d-block p-1"><i class="fa fa-reply"></i> Returning</a></li> -->
          </ul>

          <hr class="text-light">

          <ul class="list-unstyled px-2">
<!--             <li><a href="#" class="text-decoration-none d-block p-1"><i class="fa fa-file"></i> Price History</a></li>
            <li><a href="#" class="text-decoration-none d-block p-1"><i class="fa fa-usd"></i> Transaction History</a></li>
            <li><a href="#" class="text-decoration-none d-block p-1"><i class="fa fa-file-image-o"></i> Sales History</a></li> -->
            <li class="<?php if($filename == "salesAndPriceHistory"){ echo "active"; } ?>"><a href="salesAndPriceHistory.php" class="text-decoration-none d-block p-1"><i class="fa fa-file"></i> Sales & Price History</a></li>
             <li class="<?php if($filename == "transactionsHistory"){ echo "active"; } ?>"><a href="transactionsHistory.php" class="text-decoration-none d-block p-1"><i class="fas fa-dollar-sign"></i> Transactions History</a></li>
            <li class="<?php if($filename == "salesReport"){ echo "active"; } ?>"><a href="salesReport.php" class="text-decoration-none d-block p-1"><i class="fas fa-chart-pie"></i> Sales Report</a></li>
          </ul>

          <hr class="text-light">

          <ul class="list-unstyled px-2">
            <li class="<?php if($filename == "feedbacks"){ echo "active"; } ?>"><a href="feedbacks.php" class="text-decoration-none d-block p-1"><i class="fa fa-comment"></i> Feedbacks</a></li>
            <li class="<?php if($filename == "notifications"){ echo "active"; } ?>"><a href="notifications.php" class="text-decoration-none d-block p-1 d-flex justify-content-between">
              <span><i class="fa fa-bell"></i> Notifications</span>
              <span class="bg-dark text-light rounded-pill px-2 py-0" id="notificationCount"></span>
            </a>
            </li>
          </ul>

          <hr class="text-light">

          <ul class="list-unstyled px-2">
            <li class="<?php if($filename == "settings"){ echo "active"; } ?>"><a href="settings.php" class="text-decoration-none d-block p-1"><i class="fa fa-cog"></i> Settings</a></li>
            <li><a href="#" class="text-decoration-none d-block p-1" id="userLogout"><i class="fa fa-circle"></i> Logout</a></li>
          </ul>

        </div>