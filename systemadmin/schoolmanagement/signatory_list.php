<?php require_once "../../resources/config.php"; ?>
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
            echo "<p>Access Failed <a href='../index.php'>Back to Home</a></p>";
            die();
        }
    }else {
        header('Location: ../../../login.php');
    }
        date_default_timezone_set('Asia/Manila');
        $loTime = date("h:i:sa");
        $curr_date = date("m/d/Y");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>View Signatories</title>
    <link rel="shortcut icon" href="../assets/images/ico/fav.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
      <!-- jQuery -->
      <script src="../../resources/libraries/jquery/dist/jquery.min.js" ></script>

      <!-- Tablesorter themes -->
      <!-- bootstrap -->
      <link href="../../resources/libraries/tablesorter/css/bootstrap-v3.min.css" rel="stylesheet">
      <link href="../../resources/libraries/tablesorter/css/theme.bootstrap.css" rel="stylesheet">

      <!-- Tablesorter: required -->
      <script src="../../resources/libraries/tablesorter/js/jquery.tablesorter.js"></script>
      <script src="../../resources/libraries/tablesorter/js/jquery.tablesorter.widgets.js"></script>
      <!-- NProgress -->
      <link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
      
      <!-- Bootstrap -->
      <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      
      <!-- Datatables -->
      <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
      <!-- Date Range Picker -->
      <link href="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
      <!-- Custom Theme Style -->
      <link href="../../assets/css/custom.min.css" rel="stylesheet">
      <!-- Custom Theme Style -->
      <link href="../../assets/css/customstyle.css" rel="stylesheet">
    
  </head>
  <body class="nav-md">
    <!-- Sidebar -->
        <?php include "../../resources/templates/admin/sidebar.php"; ?>
        <?php include "../../resources/templates/admin/top-nav.php"; ?>
    <!-- Contents Here -->
<div class="right_col" role="main">
             <div class="col-md-5">
        <ol class="breadcrumb">
          <li><a href="../index.php">Home</a></li>
          <li class="disabled">Signatories</li>
          <li class="active">View Signatories</li>
        </ol>
      </div>
    <form class="form-horizontal form-label-left" action="signatory_list.php" method="GET">

        <div class="form-group">
            <div class="col-sm-5"></div>
            <div class="col-sm-7">
                <div class="input-group">

                    <input type="text" class="form-control" name="search_key" placeholder="Search Signatories">
                    <span class="input-group-btn">
                  <button class="btn btn-primary">Search</button>
                </span>
                </div>
            </div>
              <div class="pull-right">
                <a><i class="fa fa-info-circle"></i> Search Signatories by <strong> Name / Year / Position / Title </strong></a>
            </div>
        </div>
    </form>
     <div class="clearfix"></div>
    <div class="">

        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-users"> </i> Signatories</h2>
                    <div class="clearfix"></div>
                      <br/>
                <?php
                        if (isset($_SESSION['sign_del'])) {
                            echo $_SESSION['sign_del'];
                            unset($_SESSION['sign_del']);
                        }
                     ?>
            </div>

            <div class="x_content">
                    <div class="row">
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                          <label class="control-label col-md-10">Show Number Of Entries:</label>
                          <div class="col-sm-2">
                              <select class="form-control" onchange="changeEntries(this.value)">
                                <option value="20" 
                                  <?php if (isset($_SESSION['sign_entry'])) { if ($_SESSION['sign_entry'] == 20) { echo "selected"; } } ?> 
                                  >20</option>
                                <option value="50"
                                   <?php if (isset($_SESSION['sign_entry'])) { if ($_SESSION['sign_entry'] == 50) { echo "selected"; } } ?> 
                                   >50</option>
                                <option value="100"
                                   <?php if (isset($_SESSION['sign_entry'])) { if ($_SESSION['sign_entry'] == 100) { echo "selected"; } } ?> 
                                   >100</option>
                              </select>
                          </div>
                        </div>
                      </form>
              </div>
                    <div class="sign-list">
                        <table id="signList" class="tablesorter-bootstrap">
                            <thead>
                            <tr>
                                <th data-sorter="true">Signatory ID&nbsp</th>
                                <th data-sorter="true">First Name&nbsp</th>
                                <th data-sorter="true">M. I.&nbsp</th>
                                <th data-sorter="true">Last Name</th>
                                <th data-sorter="true">Degree</th>
                                <th data-sorter="true">Position</th>
                                <th data-sorter="true">Year Started</th>
                                <th data-sorter="true">Year Ended</th>
                                <th data-sorter="false">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                                          <?php
                              $statement = "";
                              $start = 0;
                              $limit = 20;

                              if (isset($_SESSION['sign_entry'])) {
                                $limit = $_SESSION['sign_entry'];
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
                              if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                              }
                              if (isset($_GET['search_key'])) {
                                $search = $_GET['search_key'];
                                $statement = "SELECT * FROM pcnhsdb.signatories WHERE sign_id LIKE '%$search%'
                                              OR first_name LIKE '%$search%'
                                              OR mname LIKE '%$search%'
                                              OR last_name LIKE '%$search%'
                                              OR CONCAT(first_name,mname,last_name) LIKE '$search'
                                              OR CONCAT(first_name,' ',last_name) LIKE '$search'
                                              OR CONCAT(last_name,first_name,mname) LIKE '$search'
                                              OR CONCAT(last_name,' ',first_name) LIKE '$search'
                                              OR yr_started LIKE '%$search%'
                                              OR yr_ended LIKE '%$search%'
                                              OR sign_id LIKE '%$search%'
                                              OR title LIKE '%$search%'
                                              OR position LIKE '%$search%'
                                              LIMIT $start, $limit";
                              }
                              else {
                                $statement = "SELECT * FROM pcnhsdb.signatories
                                              LIMIT $start, $limit";
                              }
                              $result = $conn->query($statement);
                              if ($result->num_rows == 0) {
                                echo <<<NORES
                                    <tr class="odd pointer">
                                    <span class="badge badge-danger">NO RESULT</span>
                                    <br><br>        
                                    </tr>
NORES;
                              }
                              else if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                  $sign_id = $row['sign_id'];
                                  $first_name = $row['first_name'];
                                  $mname = $row['mname'];
                                  $last_name = $row['last_name'];
                                  $title = $row['title'];
                                  $position = $row['position'];
                                  $yr_started = $row['yr_started'];
                                  $yr_ended = $row['yr_ended'];
                                  echo <<<SIGNLIST
                                            <tr class="odd pointer">
                                                        <td class=" ">$sign_id</td>
                                                        <td class=" ">$first_name</td>
                                                        <td class=" ">$mname</td>
                                                        <td class=" ">$last_name</td>
                                                        <td class=" ">$title</td>
                                                        <td class=" ">$position</td>
                                                        <td class=" ">$yr_started</td>
                                                        <td class=" ">$yr_ended</td>
                                                        <td class=" ">
                                                        <a href= "signatory_view.php?sign_id=$sign_id" class="btn btn-primary btn-s"><i class="fa fa-user"></i> View</a>
                                                        </td>                                                       
                                            </tr>
