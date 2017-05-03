<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php

	if(isset($_SESSION['generated_form137'])) {
            unset($_SESSION['generated_form137']);
            header("location: ../../index.php");
            die();
       }
      if(isset($_SESSION['generated_diploma'])) {
            unset($_SESSION['generated_diploma']);
            header("location: ../../index.php");
            die();
       }
	$stud_id = "";
	$credential = "";
	$request_type = "";
	$request_purpose = "";

	if(isset($_GET['stud_id']) && isset($_GET['credential'])) {
		$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
		$credential = htmlspecialchars($_GET['credential'], ENT_QUOTES);

	}else {
		header("location: ../index.php");
	}

	if(isset($_GET['purpose']) && $_GET['purpose'] != "") {
		$request_purpose = strtoupper(htmlspecialchars($_GET['purpose'], ENT_QUOTES));
	}else {
		if(isset($_GET['others']) && $_GET['others'] != "") {
			$request_purpose = $_GET['others'];
		}else {
			$request_purpose = "";
		}

	}

// Redirect to other page if credential is not form 137 or diploma
	if($credential > 2) {
		$checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' and cred_id = '$credential' order by req_id desc limit 1;";
    	$result = DB::query($checkpending);
		if(count($result) <= 0) {
	    	if(isset($_GET['new_request']) && $_GET['new_request']) {
					$cred_id = htmlspecialchars($_GET['credential'], ENT_QUOTES);
			    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
			    $date = date("Y-m-d");
			    //$request_purpose = htmlspecialchars($_GET['purpose']);

					DB::insert('requests', array(
						'cred_id' => $cred_id,
						'stud_id' => $stud_id,
						'status' => 'p',
						'date_processed' => $date,
						'request_purpose' => $request_purpose,
						'per_id' => $personnel_id
					));
		    	header("location: requests.php");
		    	die();
			}else {
		    	header("location: other_credential.php?stud_id=$stud_id&credential=$credential&purpose=$request_purpose");
				die();
		    }
	    }else {
		    	header("location: other_credential.php?stud_id=$stud_id&credential=$credential&purpose=$request_purpose");
				die();
		    }

	}
	if($credential == 2) {
		$checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' and cred_id = '$credential' order by req_id desc limit 1;";
    	$result = DB::query($checkpending);
		if(count($result) <= 0) {
	    	if(isset($_GET['new_request']) && $_GET['new_request']) {
					$cred_id = htmlspecialchars($_GET['credential'], ENT_QUOTES);
			    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
			    $date = date("Y-m-d");
			    //$request_purpose = htmlspecialchars($_GET['purpose']);
					DB::insert('requests', array(
						'cred_id' => $cred_id,
						'stud_id' => $stud_id,
						'status' => 'p',
						'date_processed' => $date,
						'request_purpose' => $request_purpose,
						'per_id' => $personnel_id
					));

		    	header("location: requests.php");
		    	die();
			}else {
		    	header("location: generate_diploma.php?stud_id=$stud_id&credential=$credential&purpose=$request_purpose");
				die();
		    }
	    }else {
		    	header("location: generate_diploma.php?stud_id=$stud_id&credential=$credential&purpose=$request_purpose");
				die();
		    }

	}

	$checkpending = "SELECT * FROM pcnhsdb.requests where status = 'p' and stud_id = '$stud_id' and cred_id = '$credential' order by req_id desc limit 1;";
    $result = DB::query($checkpending);
    if(count($result) == 0) {
    	if(isset($_GET['new_request']) && $_GET['new_request']) {
				$cred_id = htmlspecialchars($_GET['credential'], ENT_QUOTES);
		    $personnel_id = htmlspecialchars($_SESSION['per_id'], ENT_QUOTES);
		    $date = date("Y-m-d");
		    $request_purpose = strtoupper(htmlspecialchars($_GET['purpose']));
				DB::insert('requests', array(
					'cred_id' => $cred_id,
					'stud_id' => $stud_id,
					'status' => 'p',
					'date_processed' => $date,
					'request_purpose' => $request_purpose,
					'per_id' => $personnel_id
				));

	    	header("location: requests.php");
	    	die();
			}
    }

    $school_year = "SELECT max(schl_year) as schl_year from studentsubjects where stud_id = '$stud_id'";
    $ans = DB::query($school_year);
    if (count($ans) > 0) {
    	foreach ($ans as $row => $value) {
    		$last_yr_attended = $row['schl_year'];
    	}
    }


