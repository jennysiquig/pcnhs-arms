<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Student Attendance</title>
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
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Attendance - <small>Year Level: <?php echo $_GET['yr_lvl'] ?></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- First -->
                    <form id="val-gr" class="form-horizontal form-label-left" action=<?php $stud_id = $_GET['stud_id']; echo "phpinsert/attendance_insert.php?stud_id=$stud_id" ?> method="POST" novalidate>
                            <?php
                                        $stud_id = $_GET['stud_id'];
                                        $yr_lvl = $_GET['yr_lvl'];

                                        if($_GET['yr_lvl'] > 1) {

                                            $pschool_year = "";

                                            $yr_lvl = intval($_GET['yr_lvl'])-1;
                                            $statement = "SELECT * from attendance where stud_id = '$stud_id' and yr_lvl = $yr_lvl;";
                                            $result = DB::query($statement);
                                            foreach ($result as $row) {
                                              $pschool_year = $row['schl_yr'];
                                            }

                                            $explode_pschool_year = explode("-", $pschool_year);

                                            $yr1 = intval($explode_pschool_year[0]);
                                            $yr2 = intval($explode_pschool_year[1]);

                                            $yr1plus1 = $yr1+1;
                                            $yr2plus1 = $yr2+1;
                                            $stryr = $yr1plus1.' - '.$yr2plus1;

                                        }else {
                                             $pschool_year = "";

                                            $statement = "SELECT * FROM pcnhsdb.students NATURAL JOIN primaryschool where stud_id = '$stud_id';";
                                            $result = DB::query($statement);
                                            foreach ($result as $row) {
                                              $pschool_year = $row['schl_yr'];
                                            }



                                            $explode_pschool_year = explode("-", $pschool_year);

                                            $yr1 = intval($explode_pschool_year[0]);
                                            $yr2 = intval($explode_pschool_year[1]);

                                            $yr1plus1 = $yr1+1;
                                            $yr2plus1 = $yr2+1;
                                            $stryr = $yr1plus1.' - '.$yr2plus1;
                                            }
                                    ?>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Years in School</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="total_years_in_school" required="" value=<?php $yr_lvl = $_GET['yr_lvl']; echo $yr_lvl+6; ?>>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="schl_year" placeholder="YYYY - YYYY" data-inputmask="'mask': '9999 - 9999'" value=<?php echo "'$stryr'"; ?> required="" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Days of School</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="school_days" required="" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Days Attended</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="days_attended" required="" >
                                </div>
                            </div>
                           <!--  <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Years in School</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="number" class="form-control col-md-7 col-xs-12" name="days_attended" required="" >
                                </div>
                            </div> -->
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <!-- <div class="col-md-6"></div> -->
                                <div class="col-md-2 pull-right">
                                    <button id="send" type="submit" class="btn btn-default">Submit</button>
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
            <!-- Custom Theme Scripts -->
            <script src= "../../assets/js/custom.min.js"></script>
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