SIGNLIST;
                                }
                              }
                            ?>
                            </tbody>
                        </table>
                        <?php
                          $statement = "select * from signatories";
                          $rows = mysqli_num_rows(mysqli_query($conn, $statement));
                          $total = ceil($rows / $limit);
                          echo "<p>Showing $limit Entries</p>";
                          echo '<div class="pull-right">
                                                <div class="col s12">
                                                <ul class="pagination center-align">';
                          if ($page > 1) {
                            echo "<li class=''><a href='signatory_list.php?page=" . ($page - 1) . "'>Previous</a></li>";
                          }
                          else
                          if ($total <= 0) {
                            echo '<li class="disabled"><a>Previous</a></li>';
                          }
                          else {
                            echo '<li class="disabled"><a>Previous</a></li>';
                          }
                          $x = 0;
                          $y = 0;
                          if (($page + 5) <= $total) {
                            if ($page >= 3) {
                              $x = $page + 2;
                            }
                            else {
                              $x = 5;
                            }

                            $y = $page;
                            if ($y <= $total) {
                              $y-= 2;
                              if ($y < 1) {
                                $y = 1;
                              }
                            }
                          }
                          else {
                            $x = $total;
                            $y = $total - 5;
                            if ($y < 1) {
                              $y = 1;
                            }
                          }
                          for ($i = $y; $i <= $x; $i++) {
                            if ($i == $page) {
                              echo "<li class='active'><a href='signatory_list.php?page=$i'>$i</a></li>";
                            }
                            else {
                              echo "<li class=''><a href='signatory_list.php?page=$i'>$i</a></li>";
                            }
                          }

                          if ($total == 0) {
                            echo "<li class='disabled'><a>Next</a></li>";
                          }
                          else
                          if ($page != $total) {
                            echo "<li class=''><a href='signatory_list.php?page=" . ($page + 1) . "'>Next</a></li>";
                          }
                          else {
                            echo "<li class='disabled'><a>Next</a></li>";
                          }

                          echo "</ul></div></div>";
                          ?>
                      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Contents Here -->
  
    <?php include "../../resources/templates/admin/footer.php"; ?>

    <!-- Scripts -->
    <!-- Bootstrap -->
    <script src="../../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src= "../../resources/libraries/fastclick/lib/fastclick.js"></script>
    <!-- input mask -->
    <script src= "../../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <!-- Date Range Picker -->
    <script src="../../resources/libraries/moment/min/moment.min.js"></script>
    <script src="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../../resources/libraries/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src= "../../assets/js/custom.min.js"></script>
    <script type="text/javascript">
      function changeEntries(val) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           location.reload();
          }
        };
        xhttp.open("GET", "../entry/signatory_entry.php?sign_entry="+val, true);
        xhttp.send();
      }
    </script>
    <script type="text/javascript">
        $(function() {
        $('.sign-list').tablesorter();
        $('.tablesorter-bootstrap').tablesorter({
        theme : 'bootstrap',
        headerTemplate: '{content} {icon}',
        widgets    : ['zebra','columns', 'uitheme']
        });
        });
      </script>
    </body>
</html>
</body>
</html>