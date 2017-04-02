<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!-- Validations -->
<?php
    $stud_id = $_GET['stud_id'];
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $pschool_year = "";
    $getsy = $_GET['schl_year'];
    $statement = "SELECT * FROM pcnhsdb.students NATURAL JOIN primaryschool where stud_id = '$stud_id';";
    $result = $conn->query($statement);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $pschool_year = $row['pschool_year'];
        }
    }

    $explode_date_input = explode("-", $getsy);
    $explode_date_compare = explode("-", $pschool_year);

    $input_year1 = intval($explode_date_input[0]);
    $input_year2 = intval($explode_date_input[1]);

    $compare_year1 = intval($explode_date_compare[0]);
    $compare_year2 = intval($explode_date_compare[1]);



    if($input_year1 <= $compare_year1 || $input_year2 <= $compare_year2) {
        $_SESSION['error_message'] = "<p style='color: red'><b>Invalid School Year</b></p>";
        $yr_level_check = $_GET['yr_level'];
        //header("location: add_grades.php?stud_id=$stud_id&yr_level=$yr_level_check");
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

?>


<!-- Validations -->
<html>
    <head>
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
        <!-- Sidebar -->
        <?php include "../../resources/templates/registrar/sidebar.php"; ?>
        <!-- Top Navigation -->
        <?php include "../../resources/templates/registrar/top-nav.php"; ?>
        <div class="right_col" role="main">

            <div class="clearfix"></div>
            <!-- Generate Error Message Here  -->
            <?php
                if(isset($_SESSION['error_pop'])) {
                    echo $_SESSION['error_pop'];
                    unset($_SESSION['error_pop']);
                }
            ?>
            <!--  -->
            <div class="x_panel">

                <div class="x_title">
                    <h2>Grades</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- First -->
                    <form id="val-gr-form" class="form-horizontal form-label-left" name="val-gr-form" action="phpinsert/grades_insert.php" method="POST" data-parsley-validate>
                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel">
                            <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <h4 class="panel-title">Student's School Information</h4>
                            </a>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                              <div class="panel-body">
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">School Name:</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <?php
                                        $schl_name = $_GET['schl_name'];
                                        echo "<input class='form-control' value='$schl_name' name='schl_name' readonly>";
                                    ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Student ID:</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php
                                    $stud_id = $_GET['stud_id'];
                                    echo "<input class='form-control' value='$stud_id' name='stud_id' readonly>";
                                ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">School Year:</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php
                                    $sy = $_GET['schl_year'];
                                    echo "<input class='form-control' value='$sy' name='schl_year' readonly>";
                                ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Program:</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <?php
                                        $sp = $_GET['program'];
                                        echo "<input class='form-control' value='$sp' name='program' readonly>";
                                    ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum:</label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <?php
                                        if(!$conn) {
                                            die();
                                        }
                                        $curr_id = $_GET['curriculum'];
                                        $statement = "SELECT * FROM pcnhsdb.curriculum where curr_id = $curr_id";

                                        $result = $conn->query($statement);
                                        if ($result->num_rows > 0) {
                                                // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                $curr_name = $row['curr_name'];
                                                echo "<h4>".$curr_name."</h4>";
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Level or Grade:</label>
                                    <div class="col-xs-1">
                                    <?php
                                        $year = $_GET['yr_level'];
                                        $grade = ((int) $year)+6;
                                        echo "<input class='form-control' value='$year' name='yr_level' readonly>";
                                    ?>
                                    </div>

                                    <div class="col-xs-1">
                                    <?php
                                        $year = $_GET['yr_level'];
                                        $grade = ((int) $year)+6;
                                        echo "<input class='form-control' value='$grade' name='grade' readonly>";
                                    ?>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>


                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Subject ID</th>
                                    <th>Subject</th>
                                    <th>Subject Level</th>
                                    <th>Credits Earned</th>
                                    <th>Final Grade</th>
                                    
                                </tr>
                            </thead>
                            <tbody id="subj_list">

                                <?php
                                $curriculum;
                                if($_GET['curriculum_subj'] == "none") {
                                    $curriculum = $_GET['curriculum'];
                                }else {
                                    $curriculum = $_GET['curriculum_subj'];
                                }
                                
                                $yr_level_needed = $_GET['yr_level'];
                                $prog_id = $_GET['prog_id'];
                                $total_unit = 0;
                                $numberOfSubj = 0;
                                $x = 0;
                                $statement = "SELECT * from subjects NATURAL JOIN subjectcurriculum NATURAL JOIN curriculum NATURAL JOIN programs NATURAL JOIN subjectprogram WHERE subjectcurriculum.curr_id = $curriculum AND yr_level_needed = $yr_level_needed AND prog_id = $prog_id";
                                $result = $conn->query($statement);
                                if($result->num_rows>0) {
                                while ($row = $result->fetch_assoc()) {
                                //$subj_id = $row['subj_id'];
                                $subj_id = $row['subj_id'];
                                $subj_name = $row['subj_name'];
                                $subj_level = $row['subj_level'];
                                
                                
                                $numberOfSubj += 1;
                                //$curr_name = $row['curr_name'];

                                if(strtolower($subj_name) == "makabayan i" || strtolower($subj_name) == "makabayan ii" || strtolower($subj_name) == "makabayan iii" || strtolower($subj_name) == "makabayan iv") {
                                    
                                    $numberOfSubj -= 1;

                                    echo <<<SUBJ
                                
                                <tr>
                                    <td>
                                        <div class="item form-group">
                                            <div class="col-md-3">
                                                <input class="form-control" value="$subj_id" name="subj_id[]" style="width: 50px;" readonly>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$subj_name</td>
                                    <td>$subj_level</td>
                                    <td>$credit_earned</td>
                                    <td>
                                        <div class="item form-group">
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" text-align:center;" name="fin_grade[]" value="0" readonly>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                
SUBJ;

                                }else {
                                    $x+=1;
                                    $y = $x-1;

                                    if(isset($_SESSION['grade'])) {
                                        $z = $_SESSION['grade'];
                                            if(isset($z[$y])) {
                                                echo <<<SUBJ
                                
                                <tr>
                                    <td>   
                                        <div class="item form-group">
                                            <div class="col-md-3">
                                                <input class="form-control" value="$subj_id" name="subj_id[]" style="width: 50px;" readonly>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$subj_name</td>
                                    <td>$subj_level</td>
                                    <td>
                                        <div class="item form-group">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" text-align:center;" name="credit_earned[]" pattern="\d+(\.\d{2})?" onblur="computeCredits(this.value)" onkeypress="return isNumberKey(event)" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" text-align:center;" name="fin_grade[]" pattern="\d+(\.\d{2})?" onblur="saveToDB(this.value)" onkeypress="return isNumberKey(event)" placeholder="" value="$z[$y]" required>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                
SUBJ;
                                            }else {
                                                 echo <<<SUBJ
                                
                                <tr>
                                   <td>   
                                        <div class="item form-group">
                                            <div class="col-md-3">
                                                <input class="form-control" value="$subj_id" name="subj_id[]" style="width: 50px;" readonly>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$subj_name</td>
                                    <td>$subj_level</td>
                                    <td>
                                        <div class="item form-group">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" text-align:center;" name="credit_earned[]" pattern="\d+(\.\d{2})?" onblur="computeCredits(this.value)" onkeypress="return isNumberKey(event)" placeholder="" value="" required>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="item form-group">
                                            <div class="col-md-4">
                                                <input type="text" style="width: 50px; text-align:center;" name="fin_grade[]" pattern="\d+(\.\d{2})?" onblur="saveToDB(this.value)" onkeypress="return isNumberKey(event)" placeholder="" required>
                                            </div>
                                        </div>
                                    </td>
                                    
                                </tr>
                                
SUBJ;
                                            }
                                        
                                    }else {
                                        echo <<<SUBJ
                                
                                <tr>
                                    <td>   
                                        <div class="item form-group">
                                            <div class="col-md-3">
                                                <input class="form-control" value="$subj_id" name="subj_id[]" style="width: 50px;" readonly>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$subj_name</td>
                                    <td>$subj_level</td>
                                    <td>
                                        <input type="text" style="width: 50px; text-align:center;" name="credit_earned[]" pattern="\d+(\.\d{2})?" onblur="computeCredits(this.value)" onkeypress="return isNumberKey(event)" placeholder="" value="" required>
                                    </td>
                                    <td><input type="text" style="width: 50px; text-align:center;" name="fin_grade[]" pattern="\d+(\.\d{2})?" onblur="saveToDB(this.value)" onkeypress="return isNumberKey(event)" placeholder="" required></td>
                                    
                                </tr>
                                
SUBJ;
                                    }
                                    
                                    
                                
                                }
                                
                                    }
                                }
                                 
                                    echo <<<NUM
                                    <div class="item form-group">
                                        <label class="control-label col-md-11 col-sm-3 col-xs-12">Number of Subjects:</label>
                                        <div class="col-md-1 col-sm-6 col-xs-12">
                                            <input id="num_subj" class="form-control col-md-7 col-xs-12" type="text" value='$numberOfSubj' readonly>
                                        </div>
                                    </div>
NUM;
                                ?>
                                
                            </tbody>
                        </table>

                        <div class="clearfix"></div>
                        <div class="col-md-2 col-xs-12">
                            <label for="average">Average Grade: </label>
                            <input id="average" class="form-control" type="text" style="width: 70px;" value="" name="average_grade">
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <label for="total_credits">Total Credits: </label>
                            <input id="total_credits" class="form-control" type="text" style="width: 70px;" value="" name="total_credits" onkeypress="return isNumberKey(event)">
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-md-2 pull-right">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <button id="send" type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        <script src= "../../resources/libraries/parsleyjs/dist/parsley.js"></script>
        <!-- Local Storage -->
        <script src= "../../resources/libraries/sisyphus/sisyphus.js"></script>
        <!-- NProgress -->
        <script src="../../resources/libraries/nprogress/nprogress.js"></script>
        <!-- Custom Theme Scripts -->
        <script src= "../../js/custom.min.js"></script>
        <!-- Scripts -->
       <!-- Parsley -->
 
        <!-- Sisyphus -->
        
        <!-- jquery.inputmask -->
                <script>
                    $(document).ready(function() {
                        $(":input").inputmask();
                    });
                </script>
                <!-- /jquery.inputmask -->
        <!-- Save to DB Script -->
        <script type="text/javascript">
            function saveToDB(x) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                   
                  }
                };
                xhttp.open("GET", "phpscript/tempgrade.php?grade="+x, true);
                xhttp.send();
                var subj_id = document.getElementsByName('subj_id[]');
                var fin_grade = document.getElementsByName('fin_grade[]');
                var comment = document.getElementsByName('comment[]');
                var average = document.getElementById('average');
                var computed_average = 0;
                var total_finalgrade = 0;
                var num_subj = parseInt(document.getElementById('num_subj').value);
                console.log(num_subj);
                if(x == "") {

                }else {
                    for (var i = 0; i < subj_id.length; i++) {
                        console.log(subj_id[i].value+" - "+fin_grade[i].value);
                        total_finalgrade += parseFloat(fin_grade[i].value);

                    }
                    computed_average = total_finalgrade/num_subj;
                    average.value = computed_average;
                    console.log(parseInt(total_finalgrade));
                    console.log(parseInt(computed_average));
                }

            }
            function computeCredits(y) {
                var subj_id = document.getElementsByName('subj_id[]');
                var credit_earned = document.getElementsByName('credit_earned[]');
                var computed_credits = 0;
                var total_credits = document.getElementById('total_credits');
                console.log(y);
                if(y == "") {

                }else {
                    for (var i = 0; i < subj_id.length; i++) {
                       
                        computed_credits += parseFloat(credit_earned[i].value);

                    }
                    
                    total_credits.value = computed_credits;
                    console.log(computed_credits);
                }
            }
        </script>
        <!-- Save to DB Script -->
        <!-- Limit to numbers only -->
        <script type="text/javascript">
            function isNumberKey(evt, n){
            console.log(n);
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode != 46 && charCode > 31 
                && (charCode < 48 || charCode > 57))
                 return false;

              return true;
           }
        </script>
    </body>
</html>