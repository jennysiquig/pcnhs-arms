<!DOCTYPE html>
<?php ob_start() ?>
<?php require_once "../../resources/config.php"; ?>
<?php require_once "bcrypt/Bcrypt.php"; ?>
<?php include ('include_files/session_check.php'); ?>

<html>
    <head>
        <title>View Personnel Account</title>
        <link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
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
        <link href="../../assets/css/custom.min.css" rel="stylesheet">
        <link href="../../assets/css/tstheme/style.css" rel="stylesheet">
    </head>

        <body class="nav-md">
            <?php include "../../resources/templates/admin/sidebar.php"; ?>
            <?php include "../../resources/templates/admin/top-nav.php"; ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="col-md-5">
                    <ol class="breadcrumb">
                      <li><a href="../index.php">Home</a></li>
                      <li class="disabled">Personnel Accounts</li>
                      <li class="active">View Personnel Account</li>
                    </ol>
                </div>

            <div class="row top_tiles">
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <?php
                                    if (isset($_SESSION['success_edit'])) {
                                        $success_msg = $_SESSION['success_edit'];
                                        echo $success_msg;
                                        session_unset();
                                    }
                                ?>
                                <h2><i class="fa fa-user"> </i> View Personnel Account</h2>
                                    <div class="clearfix"></div><br />
                                <?php
                                    if (isset($_SESSION['success_personnel'])) {
                                        echo $_SESSION['success_personnel'];
                                        unset($_SESSION['success_personnel']);
                                    }
                                    if (isset($_SESSION['success_personnel_edit'])) {
                                        echo $_SESSION['success_personnel_edit'];
                                        unset($_SESSION['success_personnel_edit']);
                                    }
                                    if (isset($_SESSION['incorrect_pw_del'])) {
                                        echo $_SESSION['incorrect_pw_del'];
                                        unset($_SESSION['incorrect_pw_del']);
                                    }
                                ?>

                    <div class="x_content">
                        <form class="form-horizontal form-label-left" action="phpupdate/personnel_update_info.php" method="POST" novalidate>
                            <?php require_once "../../resources/config.php";

                                $per_id = $_GET['per_id'];
                                $uname;
                                $password;
                                $last_name;
                                $first_name;
                                $mname;
                                $position;
                                $access_type;
                                $accnt_status;
                                $statement = "SELECT * FROM pcnhsdb.personnel WHERE personnel.per_id = '$per_id'";
                                $result = DB::query($statement);

                                if (count($result) > 0) {
                                  foreach ($result as $row) {
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
                                else {
                                    header("location: personnel_list.php");
                                    die();
                                }
                            ?>

                            <div class="item form-group"><br />
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Personnel ID</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="per_id" class="form-control col-md-7 col-xs-12" required="required" type="text" name="per_id" readonly value=<?php echo "'$per_id'"; ?>>
                                    <?php $_SESSION['per_id'] = $per_id ?>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">User Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="uname" class="form-control col-md-7 col-xs-12" required="required" type="text" name="uname" readonly value=<?php echo "'$uname'"; ?>>
                                    <?php
                                        if (isset($_SESSION['error_msg_personnel_edit'])) {
                                            $error_msg_personnel_edit = $_SESSION['error_msg_personnel_edit'];
                                            echo "<p style='color: red'>$error_msg_personnel_edit</p>";
                                            unset($_SESSION['error_msg_personnel_edit']);
                                        }
                                    ?>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" class="form-control col-md-7 col-xs-12" required="required" type="password" name="password" readonly value=<?php echo "'$password'"; ?>>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="last_name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name" readonly value=<?php echo "'$last_name'"; ?>>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="first_name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name" readonly value=<?php echo "'$first_name'"; ?>>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="mname" class="form-control col-md-7 col-xs-12" required="required" type="text" name="mname" readonly value=<?php echo "'$mname'"; ?>>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="position" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position" readonly value=<?php echo "'$position'"; ?>>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Access Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="access_type" class="form-control col-md-7 col-xs-12" required="required" type="text" name="access_type" readonly value=<?php echo "'$access_type'"; ?>>
                                </div>

                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="accnt_status" class="form-control col-md-7 col-xs-12" required="required" type="text" name="accnt_status" readonly value=<?php echo "'$accnt_status'"; ?>>
                                </div>

                            </div>

                            <div class="form-group">
                                <br />
                                <div class="col-md-5 col-md-offset-3 pull-left">
                                    <a href = <?php echo "personnel_edit.php?per_id=$per_id" ?> button type="submit" class="btn btn-primary " >Edit Profile</a>
                                    <a href = "" button type="submit" class="btn btn-danger" data-toggle="modal" data-target=".bs-example-modal-sm" >Remove</a> &nbsp&nbsp&nbsp&nbsp
                                    <a href = "personnel_list.php" button type="submit" class="btn btn-primary " >View Personnel Accounts</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-warning"></i> Remove Personnel</h4>
                    </div>
                    <div class="modal-body">

                            <form id="change-pw" action="phpdelete/delete.php" method="POST" data-parsley-validate>
                               <?php
                                    $per_id;
                                    $uname;
                                    $password;
                                    $last_name;
                                    $first_name;
                                    $mname;
                                    $position;
                                    $access_type;
                                    $accnt_status;
                                    $statement = "SELECT * FROM pcnhsdb.personnel WHERE personnel.per_id = '$per_id'";
                                    $result = DB::query($statement);

                                    if (count($result) > 0) {
                                      foreach ($result as $row) {
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
                                ?>

                                <label for="cnpw">Enter Personnel Account Password :</label>
                                <input type="password" id="password" class="form-control" name="password" data-parsley-trigger="change" required
                                    data-parsley-minlength="4"
                                    data-parsley-minlength-message="Password should be greater than 4 characters"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error">

                                <input id = "per_id" name = "per_id" type = "hidden" value=<?php echo "'$per_id'"; ?> />
                                <input id = "uname" name = "uname" type = "hidden" value=<?php echo "'$uname'"; ?> />
                                <input id = "last_name" name = "last_name" type = "hidden" value=<?php echo "'$last_name'"; ?> />
                                <input id = "first_name" name = "first_name" type = "hidden" value=<?php echo "'$first_name'"; ?> />
                                <input id = "mname" name = "mname" type = "hidden" value=<?php echo "'$mname'"; ?> />
                                <input id = "position" name = "position" type = "hidden" value=<?php echo "'$position'"; ?> />
                                <input id = "access_type" name = "access_type" type = "hidden" value=<?php echo "'$access_type'"; ?> />
                                <input id = "accnt_status" name = "accnt_status" type = "hidden" value=<?php echo "'$accnt_status'"; ?> />

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger" >Remove</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    <!-- /modals -->
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
    <script src= "../../assets/js/custom.min.js"></script>
    <!-- Scripts -->
    <!-- Parsley -->
</body>
</html>
