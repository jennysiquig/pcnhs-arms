<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php include('../../resources/classes/Popover.php'); ?>

<!-- Validations -->
<?php
    $stud_id = $_GET['stud_id'];
    $yr_level = $_GET['yr_level'];
    $prog_id = $_GET['prog_id'];
    $curriculum = $_GET['curriculum'];
    $curriculum_subj = $_GET['curriculum_subj'];
    $schl_name = $_GET['schl_name'];
    $schl_year = $_GET['schl_year'];

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
    }else {
        header("location: ../../index.php");
        die();
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
        die();
    }

    $checkgrade = "SELECT * from pcnhsdb.grades where stud_id = '$stud_id' AND yr_level = '$yr_level'";
    $result = $conn->query($checkgrade);
    if ($result->num_rows > 0) {
        $alert_type = "danger";
        $error_message = "Student $stud_id grades for year level $yr_level is already existing.";
        $popover = new Popover();
        $popover->set_popover($alert_type, $error_message); 
        $_SESSION['hasgrades'] = $popover->get_popover();
        header("location: grades.php?stud_id=".$stud_id);
        die();
    }
?>


<!-- Validations -->
<html>
    <head>
        <title>Add Student Grades</title>
        <link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
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
            <div class="row">
                <div class="col-md-9">
                    <a class="btn btn-default" href=<?php echo "grades.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
                </div>
            </div>
            <div class="x_panel">

                <div class="x_title">
                    <h2>Grades</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- First -->
                    <!-- data-parsley-validate -->
                    <?php
                        $curr_id = $_GET['curriculum'];
                    ?>
                    <!-- val-gr-form -->
                    <form id=<?php echo "'$stud_id-$yr_level'"; ?> class="form-horizontal form-label-left" name="val-gr-form" action=<?php echo "phpinsert/grades_insert.php?curr_id=$curr_id"; ?> method="POST" > 
                        <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel">
                            <a class="panel-heading" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                              <h4 class="panel-title">Student's School Information</h4>
                            </a>
                            <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="true">
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


                        <table class="table table-hover jambo_table">
                            <thead>
                                <tr>
                                    <th>Subject ID</th>
                                    <th>Subject</th>
                                    <th>Subject Level</th>
                                    <th>Final Grade</th>
                                    <th>Credits Earned <br> (For K-12, enter 'P' for <br>'Promoted' or 'R' for 'Retained')</th>
                                    <th>Special Grade <br>(Optional. For NSEC only.)</th>
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
                                if(!$result) {
                                    die();
                                }
                                if($result->num_rows>0) {
                                    while ($row = $result->fetch_assoc()) {
                                    //$subj_id = $row['subj_id'];
                                    $subj_id = $row['subj_id'];
                                    $subj_name = $row['subj_name'];
                                    $subj_level = $row['subj_level'];
                                    $numberOfSubj += 1;

                                    $grades_pos = 1;
                                    $credits_pos = 2;
                                    
                                    if(isset($_SESSION['grades_array'])) {
                                        $grades_array = $_SESSION['grades_array'];

                                        if(empty($grades_array[$grades_pos][$x])) {
                                            $grades = "";
                                        }else {
                                            $grades = $grades_array[$grades_pos][$x];
                                        }
                                        if(empty($grades_array[$credits_pos][$x])) {
                                            $credits = "";
                                        }else {
                                            $credits = $grades_array[$credits_pos][$x];
                                        }
                                         echo <<<SUBJ
                                                <tr>
                                                    <td>
                                                        <div class="item form-group">
                                                            <div class="col-md-5">
                                                                <input class="form-control" name="subj_id[]" value="$subj_id"  style="width: 50px;" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>$subj_name</td>
                                                    <td>$subj_level</td>
                                                    <td>
                                                        <div class="col-md-5">
                                                            <input type="text" id="grade-$x" class="form-control" name="fin_grade[]"  onkeypress="return isNumberKey(event), dateModified();" placeholder="" value="$grades">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-5">
                                                            <input type="text" id="credit-$x" class="form-control" name="credit_earned[]" onkeypress="dateModified();" placeholder="" value="$credits">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="special_grade[]" placeholder="" value="">
                                                        </div>

                                                    </td>
                                                    
                                                </tr>
                                
SUBJ;
                                    }else {
                                        echo <<<SUBJ
                                                <tr>
                                                    <td>
                                                        <div class="item form-group">
                                                            <div class="col-md-5">
                                                                <input class="form-control" name="subj_id[]" value="$subj_id"  style="width: 50px;" readonly>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>$subj_name</td>
                                                    <td>$subj_level</td>
                                                    <td>
                                                        <div class="col-md-5">
                                                            <input type="text" id="grade-$x" class="form-control" name="fin_grade[]" onkeypress="return isNumberKey(event), dateModified(this.value);" placeholder="" value="">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-5">
                                                            <input type="text" id="credit-$x" class="form-control" name="credit_earned[]"  onkeypress="dateModified();" placeholder="" value="">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-5">
                                                            <input type="text" class="form-control" name="special_grade[]" onblur="dateModified();" placeholder="" value="">
                                                        </div>

                                                    </td>
                                                    
                                                </tr>
                                
SUBJ;
                                    }
                                    $x+=1;
                                    
                                   
                                    }//while end
                                 }//if end
                                        echo <<<NUM
                                        <div class="item form-group">
                                            <label class="control-label col-md-11 col-sm-3 col-xs-12">Number of Subjects:</label>
                                            <div class="col-md-1 col-sm-6 col-xs-12">
                                                <input id="num_subj" class="form-control col-md-7 col-xs-12" type="text" value='$numberOfSubj' readonly>
                                            </div>
                                        </div>
