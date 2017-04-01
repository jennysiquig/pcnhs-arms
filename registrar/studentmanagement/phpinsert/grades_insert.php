<?php
	session_start();
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	if(!$conn) {
		die();
	}
	$stud_id = $_POST['stud_id'];
	$schl_year = $_POST['schl_year'];
	$yr_level = $_POST['yr_level'];
	$average_grade = $_POST['average_grade'];
	$schl_name = $_POST['schl_name'];
	$total_credit = $_POST['total_credits'];
	$insertgrades = "";
	$comment = "";
	$credit_earned = $_POST['credit_earned'];
	$willInsert = true;

	if($average_grade > 99.999) {
		$willInsert = false;
			$alert_type = "danger";
			$error_message = "You have entered an Invalid Average Grade.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);	
			$_SESSION['error_pop'] = $popover->get_popover();
			header("Location: " . $_SERVER["HTTP_REFERER"]);
	}

	foreach ($_POST['subj_id'] as $key => $value) {
		$subj_id = $_POST['subj_id'][$key];
		$fin_grade = $_POST['fin_grade'][$key];
		$credit_earned = $_POST['credit_earned'][$key];
// 
		if($fin_grade > 99.99 || $fin_grade < 70) {
			$willInsert = false;
			$alert_type = "danger";
			$error_message = "You have entered an Invalid Final Grade.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);	
			$_SESSION['error_pop'] = $popover->get_popover();
			header("Location: " . $_SERVER["HTTP_REFERER"]);
		}
// 
		if($fin_grade < 75 && $fin_grade != 0) {
			$comment ="FAILED";
		}else {
			$comment = "PASSED";
		}
//
		if($credit_earned < 1 || $credit_earned > 100) {
			$willInsert = false;
			$alert_type = "danger";
			$error_message = "You have entered an Invalid Credits Earned.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);	
			$_SESSION['error_pop'] = $popover->get_popover();
		} 

		$insertgrades .= "INSERT INTO `pcnhsdb`.`studentsubjects` (`stud_id`, `subj_id`, `schl_year`, `yr_level`, `fin_grade`, `comment`, `credit_earned`) VALUES ('$stud_id', '$subj_id', '$schl_year', '$yr_level', '$fin_grade', '$comment', '$credit_earned');";
		
	}
	$insertaverage = "INSERT INTO `pcnhsdb`.`grades` (`stud_id`, `schl_name`, `schl_year`, `yr_level`, `average_grade`, `total_credit`) VALUES ('$stud_id', '$schl_name', '$schl_year', '$yr_level', '$average_grade', '$total_credit');";

	if($willInsert) {
		unset($_SESSION['grade']);
		mysqli_query($conn, $insertaverage);
		mysqli_multi_query($conn, $insertgrades);
		echo "<p>Updating Database, please wait...</p>";
		header("refresh:3;url=../grades.php?stud_id=$stud_id");
	}
	

	
	



?>