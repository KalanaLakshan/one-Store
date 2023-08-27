<?php include_once("./assests/adminSessions.php") ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>One Store</title>

    <link rel = "icon" href = "./Images/logo.png" type = "image/x-icon">

    <link rel="stylesheet" type="text/css" href="./CSS/sidebar.css?version=3">
    <link rel="stylesheet" type="text/css" href="./CSS/adminHome.css?version=3">

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
        <div class="container-fluid px-5">
            
            <div class="row mt-3"><!--------- Row 1 Starts ----------->   <!--- Content Area Starts ---->
                        <div class="col-md-6 col-lg-3">
                                <div class="card border-danger border-2 mb-3">
                                    <div class="card-header bg-danger text-light text-center h5">Total Users</div>
                                    <div class="card-body text-danger">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cadmin->countTotalUsers(); ?> </p>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                                <div class="card border-success border-2 mb-3">
                                    <div class="card-header bg-success text-light text-center h5">Active Users</div>
                                    <div class="card-body text-success">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cadmin->countActiveUsers(); ?> </p>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                                <div class="card border-dark border-2 mb-3">
                                    <div class="card-header bg-dark text-light text-center h5">Feedbacks</div>
                                    <div class="card-body text-dark">
                                        <p class="display-3 fw-bolder text-center"> <?php echo $cadmin->countAdminFeedbacks(); ?> </p>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-6 col-lg-3">
                                <div class="card border-primary border-2 mb-3">
                                    <div class="card-header bg-primary text-light text-center h5">Site Hits</div>
                                    <div class="card-body text-primary">
                                        <p class="display-3 fw-bolder text-center"> 
                                                  <?php 
                                                      $result = $cadmin->countSiteHits(); 
                                                      foreach ($result as $key) {
                                                        echo $key['hits'];
                                                      }                   
                                                  ?> 
                                        </p>
                                    </div>
                                </div>
                        </div>
                    </div><!--------- Row 1 Ends -----------> 

                    <div class="row mt-3"><!--------- Row 2 Starts ----------->
                      
                        <div class="col-md-12 col-lg-6">
                                <div class="card border-secondary border-2 mb-3">
                                    <div class="card-header bg-secondary text-light text-center h5">Active Users / Total Users</div>
                                    <div class="card-body text-secondary">
                                        <div id="activePiechart" style="height: 400px; width: 90%;"></div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-12 col-lg-6">
                                <div class="card border-secondary border-2 mb-3">
                                    <div class="card-header bg-secondary text-light text-center h5">Daily User Registration (Last 7 Days)</div>
                                    <div class="card-body text-secondary">
                                        <div id="usersColumnchart" style="height: 400px; width: 50%;"></div>
                                    </div>
                                </div>
                        </div>


                    </div><!--------- Row 2 Ends -----------> 

        </div><!-- Your HTML Codes Ends -->


      </div><!-- Content of the Page Ends -->
    </div>

<!--     <script src="./assests/jquery-3.6.0.min.js"> </script>

  <script type="text/javascript" src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> -->


    <script src="./JS/adminHome.js" type="text/javascript"> </script>
    <script src="./JS/setAdminNotifications.js" type="text/javascript"> </script>
    <script src="./JS/adminLogout.js" type="text/javascript"> </script>

    <script type="text/javascript">
      //Pie Chart Starts
      google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Users', 'Number'],
              ['Active',     <?php echo $cadmin->countActiveUsers() ?>],
              ['Non Active',      <?php echo $cadmin->countNonActiveUsers() ?>]
            ]);

            var options = {
              title: ''
            };

            var chart = new google.visualization.PieChart(document.getElementById('activePiechart'));

            chart.draw(data, options);
          };//Pie Chart Ends
    </script>

    <script type="text/javascript">
    //Column Chart Starts SELECT reg_date,count(*) as count FROM users WHERE reg_date >= current_date - 7 group by reg_date;
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Day', 'Number Of Users'],
         <?php 
            $result = $cadmin->countUserRegistration(); 
            foreach($result as $row)
            {
                echo '["'.$row['reg_date'].'",'.$row['count'].'],';
            }
          ?> 
        ]);

        var options = {
          width: 600,
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

        var chart = new google.charts.Bar(document.getElementById('usersColumnchart'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      };//Column Chart Ends
    </script>

  </body>
</html>