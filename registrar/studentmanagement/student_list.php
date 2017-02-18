<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
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
    <?php include "../../resources/templates/registrar/sidebar.php"; ?>
    <?php include "../../resources/templates/registrar/top-nav.php"; ?>
    <!-- Content Start -->
    <div class="right_col" role="main">
      
      <form class="form-horizontal form-label-left" action="student_list.php" method="GET">
        
        <div class="form-group">
          <div class="col-sm-5"></div>
          <div class="col-sm-7">
            <div class="input-group">
              
                <input type="text" class="form-control" name="search_key" placeholder="Search Student...">
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
              <h2>Student Management <small>Student List</small></h2>
              <div class="clearfix"></div>
              <br/>
              
            </div>
            <div class="x_content">
              <div class="table-responsive">
                <table id="studList" class="table table-bordered tablesorter">
                  <thead>
                    <tr>
                      <th>Student ID</th>
                      <th>Last Name</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Curriculum</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                    $statement = "";
                    $start=0;
                    $limit=20;
                    if(isset($_GET['page'])){
                      $page=$_GET['page'];
                      $start=($page-1)*$limit;
                    }else{
                      $page=1;
                    }

                    if(!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                    }

                    if(isset($_GET['search_key'])) {
                      $search = $_GET['search_key'];
                      $statement = "select * from students left join curriculum on students.curr_id = curriculum.curr_id where last_name like '%$search' or first_name like '%$search' or stud_id like '%$search' or concat(first_name,' ',last_name) like '%$search' or concat(last_name,' ',first_name,' ',mid_name) like '%$search' or concat(first_name,' ',mid_name,' ',last_name) like '%$search' limit $start, $limit";
                    }else {
                      $statement = "select * from students left join curriculum on students.curr_id = curriculum.curr_id limit $start, $limit";
                    }

                    
                    
                    

                    $result = $conn->query($statement);
                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    $stud_id = $row['stud_id'];
                    $first_name = $row['first_name'];
                    $mid_name = $row['mid_name'];
                    $last_name = $row['last_name'];
                    $gender = $row['gender'];
                    $birth_date = $row['birth_date'];
                    
                    
                    //$yr_grad = $row['yr_grad'];
                    $program = $row['prog_id'];
                    $curriculum = $row['curr_id'];
                    $curr_code = $row['curr_code'];

                    echo <<<STUDLIST
                    <tr>
                      <td>$stud_id</td>
                      <td>$last_name</td>
                      <td>$first_name</td>
                      <td>$mid_name</td>
                      <td>$curr_code</td>
                      <td>
                        <span class="">
                          <a href="../../registrar/studentmanagement/student_info.php?stud_id=$stud_id" class="btn btn-primary btn-xs"><i class="fa fa-user"></i> View </a>
                        </span>
                      </td>
                    </tr>
STUDLIST;
                      }
                    }
                    ?>
                  </tbody>
                </table>
                <?php
                  $statement = "select * from students left join curriculum on students.curr_id = curriculum.curr_id";
                    $rows = mysqli_num_rows(mysqli_query($conn, $statement));
                    $total = ceil($rows/$limit);

                    echo '<div class="pull-right">
                      <div class="col s12">
                      <ul class="pagination center-align">';
                      if($page > 1) {
                        echo "<li class=''><a href='student_list.php?page=".($page-1)."'>Previous</a></li>";
                      }else if($total <= 0) {
                        echo '<li class="disabled"><a>Previous</a></li>';
                      }else {
                        echo '<li class="disabled"><a>Previous</a></li>';
                      }
                      for($i = 1;$i <= $total; $i++) {
                        if($i==$page) {
                          echo "<li class='active'><a href='student_list.php?page=$i'>$i</a></li>";
                      } else {
                          echo "<li class=''><a href='student_list.php?page=$i'>$i</a></li>";
                        }
                      }
                      if($total == 0) {
                        echo "<li class='disabled'><a>Next</a></li>";
                      }else if($page!=$total) {
                        echo "<li class=''><a href='student_list.php?page=".($page+1)."'>Next</a></li>";
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
    <!-- Custom Theme Scripts -->
    <script src= "../../js/custom.min.js"></script>
    
    <script type="text/javascript" src=<?php echo "../../resources/libraries/tablesorter/jquery.tablesorter.js" ?>></script>
    <!-- Scripts -->
    
    <script type="text/javascript">
    
    $(document).ready(function(){
    $("#studList").tablesorter({headers: { 6:{sorter: false}, }});
    }
    );
    
    </script>
    
  </body>
</html>