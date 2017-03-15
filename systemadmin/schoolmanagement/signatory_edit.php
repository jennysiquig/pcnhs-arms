<!DOCTYPE html>
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
<?php require_once "../../resources/config.php" ?>
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
    <div class="">
        <div class="row top_tiles">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-user"> </i> Edit Signatory</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="signatory-edit" class="form-horizontal form-label-left" action="phpupdate/update_signatory_info.php" method="POST" novalidate>

                        <?php
                        $sign_id = $_GET['sign_id'];
                        //$sign_id;
                        $last_name;
                        $first_name;
                        $mname;
                        $title;
                        $yr_started;
                        $yr_ended;
                        $position;

                        $statement = "SELECT * FROM pcnhsdb.signatories WHERE signatories.sign_id='$sign_id'";
                        $result = $conn->query($statement);
                        if($result->num_rows>0) {
                            while($row=$result->fetch_assoc()) {
                                //$sign_id = $row['sign_id'];
                                $first_name = $row['first_name'];
                                $mname = $row['mname'];
                                $last_name = $row['last_name'];
                                $title = $row['title'];
                                $yr_started = $row['yr_started'];
                                $yr_ended = $row['yr_ended'];
                                $position = $row['position'];
                            }
                        }
                        ?>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Signatory ID</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="sign_id" readonly value=<?php echo "'$sign_id'"; ?>>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name" value=<?php echo "'$first_name'"; ?>
                                    data-parsley-pattern="^[a-zA-Z\s\+\-\ñ]+$"
                                    data-parsley-pattern-message="Invalid First Name"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="mname" value=<?php echo "'$mname'"; ?>
                                    data-parsley-pattern="^[a-zA-Z\s\+\-\ñ]+$"
                                    data-parsley-pattern-message="Invalid Middle Name"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name" value=<?php echo "'$last_name'"; ?>
                                    data-parsley-pattern="^[a-zA-Z\s\+\-\ñ]+$"
                                    data-parsley-pattern-message="Invalid Last Name"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Academic Degree</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" type="text" name="title" value=<?php echo "'$title'"; ?>
                                    data-parsley-pattern="^[a-zA-Z\s\+\-\.]+$"
                                    data-parsley-pattern-message="Invalid Format"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Started</label>
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <select id = "yrStarted"class="form-control col-md-7 col-xs-12" name="yr_started"  required = "required" value=<?php echo "'$yr_started'";?>>
                                    <option value="<?php echo $yr_started?>"> <?php echo $yr_started?></option>
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
                                <select id = "yrEnded" class="form-control col-md-7 col-xs-12" name="yr_ended"  required = "required" value=<?php echo "'$yr_ended'";?>
                                    data-parsley-ge = "#yrStarted"
                                    data-parsley-ge-message = "Year Ended should be greater than or equal to Year Started">
                                    <option value="<?php echo $yr_ended?>"> <?php echo $yr_ended?></option>
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
                                <select id="pselect" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position" value=<?php echo "'$position'"; ?>>
                                    <option value="<?php echo $position?>"> <?php echo $position?></option>
                                    <?php
                                    $position= $row['position'];
                                    echo <<<OPTION0
                                            <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                                            <option value="HEAD TEACHER">HEAD TEACHER</option>
                                            <option value="PRINCIPAL">PRINCIPAL</option>
                                            <option value="REGISTRAR">REGISTRAR</option>
                                            <option value="SUPERINTENDENT">SUPERINTENDENT</option>
OPTION0;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-3 pull-left">
                                <br>
                                <div class=" pull-left">
                                    <button class="btn btn-danger" onclick="history.go(-1);return true;">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
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
<script>
    $(document).ready(function() {
        $(":input").inputmask();
    });
</script>
<!-- /jquery.inputmask -->
<!-- Parsley -->
<script>
    $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
            validateFront();
        });
        $('#signatory-edit .btn').on('click', function() {
            $('#signatory-edit').parsley().validate();
            validateFront();
        });
        var validateFront = function() {
            if (true === $('#signatory-edit').parsley().isValid()) {
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