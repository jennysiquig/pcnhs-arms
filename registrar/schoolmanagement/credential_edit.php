<?php require_once "../../resources/config.php"; ?>
<?php
    session_start();

    if(!isset($_SESSION['logged_in']) && !isset($_SESSION['account_type'])){
      header('Location: ../../login.php');
    }

  ?>
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
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Edit Credential</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<?php
							if(!$conn) {
								die("Connection failed: " . mysqli_connect_error());
							}
							$statement = "SELECT * FROM pcnhsdb.credentials";
							$result = $conn->query($statement);
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									$cred_id = $row['cred_id'];
									$cred_name = $row['cred_name'];
									$price = $row['price'];
								}
							}
						?>
						<form id="credential-val" class="form-horizontal form-label-left" action="phpupdate/credential_update.php" method="POST" novalidate>
						<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Credential ID</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="cred_id" value=<?php echo $cred_id; ?> readonly="">
								</div>
							</div>
							
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Credential Name</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="cred_name" value=<?php echo "'$cred_name'"; ?>>
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input id="name" class="form-control col-md-7 col-xs-12" required="required" type="text" name="price" value=<?php echo $price; ?>>
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-5  pull-right">
									<button type="submit" class="btn btn-default" onclick="history.go(-1);return true";>Cancel</button>
									<button type="submit" class="btn btn-success">Save Changes</button>
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
		<!-- Custom Theme Scripts -->
		<script src= "../../js/custom.min.js"></script>
	<!-- Scripts -->
	<!-- Parsley -->
			    <script>
			      $(document).ready(function() {
			        $.listen('parsley:field:validate', function() {
			          validateFront();
			        });
			        $('#credential-val .btn').on('click', function() {
			          $('#credential-val').parsley().validate();
			          validateFront();
			        });
			        var validateFront = function() {
			          if (true === $('#credential-val').parsley().isValid()) {
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