<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<html>
	<head>
		<title>Request Credential</title>
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

		<!-- Custom Theme Style -->
		<link href="../../assets/css/custom.min.css" rel="stylesheet">
		<link href="../../assets/css/easy-autocomplete.css" rel="stylesheet">

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

			<div class="x_panel">
				<div class="x_title">
					<h2>New Credential Request<small></small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">


				<form id="choose_cred" class="form-horizontal form-label-left" action="verify_student.php" method="GET" >
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="full-name">Full Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="full-name" name="full-name" required="required" class="form-control">
								</div>
							</div>
						<div class="form-group">
                        	<label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Credential <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="credential" class="form-control" name="credential" required>
							<option value="">Choose..</option>
							<?php

								$statement = "SELECT * FROM credentials";
								$result = DB::query($statement);
								if (count($result) > 0) {
									foreach ($result as $row) {
										$cred_id = $row['cred_id'];
										$cred_name = $row['cred_name'];

										echo "<option value='$cred_id'>$cred_name</option>";
									}
								}
							?>
							</select>
	                      </div>
                      	</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Purpose <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select id="purpose" class="form-control" onchange="disableOthers();" name="purpose">
								<option value="">Choose..</option>
								<option value="employment">Employment</option>
								<option value="local">Local</option>
								<option value="abroad">Abroad</option>
								<option value="change of name">Change of Name</option>
							</select>
						</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-4 col-sm-3 col-xs-12">Others:
							</label>
							<div class="col-md-5 col-sm-6 col-xs-12">
								<input id="others" type="text" name="others" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="ln_solid"></div>

						<div class="clearfix"></div>
						<br>

						<!--  -->
						<!-- this row will not appear when printing -->
						<div class="row no-print">
							<div class="col-xs-12">
								<button type="submit" class="btn btn-primary pull-right">Next</button>
								<a href="../../registrar/index.php" class="btn btn-default pull-right">Cancel</a>
							</div>
						</div>
				</div>
			</form>
		</div>
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
		<!-- NProgress -->
	  <script src="../../resources/libraries/nprogress/nprogress.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../../assets/js/custom.min.js"></script>
		<script src= "../../assets/js/jquery.easy-autocomplete.js"></script>
		<script type="text/javascript">
			var options = {
			  url: function(phrase) {
			    return "phpscript/student_search.php?query="+phrase;
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
			    data.phrase = $("#full-name").val();
			    return data;
			  },

			  requestDelay: 200
			};

			$("#full-name").easyAutocomplete(options);
		</script>
		<script type="text/javascript">
			function disableOthers() {
				var purpose = document.getElementById('purpose').value;
				console.log(purpose);

				if(purpose=="") {
					document.getElementById('others').removeAttribute('disabled');
				}else {
					document.getElementById('others').setAttribute('disabled','');
				}
			}
		</script>
		<!-- Scripts -->
	</body>
</html>
