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
							<h2>Credentials</h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="table-responsive">
							<table class="table table-striped jambo_table">
								<thead>
									<tr class="headings">
										<th class="column-title">Credential ID</th>
										<th class="column-title">Credential Name</th>
										<th class="column-title">Price</th>
									</th>
									
								</tr>
							</thead>
							<tbody>
								
								
								<?php
									require_once "../../resources/config.php";
									if(!$conn) {
										die("Connection failed: " . mysqli_connect_error());
									}
									$statement = "SELECT * FROM pcnhsdb.credentials";
									$result = $conn->query($statement);
									if($result->num_rows>0) {
										while($row=$result->fetch_assoc()) {
											$cred_id = $row['cred_id'];
											$cred_name = $row['cred_name'];
											$price = $row['price'];
											echo <<<CURR
											<tr class="odd pointer">
														<td class=" ">$cred_id</td>
														<td class=" ">$cred_name</td>
														<td class=" ">$price</td>
											</tr>
CURR;
										}
									}
									$conn->close();
								?>
								
							</tbody>
						</table>
					</div>
					<a href=<?php echo "$base_url/registrar/schoolmanagement/credential_add.php" ?>>Add Credential</a>
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