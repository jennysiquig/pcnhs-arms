<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Credential Requests</title>
		<link rel="shortcut icon" href="../../assets/images/ico/fav.png" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- jQuery -->
	    <script src="../../resources/libraries/jquery/dist/jquery.min.js" ></script>

	    <!-- Tablesorter themes -->
	    <!-- bootstrap -->
	    <link href="../../resources/libraries/tablesorter/css/bootstrap-v3.min.css" rel="stylesheet">
	    <link href="../../resources/libraries/tablesorter/css/theme.bootstrap.css" rel="stylesheet">

	    <!-- Tablesorter: required -->
	    <script src="../../resources/libraries/tablesorter/js/jquery.tablesorter.js"></script>
	    <script src="../../resources/libraries/tablesorter/js/jquery.tablesorter.widgets.js"></script>

	    <!-- NProgress -->
	    <link href="../../resources/libraries/nprogress/nprogress.css" rel="stylesheet">
	    <!-- Bootstrap -->
	    <link href="../../resources/libraries/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	    <!-- Font Awesome -->
	    <link href="../../resources/libraries/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	    <!-- Datatables -->
	    <link href="../../resources/libraries/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">

	    <!-- Custom Theme Style -->
	    <link href="../../assets/css/custom.min.css" rel="stylesheet">
	     <!-- Custom Theme Style -->
	    <link href="../../assets/css/customstyle.css" rel="stylesheet">

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
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Credential Requests</h2>
							<a href="request_credential.php" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i> New Request</a>
							<ul class="nav navbar-right panel_toolbox">
							</ul>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<div class="credential-request table-list">
								<table class="tablesorter-bootstrap">
									<thead>
										<tr class="headings">
											<th class="column-title" data-sorter="false">Date of Request</th>
											<th class="column-title" data-sorter="false">Student Name</th>
											<th class="column-title" data-sorter="false">Requested Credential</th>
											<th class="column-title" data-sorter="false">Purpose</th>
											<th class="column-title no-link last" data-sorter="false"><span class="nobr">Action</span>
										</th>

									</tr>
								</thead>
								<tbody>
									<?php
										$statement = "";
										$start=0;
										$limit=20;
										if(isset($_GET['page'])){
										$page=$_GET['page'];
										$start=($page-1)*$limit;
										}else{
										$page=1;
										}

										$statement = "SELECT stud_id, req_id, cred_id, request_purpose, date_processed as 'date processed', concat(first_name, ' ', last_name) as 'stud_name', cred_id, cred_name, request_type FROM pcnhsdb.requests natural join students natural join credentials where status='p' order by req_id asc limit $start, $limit;";
										$result = DB::query($statement);

										if (count($result) > 0) {
											foreach ($result as $row) {
												$date_processed = $row['date processed'];
												$stud_name = $row['stud_name'];
												$cred_name = $row['cred_name'];
												$request_purpose = $row['request_purpose'];
												$request_purpose = strtoupper($request_purpose);
												$cred_id = $row['cred_id'];
												$stud_id = $row['stud_id'];

												echo <<<UNCLAIMED
												<tr class="odd pointer">
																<td class=" ">$date_processed</td>
																<td class=" ">$stud_name</td>
																<td class=" ">$cred_name</td>
																<td class=" ">$request_purpose</td>
																<td class=" ">
																<center>
																	<a href="../../registrar/credentials/generate_cred.php?stud_id=$stud_id&credential=$cred_id&purpose=$request_purpose" class="btn btn-default"> Process Request</a>
																</center>
																</td>
												</tr>
UNCLAIMED;
											}
										}

									?>
								</tbody>
							</table>
							<?php
							$statement = "SELECT req_id, stud_id, date_processed as 'date processed', concat(first_name, ' ', last_name) as 'stud_name', cred_name FROM pcnhsdb.requests natural join students natural join credentials where status='p' order by req_id asc;";

							$result = DB::query($statement);
							$rows = count($result);
							$total = ceil($rows/$limit);
							echo '<div class="pull-right">
									<div class="col s12">
											<ul class="pagination center-align">';
													if($page > 1) {
													echo "<li class=''><a href='requests.php?page=".($page-1)."'>Previous</a></li>";
													}else if($total <= 0) {
													echo '<li class="disabled"><a>Previous</a></li>';
													}else {
													echo '<li class="disabled"><a>Previous</a></li>';
													}
													for($i = 1;$i <= $total; $i++) {
													if($i==$page) {
													echo "<li class='active'><a href='requests.php?page=$i'>$i</a></li>";
													} else {
													echo "<li class=''><a href='requests.php?page=$i'>$i</a></li>";
													}
													}
													if($total == 0) {
													echo "<li class='disabled'><a>Next</a></li>";
													}else if($page!=$total) {
													echo "<li class=''><a href='requests.php?page=".($page+1)."'>Next</a></li>";
													}else {
													echo "<li class='disabled'><a>Next</a></li>";
													}
											echo "</ul></div></div>";

									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Contents Here -->
			<?php include "../../resources/templates/registrar/footer.php"; ?>
			<!-- Scripts -->
			<!-- Bootstrap -->
			<script src="../../resources/libraries/bootstrap/dist/js/bootstrap.min.js"></script>
			<!-- FastClick -->
			<script src= "../../resources/libraries/fastclick/lib/fastclick.js"></script>
			<!-- input mask -->
			<script src= "../../resources/libraries/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
			<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
			<!-- NProgress -->
		  <script src="../../resources/libraries/nprogress/nprogress.js"></script>
			<!-- Bootbox -->
			<script src= "../../resources/libraries/bootbox/bootbox.min.js"></script>
			<!-- Custom Theme Scripts -->

			<script src= "../../assets/js/custom.min.js"></script>
			<!-- Scripts -->
			<script type="text/javascript">
				function releaseAction(stud_id, cred_id, req_id, request_type) {
				bootbox.prompt({
				size: "small",
				title: "Enter OR Number",
				callback: function(or_no){
				if(or_no != null && !isNaN(or_no) && or_no != "") {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				location.assign("released.php");
				}
				};
				xhttp.open("GET", "release_action.php?stud_id="+stud_id+"&cred_id="+cred_id+"&req_id="+req_id+"&request_type="+request_type+"&or_no="+or_no, true);
				xhttp.send();
				}else if(or_no != null && isNaN(or_no)) {
				bootbox.alert({
				size: "small",
				message: "Invalid OR Number"
				});
				}
				}

				});
				}
			</script>
			<script type="text/javascript">
		      $(function() {
		      $('.credential-request').tablesorter();
		      $('.tablesorter-bootstrap').tablesorter({
		      theme : 'bootstrap',
		      headerTemplate: '{content} {icon}',
		      widgets    : ['zebra','columns', 'uitheme']
		      });
		      });
		    </script>
		</body>
	</html>
