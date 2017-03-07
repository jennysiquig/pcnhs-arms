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
                    <h2><i class="fa fa-user"> </i> View Signatory</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal form-label-left" action="phpupdate/update_signatory_info.php" method="POST" novalidate>

                        <?php require_once "../../resources/config.php";

                        $sign_id = $_GET['sign_id'];

                        $first_name;
                        $mname;
                        $last_name;
                        $title;
                        $yr_started;
                        $yr_ended;
                        $position;

                        $statement = "SELECT * FROM pcnhsdb.signatories WHERE signatories.sign_id = '$sign_id'";
                        $result = $conn->query($statement);
                        if($result->num_rows>0) {
                            while($row=$result->fetch_assoc()){

                                //$sign_id = row['sign_id'];
                                $first_name = $row['first_name'];
                                $mname = $row['mname'];
                                $last_name = $row['last_name'];
                                $title = $row['title'];
                                $yr_started = $row['yr_started'];
                                $yr_ended = $row['yr_ended'];
                                $position = $row['position'];
                            }
                        }
                        $conn->close();
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
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name" readonly value=<?php echo "'$first_name'"; ?>>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="mname" readonly value=<?php echo "'$mname'"; ?>>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name" readonly value=<?php echo "'$last_name'"; ?>>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Academic Degree</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="title" readonly value=<?php echo "'$title'"; ?>>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Started</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="yr_started" readonly value=<?php echo "'$yr_started'"; ?>>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year Ended</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="yr_ended" readonly value=<?php echo "'$yr_ended'"; ?>>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position" readonly value=<?php echo "'$position'"; ?>>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-3 pull-left">
                                <br>
                                <a href = <?php echo "signatory_edit.php?sign_id=$sign_id"?> button type="submit" class="btn btn-primary " >Edit Signatory</a>
                                <a href = "" button type="submit" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm" >Remove</a> &nbsp&nbsp&nbsp&nbsp
                                <a href = "signatories.php" button type="submit" class="btn btn-primary " >View Signatories</a>
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
<!-- Modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Remove Signatory <?php echo $first_name?> ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a href= <?php echo "phpdelete/delete.php?sign_id=$sign_id"?> class="btn btn-danger">Remove</a>
            </div>

        </div>
    </div>
</div>
<!-- /Modal -->
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

</body>
</html>