assets/<!DOCTYPE html>
<?php include('include_files/session_check.php'); ?>
<?php require_once "../../resources/config.php"; ?>
<?php 
  if(!isset($_GET['first-name']) || !isset($_GET['last-name'])) {
    header("location: request_credential.php");
  }
?>
<html>
  <head>
    <title>Validate Request</title>
    <link rel="shortcut icon" href="../../assets/images/pines.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <!-- NProgress -->
      <link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Datatables -->
    <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="../../assets/css/custom.min.css" rel="stylesheet">
    <link href="../../assets/css/tstheme/style.css" rel="stylesheet">
    
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
        
       
      </form>
      <div class="clearfix"></div>
      <div class="">
        
        <div class="clearfix"></div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Search Result</h2>
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
                      
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php

                    $stud_id = "";
                    $cred_id = $_GET['credential'];
                    $purpose = $_GET['purpose'];

                    if($_GET['last-name'] != null && $_GET['first-name'] != null) {
                      $search = htmlspecialchars($_GET['first-name']." ".$_GET['last-name'], ENT_QUOTES);
                      $first_name = htmlspecialchars($_GET['first-name'], ENT_QUOTES);
                      $last_name = htmlspecialchars($_GET['last-name'], ENT_QUOTES);
                      $statement = "select * from students left join curriculum on students.curr_id = curriculum.curr_id where last_name like '%$last_name' or first_name like '%$first_name' or stud_id like '%$search' or concat(first_name,' ',last_name) like '%$search' or concat(last_name,' ',first_name,' ',mid_name) like '%$search' or concat(first_name,' ',mid_name,' ',last_name) like '%$search'";


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
                      <td>
                        <span class="">
                          <center><a href="../../registrar/credentials/generate_cred.php?stud_id=$stud_id&credential=$cred_id&purpose=$purpose&new_request=true" class="btn btn-default btn-xs"> Add Request</a></center>
                        </span>
                      </td>
                    </tr>
STUDLIST;
                      }
                    }
                    }else {
                      echo "<p>No Result</p>";
                    }
                    
                    ?>
                  </tbody>
                </table>
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
    <!-- NProgress -->
    <script src="../../resources/libraries/nprogress/nprogress.js"></script>
    <script type="text/javascript" src=<?php echo "../../resources/libraries/tablesorter/jquery.tablesorter.js" ?>></script>
    <!-- Scripts -->
    
    <script type="text/javascript">
    
    $(document).ready(function(){
    $("#studList").tablesorter({headers: { 6:{sorter: false}, }});
    }
    );
    
    </script>
    <!-- Change Entry -->
    <script type="text/javascript">
      function changeEntries(val) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
           location.reload();
          }
        };
        xhttp.open("GET", "showentry.php?entry="+val, true);
        xhttp.send();
      }
    </script>
    <!--  -->
  </body>
</html>