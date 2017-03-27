<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php
    session_start();
     // Session Timeout
    $time = time();
    $session_timeout = 1800; //seconds
    
    if(isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
      session_unset();
      session_destroy();
      session_start();
    }

    $_SESSION['last_activity'] = $time;
    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }

?>
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
        header("location: add_grades.php?stud_id=$stud_id&yr_level=$yr_level_check");
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
            <div class="x_panel">
                <div class="x_title">
                    <h2>Grades</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- First -->
                    <form id="val-gr-form" class="form-horizontal form-label-left" name="val-gr-form" action="phpinsert/grades_insert.php" method="POST" novalidate>
                        <?php
                            $schl_name = $_GET['schl_name'];
                            echo "<h4>School Name: <input value='$schl_name' name='schl_name' readonly></h4>";
                        ?>
                        <?php
                            $stud_id = $_GET['stud_id'];
                            echo "<h4>Student ID: <input value='$stud_id' name='stud_id' readonly></h4>";
                        ?>
                        <?php
                            $sy = $_GET['schl_year'];
                            echo "<h4>School Year: <input value='$sy' name='schl_year' readonly></h4>";
                        ?>
                        <?php
                            $sp = $_GET['program'];
                            echo "<h4>Program: <input value='$sp' name='program' readonly></h4>";
                        ?>
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
                                    echo "<h4>Curriculum: ".$curr_name."</h4>";
                                }
                            }
                        ?>
                        <?php
                            $year = $_GET['yr_level'];
                            $grade = ((int) $year)+6;
                            echo "<h4>Year Level: <input value='$year' name='yr_level' style='width: 20px;' readonly> | Grade: <input value='$grade' style='width: 20px;' readonly></h4>";
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Subject ID</th>
                                    <th>Subject</th>
                                    <th>Subject Level</th>
                                    <th>Unit</th>
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
                                $statement = "SELECT * from subjects NATURAL JOIN subjectcurriculum NATURAL JOIN curriculum NATURAL JOIN programs NATURAL JOIN subjectprogram WHERE subjectcurriculum.curr_id = $curriculum AND yr_level_needed = $yr_level_needed AND prog_id = $prog_id";
                                $result = $conn->query($statement);
                                if($result->num_rows>0) {
                                while ($row = $result->fetch_assoc()) {
                                //$subj_id = $row['subj_id'];
                                $subj_id = $row['subj_id'];
                                $subj_name = $row['subj_name'];
                                $subj_level = $row['subj_level'];
                                $unit = $row['unit'];
                                $total_unit += $unit;
                                $numberOfSubj += 1;
                                //$curr_name = $row['curr_name'];

                                if(strtolower($subj_name) == "makabayan i" || strtolower($subj_name) == "makabayan ii" || strtolower($subj_name) == "makabayan iii" || strtolower($subj_name) == "makabayan iv") {
                                    
                                    $numberOfSubj -= 1;

                                    echo <<<SUBJ
                                
                                <tr>
                                    <td><input value="$subj_id" name="subj_id[]" style="width: 50px;" readonly></td>
                                    <td>$subj_name</td>
                                    <td>$subj_level</td>
                                    <td>$unit</td>
                                    <td><input type="text" style="width: 50px; text-align:center;" name="fin_grade[]" value="0" readonly></td>
                                    
                                </tr>
                                
SUBJ;

                                }else {
                                    echo <<<SUBJ
                                
                                <tr>
                                    <td><input value="$subj_id" name="subj_id[]" style="width: 50px;" readonly></td>
                                    <td>$subj_name</td>
                                    <td>$subj_level</td>
                                    <td>$unit</td>
                                    <td><input type="text" style="width: 50px; text-align:center;" name="fin_grade[]" pattern="\d*" minlength="2" maxlength="2" onblur="saveToDB(this.value)" required></td>
                                    
                                </tr>
                                
SUBJ;
                                }
                                
                                    }
                                }
                                    echo "Number of Subjects: <input type='number' id='num_subj' style='width: 50px; text-align:center;'' value='$numberOfSubj' readonly>";
                                ?>
                                
                            </tbody>
                        </table>

                        <div class="clearfix"></div>
                        <div class="col-md-2 col-xs-12">
                            <label for="average">Average Grade: </label>
                            <input id="average" class="form-control" type="text" style="width: 70px;" value="" name="average_grade">
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <label for="total_unit">Total Units: </label>
                            <input id="total_unit" class="form-control" type="text" style="width: 70px;" value=<?php echo $total_unit; ?> name="total_unit" readonly="">
                        </div>

                        <div class="clearfix"></div>
                        <div class="col-md-2 pull-right">
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
        <script>
        $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
        validateFront();
        });
        $('#val-gr-form .btn').on('click', function() {
        $('#val-gr-form').parsley().validate();
        validateFront();
        });
        var validateFront = function() {
        if (true === $('#val-gr-form').parsley().isValid()) {
        $('.bs-callout-info').removeClass('hidden');
        $('.bs-callout-warning').addClass('hidden');
        } else {
        $('.bs-callout-info').addClass('hidden');
        $('.bs-callout-warning').removeClass('hidden');
        }
        };
        });
        try {
        hljs.initHighlightingOnLoad();
        } catch (err) {}
        </script>
            <!-- /Parsley -->
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
                        total_finalgrade += parseInt(fin_grade[i].value);

                    }
                    computed_average = total_finalgrade/num_subj;
                    average.value = computed_average;
                    console.log(parseInt(total_finalgrade));
                    console.log(parseInt(computed_average));
                }

            }
        </script>
        <!-- Save to DB Script -->
    </body>
</html>