<?php
	session_start();
	include('../../../resources/classes/Popover.php');
	require_once "../../../resources/config.php";


	if(!$conn) {
		die();
	}
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$schl_name = htmlspecialchars($_POST['schl_name'], ENT_QUOTES);
	$schl_year = htmlspecialchars($_POST['schl_year'], ENT_QUOTES);
	$yr_level = htmlspecialchars($_POST['yr_level'], ENT_QUOTES);
	$subj_name = htmlspecialchars($_POST['subj_name'], ENT_QUOTES);
	$subj_level = htmlspecialchars($_POST['subj_level'], ENT_QUOTES);
	$subj_type = strtoupper(htmlspecialchars($_POST['subj_type'], ENT_QUOTES));
	$fin_grade = htmlspecialchars($_POST['fin_grade'], ENT_QUOTES);
	$credit_earned = htmlspecialchars($_POST['credit_earned'], ENT_QUOTES);
	$subj_id = htmlspecialchars($_GET['subj_id']);
	$subj_order = htmlspecialchars($_GET['subj_order']);
	$comment = "";
	$willInsert = true;

	// 
	$input_year = explode("-", $schl_year);
	// 

	if(empty($schl_name) || empty($schl_year) || empty($yr_level) || empty($subj_name)
		|| empty($subj_level) || empty($subj_type) || empty($fin_grade) || empty($credit_earned)) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Please complete the form before saving.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(!is_numeric($fin_grade) || $fin_grade < 65) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Invalid Final Grade Input.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(!is_numeric($credit_earned)) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Invalid Credit Earned Input.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(intval($input_year[0]) > intval($input_year[1]) || intval($input_year[0]) != (intval($input_year[1]))-1) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Invalid School Year Input.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);	
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}

	if($fin_grade < 75) {
		$comment = "FAILED";
	}else {
		$comment = "PASSED";
	}

	$insertothersubj = "INSERT INTO `pcnhsdb`.`othersubjects` (`subj_id`, `stud_id`,  `subj_name`, `subj_level`, `subj_type`, `schl_name`, `schl_year`, `yr_level`, `fin_grade`, `credit_earned`, `comment`, `subj_order`) VALUES ('$subj_id', '$stud_id', '$subj_name', $subj_level, '$subj_type', '$schl_name', '$schl_year', '$yr_level', '$fin_grade', '$credit_earned', '$comment', '$subj_order');";

	if($willInsert) {
		mysqli_query($conn, $insertothersubj);
		header("location: ../grades.php?stud_id=$stud_id");
	}
	
	$_SESSION['user_activity'][] = "ADDED NEW OTHER SUBJECT GRADE OF: $stud_id";

	



?>