<!DOCTYPE html>

<?php require_once "../resources/config.php"; ?>
<?php
    session_start();
    // Session Timeout
    $time = time();
    $session_timeout = 1800; //seconds
    
    if(isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
      header("location: ../../../logout.php");
    }

    $_SESSION['last_activity'] = $time;
    if(isset($_SESSION['logged_in']) && isset($_SESSION['account_type'])){
        if($_SESSION['account_type'] != "systemadmin") {
            echo "<p>Access Failed <a href='../../index.php'>Back to Home</a></p>";
            die();
        }
    }else {
        header('Location: ../../../login.php');
    }
        date_default_timezone_set('Asia/Manila');
        $loTime = date("h:i:sa");
?>
<html>
    <head>
        <title>Activity Logs</title>
        <link rel="shortcut icon" href="../images/pines.png" type="image/x-icon" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap -->
        <link href="../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <!-- Date Range Picker -->
        <link href="../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../css/custom.min.css" rel="stylesheet">
        <link href="../css/tstheme/style.css" rel="stylesheet">

    </head>
    <body class="nav-md">
        <?php include "../resources/templates/admin/sidebar.php"; ?>
        <?php include "../resources/templates/admin/top-nav.php"; ?>
        <!-- Content Start -->
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
                            <input type="text" class="form-control" name="search_key" placeholder="Search Personnel Username">
                                <span class="input-group-btn">
                                       <button class="btn btn-primary">Go</button>
                                </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
            <div class="">

            <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-tasks"> </i> PCNHS-ARMS User Activity Logs</h2>
                            <div class="clearfix"></div>
                            <br/>
                         </div>
                          <!-- Date Picker -->
                          <div class="col-md-4">
                            Sort by Date
                            <form class="form-horizontal" action="transaction.php" method="get">
                              <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="input-prepend input-group">
                                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                      <input type="text" style="width: 200px" name="log_date" id="reservation" class="form-control" value=<?php echo "'$loTime'";?>/>
                                    </div>

                                  </div>
                                  <button type="button" class="btn btn-primary">Go</button>
                                </div>
                              </fieldset>
                            </form>
                          </div>
                          <!-- Date Picker -->
            <div class="x_content">
                <div class="row">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                          <label class="control-label col-md-10">Show Number Of Entries:</label>
                          <div class="col-sm-2">
                              <select class="form-control" onchange="changeEntries(this.value)">
                                <option value="20" 
                                  <?php if(isset($_SESSION['entry'])){if($_SESSION['entry'] == 20) {echo "selected";}} ?>
                                  >20</option>
                                <option value="50"
                                   <?php if(isset($_SESSION['entry'])){if($_SESSION['entry'] == 50) {echo "selected";}} ?>
                                  >50</option>
                                <option value="100"
                                   <?php if(isset($_SESSION['entry'])){if($_SESSION['entry'] == 100) {echo "selected";}} ?>
                                >100</option>
                              </select>
                          </div>
                        </div>
                      </form>
              </div>
                <div class="table-responsive">
                    <table id="logList" class="table table-bordered tablesorter">
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
                            $statement = "";
                            $start=0;
                            $limit;

                            if(isset($_SESSION['entry'])){
                              $limit = $_SESSION['entry'];
                            }else {
                              $limit = 20;
                            }

                            if(isset($_GET['page'])){
                              $page=$_GET['page'];
                              $start=($page-1)*$limit;
                            }else{
                              $page=1;
                            }

                              if(isset($_GET['log_date'])) {
                              
                              $log_date = $_GET['log_date'];
                              $from_and_to_date = explode("-", $log_date);
                              $sqldate_format_from = explode("/", $from_and_to_date[0]);
                              $m = $sqldate_format_from[0];
                              $d = $sqldate_format_from[1];
                              $y = $sqldate_format_from[2];
                              $m = preg_replace('/\s+/', '', $m);
                              $d = preg_replace('/\s+/', '', $d);
                              $y = preg_replace('/\s+/', '', $y);

                              $from = $y."-".$m."-".$d;

                              $sqldate_format_to = explode("/", $from_and_to_date[1]);
                              $m = $sqldate_format_to[0];
                              $d = $sqldate_format_to[1];
                              $y = $sqldate_format_to[2];
                              $m = preg_replace('/\s+/', '', $m);
                              $d = preg_replace('/\s+/', '', $d);
                              $y = preg_replace('/\s+/', '', $y);

                              $to = $y."-".$m."-".$d;

                              $statement = "SELECT * FROM pcnhsdb.user_logs 
                                            WHERE log_date 
                                            BETWEEN '$from' and '$to' 
                                            LIMIT $start, $limit;";
                            }else{
                              $log_date = date('m/d/y').'-'.date('m/d/y');
                              $statement = "SELECT * FROM pcnhsdb.user_logs 
                                            LIMIT $start, $limit";
                            }

                            if(!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
                            if (isset($_GET['search_key'])){
                                $search = $_GET['search_key'];
                                $statement = "SELECT * FROM pcnhsdb.user_logs WHERE user_name 
                                              LIKE '%$search%'
                                              ORDER BY log_id DESC
                                              LIMIT $start, $limit";
                            }else{
                                $statement = "SELECT * FROM pcnhsdb.user_logs
                                              ORDER BY log_id DESC
                                              LIMIT $start, $limit";
                            }

                            $result = $conn->query($statement);
                            if ($result ->num_rows == 0) {
                                echo <<<NORES
                                    <tr class="odd pointer">
                                    <span class="badge badge-danger">NO RESULT</span>        
                                    </tr>
NORES;
                            }
                            else if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $log_id = $row['log_id'];
                                    $log_date = $row['log_date'];
                                    $user_name = $row['user_name'];
                                    $account_type = $row['account_type'];
                                    $log_date = $row['log_date'];
                                    $log_in_time = $row['log_in_time'];
                                    $log_out_time = $row['log_out_time'];
                                    $user_act = $row['user_act'];

                                    echo <<<LOGLIST
                                            <tr class="odd pointer">
                                                        <td class=" ">$log_id</td>
                                                        <td class=" ">$log_date</td>
                                                        <td class=" ">$user_name</td>
                                                        <td class=" ">$account_type</td>
                                                        <td class=" ">$log_in_time</td>
                                                        <td class=" ">$user_act</td>
                                                        <td class=" ">$log_out_time</td>                                                    
                                            </tr>
LOGLIST;
                                        }
                                }
                            ?>
                            </tbody>
                        </table>
                        
                    <?php
                    $statement = "select * from user_logs";
                    $rows = mysqli_num_rows(mysqli_query($conn, $statement));
                    if ($rows > 20000) {
                        $sql = "TRUNCATE TABLE user_logs";
                        mysqli_query($conn, $sql);
                      }
                    else
                      {
                    $total = ceil($rows/$limit);
                    
                    echo "<p>Showing $limit of $rows Entries</p>";

                    echo '<div class="pull-right">
                      <div class="col s12">
                      <ul class="pagination center-align">';
                      if($page > 1) {
                        echo "<li class=''><a href='index.php?page=".($page-1)."'>Previous</a></li>";
                      }else if($total <= 0) {
                        echo '<li class="disabled"><a>Previous</a></li>';
                      }else {
                        echo '<li class="disabled"><a>Previous</a></li>';
                      }
                      // Google Like Pagination
                      $x = 0;
                      $y = 0;
                      if(($page+5) <= $total) {
                        if($page >= 3) {
                          $x = $page + 2;

                        }else {
                          $x = 5;
                        }

                        $y = $page;
                        if($y <= $total) {
                          $y -= 2;
                          if($y < 1) {
                            $y = 1;
                          }
                        }
                      }else {
                        $x = $total;
                        $y = $total - 5;
                        if($y < 1) {
                          $y = 1;
                        }
                      }
                      // Google Like Pagination
                      for($i = $y;$i <= $x; $i++) {
                        if($i==$page) {
                          echo "<li class='active'><a href='index.php?page=$i'>$i</a></li>";
                        } else {
                            echo "<li class=''><a href='index.php?page=$i'>$i</a></li>";
                          }
                      }


                      if($total == 0) {
                        echo "<li class='disabled'><a>Next</a></li>";
                      }else if($page!=$total) {
                        echo "<li class=''><a href='index.php?page=".($page+1)."'>Next</a></li>";
                      }else {
                        echo "<li class='disabled'><a>Next</a></li>";
                      }
                        echo "</ul></div></div>";
                      
                        }
                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Content End -->
    <?php include "../resources/templates/registrar/footer.php"; ?>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="../resources/libraries/jquery/dist/jquery.min.js" ></script>
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
    <script src= "../js/custom.min.js"></script>
    <script type="text/javascript" src=<?php echo "../resources/libraries/tablesorter/jquery.tablesorter.js" ?>></script>
    <!-- Scripts -->
    <script type="text/javascript">
        $(document).ready(function(){
                $("#logList").tablesorter({headers: { 7:{sorter: false}, }});
            }
        );
    </script>

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

    </body>
</html>