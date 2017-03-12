<?php require_once "../../resources/config.php"; ?>
<?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }

  ?>
<!DOCTYPE html>
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
                    <form id="val-gr-form" class="form-horizontal form-label-left" action="phpinsert/grades_insert.php" method="POST" novalidate>
                        <?php
                            $schl_name = $_POST['schl_name'];
                            echo "<h4>School Name: <input value='$schl_name' name='schl_name' readonly></h4>";
                        ?>
                        <?php
                            $stud_id = $_GET['stud_id'];
                            echo "<h4>Student ID: <input value='$stud_id' name='stud_id' readonly></h4>";
                        ?>
                        <?php
                            $sy = $_POST['schl_year'];
                            echo "<h4>School Year: <input value='$sy' name='schl_year' readonly></h4>";
                        ?>
                        <?php
                            $sp = $_POST['program'];
                            echo "<h4>Program: <input value='$sp' name='program' readonly></h4>";
                        ?>
                        <?php
                            if(!$conn) {
                                die();
                            }
                            $curr_id = $_POST['curriculum'];
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
                            $year = $_POST['yr_level'];
                            $grade = ((int) $year)+6;
                            echo "<h4>Year Level: <input value='$year' name='yr_level' style='width: 20px;' readonly> | Grade: <input value='$grade' style='width: 20px;' readonly></h4>";
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Subject ID</th>
                                    <th>Subject</th>
                                    <th>Subject Level</th>
                                    <th>Final Grade</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody id="subj_list">
                                <?php
                                $curriculum;
                                if($_POST['curriculum_subj'] == "none") {
                                    $curriculum = $_POST['curriculum'];
                                }else {
                                    $curriculum = $_POST['curriculum_subj'];
                                }
                                
                                $yr_level_needed = $_POST['yr_level'];
                                $prog_id = $_POST['prog_id'];
                                $statement = "select * from subjects natural join subjectcurriculum natural join curriculum natural join programs natural join subjectprogram where subjectcurriculum.curr_id = $curriculum and yr_level_needed = $yr_level_needed and prog_id = $prog_id";
                                $result = $conn->query($statement);
                                if($result->num_rows>0) {
                                while ($row = $result->fetch_assoc()) {
                                //$subj_id = $row['subj_id'];
                                $subj_id = $row['subj_id'];
                                $subj_name = $row['subj_name'];
                                $subj_level = $row['subj_level'];
                                //$curr_name = $row['curr_name'];
                                echo <<<SUBJ
                                
                                <tr>
                                    <td><input value="$subj_id" name="subj_id[]" style="width: 50px;" readonly></td>
                                    <td>$subj_name</td>
                                    <td>$subj_level</td>
                                    <td><input style="width: 60px;" name="fin_grade[]" required></td>
                                    <td><select name="comment[]" class="form-control">
                                            <option value="PASSED">PASSED</option>
                                            <option value="FAILED">FAILED</option>
                                        </select>
                                    </td>
                                </tr>
                                
SUBJ;
                                    }
                                }
                                
                                ?>
                                
                            </tbody>
                        </table>

                        <div class="clearfix"></div>
                        <div class="col-md-2 col-xs-12">
                            <label for="average">Average Grade: </label>
                            <input id="average" class="form-control" type="text" style="width: 70px;" name="average_grade" required="">
                        </div>
                        <div class="col-md-2 col-xs-12">
                            <label for="average">Total Units: </label>
                            <input id="average" class="form-control" type="text" style="width: 70px;" name="total_unit" required="">
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
        <script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
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
    </body>
</html>