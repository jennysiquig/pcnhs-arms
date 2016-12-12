<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
<?php require_once "../../resources/config.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <?php include "$base_url/resources/templates/registrar/header.php"; ?>
    
  </head>
  <body class="nav-md">
    <?php include "$base_url/resources/templates/registrar/sidebar.php"; ?>
    <?php include "$base_url/resources/templates/registrar/top-nav.php"; ?>
    <!-- Content Start -->
    <div class="right_col" role="main">
      
      <form class="form-horizontal form-label-left ">
        
        <div class="form-group">
          <div class="col-sm-5"></div>
          <div class="col-sm-7">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search Student...">
              <span class="input-group-btn">
                <button type="button" class="btn btn-primary">Go</button>
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
                      <th>Last School Year Attended</th>
                      <th>Curriculum</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                      
                      <?php 
                        if(!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }

                        $statement = "select * from students left join curriculum on students.curr_id = curriculum.curr_id";

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
                              $birth_place = $row['birth_place'];
                              
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
                                  <td>$mid_name</td>
                                  <td>$curr_code</td>
                                  <td>
                                    <span class="">
                                      <a href="$base_url/registrar/studentmanagement/student_info.php?stud_id=$stud_id" class="btn btn-primary btn-xs"><i class="fa fa-user"></i> View </a>
                                    </span>
                                  </td>
                                </tr>

STUDLIST;
                          }
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
      <?php include "$base_url/resources/templates/registrar/footer.php"; ?>
      <?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
      <!-- Scripts -->
      <script type="text/javascript" src=<?php echo "$base_url/resources/libraries/tablesorter/jquery.tablesorter.js" ?>></script>
      <script type="text/javascript">
      
        $(document).ready(function(){
          $("#studList").tablesorter({headers: { 6:{sorter: false}, }});
          }
        );
        
      </script>
      
    </body>
  </html>