?>
<html>
	<head>
		<title>Generate Credential</title>
		<link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
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
		<!-- iCheck -->
		<link href=".../../../../resources/libraries/iCheck/skins/flat/green.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.min.css" rel="stylesheet">
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">

		<!--[if lt IE 9]>
		<script src="../../js/ie8-responsive-file-warning.js"></script>
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
		<!-- Contents Here -->
		<div class="right_col" role="main">
			<form id="choose_cred" class="form-horizontal form-label-left" data-parsley-validate action=<?php echo "choose_template.php?stud_id=$stud_id" ?> method="POST" >
				<div class="x_panel">
					<div class="x_title">
						<h2>Form 137 <small></small></h2>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="clearfix"></div>
					<br>
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type of Request <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <p>
							<input type="radio" class="flat" name="request_type" id="tor-individual" value="individual" checked="" required /> Individual Request:
							<input type="radio" class="flat" name="request_type" id="tor-bulk" value="school" />
							School Request:

						</p>
                        </div>
                      </div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Date Today</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="date" readonly="" value=<?php echo date("Y-m-d"); ?>>
						</div>
					</div>
					<div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Credential ID</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="credential" readonly="" value=<?php echo "'$credential'"; ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Request Purpose/Remarks: </label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input required="required" class="form-control" name="request_purpose" placeholder="" value=<?php echo "'$request_purpose'"; ?>>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Admitted To:</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input class="form-control col-md-7 col-xs-12" type="text" name="admitted_to" value="" placeholder="ex: Grade 11 | Empty value will be set to 'N/A'.">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Last School Year Attended</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input class="form-control col-md-7 col-xs-12" type="text" name="last_yr_attended" readonly value=<?php echo "'$last_yr_attended'";?>>
							<p><i class="fa fa-info-circle"></i> If the Last School Year Attended is empty, please add grades and attendance first before generating credential.</p>
						</div>
					</div>
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Current Principal <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select id="credential" class="form-control" name="signatory" required="">
						<?php

							$statement = "SELECT * FROM signatories where position = 'PRINCIPAL' order by yr_started desc limit 1";

							$result = DB::query($statement);
							if (count($result) > 0) {
								foreach ($result as $row) {
									$sign_id = $row['sign_id'];
									$sign_name = $row['first_name'].' '.$row['mname'].' '.$row['last_name'].'  ('
												 .$row['position'].',  '.$row['title'].' '.$row['yr_started'].'-'.$row['yr_ended'].')';
									echo "<option value='$sign_id'>$sign_name</option>";
								}
							}
						?>

					</select>
				</div>
			</div>
			<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Signatory
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select id="credential" class="form-control" name="for_signature">
						<option value="">Choose Signatory</option>
						<?php

							$statement = "SELECT * FROM signatories where position = 'HEAD TEACHER' order by yr_started;";

							$result = DB::query($statement);
							if (count($result) > 0) {
								foreach ($result as $row) {
									$sign_id = $row['sign_id'];
									$sign_name = $row['first_name'].' '.$row['mname'].' '.$row['last_name'].'  ('
												 .$row['position'].',  '.$row['title'].' '.$row['yr_started'].'-'.$row['yr_ended'].')';
									echo "<option value='$sign_id'>$sign_name</option>";
								}
							}
						?>

					</select>
					<p><i class="fa fa-info-circle"></i> Choose only if the Principal is not present for signing.</p>
				</div>
			</div>
			<!--  -->
		</div>
	</div>
	<!-- this row will not appear when printing -->
	<div class="row no-print">
		<div class="col-xs-12">
			<button class="btn btn-primary pull-right"><i class="fa fa-print"></i> Generate</button>
			<a class="btn btn-default pull-right" href=<?php echo "choose_credential.php?stud_id=$stud_id"; ?>>Cancel</a>
		</div>
	</div>
</form>
</div>
<!-- Contents Here -->
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
<!-- iCheck -->
	<script src="../../resources/libraries/iCheck/icheck.min.js"></script>
<!-- Custom Theme Scripts -->
<script src= "../../assets/js/custom.min.js"></script>
<!-- Scripts -->
</body>
</html>
