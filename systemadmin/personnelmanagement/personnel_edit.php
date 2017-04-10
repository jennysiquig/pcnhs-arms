<!DOCTYPE html>
<?php ob_start()?>
<?php require_once "../../resources/config.php"; ?>
<?php require_once "bcrypt/Bcrypt.php";?>
<?php include('include_files/session_check.php'); ?>

<html>
    <head>
        <title>Edit Personnel Account</title>
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
            <?php include "../../resources/templates/admin/sidebar.php"; ?>
            <?php include "../../resources/templates/admin/top-nav.php"; ?>
            <!-- page content -->
            <div class="right_col" role="main">
              
              <div class="col-md-5">
                <ol class="breadcrumb">
                  <li><a href="../index.php">Home</a></li>
                  <li class="disabled">Personnel Accounts</li>
                  <li class="active">Edit Personnel Account</li>
                </ol>
              </div>
                
                <div class="row top_tiles"></div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                            <h2><i class="fa fa-user"> </i> Edit Personnel Account</h2>
                            <div class="clearfix"></div>
                            <br>
                                  <?php
                                        if(isset($_SESSION['duplicate_uname'])) {
                                            echo $_SESSION['duplicate_uname'];
                                            unset($_SESSION['duplicate_uname']);
                                            }
                                        if(isset($_SESSION['incorrect_pw'])) {
                                            echo $_SESSION['incorrect_pw'];
                                            unset($_SESSION['incorrect_pw']);
                                            }
                                        if(isset($_SESSION['incorrect_pw_change'])) {
                                            echo $_SESSION['incorrect_pw_change'];
                                            unset($_SESSION['incorrect_pw_change']);
                                            }
                                  ?>

                                <div class="x_content">
                                    <form id="personnel-edit" class="form-horizontal form-label-left" action="phpupdate/personnel_update_info.php" method="POST" data-parsley-trigger="keyup">
                                        <?php
                                          $per_id = $_GET['per_id'];
                                          $uname;
                                          $password;
                                          $hashed_pw;
                                          $last_name;
                                          $first_name;
                                          $mname;
                                          $position;
                                          $access_type;
                                          $accnt_status;

                                        $statement = "SELECT * FROM pcnhsdb.personnel WHERE personnel.per_id = '$per_id'";
                                        $result = $conn->query($statement);

                                        if (!$result) {
                                          header("location: personnels.php");
                                          die();
                                        }

                                        if($result->num_rows>0) {
                                            while($row=$result->fetch_assoc()){
                                                $uname = $row['uname'];
                                                $hashed_pw = $row['hashed_pw'];
                                                $password = $row['password'];
                                                $last_name = $row['last_name'];
                                                $first_name = $row['first_name'];
                                                $mname = $row['mname'];
                                                $position = $row['position'];
                                                $access_type = $row['access_type'];
                                                $accnt_status = $row['accnt_status'];
                                            }
                                        }else{
                                          header("location: personnels.php");
                                          die();
                                        }
                                        ?>

                                        <div class="item form-group"><br>
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Personnel ID</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="per_id" class="form-control col-md-7 col-xs-12"type="text" name="per_id" readonly value=<?php echo "'$per_id'"; ?>/>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">User Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="uname" class="form-control col-md-7 col-xs-12" required="required" type="text" name="uname" value=<?php echo "'$uname'"; ?>
                                                 data-parsley-minlength="4"
                                                 data-parsley-minlength-message="User Name should be greater than 4 characters"
                                                 data-parsley-maxlength="50"
                                                 data-parsley-maxlength-message="Error"/>
                                                    <?php
                                                        $_SESSION['unameChck'] = $uname;
                                                        if(isset($_SESSION['error_msg_username_exists'])) {
                                                            $error_msg_username_exists = $_SESSION['error_msg_username_exists'];
                                                            echo "<p style='color: red'>$error_msg_username_exists</p>";
                                                            unset($_SESSION['error_msg_username_exists']);
                                                     } 
                                                    ?>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="hashed_pw" class="form-control col-md-7 col-xs-12" required="required" type="password" name="hashed_pw" readonly value=<?php echo "'$hashed_pw'"; ?>
                                                 data-parsley-minlength="4"
                                                 data-parsley-minlength-message="Password should be greater than 4 characters"/><br><br>

                                                <a href="" span class="label label-warning" data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-warning btn-xs">Edit Password</a></span>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                 <input id="last_name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="last_name" value=<?php echo "'$last_name'"; ?>
                                                  data-parsley-pattern="^[a-zA-Z\,\-\.\s\ñ]+$"
                                                  data-parsley-pattern-message="Invalid Last Name"
                                                  data-parsley-maxlength="50"
                                                  data-parsley-maxlength-message="Error"/>
                                             </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="first_name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="first_name" value=<?php echo "'$first_name'"; ?>
                                                 data-parsley-pattern="^[a-zA-Z\,\-\.\s\ñ]+$"
                                                 data-parsley-pattern-message="Invalid First Name"
                                                 data-parsley-maxlength="50"
                                                 data-parsley-maxlength-message="Error"/>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="mname" class="form-control col-md-7 col-xs-12"  type="text" name="mname" value=<?php echo "'$mname'"; ?>
                                                 data-parsley-pattern="^[a-zA-Z\,\-\.\s\ñ]+$"
                                                 data-parsley-pattern-message="Invalid Middle Name"
                                                 data-parsley-maxlength="50"
                                                 data-parsley-maxlength-message="Error"/>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                             <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                             <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="position" class="form-control col-md-7 col-xs-12" required="required" type="text" name="position" value=<?php echo "'$position'";?>
                                                data-parsley-pattern="^[a-zA-Z\,\-\.\s\0-9]+$"
                                                data-parsley-pattern-message="Invalid Format"
                                                data-parsley-maxlength="50"
                                                data-parsley-maxlength-message="Error">
                                             </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Access Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select id="curr-select" class="form-control col-md-7 col-xs-12" required="required" name="access_type" value = <?php echo "'access_type'"; ?>>
                                                     <option value="<?php echo $access_type?>"> <?php echo $access_type?></option>
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
                                                 <select id="curr-select" class="form-control col-md-7 col-xs-12" required="required" name="accnt_status" value=<?php echo "'accnt_status'"; ?>>
                                                     <option value="<?php echo $accnt_status?>"> <?php echo $accnt_status?></option>
                                                        <?php
                                                        if(!$conn) {
                                                            die("Connection failed: " . mysqli_connect_error());
                                                        }
                                                        $access_type= $row['accnt_status'];
                                                        echo <<<OPTION2
                                                                <option value="ACTIVE">ACTIVATE</option>
                                                                <option value="DEACTIVATED">DEACTIVATE</option>
