<?php require_once '../resources/config.php' ?>
<?php
session_start();
// Session Timeout
$time = time();
$session_timeout = 1800; //seconds
if (isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
    header("location: ../logout.php");
}
$_SESSION['last_activity'] = $time;

if (isset($_SESSION['logged_in']) && isset($_SESSION['account_type'])) {
    if ($_SESSION['account_type'] != "systemadmin") {
        echo "<p>Access Failed <a href='../../index.php'>Back to Home</a></p>";
        die();
    }
}
else {
    header('Location: ../login.php');
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Activity Logs</title>
    <link rel="shortcut icon" href="../assets/images/ico/fav.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- jQuery -->
    <script src="../resources/libraries/jquery/dist/jquery.min.js" ></script>

      <!-- Tablesorter themes -->
      <!-- bootstrap -->
    <link href="../resources/libraries/tablesorter/css/bootstrap-v3.min.css" rel="stylesheet">
    <link href="../resources/libraries/tablesorter/css/theme.bootstrap.css" rel="stylesheet">

      <!-- Tablesorter: required -->
    <script src="../resources/libraries/tablesorter/js/jquery.tablesorter.js"></script>
    <script src="../resources/libraries/tablesorter/js/jquery.tablesorter.widgets.js"></script>
    <!-- NProgress -->
    <link href="../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../assets/css/custom.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
      <link href="../assets/css/customstyle.css" rel="stylesheet">
    <!-- Date Range Picker -->
    <link href="../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  </head>
  <body class="nav-md">
      <?php include "../resources/templates/admin/sidebar.php"; ?>
      <?php include "../resources/templates/admin/top-nav.php"; ?>
    <div class="right_col" role="main">
        <div class="col-md-5">
          <ol class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="disabled">System Logs</li>
            <li class="active">View System Logs</li>
          </ol>
        </div>

            <form class="form-horizontal form-label-left" action="index.php" method="GET">
                 <div class="form-group">
                 <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search_key" placeholder="Search System Logs">
                                <span class="input-group-btn">
                                       <button class="btn btn-primary">Search</button>
                                </span>
                        </div>
                    </div>
              <div class="pull-right">
            <a><i class="fa fa-info-circle"></i> Search User Logs by <strong>Username or Activity</strong></a>
          </div>
                </div>
            </form>

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
               <h2><i class="fa fa-tasks"> </i> User Activity Logs</h2>
              <ul class="nav navbar-right panel_toolbox">
              </ul>
              <div class="clearfix"></div>
            </div>

            <div class="row">
              <div class="col-md-4">
                Sort by date<br />
                <form class="form-horizontal" action="index.php" method="get">
                  <fieldset>
                    
                    <div class="control-group">
                      <div class="controls">
                        <div class="input-prepend input-group">
                          <span class="add-on input-group-addon">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                          </span>
                          <input type="text" name="log_date" id="log_date" class="form-control" value=" " />
                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Search</button>
                          </span>
                        </div>
                      </div>
                    </div>
                    
                  </fieldset>
                </form>
              </div>

            <div class="x_content">
                              <div class="row">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                          <label class="control-label col-md-10">Show Number Of Entries:</label>
                          <div class="col-sm-2">
                              <select class="form-control" onchange="changeEntries(this.value)">
                                <option value="20" 
                                  <?php if (isset($_SESSION['entry'])) { if ($_SESSION['entry'] == 20) { echo "selected"; } } ?> >20</option>
                                <option value="50"
                                   <?php if (isset($_SESSION['entry'])) { if ($_SESSION['entry'] == 50) { echo "selected"; } } ?> >50</option>
                                <option value="100"
                                   <?php if (isset($_SESSION['entry'])) { if ($_SESSION['entry'] == 100) { echo "selected"; } } ?> >100</option>
                              </select>
                          </div>
                        </div>
                      </form>
              </div>
                <div class="log-list table-list">
                    <table id="logList" class="tablesorter-bootstrap">
                        <thead>
                            <tr>
                                <th>Log ID</th>
                                <th>Date</th>
                                <th>Username</th>
                                <th>Access Type</th>
                                <th>Login Time</th>
                                <th>User Activity</th>
                                <th>Logout Time</th>
                            </tr>
                            </thead>
                            <tbody>
              <?php

                if (!$conn) {
                  die("Connection failed: " . mysqli_connect_error());
                }
                $statement = "";
                $statement2 = "";
                $start = 0;
                $limit = 20;

                if (isset($_SESSION['entry'])) {
                  $limit = $_SESSION['entry'];
                }
                else {
                  $limit = 20;
                }

                if (isset($_GET['page'])) {
                  $page = $_GET['page'];
                  $start = ($page - 1) * $limit;
                }
                else {
                  $page = 1;
                }

                $statement3 = "SELECT * FROM pcnhsdb.user_logs ORDER BY log_id DESC LIMIT $start, $limit";

                if (isset($_GET['log_date'])) {
                  $log_date = $_GET['log_date'];
                  $from_and_to_date = explode("-", $log_date);
                  $sqldate_format_from = explode("/", $from_and_to_date[0]);
                  $m = $sqldate_format_from[0];
                  $d = $sqldate_format_from[1];
                  $y = $sqldate_format_from[2];
                  $m = preg_replace('/\s+/', '', $m);
                  $d = preg_replace('/\s+/', '', $d);
                  $y = preg_replace('/\s+/', '', $y);
                  $from = $y . "-" . $m . "-" . $d;
                  $sqldate_format_to = explode("/", $from_and_to_date[1]);
                  $m = $sqldate_format_to[0];
                  $d = $sqldate_format_to[1];
                  $y = $sqldate_format_to[2];
                  $m = preg_replace('/\s+/', '', $m);
                  $d = preg_replace('/\s+/', '', $d);
                  $y = preg_replace('/\s+/', '', $y);
                  $to = $y . "-" . $m . "-" . $d;
                  $statement = "SELECT * FROM pcnhsdb.user_logs 
                                WHERE log_date 
                                BETWEEN '$from' and '$to'
                                ORDER BY log_id DESC                                           
                                LIMIT $start, $limit;";
                }

                if (isset($_GET['search_key'])) {
                  $search = $_GET['search_key'];
                  $statement2 = "SELECT * FROM pcnhsdb.user_logs WHERE 
                                 user_name  LIKE '%$search%'
                                 OR user_act LIKE '%$search%'                                     
                                 ORDER BY log_id DESC
                                 LIMIT $start, $limit";
                }

                if (empty($statement) && empty($statement2)) {
                  include "userlogs/results/i_res.php";
                  include "userlogs/paginations/i_res_p.php";
                }
                if (!empty($statement2)) {
                  include "userlogs/results/sk_res.php";
                  include "userlogs/paginations/sk_res_p.php";
                }
                if (!empty($statement)) {
                  include "userlogs/results/dp_res.php";
                  include "userlogs/paginations/dp_res_p.php";
                }
            ?>
                    
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Contents Here -->
    <?php include "../resources/templates/admin/footer.php"; ?>
    <!-- Bootstrap -->
    <script src="../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src= "../resources/libraries/fastclick/lib/fastclick.js"></script>
    <!-- input mask -->
    <script src= "../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src= "../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
    <!-- NProgress -->
    <script src="../resources/libraries/nprogress/nprogress.js"></script>
    <!-- Date Range Picker -->
    <script src="../resources/libraries/moment/min/moment.min.js"></script>
    <script src="../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src= "../assets/js/custom.min.js"></script>
  
    <!-- Scripts -->
    <script type="text/javascript">
      function changeEntries(val) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           location.reload();
          }
        };
        xhttp.open("GET", "entry/index_entry.php?entry="+val, true);
        xhttp.send();
      }
    </script>

    <script type="text/javascript">
      $('#log_date').daterangepicker({
          ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
        endDate: moment()
      }, function(start, end, label) {
        console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
      });
    </script>
    <script type="text/javascript">
        $(function() {
        $('.log-list').tablesorter();
        $('.tablesorter-bootstrap').tablesorter({
        theme : 'bootstrap',
        headerTemplate: '{content} {icon}',
        widgets    : ['zebra','columns', 'uitheme']
        });
        });
      </script>
</body>
</html>