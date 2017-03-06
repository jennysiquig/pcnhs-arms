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
                    <h2>Attendance</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- First -->
                    <form id="val-gr" class="form-horizontal form-label-left" action=<?php $stud_id = $_GET['stud_id']; echo "phpinsert/attendance_insert.php?stud_id=$stud_id" ?> method="POST" novalidate>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Level or Grade</label>
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
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">School Year</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="schl_year" placeholder="YYYY - YYYY" data-inputmask="'mask': '9999 - 9999'" required="" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Days of School</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="school_days" data-inputmask="'mask': '999'" required="" >
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Days Attended</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="days_attended" data-inputmask="'mask': '999'" required="" >
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