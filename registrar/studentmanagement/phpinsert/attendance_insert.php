<?php
	require_once "../../../resources/config.php";

	if(!$conn) {
		die();
	}

	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);

	$yr_lvl = htmlspecialchars($_POST['yr_level'], ENT_QUOTES);
	$schl_yr = htmlspecialchars($_POST['schl_year'], ENT_QUOTES);
	$school_days = htmlspecialchars($_POST['school_days'], ENT_QUOTES);
	$days_attended = htmlspecialchars($_POST['days_attended'], ENT_QUOTES);



	
	$insertattendance = "INSERT INTO `pcnhsdb`.`attendance` (`stud_id`, `schl_yr`, `yr_lvl`, `days_attended`, `school_days`) VALUES ('$stud_id', '$schl_yr', '$yr_lvl', '$days_attended', '$school_days');";

	mysqli_query($conn, $insertattendance);

	header("location: ../attendance.php?stud_id=$stud_id");

?>