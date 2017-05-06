<?php
	session_start();
	include('../../../resources/classes/Popover.php');
	require_once "../../../resources/config.php";
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
	$special_grade = htmlspecialchars($_POST['special_grade']);
	$comment = "";
	$willInsert = true;
	$hasSpecialGrade = false;

	if(empty($subj_id)) {
		$subj_id = "null";
	}else {
		$subj_id = "'$subj_id'";
	}
	if(empty($subj_order)) {
		$subj_order = "null";
	}else {
		$subj_order = "'$subj_order'";
	}
	//
	$input_year = explode("-", $schl_year);
	//
	if(!empty($fin_grade) && !empty($special_grade)) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please leave the Special Grade field blank if the Final Grade has value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(empty($fin_grade) && !empty($special_grade)){
		if(strtoupper($special_grade) == 'S' || strtoupper($special_grade) == 'VS' || strtoupper($special_grade) == 'O' || strtoupper($special_grade) == 'P') {
			$fin_grade = 99;
			$hasSpecialGrade = true;
		}else {
			$willInsert = false;
			$alert_type = "danger";
			$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);
			$_SESSION['error_pop'] = $popover->get_popover();
			header("Location: " . $_SERVER["HTTP_REFERER"]);
			die();
		}
	}
	if(empty($schl_name) || empty($schl_year) || empty($yr_level) || empty($subj_name)
		|| empty($subj_level) || empty($subj_type) || empty($credit_earned)) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Please complete the form before saving.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if((!is_numeric($fin_grade) && !$hasSpecialGrade) || $fin_grade < 65 || $fin_grade > 99.99) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}
	if(!is_numeric($credit_earned)) {
		if(strtoupper($credit_earned) == 'P') {
			$credit_earned = "PROMOTED";
		}elseif (strtoupper($credit_earned) == 'R') {
			$credit_earned = "RETAINED";
		}else {
			$willInsert = false;
			$alert_type = "danger";
			$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
			$popover = new Popover();
			$popover->set_popover($alert_type, $error_message);
			$_SESSION['error_pop'] = $popover->get_popover();
			header("Location: " . $_SERVER["HTTP_REFERER"]);
			die();
		}
		if($fin_grade < 75) {
			$credit_earned = "RETAINED";
		}else {
			$credit_earned = "PROMOTED";
		}
	}
	if(intval($input_year[0]) > intval($input_year[1]) || intval($input_year[0]) != (intval($input_year[1]))-1) {
		$willInsert = false;
		$alert_type = "danger";
		$error_message = "Ooops. The system did not accept the value that you entered, please check and enter a valid value.";
		$popover = new Popover();
		$popover->set_popover($alert_type, $error_message);
		$_SESSION['error_pop'] = $popover->get_popover();
		header("Location: " . $_SERVER["HTTP_REFERER"]);
		die();
	}

	if(!$hasSpecialGrade) {
		if($fin_grade < 75) {
			$comment = "FAILED";
		}else {
			$comment = "PASSED";
		}
	}

	if($hasSpecialGrade) {
		$fin_grade = 0;
		$comment = "PASSED";
	}

	$insertothersubj = "INSERT INTO `pcnhsdb`.`othersubjects` (`subj_id`, `stud_id`,  `subj_name`, `subj_level`, `subj_type`, `schl_name`, `schl_year`, `yr_level`, `fin_grade`, `credit_earned`, `comment`, `subj_order`, `special_grade`) VALUES ($subj_id, '$stud_id', '$subj_name', $subj_level, '$subj_type', '$schl_name', '$schl_year', '$yr_level', '$fin_grade', '$credit_earned', '$comment', $subj_order, '$special_grade');";


	if($willInsert) {
		$student_grade = "SELECT * FROM pcnhsdb.grades where stud_id = '$stud_id' and schl_year='$schl_year';";
		$result_1 = DB::query($student_grade);

		if (count($result_1) > 0) {
			foreach ($result_1 as $row) {
				$total_credit = $row['total_credit'];
				$total_credit = doubleval($total_credit) + doubleval($credit_earned);

			    $totalcreditupdate = "UPDATE `pcnhsdb`.`grades` SET `total_credit`='$total_credit' WHERE stud_id = '$stud_id' and schl_year = '$schl_year';";

			    DB::query($totalcreditupdate);
			}
		}
		DB::query($insertothersubj);

		echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
		echo "<br>";

		$_SESSION['user_activity'][] = "ADDED NEW OTHER SUBJECT GRADE OF: $stud_id";
		header("location: ../student_info.php?stud_id=$stud_id");
	}

?>
