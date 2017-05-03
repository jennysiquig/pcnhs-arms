<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php $stud_id = $_GET['stud_id']; ?>
<?php
if(isset($_GET['stud_id'])) {
  $stud_id = $_GET['stud_id'];
}else {

  header("location: student_list.php");
  die();
}


$first_name;
$last_name;
$curriculum;
$statement = "SELECT * FROM pcnhsdb.students left join curriculum on students.curr_id = curriculum.curr_id where students.stud_id = '$stud_id' limit 1";
$result = DB::query($statement);
if (count($result) > 0) {
  foreach ($result as $row) {
$curriculum = $row['curr_name'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
}
} else {
header("location: student_list.php");
die();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Student Other Subjects</title>
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
            <?php
                if(isset($_SESSION['error_pop'])) {
                    echo $_SESSION['error_pop'];
                    unset($_SESSION['error_pop']);
                }
            ?>
            <div class="row">
                <div class="col-md-9">
                    <a class="btn btn-default" href=<?php echo "../studentmanagement/student_info.php?stud_id=$stud_id"; ?>><i class="fa fa-arrow-circle-left"></i> Back</a>
                </div>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Other Subject Grades</h2>
                    <div class="clearfix"></div>
                    <h5><b>Student ID: </b><?php echo "$stud_id"; ?></h5>
          					<h5><b>Student Name: </b><?php echo "$last_name".', '."$first_name"; ?></h5>
          					<h5><b>Curriculum: </b><?php echo "$curriculum"; ?></h5>
                </div>
                <div class="x_content">
                    <!-- First -->
                    <?php
                        $stud_id = $_GET['stud_id'];
                        $schl_name = "";
                        $yr_level = "";
                        $subj_name = "";
                        $subj_level = "";
                        $subj_id = "";
                        $subj_order = "";
                        if(isset($_GET['schl_name'])) {
                            $schl_name = htmlspecialchars($_GET['schl_name']);
                        }
                        if(isset($_GET['yr_level'])) {
                            $yr_level = htmlspecialchars($_GET['yr_level']);
                        }
                        if(isset($_GET['subj_name'])) {
                            $subj_name = htmlspecialchars($_GET['subj_name']);
                        }
                        if(isset($_GET['subj_level'])) {
                            $subj_level = htmlspecialchars($_GET['subj_level']);
                        }
                        if(isset($_GET['subj_id'])) {
                            $subj_id = htmlspecialchars($_GET['subj_id']);
                        }
                        if(isset($_GET['subj_order'])) {
                            $subj_order = htmlspecialchars($_GET['subj_order']);
                        }

                    ?>
                    <form id=<?php $stud_id = $_GET['stud_id']; echo "$stud_id"; ?> class="form-horizontal form-label-left other_subj" name="val-gr" action=<?php $stud_id = $_GET['stud_id']; echo "phpinsert/othersubjectgrades_insert.php?stud_id=$stud_id&subj_id=$subj_id&subj_order=$subj_order"; ?> data-parsley-validate method="POST">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">School Name <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" minlength="3" required=" " type="text" name="schl_name" value=<?php echo "'$schl_name'"; ?>>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">School Year <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" data-inputmask="'mask': '9999 - 9999'" required=" " type="text" name="schl_year">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Level <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="number" maxlength="2" min="1" max="10" name="yr_level" required=" " value=<?php echo "'$yr_level'"; ?>>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" minlength="3" name="subj_name" required=" " value=<?php echo "'$subj_name'"; ?>>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Level <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="number" maxlength="2" min="1" max="10" name="subj_level" required=" " value=<?php echo "'$subj_level'"; ?>>
                            </div>
                        </div>
                         <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Type <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="subj_type" required="">
                                    <option value="">-- No Selected --</option>
                                    <option value="summer">Summer</option>
                                    <option value="transferee">Transferee</option>
                                    <option value="regular">Regular</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Final Grade</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="fin_grade" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Special Grade</label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="special_grade" placeholder="For subjects with special grades only.">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Credit Earned <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="credit_earned">
                            </div>
                        </div>
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <!-- <div class="col-md-6"></div> -->
                                <div class="col-md-6 pull-right">
                                    <button type="reset" class="btn btn-default" onclick="releaseData();">Clear Fields</button>
                                    <button id="send" type="submit" class="btn btn-success"><i class="fa fa-save m-right-xs"></i> Save</button>
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
            <!-- NProgress -->
            <script src="../../resources/libraries/nprogress/nprogress.js"></script>
            <!-- Local Storage -->
            <script src= "../../resources/libraries/sisyphus/sisyphus.js"></script>
            <!-- Custom Theme Scripts -->
            <script src= "../../assets/js/custom.min.js"></script>
            <!-- Scripts -->
            <!-- Parsley -->
            <script>
                $(document).ready(function() {
                $.listen('parsley:field:validate', function() {
                validateFront();
                });
                $('.other_subj #send').on('click', function() {
                $('.other_subj').parsley().validate();
                validateFront();
                });
                var validateFront = function() {
                if (true === $('.other_subj').parsley().isValid()) {
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
            <script type="text/javascript">
            var val_gr = document.getElementsByName("val-gr");
            var stud_unique_id = val_gr[0].id;


            $( function() {
                        $('#' + stud_unique_id).sisyphus({
                            autoRelease: false,
                        });
                    });
        </script>
        <script type="text/javascript">
            var val_gr = document.getElementsByName("val-gr");
            var stud_unique_id = val_gr[0].id;


            function releaseData() {
                $('#' + stud_unique_id).sisyphus().manuallyReleaseData();
            }
        </script>
        <script type="text/javascript">
            function isNumberKey(evt, n){
            console.log(n);
              var charCode = (evt.which) ? evt.which : evt.keyCode;
              if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
                 return false;

              return true;
            }
        </script>
        </body>
    </html>
