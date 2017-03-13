<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }
    // Session Timeout
    $time = time();
    $session_timeout = 1800; //seconds
    
    if(isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
      session_unset();
      session_destroy();
      session_start();
    }

    $_SESSION['last_activity'] = $time;
  ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Bootstrap -->
    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Datatables -->
    <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../../css/custom.min.css" rel="stylesheet">
    <link href="../../css/tstheme/style.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="../js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-md">
<?php include "../../resources/templates/admin/sidebar.php"; ?>
<?php include "../../resources/templates/admin/top-nav.php"; ?>
<!-- Content Start -->
<div class="right_col" role="main">
    <form class="form-horizontal form-label-left" action="personnels.php" method="GET">

        <div class="form-group">
            <div class="col-sm-5"></div>
            <div class="col-sm-7">
                <div class="input-group">

                    <input type="text" class="form-control" name="search_key" placeholder="Search Personnel ID or User Name">
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
                    <h2><i class="fa fa-users"></i> Personnel Accounts 
                    </h2>
                    <div class="clearfix"></div>
                    <br/>

                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="personnelList" class="table table-bordered tablesorter ">
                            <thead>
                            <tr>
                                <th>Personnel ID</th>
                                <th>Username</th>
                                <th>Position</th>
                                <th>Access Type</th>
                                <th>Account Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $start=0;
                            $limit=8;
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
                                $statement = "SELECT * FROM pcnhsdb.personnel 
                                WHERE (per_id LIKE '%$search%') 
                                AND (per_id NOT LIKE '1' and per_id NOT LIKE '2') 
                                OR (uname LIKE '%$search%')
                                AND (uname NOT LIKE 'admin' and uname NOT LIKE 'registrar') 
                                LIMIT $start, $limit";
                            }else{
                                $statement = "SELECT * FROM pcnhsdb.personnel
                                WHERE uname NOT LIKE 'registrar' 
                                AND uname NOT LIKE 'admin' 
                                LIMIT $start, $limit";
                            }

                            $result = $conn->query($statement);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $per_id = $row['per_id'];
                                    $uname = $row['uname'];
                                    $password = $row['password'];
                                    $last_name = $row['last_name'];
                                    $first_name = $row['first_name'];
                                    $mname = $row ['mname'];
                                    $position = $row ['position'];
                                    $access_type = $row ['access_type'];
                                    $accnt_status = $row ['accnt_status'];
                                    echo <<<PERSONNELLIST
                    <tr class="odd pointer">
                                                        <td class=" ">$per_id</td>
                                                        <td class=" ">$uname</td>
                                                        <td class=" ">$position</td>
                                                        <td class=" ">$access_type</td>
                                                        <td class=" ">$accnt_status</td>
                                                        <td class=" ">
                                                        <a href= "personnel_view.php?per_id=$per_id" class="btn btn-primary btn-xs">
                                                        <i class="fa fa-user"></i>View</a>
                                                        </td>
                                                        
                                            </tr>
PERSONNELLIST;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        $statement = "SELECT * FROM pcnhsdb.personnel";
                        $rows = mysqli_num_rows(mysqli_query($conn, $statement));
                        $total = ceil($rows/$limit);

                        echo '<div class="pull-right">
                      <div class="col s12">
                      <ul class="pagination center-align">';
                        if($page > 1) {
                            echo "<li class=''><a href='personnels.php?page=".($page-1)."'>Previous</a></li>";
                        }else if($total <= 0) {
                            echo '<li class="disabled"><a>Previous</a></li>';
                        }else {
                            echo '<li class="disabled"><a>Previous</a></li>';
                        }
                        for($i = 1;$i <= $total; $i++) {
                            if($i==$page) {
                                echo "<li class='active'><a href='personnels.php?page=$i'>$i</a></li>";
                            } else {
                                echo "<li class=''><a href='personnels.php?page=$i'>$i</a></li>";
                            }
                        }
                        if($total == 0) {
                            echo "<li class='disabled'><a>Next</a></li>";
                        }else if($page!=$total) {
                            echo "<li class=''><a href='personnels.php?page=".($page+1)."'>Next</a></li>";
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
<?php include "../../resources/templates/admin/footer.php"; ?>

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
<!-- Custom Theme Scripts -->
<script src= "../../js/custom.min.js"></script>

<script type="text/javascript" src=<?php echo "../../resources/libraries/tablesorter/jquery.tablesorter.js" ?>></script>
<!-- Scripts -->

<script type="text/javascript">

    $(document).ready(function(){
            $("#personnelList").tablesorter({headers: { 5:{sorter: false}, }});
        }
    );
</script>

</body>
</html>