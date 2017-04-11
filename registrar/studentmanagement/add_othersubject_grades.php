<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Student Other Subjects</title>
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
        <!-- Sidebar -->
        <?php include "../../resources/templates/registrar/sidebar.php"; ?>
        <!-- Top Navigation -->
        <?php include "../../resources/templates/registrar/top-nav.php"; ?>
        <div class="right_col" role="main">
            <div class="clearfix"></div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Other Subject Grades</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- First -->
                    <form id="val-gr" class="form-horizontal form-label-left" action=<?php $stud_id = $_GET['stud_id']; echo "phpinsert/othersubjectgrades_insert.php?stud_id=$stud_id" ?> method="POST" novalidate>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">School Name <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required=" " type="text" name="schl_name">
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
                                <input id="name" class="form-control col-md-7 col-xs-12" type="number" maxlength="2" min="1" max="10" name="yr_level" required=" ">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text"  name="subj_name" required=" ">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Level <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="number" maxlength="2" min="1" max="10" name="subj_level" required=" ">
                            </div>
                        </div>
                         <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Subject Type <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" name="subj_type" required="">
                                    <option value="">-- No Selected --</option>
                                    <option value="summer">Summer</option>
                                    <option value="transferee">Transferee</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Final Grade <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" data-inputmask="'mask': '99'" name="fin_grade" required=" ">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Credit Earned <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="credit_earned" required=" ">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks <span style="color:red;">*</span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="comment" required=" ">
                            </div>
                        </div>
                            <div class="clearfix"></div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <!-- <div class="col-md-6"></div> -->
                                <div class="col-md-2 pull-right">
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