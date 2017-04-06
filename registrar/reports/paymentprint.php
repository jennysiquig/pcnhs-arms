<?php include('include_files/session_check.php'); ?>
<?php require_once "../../resources/config.php"; ?>
<?php $stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES) ?>
<!-- Update Database -->
<?php
	if(!$conn) {
		die();
	}
?>
<html>
	<head>
	</head>

	<body>
	<div class="main">
	<h4 class="top">PINES CITY NATIONAL HIGH SCHOOL</h4>
	<h4 class="top">PAYMENT REMITTANCE</h4>
	<h4 class="top"><?php // date ex. March 1-17, 2017?></h4>

	<table>

		<thead>

			<th>DATE</th>
			<th>OR NUMBER</th>
			<th>NAME</th>
			<th>ITEM</th>
			<th>AMOUNT</th>
			<th>REMARKS</th>

		</thead>

		<tbody>

			<tr>

		</tbody>
	</table>
	</div>

				<div class="row no-print">
				<div class="col-xs-12">
					<button class="btn btn-success pull-right" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
          <a href="../../registrar" class="btn btn-success pull-right"><i class="fa fa-home"></i> Back to Home</a>
				</div>
			</div>
	</body>
</html>