
        <style>
          .fa{
            width: 20px;
          }
        </style>

        <?php $filename  = basename($_SERVER['PHP_SELF'], ".php"); ?>

        <div class="header-box">
          
          <h1 class="text-center mt-2 mb-4"><img src="./Images/logo.png" width="70px"><br><span class="text-light">One Store</span></h1>

          <ul class="list-unstyled px-2">
            <li class="<?php if($filename == "adminHome"){ echo "active"; } ?>"><a href="adminHome.php" class="text-decoration-none d-block p-2"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="<?php if($filename == "adminUsers"){ echo "active"; } ?>"><a href="adminUsers.php" class="text-decoration-none d-block p-2"><i class="fa fa-users"></i> Users</a></li>
            <li class="<?php if($filename == "adminFeedbacks"){ echo "active"; } ?>"><a href="adminFeedbacks.php" class="text-decoration-none d-block p-2"><i class="fa fa-comment"></i> Feedbacks</a></li>
            <li class="<?php if($filename == "adminNotifications"){ echo "active"; } ?>"><a href="adminNotifications.php" class="text-decoration-none d-block p-2 d-flex justify-content-between">
              <span><i class="fa fa-bell"></i> Notifications</span>
              <span class="bg-danger text-light rounded-pill px-2 py-0" id="adminNotificationCount"></span>
            </a>
            </li>
          </ul>

          <hr class="text-light">

          <ul class="list-unstyled px-2">
            <li class="<?php if($filename == "adminSettings"){ echo "active"; } ?>"><a href="adminSettings.php" class="text-decoration-none d-block p-2"><i class="fa fa-cog"></i> Settings</a></li>
            <li><a href="#" class="text-decoration-none d-block p-2" id="adminLogout"><i class="fa fa-circle"></i> Logout</a></li>
          </ul>

        </div>