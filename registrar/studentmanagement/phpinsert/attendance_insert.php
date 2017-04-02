<?php
	session_start();
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	if(!$conn) {
		die();
	}
	$willInsert = true;
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);

	$yr_lvl = htmlspecialchars($_POST['yr_level'], ENT_QUOTES);
	$schl_yr = htmlspecialchars($_POST['schl_year'], ENT_QUOTES);
	$school_days = htmlspecialchars($_POST['school_days'], ENT_QUOTES);
	$days_attended = htmlspecialchars($_POST['days_attended'], ENT_QUOTES);

	if($days_attended > $school_days) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Days attended must be lesser than or equal to School Days";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
	}

	$validate_schl_yr = explode("-", $schl_yr);
	$year1 = $validate_schl_yr[0];
	$year2 = $validate_schl_yr[1];
// validate primary school year
	if(intval($year1) > intval($year2) || intval($year2) != (intval($year1)+1) ) {
		$willInsert = false;
			$alert_type = "danger";
			$error_message = "You have entered an Invalid School Year.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);	
			$_SESSION['error_pop'] = $popover->get_popover();
		
			header("Location: " . $_SERVER["HTTP_REFERER"]);
	}
	
	$insertattendance = "INSERT INTO `pcnhsdb`.`attendance` (`stud_id`, `schl_yr`, `yr_lvl`, `days_attended`, `school_days`) VALUES ('$stud_id', '$schl_yr', '$yr_lvl', '$days_attended', '$school_days');";

	if($willInsert) {
		mysqli_query($conn, $insertattendance);

		header("location: ../attendance.php?stud_id=$stud_id");
	}
	

?>