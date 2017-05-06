<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<?php

	$stud_id = "";
	$credential = "";
	$request_type = "";
	$request_purpose = "";

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

	if(isset($_GET['stud_id']) && isset($_GET['credential'])) {
		$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
		$credential = htmlspecialchars($_GET['credential'], ENT_QUOTES);

	}else {
		header("location: ../index.php");
	}

		$request_purpose = strtoupper(htmlspecialchars($_GET['purpose']));

    $school_year = "SELECT max(schl_year) as schl_year from studentsubjects where stud_id = '$stud_id'";
    $ans = DB::query($school_year);
    if (count($ans) > 0) {
    	foreach ($ans as $row) {
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
		<!-- NProgress -->
		<link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<!-- iCheck -->
		<link href=".../../../../resources/libraries/iCheck/skins/flat/green.css" rel="stylesheet">
		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.min.css" rel="stylesheet">
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">
		<link href="../../assets/css/easy-autocomplete-topnav.css" rel="stylesheet">

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
			<form id="choose_cred" class="form-horizontal form-label-left" data-parsley-validate action=<?php echo "diplomaprint.php?stud_id=$stud_id" ?> method="POST" >
				<div class="x_panel">
					<div class="x_title">
						<h2>Diploma<small>Second Copy</small></h2>
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
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Last School Year Attended</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input class="form-control col-md-7 col-xs-12" type="text" name="" readonly value=<?php echo "'$last_yr_attended'";?>>
						</div>
					</div>
					<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Date of Graduation</label>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<select id="credential" class="form-control" name="grad_month" required="">
								<option value="">-- Select Month --</option>
								<?php
									$i = 1;
										$month = strtotime('-3 month');
											while($i <= 12) {
											    $month_name = date('F', $month);
												    echo "<option value='$month_name'>$month_name</option>";
												    $month = strtotime('+1 month', $month);
											    $i++;
										}
								?>
							</select>

						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<select id="credential" class="form-control" name="grad_day" required="">
								<option value="">-- Select Day --</option>
								    <?php $day = date("d");
                                    	for ($day = 1; $day <= 31; $day++) {
                                        	echo "<option value='$day'>$day</option>";
                                        }
                                    ?>
							</select>
						</div>
					</div
				<!--  -->
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Signatory for Principal <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select id="credential" class="form-control" name="signatory_principal" required="">
						<option value="">-- Choose Signatory --</option>
						<?php

							$school_years = explode(" ", $last_yr_attended);
							$yr_started = $school_years[0];
							$yr_ended = $school_years[2];

							$statement = "SELECT * FROM signatories WHERE ('$yr_ended'
										  BETWEEN yr_started AND yr_ended)
										  AND (position NOT LIKE 'HEAD TEACHER')
										  AND (position NOT LIKE 'SUPERINTENDENT')";

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
			<!--  -->
							<!--  -->
				<div class="form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Signatory for Superintendent<span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<select id="credential" class="form-control" name="signatory_superintendent" required="">
						<option value="">-- Choose Signatory --</option>
						<?php

							$school_years = explode(" ", $last_yr_attended);
							$yr_started = $school_years[0];
							$yr_ended = $school_years[2];

							$statement = "SELECT * FROM signatories WHERE ('$yr_ended'
										  BETWEEN yr_started AND yr_ended)
										  AND (position NOT LIKE 'HEAD TEACHER')
										  AND (position NOT LIKE 'PRINCIPAL')";

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
	<!-- NProgress -->
  <script src="../../resources/libraries/nprogress/nprogress.js"></script>
<!-- Custom Theme Scripts -->
<script src= "../../assets/js/jquery.easy-autocomplete.js"></script>
	<script type="text/javascript">
	      var options = {
	        url: function(phrase) {
	          return "../../registrar/studentmanagement/phpscript/student_search.php?query="+phrase;
	        },

	        getValue: function(element) {
	          return element.name;
	        },

	        ajaxSettings: {
	          dataType: "json",
	          method: "POST",
	          data: {
	            dataType: "json"
	          }
	        },

	        preparePostData: function(data) {
	          data.phrase = $("#search_key").val();
	          return data;
	        },

	        requestDelay: 200
	      };

	      $("#search_key").easyAutocomplete(options);
	</script>
<script src= "../../assets/js/custom.min.js"></script>
<!-- Scripts -->
</body>
</html>
