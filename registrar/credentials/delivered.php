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
		<!-- Contents Here -->
		<div class="right_col" role="main">
			
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Released Credentials</h2>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="table-responsive">
							<table class="table table-striped jambo_table">
								<thead>
									<tr class="headings">
										<th class="column-title">Date Released</th>
										<th class="column-title">Student Name</th>
										<th class="column-title">Requested Credential/s</th>
									</th>
									
								</tr>
							</thead>
							<tbody>
								
							<tr class="odd pointer">
								<td class=" ">11/11/2016</td>
								<td class=" ">Juan Migu</td>
								<td class=" ">Form 137</td>
							</tr>
							<tr class="odd pointer">
								<td class=" ">11/13/2016</td>
								<td class=" ">Jake Ross</td>
								<td class=" ">Form 137</td>
							</tr>
							<tr class="odd pointer">
								<td class=" ">11/16/2016</td>
								<td class=" ">Kaiser Ken</td>
								<td class=" ">Form 137</td>
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
<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
</body>
</html>