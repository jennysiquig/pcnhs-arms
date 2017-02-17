<?php
	require_once "../../../resources/config.php";

	if(!$conn) {
		die();
	}

	$stud_id = $_GET['stud_id'];

	$yr_lvl = $_POST['yr_level'];
	$schl_yr = $_POST['schl_year'];
	$school_days = $_POST['school_days'];
	$days_attended = $_POST['days_attended'];



	
	$insertattendance = "INSERT INTO `pcnhsdb`.`attendance` (`stud_id`, `schl_yr`, `yr_lvl`, `days_attended`, `school_days`) VALUES ('$stud_id', '$schl_yr', '$yr_lvl', '$days_attended', '$school_days');";

	mysqli_query($conn, $insertattendance);

	header("location: ../attendance.php?stud_id=$stud_id");

?>