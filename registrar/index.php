<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include "$base_url/resources/templates/registrar/header.php"; ?>
	</head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "$base_url/resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "$base_url/resources/templates/registrar/top-nav.php"; ?>
		<!-- Content Here -->
		<!-- page content --> 
		<div class="right_col" role="main">
			<div class="">
				<div class="row top_tiles">
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-user"></i></div>
								<div class="count">179</div>
								<p>&nbsp</p>
								<h3>Total Students</h3>
								<p>&nbsp</p>
							</div>
						</div>
						<a href="#">
							<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="glyphicon glyphicon-hourglass"></i></div>
									<div class="count">179</div>
									<p>&nbsp</p>
									<h3>Unclaimed Credentials</h3>
									<p>&nbsp</p>
								</div>
							</div>
						</a>
						<a href="#">
							<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="tile-stats">
									<div class="icon"><i class="fa fa-paper-plane"></i></div>
									<div class="count">179</div>
									<p>&nbsp</p>
									<h3>Released Credentials</h3>
									<p>&nbsp</p>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
		                <div class="x_panel">
		                  <div class="x_title">
		                    <h2>Recent Released Credentials</h2>
		                    <ul class="nav navbar-right panel_toolbox">
		                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
		                      </li>
		                    </ul>
		                    <div class="clearfix"></div>
		                  </div>

		                  <div class="x_content">

							<div class="table-responsive">
		                      <table class="table table-striped">
		                        <thead>
		                          <tr class="headings">
		                            <th class="column-title">Date</th>
		                            <th class="column-title">Student Name</th>
		                            <th class="column-title">Requested Credential/s</th>
		                            <th class="column-title">Total Amount Paid</th>
		                          </tr>
		                        </thead>

		                        <tbody>
		                        	
		                        </tbody>
		                      </table>
		                    </div>
		                 </div>
						</div>
					</div>
				</div>
		</div>
		<!-- /page content -->
		<!-- Content Here -->
		<!-- Footer -->
		<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
		
		<!-- Scripts -->
		<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
	</body>
</html>