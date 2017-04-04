<?php
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
	$subj_type = htmlspecialchars($_POST['subj_type'], ENT_QUOTES);
	$fin_grade = htmlspecialchars($_POST['fin_grade'], ENT_QUOTES);
	$unit = htmlspecialchars($_POST['unit'], ENT_QUOTES);
	$comment = htmlspecialchars($_POST['comment'], ENT_QUOTES);

	$insertothersubj = "INSERT INTO `pcnhsdb`.`othersubjects` (`stud_id`, `subj_name`, `subj_level`, `subj_type`, `schl_name`, `schl_year`, `yr_level`, `fin_grade`, `unit`, `comment`) VALUES ('$stud_id', '$subj_name', $subj_level, '$subj_type', '$schl_name', '$schl_year', $yr_level, $fin_grade, $unit, '$comment');";


	mysqli_query($conn, $insertothersubj);
	

	$_SESSION['user_activity'][] = "Added New Other Subject grade for: $stud_id";

	header("location: ../grades.php?stud_id=$stud_id");



?>