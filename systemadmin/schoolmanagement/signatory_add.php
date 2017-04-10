<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<html>
<head>
    <title>Add Signatory</title>
    <link rel="shortcut icon" href="../../images/pines.png" type="image/x-icon" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../../css/custom.min.css" rel="stylesheet">
    <link href="../../css/tstheme/style.css" rel="stylesheet">

</head> 
<body class="nav-md">
<!-- Sidebar -->
<?php include "../../resources/templates/admin/sidebar.php"; ?>
<!-- Top Navigation -->
<?php include "../../resources/templates/admin/top-nav.php"; ?>
<!-- Content Here -->
<!-- page content -->
<div class="right_col" role="main">
                 <div class="col-md-5">
        <ol class="breadcrumb">
          <li><a href="../index.php">Home</a></li>
          <li class="disabled">Signatories</li>
          <li class="active">Add Signatory</li>
        </ol>
      </div>
    <div class="">
        <div class="row top_tiles">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-user"> </i> Add Signatory</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <?php
                        if(isset($_SESSION['error_pop'])) {
                            echo $_SESSION['error_pop'];
                            unset($_SESSION['error_pop']);
                                    }
                    ?>
                </div>
                <div class="x_content">
                    <form id="signatory-add" class="form-horizontal form-label-left" action="phpinsert/signatory_insert.php" method="POST" data-parsley-trigger="keyup">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Signatory ID</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="sign_id"
                                     data-parsley-pattern="^[a-zA-Z\s\0-9\-]+$"
                                     data-parsley-pattern-message="Signatory ID Invalid"
                                     data-parsley-maxlength="50"
                                     data-parsley-maxlength-message="Error"/>
                                     <?php
                                            if(isset($_SESSION['error_msg_signatory'])) {
                                                $error_msg_signatory = $_SESSION['error_msg_signatory'];
                                                echo "<p style='color: red'>$error_msg_signatory</p>";
                                                unset($_SESSION['error_msg_signatory']);
                                         }
                                     ?>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name"
                                    data-parsley-pattern="^[a-zA-Z\,\-\.\s\ñ]+$"
                                    data-parsley-pattern-message="Invalid First Name"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="mname"
                                    data-parsley-pattern="^[a-zA-Z\,\-\.\s\ñ]+$"
                                    data-parsley-pattern-message="Invalid Middle Name"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name"
                                    data-parsley-pattern="^[a-zA-Z\,\-\.\s\ñ]+$"
                                    data-parsley-pattern-message="Invalid Last Name"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Academic Degree</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="title" placeholder="e.g. Ed.D., CESO IV"
                                    data-parsley-pattern="^[a-zA-Z\,\-\.\s\ñ]+$"
                                    data-parsley-pattern-message="Invalid Format"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Started</label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id = "yrStarted"class="form-control col-md-7 col-xs-12" required="required" name="yr_started">
                                    <option value="">-- Year --</option>
                                    <?php
                                    $present = date("Y");
                                    for ($year=1973; $year <= $present; $year++) {
                                        echo "<option value='$year'>$year</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Ended</label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id = yrEnded class="form-control col-md-7 col-xs-12" required="required" name="yr_ended"
                                    data-parsley-ge = "#yrStarted"
                                    data-parsley-ge-message = "Year Ended should be greater than or equal to Year Started">
                                    <option value="">-- Year --</option>
                                    <?php
                                    $present = date("Y");
                                    for ($year=1973; $year <= $present; $year++) {
                                        echo "<option value='$year'>$year</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="position" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position"
                                    data-parsley-pattern="^[a-zA-Z\,\-\.\s]+$"
                                    data-parsley-pattern-message="Invalid Format"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error">
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-3 pull-left">
                                <br>
                                <button type="submit" class="btn btn-success">Add Signatory</button>
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
        $('#signatory-add .btn').on('click', function() {
            $('#signatory-add').parsley().validate();
            validateFront();
        });
        var validateFront = function() {
            if (true === $('#signatory-add').parsley().isValid()) {
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

<script>
window.ParsleyValidator.addValidator('ge', 
    function (value, requirement) {
        return parseFloat(value) >= parseFloat($(requirement).val());
    }, 32)
</script>
<!-- /Parsley -->
</body>
</html>