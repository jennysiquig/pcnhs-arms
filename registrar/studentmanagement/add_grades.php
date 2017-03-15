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
                    <form id="val-gr" class="form-horizontal form-label-left" action=<?php $stud_id = $_GET['stud_id']; echo "grades_form.php?stud_id=$stud_id" ?> method="POST" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Student Program</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                
                                    <?php
                                    if(!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $stud_id = $_GET['stud_id'];
                                    $statement = "SELECT prog_id, prog_name FROM pcnhsdb.students left join programs using (prog_id) where stud_id = '$stud_id'";
                                    $result = $conn->query($statement);
                                    if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                    $prog_name = $row['prog_name'];
                                    $prog_id = $row['prog_id'];
                                    echo <<<SP
                                        <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="program" readonly value='$prog_name'>
                                        
SP;
                                    }
                                    }
                                    ?>
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Program ID</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                
                                    <?php
                                    if(!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $stud_id = $_GET['stud_id'];
                                    $statement = "SELECT prog_id, prog_name FROM pcnhsdb.students left join programs using (prog_id) where stud_id = '$stud_id'";
                                    $result = $conn->query($statement);
                                    if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                    $prog_name = $row['prog_name'];
                                    $prog_id = $row['prog_id'];
                                    echo <<<SP
                                        <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="prog_id" readonly value='$prog_id'>
                                        
SP;
                                    }
                                    }
                                    ?>
                                
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Student Curriculum</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="curriculum">
                                    <?php
                                    if(!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $stud_id = $_GET['stud_id'];
                                    $statement = "SELECT curr_id, curr_name FROM pcnhsdb.students left join curriculum using (curr_id) where stud_id = '$stud_id'";
                                    $result = $conn->query($statement);
                                    if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                    $curr_name = $row['curr_name'];
                                    $curr_id = $row['curr_id'];
                                    echo "<option value='$curr_id' selected>$curr_name</option>";
                                    }
                                    }
                                    ?>
                                </select>
                                <p style="color: red">Curriculum that is indicated on Form-137.</p>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Curriculum</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="curriculum_subj">
                                    <option value="none">-- No Selected --</option>>
                                    <?php
                                    if(!$conn) {
                                    die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $stud_id = $_GET['stud_id'];
                                    $statement = "SELECT * FROM pcnhsdb.curriculum";
                                    $result = $conn->query($statement);
                                    if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                    $curr_name = $row['curr_name'];
                                    $curr_id = $row['curr_id'];
                                    echo "<option value='$curr_id'>$curr_name</option>";
                                    }
                                    }
                                    ?>
                                </select>
                                <p style="color: red">Select to override the <b>Student Curriculum</b></p>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">School Name</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <?php
                                if(!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                                }
                                $stud_id = $_GET['stud_id'];
                                $statement = "SELECT * from students where stud_id = '$stud_id'";
                                $result = $conn->query($statement);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                $second_school_name = $row['second_school_name'];
                                echo <<<OPTION2
                                    <input class="form-control col-md-7 col-xs-12" required="required" type="text" name="schl_name" value="$second_school_name" placeholder="School Name">
OPTION2;
                                    }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="schl_year" placeholder="YYYY - YYYY" data-inputmask="'mask': '9999 - 9999'" required="" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Year or Grade</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="yr_level" required="">
                                        <option value="" selected="" disabled="">-- No Selected --</option>
                                        <option value="1">Year 1 or Grade 7</option>
                                        <option value="2">Year 2 or Grade 8</option>
                                        <option value="3">Year 3 or Grade 9</option>
                                        <option value="4">Year 4 or Grade 10</option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <!-- <div class="col-md-6"></div> -->
                                <div class="col-md-2 pull-right">
                                    <button id="send" type="submit" class="btn btn-default"><i class="fa fa-paper-plane-o m-right-xs"></i> Submit</button>
                                </div>
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
                $('#val-gr .btn').on('click', function() {
                $('#val-gr').parsley().validate();
                validateFront();
                });
                var validateFront = function() {
                if (true === $('#val-gr').parsley().isValid()) {
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
                <!-- jquery.inputmask -->
            <script>
                $(document).ready(function() {
                    $(":input").inputmask();
                });
            </script>
                <!-- /jquery.inputmask -->

        </body>
    </html>