<!DOCTYPE html>
<?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }

  ?>
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
		<!-- Date Range Picker -->
		<link href="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<!-- Datatables -->
		<link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		
		<!-- Custom Theme Style -->
		<link href="../../css/custom.css" rel="stylesheet">
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
		<?php include "../../resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "../../resources/templates/registrar/top-nav.php"; ?>
		<!-- Contents Here -->
		<div class="right_col" role="main">
			
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Accomplishment Reports</h2>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<div class="clearfix"></div>
						</div>
						<!-- Date Picker -->
	                      <div class="col-md-4">
	                        Select Date of Accomplishment
	                        <form class="form-horizontal" action="temp.php" method="get">
	                          <fieldset>
	                            <div class="control-group">
	                              <div class="controls">
	                                <div class="input-prepend input-group">
	                                  <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
	                                  <input type="text" style="width: 200px" name="accomplishment" class="form-control"/>
	                                </div>

	                              </div>
	                              <button>Go</button>
	                            </div>
	                          </fieldset>
	                        </form>
	                      </div>
	                      <!-- Date Picker -->
						<div class="x_content">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr class="headings">
											<th class="column-title">Item</th>
											<th class="column-title">Processed</th>
											<th class="column-title">Released</th>
											
										</th>
										
									</tr>
								</thead>
								<tbody>
									
									<tr class="odd pointer">
										<td class=" ">Form 137</td>
										<td class=" ">11</td>
										<td class=" ">11</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
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
	<!-- Date Range Picker -->
	<script src="../../resources/libraries/moment/min/moment.min.js"></script>
	<script src="../../resources/libraries/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
	<!-- Custom Theme Scripts -->
	<script src= "../../js/custom.js"></script>
	
	<!-- Scripts -->
	<script type="text/javascript">
	$(function() {
	$('input[name="accomplishment"]').daterangepicker({
	singleDatePicker: true,
	showDropdowns: false
	});
	});
	</script>
</body>
</html>