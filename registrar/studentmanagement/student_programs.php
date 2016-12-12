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
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Student Programs</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr class="headings">
										<th class="column-title">Program ID</th>
										<th class="column-title">Program Name</th>
									
									</th>		
								</tr>
							</thead>
							<tbody>
								
								
								<?php
									require_once "../../resources/config.php";
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$statement = "SELECT * FROM pcnhsdb.programs";
									$result = $conn->query($statement);
									if($result->num_rows>0) {
										while($row=$result->fetch_assoc()) {
											$prog_id = $row['prog_id'];
											$prog_name = $row['prog_name'];
											
											echo <<<CURR
											<tr class="odd pointer">
													<td class=" ">$prog_id</td>
													<td class=" ">$prog_name</td>
													
													
											</tr>
CURR;
										}
									}
									$conn->close();
								?>
								
							</tbody>
						</table>
					</div>
					<a href=<?php echo "$base_url/registrar/studentmanagement/programs_add.php" ?>>Add Program</a>
					
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