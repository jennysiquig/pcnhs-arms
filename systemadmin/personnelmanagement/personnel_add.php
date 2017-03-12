<?php require_once "../../resources/config.php"; ?>
<!DOCTYPE html>
    <?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }
    // Session Timeout
    $time = time();
    $session_timeout = 1800; //seconds
    
    if(isset($_SESSION['last_activity']) && ($time - $_SESSION['last_activity']) > $session_timeout) {
      session_unset();
      session_destroy();
      session_start();
    }

    $_SESSION['last_activity'] = $time;
  ?>
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
    <script src="../../js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>	<body class="nav-md">
<!-- Sidebar -->
<?php include "../../resources/templates/admin/sidebar.php"; ?>
<!-- Top Navigation -->
<?php include "../../resources/templates/admin/top-nav.php"; ?>
<!-- Content Here -->
<!-- page content -->
<div class="right_col" role="main">
    <div class="row top_tiles">

    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-user"> </i> Add Personnel Account</h2>
                    <div class="clearfix"></div>
                    <br>

                    <div class="x_content">
                        <form id="personnel-add" class="form-horizontal form-label-left" action="phpinsert/personnel_insert.php" method="POST" novalidate>

                            <div class="item form-group"><br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Personnel ID</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="per_id">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">User Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" required="required"  type="text" name="uname"
                                     data-parsley-trigger="keyup"
                                     data-parsley-minlength="4"
                                     data-parsley-minlength-message="User Name should be greater than 4 characters"
                                     data-parsley-validation-threshold="40">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" class="form-control col-md-7 col-xs-12" required="required"  type="password" name="password"
                                     data-parsley-trigger="keyup" 
                                     data-parsley-minlength="4"
                                     data-parsley-minlength-message="Password should be greater than 4 characters"
                                     data-parsley-validation-threshold="40">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name"
                                    data-parsley-pattern="^[a-zA-Z]+$"
                                    data-parsley-pattern-message="Last Name should not contain a special character or number"
                                    data-parsley-validation-threshold="40">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name"
                                    data-parsley-pattern="^[a-zA-Z]+$"
                                    data-parsley-pattern-message="First Name should not contain a special character or number"
                                    data-parsley-validation-threshold="40">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12"  type="text" name="mname"
                                    data-parsley-pattern="^[a-zA-Z]+$"
                                    data-parsley-pattern-message="Middle Name should not contain a special character or number"
                                    data-parsley-validation-threshold="40">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="pselect" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position">
                                        <option value="">--NO SELECTED--</option>
                                        <?php
                                        if(!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }
                                        $position= $row['position'];
                                        echo <<<OPTION0
                                            <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                                            <option value="HEAD TEACHER">HEAD TEACHER</option>
                                            <option value="PRINCIPAL">PRINCIPAL</option>
                                            <option value="SUPERINTENDENT">SUPERINTENDENT</option>
OPTION0;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Access Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="curr-select" class="form-control col-md-7 col-xs-12" name="access_type"  required="required">
                                        <option value="">--NO SELECTED--</option>
                                        <?php
                                        if(!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }
                                        $access_type= $row['access_type'];
                                        echo <<<OPTION1
                                            <option value="REGISTRAR">REGISTRAR</option>
                                            <option value="SYSTEM ADMINISTRATOR">SYSTEM ADMINISTRATOR</option>
OPTION1;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="curr-select" class="form-control col-md-7 col-xs-12" name="accnt_status"  required="required">
                                        <option value="">--NO SELECTED--</option>
                                        <?php
                                        if(!$conn) {
                                            die("Connection failed: " . mysqli_connect_error());
                                        }
                                        $access_type= $row['accnt_status'];
                                        echo <<<OPTION2
                                            <option value="ACTIVE">ACTIVATED</option>
                                            <option value="DEACTIVATED">DEACTIVATED</option>
OPTION2;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <br>
                                <div class="col-md-5 col-md-offset-3 pull-left">
                                    <button type="submit" class="btn btn-success"  >Add Personnel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
    <!-- Content Here -->
    <!-- Footer -->
    <?php include "../../resources/templates/admin/footer.php"; ?>
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
            $('#personnel-add .btn').on('click', function() {
                $('#personnel-add').parsley().validate();
                validateFront();
            });
            var validateFront = function() {
                if (true === $('#personnel-add').parsley().isValid()) {
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