<!DOCTYPE html>
<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<html>
	<head>
		<title>Add Curriculum</title>
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
		<link href="../../assets/css/tstheme/style.css" rel="stylesheet">
		<link href="../../assets/css/customstyle.css" rel="stylesheet">
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
		<!-- Content Here -->
		<!-- page content -->
		<div class="right_col" role="main">
			<div class="">
				<div class="row top_tiles">

				</div>
			</div>
			<?php
				if(isset($_SESSION['error_pop'])) {
					echo $_SESSION['error_pop'];
					unset($_SESSION['error_pop']);
				}
			?>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Add Curriculum</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<form id="curriculum-val" class="form-horizontal form-label-left" action="phpinsert/curriculum_insert.php" method="POST" novalidate>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum Code</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="curr_code" placeholder="ex: BEC">
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Curriculum Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="curr_name" >
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Year Started</label>


								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control" name="year_started">
										<option value="">-- Choose Year Started --</option>
										<?php
											$year_today = date('Y');
											echo $year_today;
											for($year_start = 1990; $year_start <= $year_today; $year_start++) {
												echo "<option value='$year_start'>$year_start</option>";
											}

										?>
									</select>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Year Ended</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="form-control" name="year_ended">
										<option value="">-- Choose Year Ended --</option>
										<option value="PRESENT">Present</option>
										<?php
											$year_today = date('Y');
											echo $year_today;
											for($year_start = 1990; $year_start <= $year_today; $year_start++) {
												echo "<option value='$year_start'>$year_start</option>";
											}

										?>
									</select>
								</div>
							</div>
							<div class="form-group">
							<div class="col-md-5 col-md-offset-3 pull-right">
								<button type="submit" class="btn btn-success">Add Curriculum</button>
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

	<!-- Parsley -->
			    <script>
			      $(document).ready(function() {
			        $.listen('parsley:field:validate', function() {
			          validateFront();
			        });
			        $('#curriculum-val .btn').on('click', function() {
			          $('#curriculum-val').parsley().validate();
			          validateFront();
			        });
			        var validateFront = function() {
			          if (true === $('#curriculum-val').parsley().isValid()) {
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
