<?php
	session_start();
	require_once "../../../resources/config.php";
	include('../../../resources/classes/Popover.php');
	if(!$conn) {
		die();
	}
	$stud_id = htmlspecialchars($_POST['stud_id'], ENT_QUOTES);
	$schl_year = htmlspecialchars($_POST['schl_year'], ENT_QUOTES);
	$yr_level = htmlspecialchars($_POST['yr_level'], ENT_QUOTES);
	$average_grade = htmlspecialchars($_POST['average_grade'], ENT_QUOTES);
	$schl_name = htmlspecialchars($_POST['schl_name'], ENT_QUOTES);
	$total_credit = htmlspecialchars($_POST['total_credits'], ENT_QUOTES);
	$insertgrades = "";
	$comment = "";
	$credit_earned = htmlspecialchars($_POST['credit_earned'], ENT_QUOTES);
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
		$_SESSION['user_activity'][] = "Added New Grades for: $stud_id";
		echo "<p>Updating Database, please wait...</p>";
		header("refresh:3;url=../grades.php?stud_id=$stud_id");
	}
	

	
	



?>