OPTION2;
                                                        ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input id="password" class="form-control col-md-7 col-xs-12" required="required"  type="password" name="password" 
                                                 data-parsley-minlength="4"
                                                 data-parsley-minlength-message="Password should be greater than 4 characters"/>
                                            </div>
                                        </div>

                                        <div class="form-group"><br>
                                            <div class="col-md-5 col-md-offset-3 pull-left">
                                                <button class="btn btn-danger" onclick="history.go(-1);return true;">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>

                                     </form>
                                 </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
<!-- /page content -->

<!-- Small modal -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2"><i class="fa fa-lock"></i> Change Password</h4>
                    </div>
                    <div class="modal-body">
                            <!-- start form for validation -->
                            <form id="change-pw" action="phpupdate/personnel_update_pw.php" method="POST" data-parsley-validate>
                               <?php
                                $per_id;
                                $uname;
                                $password;
                                $hashed_pw;
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
                                        $uname = $row['uname'];
                                        $password = $row['password'];
                                        $hashed_pw = $row['hashed_pw'];
                                        $last_name = $row['last_name'];
                                        $first_name = $row['first_name'];
                                        $mname = $row['mname'];
                                        $position = $row['position'];
                                        $access_type = $row['access_type'];
                                        $accnt_status = $row['accnt_status'];
                                    }
                                }
                                ?>
                                <label for="cpw">Current Password :</label>
                                <input type="password" id="cpw" class="form-control" name="password" required 
                                    data-parsley-minlength="4"
                                    data-parsley-minlength-message="Password should be greater than 4 characters"
                                    data-parsley-maxlength="300"
                                    data-parsley-maxlength-message="Error">

                                <label for="npw">New Password :</label>
                                <input type="password" id="npw" class="form-control" name="npw" data-parsley-trigger="change" required 
                                    data-parsley-minlength="4"
                                    data-parsley-minlength-message="Password should be greater than 4 characters"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error">

                                <label for="cnpw">Confirm New Password :</label>
                                <input type="password" id="cnpw" class="form-control" name="new_password" data-parsley-trigger="change" required 
                                    data-parsley-minlength="4"
                                    data-parsley-minlength-message="Password should be greater than 4 characters"
                                    data-parsley-maxlength="50"
                                    data-parsley-maxlength-message="Error"
                                    data-parsley-equalto = "#npw"
                                    data-parsley-equalto-message = "Password does not match">

                                <input id = "per_id" name = "per_id" type = "hidden" value=<?php echo "'$per_id'"; ?> />
                                <input id = "uname" name = "uname" type = "hidden" value=<?php echo "'$uname'"; ?> />
                                <input id = "last_name" name = "last_name" type = "hidden" value=<?php echo "'$last_name'"; ?> />
                                <input id = "first_name" name = "first_name" type = "hidden" value=<?php echo "'$first_name'"; ?> />
                                <input id = "mname" name = "mname" type = "hidden" value=<?php echo "'$mname'"; ?> />
                                <input id = "position" name = "position" type = "hidden" value=<?php echo "'$position'"; ?> />
                                <input id = "access_type" name = "access_type" type = "hidden" value=<?php echo "'$access_type'"; ?> />
                                <input id = "accnt_status" name = "accnt_status" type = "hidden" value=<?php echo "'$accnt_status'"; ?> />

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" >Save</button>
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
    <!-- Date Range Picker -->
    <script src="../../resources/libraries/moment/min/moment.min.js"></script>
    <script src="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src= "../../js/custom.min.js"></script>
    <!-- Scripts -->
    <!-- jquery.inputmask -->
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
                $('#personnel-edit .btn').on('click', function() {
                    $('#personnel-edit').parsley().validate();
                    validateFront();
                });
                var validateFront = function() {
                    if (true === $('#personnel-edit').parsley().isValid()) {
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
    </body>
</html>