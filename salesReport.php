<?php include_once("./assests/sessions.php") ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/salesReport.css?version=3">
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
              <div class="col-md-3">
                <h3 class="text-center text-dark bg-warning rounded-pill">Top Selling Items</h3>
                  <div id="topSellingItems">
<!--                     <ul class="list-group mt-3">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Samsumg M01 Core
                        <span class="badge bg-primary rounded-pill">45</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Samsumg M02
                        <span class="badge bg-primary rounded-pill">37</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        I Phone 6s
                        <span class="badge bg-primary rounded-pill">24</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        I Phone 14+
                        <span class="badge bg-primary rounded-pill">13</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        Macbook Pro
                        <span class="badge bg-primary rounded-pill">8</span>
                      </li>
                    </ul> -->
                  </div>
              </div>

              <div class="col-md-3">
                                <div class="card border-dark border-2 mb-3">
                                    <div class="card-header bg-dark text-light text-center h5">Daily Sales</div>
                                    <div class="card-body text-primary">                                      
                                        <?php 
                                            $currentDaySales = $cuser->countCurrentDaySales($orgID)['count'];
                                            $preaviousDaySales = $cuser->countPreaviousDaySales($orgID)['count'];

                                            if($currentDaySales==0 || $preaviousDaySales==0)
                                            {
                                                echo "<p class='display-5 fw-bolder text-center text-success'> No Enough Data </p>";
                                            }
                                            else
                                            {
                                                  $salesDifference = 0;
                                                  $percentage = 0;

                                                  if($currentDaySales>$preaviousDaySales)
                                                  {
                                                      $salesDifference = $currentDaySales - $preaviousDaySales;
                                                      $percentage = ($salesDifference / $preaviousDaySales)*100;
                                                      $percentage = round($percentage,0);
                                                      echo "<p class='display-5 fw-bolder text-center text-success'>".$percentage."% Increased"."</p>";
                                                  }
                                                  else if($currentDaySales == $preaviousDaySales)
                                                  {
                                                      echo "<p class='display-5 fw-bolder text-center text-warning'> 0% No Changes </p>";
                                                  }
                                                  else
                                                  {
                                                      $salesDifference = $preaviousDaySales - $currentDaySales;
                                                      $percentage = ($salesDifference / $preaviousDaySales)*100;
                                                      $percentage = round($percentage,0);
                                                      echo "<p class='display-5 fw-bolder text-center text-danger'>".$percentage."% Decreased"."</p>";
                                                  }
                                            }


                                         ?>                                        
                                    </div>
                                </div>
              </div>

              <div class="col-md-3">
                                <div class="card border-dark border-2 mb-3">
                                    <div class="card-header bg-dark text-light text-center h5">Weekly Sales</div>
                                    <div class="card-body text-primary">
                                          <?php 
                                            $currentWeekSales = $cuser->countCurrentWeekSales($orgID)['count'];
                                            $preaviousTwoWeeksSales = $cuser->countPreaviousTwoWeeksSales($orgID)['count'];

                                            $firstWeekSales = $currentWeekSales;
                                            $secondWeekSales = $preaviousTwoWeeksSales - $firstWeekSales;

                                            $salesDifference = 0;
                                            $percentage = 0;

                                            if($firstWeekSales==0 || $secondWeekSales==0)
                                            {
                                                echo "<p class='display-5 fw-bolder text-center text-success'> No Enough Data </p>";
                                            }
                                            else
                                            {
                                                  if($firstWeekSales>$secondWeekSales)
                                                  {
                                                      $salesDifference = $firstWeekSales - $secondWeekSales;
                                                      $percentage = ($salesDifference / $secondWeekSales)*100;
                                                      $percentage = round($percentage,0);
                                                      echo "<p class='display-5 fw-bolder text-center text-success'>".$percentage."% Increased"."</p>";
                                                  }
                                                  else if($firstWeekSales == $secondWeekSales)
                                                  {
                                                      echo "<p class='display-5 fw-bolder text-center text-warning'> 0% No Changes </p>";
                                                  }
                                                  else
                                                  {
                                                      $salesDifference = $firstWeekSales - $secondWeekSales;
                                                      $percentage = ($salesDifference / $secondWeekSales)*100;
                                                      $percentage = round($percentage,0);
                                                      echo "<p class='display-5 fw-bolder text-center text-danger'>".$percentage."% Decreased"."</p>";
                                                  }
                                            }


                                         ?>
                                    </div>
                                </div>
              </div>

              <div class="col-md-3">
                                <div class="card border-dark border-2 mb-3">
                                    <div class="card-header bg-dark text-light text-center h5">Monthly Sales</div>
                                    <div class="card-body text-primary">
                                          <?php 
                                            $currentMonthSales = $cuser->countCurrentMonthSales($orgID)['count'];
                                            $preaviousTwoMonthsSales = $cuser->countPreaviousTwoMonthsSales($orgID)['count'];


                                                  $firstMonthSales = $currentMonthSales;
                                                  $secondMonthSales = $preaviousTwoMonthsSales - $firstMonthSales;

                                                  $salesDifference = 0;
                                                  $percentage = 0;

                                              if($firstMonthSales == 0 || $secondMonthSales == 0)
                                              {
                                                  echo "<p class='display-5 fw-bolder text-center text-success'> No Enough Data </p>";
                                              }
                                              else
                                              {
                                                  if($firstMonthSales>$secondMonthSales)
                                                  {
                                                      $salesDifference = $firstMonthSales - $secondMonthSales;

                                                      if($secondMonthSales == 0)
                                                      {
                                                         $secondMonthSales == 1; // Make One to Reduce Error
                                                      }

                                                      $percentage = ($salesDifference / $secondMonthSales)*100;
                                                      $percentage = round($percentage,0);
                                                      echo "<p class='display-5 fw-bolder text-center text-success'>".$percentage."% Increased"."</p>";
                                                  }
                                                  else if($firstMonthSales == $secondMonthSales)
                                                  {
                                                      echo "<p class='display-5 fw-bolder text-center text-warning'> 0% No Changes </p>";
                                                  }
                                                  else
                                                  {
                                                      $salesDifference = $firstMonthSales - $secondMonthSales;
                                                      $percentage = ($salesDifference / $secondMonthSales)*100;
                                                      $percentage = round($percentage,0);
                                                      echo "<p class='display-5 fw-bolder text-center text-danger'>".$percentage."% Decreased"."</p>";
                                                  }
                                              }                                      
                                         ?>
                                    </div>
                                </div>
              </div>
            </div>

            <div class="row mt-3">
                        <div class="col-md-12 col-lg-6">
                                <div class="card border-secondary border-2 mb-3">
                                    <div class="card-header bg-secondary text-light text-center h5">Daily Sales (Last 7 Days)</div>
                                    <div class="card-body text-secondary">
                                        <div id="dailySalesColumnChart" style="height: 400px; width: 50%;"></div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-12 col-lg-6">
                                <div class="card border-secondary border-2 mb-3">
                                    <div class="card-header bg-secondary text-light text-center h5">Daily Sales (Last 7 Days)</div>
                                    <div class="card-body text-secondary">
                                        <div id="dailySalesPieChart" style="height: 400px; width: 90%;"></div>
                                    </div>
                                </div>
                        </div>
            </div>
          </div>
          <!-- Your HTML Codes Ends -->


      </div><!-- Content of the Page Endss -->
    </div>

    <script src="./JS/salesReport.js" type="text/javascript"> </script>
    <script src="./JS/setNotifications.js" type="text/javascript"> </script>
    <script src="./JS/userLogout.js" type="text/javascript"> </script>

     <script type="text/javascript">
      //Pie Chart Starts
      google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

        var data = new google.visualization.arrayToDataTable([
          ['Day', 'Number Of Sales'],
         <?php 
            $result = $cuser->salesGraph($orgID); 
            if($result != null)
            {
                foreach($result as $row)
                {
                    echo '["'.$row['date'].'",'.$row['count'].'],';
                }
            }
            else
            {
                echo "No Data";
            }

          ?> 
        ]);

            var options = {
              title: ''
            };

            var chart = new google.visualization.PieChart(document.getElementById('dailySalesPieChart'));

            chart.draw(data, options);
          };//Pie Chart Ends
     </script>

     <script type="text/javascript">
    //Column Chart Starts
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {

        var data = new google.visualization.arrayToDataTable([
          ['Day', 'Number Of Sales'],
         <?php 
            $result = $cuser->salesGraph($orgID); 
            if($result !=null)
            {
                foreach($result as $row)
                {
                    echo '["'.$row['date'].'",'.$row['count'].'],';
                }
            }
            else
            {
                echo "No Data"; 
            }
          ?> 
        ]);

        var options = {
          width: 650,
          legend: { position: 'none' },
          chart: {
            title: '',
            subtitle: '' },
          axes: {
            x: {
              0: { side: 'bottom', label: 'Day'}
            }
          },
          bar: { groupWidth: "80%" }
        };

        /*var chart = new google.charts.Bar(document.getElementById('dailySalesColumnChart'));*/

        var chart = new google.visualization.LineChart(document.getElementById('dailySalesColumnChart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      };//Column Chart Ends
    </script>

  </body>
</html>