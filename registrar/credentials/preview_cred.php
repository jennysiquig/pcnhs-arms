<?php
	session_start();
?>
<?php require_once "../../resources/config.php"; ?>
<?php $stud_id = $_GET['stud_id'] ?>
<!-- Update Database -->
<?php
	if(!$conn) {
		die();
	}
	$cred_id = $_POST['credential'];
	$request_type = $_POST['request_type'];
	$signatory = $_POST['signatory'];
	$personnel_id = $_SESSION['personnel_id'];
	$date = $_POST['date'];

	$statement1 = "INSERT INTO `pcnhsdb`.`requests` (`cred_id`, `stud_id`, `request_type`, `status`, `sign_id`, `per_id`) VALUES ('$cred_id', '$stud_id', '$request_type', 'u', '$signatory', '$personnel_id');";

	$statement2 = "INSERT INTO `pcnhsdb`.`unclaimed` (`date_processed`) VALUES ('$date');";

	mysqli_query($conn, $statement1);
	mysqli_query($conn, $statement2);

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
		
		<style type="text/css" media="print">
		   .no-print { display: none; }
		</style>
	</head>
	<body class="nav-md">
		<!-- Sidebar -->
		<?php include "../../resources/templates/registrar/sidebar.php"; ?>
		<!-- Top Navigation -->
		<?php include "../../resources/templates/registrar/top-nav.php"; ?>
		<!-- Contents Here -->
		<div class="right_col" role="main">

			<?php
				$input1 = $_POST['input1'];
				$input2 = $_POST['input2'];
				$remarks = $_POST['remarks'];

				echo $input1;
				echo $input2;
				echo $remarks;

			?>

			<div class="row no-print">
				<div class="col-xs-12">
					<button class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
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
		<script src= "../../resources/libraries/parsleyjs/dist/parsley.min.js"></script>
		<!-- Custom Theme Scripts -->
		<script src= "../../js/custom.min.js"></script>
		<!-- Scripts -->
	</body>
</html>