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
<?php include "../../resources/templates/admin/sidebar.php"; ?>
<!-- Top Navigation -->
<?php include "../../resources/templates/admin/top-nav.php"; ?>
<!-- Contents Here -->
<div class="right_col" role="main">
    <div class="x_panel">
        <div class="x_title">
            <h2>View Personnel Account</h2>
            <div class="clearfix"></div>
            <br/>
            <form class="form-horizontal form-label-left" action="phpupdate/personnel_update_info.php" method="POST" novalidate>

                <?php require_once "../../resources/config.php";

                $per_id = $_GET['per_id'];
                //$per_id;
                $uname;
                $password;
                $last_name;
                $first_name;
                $mname;
                $position;
                $access_type;
                $accnt_status;

                $statement = "SELECT * FROM pcnhsdb.personnel WHERE personnel.per_id = '$per_id'";
                $result = $conn->query($statement);
                if($result->num_rows>0) {
                    while($row=$result->fetch_assoc()){

                        //$per_id = row['per_id'];
                        $uname = $row['uname'];
                        $password = $row['password'];
                        $last_name = $row['last_name'];
                        $first_name = $row['first_name'];
                        $mname = $row['mname'];
                        $position = $row['position'];
                        $access_type = $row['access_type'];
                        $accnt_status = $row['accnt_status'];
                    }
                }
                $conn->close();
                ?>

        </div>


        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Personnel ID</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="per_id" readonly value=<?php echo "'$per_id'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">User Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="uname" readonly value=<?php echo "'$uname'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="password" name="password" readonly value=<?php echo "'$password'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name" readonly value=<?php echo "'$last_name'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name" readonly value=<?php echo "'$first_name'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="mname" readonly value=<?php echo "'$mname'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position" readonly value=<?php echo "'$position'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Access Type</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="access_type" readonly value=<?php echo "'$access_type'"; ?>>
                </div>

            </div>
        </div>

        <div class="x_content">
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="accnt_status" readonly value=<?php echo "'$accnt_status'"; ?>>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="col-md-6">
                <a href = <?php echo "personnel_edit.php?per_id=$per_id" ?> button type="submit" class="btn btn-primary " >Edit Profile</a>
                <a href = "" button type="submit" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm" >Remove</a> &nbsp&nbsp&nbsp&nbsp
                <a href = "../index.php" button type="submit" class="btn btn-primary " >View Personnels</a>
            </div>
        </div>

        </form>
    </div>
</div>
<!-- Modal -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel2">Remove Personnel Account?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a href= <?php echo "phpupdate/delete.php?per_id=$per_id"?> class="btn btn-danger">Remove</a>
            </div>

        </div>
    </div>
</div>
<!-- /Modal -->
<!-- Contents Here -->
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