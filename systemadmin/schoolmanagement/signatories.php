<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<html>
<head>
    <title>View Signatories</title>
    <link rel="shortcut icon" href="../../images/pines.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../css/custom.min.css" rel="stylesheet">
    <link href="../../css/tstheme/style.css" rel="stylesheet">
    
</head>
<body class="nav-md">
<?php include "../../resources/templates/admin/sidebar.php"; ?>
<?php include "../../resources/templates/admin/top-nav.php"; ?>
<!-- Content Start -->
<div class="right_col" role="main">
             <div class="col-md-5">
        <ol class="breadcrumb">
          <li><a href="../index.php">Home</a></li>
          <li class="disabled">Signatories</li>
          <li class="active">View Signatories</li>
        </ol>
      </div>
    <form class="form-horizontal form-label-left" action="signatories.php" method="GET">

        <div class="form-group">
            <div class="col-sm-5"></div>
            <div class="col-sm-7">
                <div class="input-group">

                    <input type="text" class="form-control" name="search_key" placeholder="Search Signatories">
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
                    <h2><i class="fa fa-users"> </i> Signatories</h2>
                    <div class="clearfix"></div>
                      <br/>
                     <?php
                        if(isset($_SESSION['sign_del'])) {
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
                        <table id="signList" class="table table-bordered tablesorter">
                            <thead>
                            <tr>
                                <th>Signatory ID</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Degree</th>
                                <th>Position</th>
                                <th>Year Started</th>
                                <th>Year Ended</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $start=0;
                            $limit=10;

                            if(isset($_GET['page'])){
                              $page=$_GET['page'];
                              $start=($page-1)*$limit;
                            }else{
                              $page=1;
                            }

                            if(!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
                            if (isset($_GET['search_key'])){
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
                            }else{
                                $statement = "SELECT * FROM pcnhsdb.signatories
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
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
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
                                                        <a href= "signatory_view.php?sign_id=$sign_id" class="btn btn-primary btn-xs"><i class="fa fa-user"></i> View </a>
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
                    $total = ceil($rows/$limit);
                    
                    echo "<p>Showing $limit of $rows Entries</p>";

                    echo '<div class="pull-right">
                      <div class="col s12">
                      <ul class="pagination center-align">';
                      if($page > 1) {
                        echo "<li class=''><a href='signatories.php?page=".($page-1)."'>Previous</a></li>";
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
                          echo "<li class='active'><a href='signatories.php?page=$i'>$i</a></li>";
                        } else {
                            echo "<li class=''><a href='signatories.php?page=$i'>$i</a></li>";
                          }
                      }


                      if($total == 0) {
                        echo "<li class='disabled'><a>Next</a></li>";
                      }else if($page!=$total) {
                        echo "<li class=''><a href='signatories.php?page=".($page+1)."'>Next</a></li>";
                      }else {
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
<!-- Content End -->
<?php include "../../resources/templates/registrar/footer.php"; ?>

<!-- Scripts -->
<!-- jQuery -->
<script src="../../resources/libraries/jquery/dist/jquery.min.js" ></script>
<!-- Bootstrap -->
<script src="../../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src= "../../resources/libraries/fastclick/lib/fastclick.js"></script>
<!-- input mask -->
<script src= "../../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
<!-- NProgress -->
<script src="../../resources/libraries/nprogress/nprogress.js"></script>
<!-- Custom Theme Scripts -->
<script src= "../../js/custom.min.js"></script>
<script type="text/javascript" src=<?php echo "../../resources/libraries/tablesorter/jquery.tablesorter.js" ?>></script>
<!-- Scripts -->
<script type="text/javascript">
    $(document).ready(function(){
            $("#signList").tablesorter({headers: { 8:{sorter: false}, }});
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
        xhttp.open("GET", "../entry/index_entry.php?entry="+val, true);
        xhttp.send();
      }
</script>

</body>
</html>