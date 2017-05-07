<?php
	session_start();
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$yr_lvl = 1;
	$statement = "SELECT * FROM pcnhsdb.attendance where stud_id = '$stud_id' order by yr_lvl desc limit 1;";
	$result = DB::query($statement);
	if (count($result) > 0) {
		foreach ($result as $row) {
			$yr_lvl = $row['yr_lvl'];
			$yr_lvl = $yr_lvl+1;
		}
	}else {
			$yr_lvl = 1;
	}
	$willInsert = true;


	//$yr_lvl = htmlspecialchars($_POST['yr_lvl'], ENT_QUOTES);
	$schl_yr = htmlspecialchars($_POST['schl_year'], ENT_QUOTES);
	$school_days = htmlspecialchars($_POST['school_days'], ENT_QUOTES);
	$days_attended = htmlspecialchars($_POST['days_attended'], ENT_QUOTES);
	$total_years_in_school = htmlspecialchars($_POST['total_years_in_school'], ENT_QUOTES);
	$days_in_year = 365;

	if(!is_numeric($days_attended) || !is_numeric($school_days)) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
//validate days attended.
	if($days_attended > $school_days) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(intval($days_attended) > $days_in_year || intval($school_days) > $days_in_year) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(intval($days_attended) < 100 || intval($school_days) < 100) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	$validate_schl_yr = explode("-", $schl_yr);
	$year1 = $validate_schl_yr[0];
	$year2 = $validate_schl_yr[1];
// validate primary school year
	if(intval($year1) > intval($year2) || intval($year2) != (intval($year1)+1) ) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();

		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(intval($total_years_in_school) != (intval($yr_lvl)+6)) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	// $insertattendance = "INSERT INTO `pcnhsdb`.`attendance` (`stud_id`, `schl_yr`, `yr_lvl`, `days_attended`, `school_days`, `total_years_in_school`) VALUES ('$stud_id', '$schl_yr', '$yr_lvl', '$days_attended', '$school_days', '$total_years_in_school');";

	if($willInsert) {
		//mysqli_query(, $insertattendance);
		DB::insert('attendance', array(
			'stud_id' => $stud_id,
			'schl_yr' => $schl_yr,
			'yr_lvl' => $yr_lvl,
			'days_attended' => $days_attended,
			'school_days' => $school_days,
			'total_years_in_school' => $total_years_in_school
		));

		echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
		echo "<br>";
		$_SESSION['user_activity'][] = "ADDED NEW ATTENDANCE OF: $stud_id";
		header("location: ../student_info.php?stud_id=$stud_id");
	}


?>