NUM;
                                unset($_SESSION['grades_array']);
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
                        <br>
                        <div class="row">
                            <div class="pull-right">
                                <button type="reset" class="btn btn-default" onclick="releaseData();">Reset</button>
                                
                                <button type="" id="send" class="btn btn-primary" onclick="saveToFile();" data-toggle="tooltip" data-placement="top" title="Save grades as CSV"><i class="glyphicon glyphicon-floppy-disk"></i> Save to File</button>
                                <button type="submit" id="send" class="btn btn-success" onclick="saveToDB(); computeCredit(); computeAverage();"><i class="glyphicon glyphicon-floppy-disk"></i> Save to Database</button>
                            </div>
                            
                        </div>
                    </form>
                    <div class="ln_solid"></div>
                    <form action="phpscript/parsegrades.php" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="pull-right">
                
                                <button id="upbtn" class="btn btn-default" type="submit" value="submit" disabled>Upload</button>
                            </div>
                            <div class="pull-right">
                            <p>Open Grades Save File (filename.csv)</p>
                                <input type="file" name="grades" id="fileInput" accept=".csv" />
                            </div>
                            <br>     
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
        <script src= "../../assets/js/custom.min.js"></script>
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
            function computeCredit() {
                var subj_id = document.getElementsByName('subj_id[]');
                var credit_earned = document.getElementsByName('credit_earned[]');
                var computed_credits = 0;
                var total_credits = document.getElementById('total_credits');
                    for (var i = 0; i < subj_id.length; i++) {
                        computed_credits += parseFloat(credit_earned[i].value);
                    }
                    total_credits.value = computed_credits;
                    console.log(computed_credits);
            }
            function computeAverage() {
                var subj_id = document.getElementsByName('subj_id[]');
                var fin_grade = document.getElementsByName('fin_grade[]');
                var comment = document.getElementsByName('comment[]');
                var average = document.getElementById('average');
                var computed_average = 0;
                var total_finalgrade = 0;
                var num_subj = parseInt(document.getElementById('num_subj').value);
                console.log(num_subj);
            
                    for (var i = 0; i < subj_id.length; i++) {
                        console.log(subj_id[i].value+" - "+fin_grade[i].value);
                        total_finalgrade += parseFloat(fin_grade[i].value);

                    }
                    computed_average = total_finalgrade/num_subj;
                    average.value = computed_average;
                    console.log(parseInt(total_finalgrade));
                    console.log(parseInt(computed_average));
                
            }
            function dateModified() {
                var date = new Date();
                var n = date.toDateString();
                var time = date.toLocaleTimeString();
                var date_modified = n + ' ' + time;
                var stud_id = document.getElementsByName('stud_id')[0].value;

                var modified = "EDITED GRADES";
                

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                   
                  }
                };
                xhttp.open("GET", "phpscript/update_date_modified.php?date_modified="+date_modified+"&stud_id="+stud_id+"&modified="+modified, true);
                xhttp.send();

            }
            function isNumberKey(evt, n){
            console.log(n);
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode != 46 && charCode > 31 
                && (charCode < 48 || charCode > 57))
                 return false;

              return true;
            }
            function saveToFile() {
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                   console.log("saved to file.");
                  }
                };
                xhttp.open("GET", "phpscript/saveToFile.php", false);
                xhttp.send(null);
            }
            function saveToDB() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                   console.log("saved to database.");
                  }
                };
                xhttp.open("GET", "phpscript/saveToDB.php", false);
                xhttp.send(null);
                
            }

        </script>
        <script type="text/javascript">
            $(document).ready(
                function(){
                    $('input:file').change(
                        function(){
                            if ($(this).val()) {
                                $('#upbtn').attr('disabled',false);
                                // or, as has been pointed out elsewhere:
                                // $('input:submit').removeAttr('disabled'); 
                            } 
                        }
                        );
                });
        </script>
        <script type="text/javascript">
            var val_gr_form = document.getElementsByName("val-gr-form");
            var stud_unique_id = val_gr_form[0].id;
      

            $( function() {
                        $('#' + stud_unique_id).sisyphus({
                            autoRelease: false,
                        });
                    });
        </script>
        <script type="text/javascript">
            var val_gr_form = document.getElementsByName("val-gr-form");
            var stud_unique_id = val_gr_form[0].id;
            

            function releaseData() {
                $('#' + stud_unique_id).sisyphus().manuallyReleaseData();
            }
        </script>
    </body>
</html>