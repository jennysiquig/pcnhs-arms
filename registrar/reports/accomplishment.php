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
			<div class="x_panel">
				<div class="x_title">
					<h2>Month <small>January</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			Choose Month: <a href="#">January</a> | <a href="#">February</a> | <a href="#">March</a> | <a href="#">April</a> | <a href="#">May</a> | <a href="#">June</a> | <a href="#">July</a> | <a href="#">August</a> | <a href="#">September</a> | <a href="#">October</a> | <a href="#">November</a> | <a href="#">December</a>
			<div class="ln_solid"></div>
			<div class="x_content">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr class="headings">
								<th class="column-title">Item</th>
								<th class="column-title">Processed</th>
								<th class="column-title">Released</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Form 137</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Form 138</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Diploma</td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Contents Here -->
	<?php include "$base_url/resources/templates/registrar/footer.php"; ?>
	<?php include "$base_url/resources/templates/registrar/scripts.php"; ?>
</body>
</html>