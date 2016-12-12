<?php $base_url =  "http://".$_SERVER['SERVER_NAME']."/pcnhs.sis"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include "$base_url/resources/templates/admin/header.php"; ?>
	</head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "$base_url/resources/templates/admin/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "$base_url/resources/templates/admin/top-nav.php"; ?>
		<!-- Contents Here -->
		<div class="right_col" role="main">
			<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Peronnel Accounts</h2>
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
										<th class="column-title">Username</th>
										<th class="column-title">Password</th>
										<th class="column-title">Full Name</th>
										<th class="column-title">Position</th>
										<th class="column-title">Action</th>
									</tr>
								</thead>
								
								<tbody>
									<tr>
										<td>elvi</td>
										<td>elvi</td>
										<td>Elvira Cudli</td>
										<td>Registrar</td>
										<td>
											<a href=<?php echo "$base_url/systemadmin/editpersonnel.php" ?> class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
											<button class="btn btn-danger btn-xs" onclick="confirm('Are you sure?');"><i class="fa fa-trash-o"></i> Remove </button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<div class="row">
				
			</div>
		</div>
	</div>
	<!-- Contents Here -->
	<?php include "$base_url/resources/templates/admin/footer.php"; ?>
	<?php include "$base_url/resources/templates/admin/scripts.php"; ?>
	<script type="text/javascript">

	</script>
</body>
</html>