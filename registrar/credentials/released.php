<?php require_once "../../resources/config.php"; ?>
<?php include('include_files/session_check.php'); ?>
<!DOCTYPE html>
<html>
		<head>
		<title>Released Credentials</title>
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
	    <link href="../../assets/css/easy-autocomplete-topnav.css" rel="stylesheet">

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
			<div class="col-md-9">
				<ol class="breadcrumb">
				  <li><a href="../index.php">Home</a></li>
				  <li><a href="#">Credentials</a></li>
				  <li class="active">Released Credentials</li>
				</ol>
			</div>
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
						<div class="released-list">
							<table class="tablesorter-bootstrap">
								<thead>
									<tr class="headings">
										<th class="column-title">Date Released</th>
										<th class="column-title">Student Name</th>
										<th class="column-title">Requested Credential/s</th>
									</th>

								</tr>
							</thead>
							<tbody>
							<?php
								$start=0;
								$limit=20;
								if(isset($_GET['page'])){
									$page=$_GET['page'];
									$start=($page-1)*$limit;
								}else{
									$page=1;
								}

								$statement = "SELECT stud_id, date_released as 'date released', concat(first_name, ' ' ,last_name) as 'stud_name', cred_name FROM pcnhsdb.requests natural join students natural join credentials where status='r' order by date_released desc limit $start, $limit;";
								$result = DB::query($statement);
								if (count($result) > 0) {
									foreach ($result as $row) {
										$date_released = $row['date released'];
										$stud_name = $row['stud_name'];
										$cred_name = $row['cred_name'];
										$stud_id = $row['stud_id'];
										echo <<<RELEASED
										<tr class="odd pointer">
											<td class=" ">$date_released</td>
											<td class=" "><a href="../studentmanagement/student_info.php?stud_id=$stud_id">$stud_name</a></td>
											<td class=" ">$cred_name</td>
										</tr>
RELEASED;
									}
								}

							?>
					</tbody>
				</table>
				<?php
							$statement = "SELECT date_released as 'date released', concat(first_name, ' ' ,last_name) as 'stud_name', cred_name FROM pcnhsdb.requests natural join students natural join credentials where status='r';";

							$result = DB::query($statement);
							$rows = count($result);

							$total = ceil($rows/$limit);
							echo '<div class="pull-right">
									<div class="col s12">
											<ul class="pagination center-align">';
													if($page > 1) {
													echo "<li class=''><a href='released.php?page=".($page-1)."'>Previous</a></li>";
													}else if($total <= 0) {
													echo '<li class="disabled"><a>Previous</a></li>';
													}else {
													echo '<li class="disabled"><a>Previous</a></li>';
													}
													for($i = 1;$i <= $total; $i++) {
													if($i==$page) {
													echo "<li class='active'><a href='released.php?page=$i'>$i</a></li>";
													} else {
													echo "<li class=''><a href='released.php?page=$i'>$i</a></li>";
													}
													}
													if($total == 0) {
													echo "<li class='disabled'><a>Next</a></li>";
													}else if($page!=$total) {
													echo "<li class=''><a href='released.php?page=".($page+1)."'>Next</a></li>";
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
		<script type="text/javascript">
		$(function() {
		$('.released-list').tablesorter();
		$('.tablesorter-bootstrap').tablesorter({
		theme : 'bootstrap',
		headerTemplate: '{content} {icon}',
		widgets    : ['zebra','columns', 'uitheme']
		});
		});
		</script>
	<!-- Scripts -->
</body>
</html>
