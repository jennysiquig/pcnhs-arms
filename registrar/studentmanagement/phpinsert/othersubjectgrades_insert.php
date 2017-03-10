<?php
	require_once "../../../resources/config.php";

	if(!$conn) {
		die();
	}
	$stud_id = $_GET['stud_id'];
	$schl_name = $_POST['schl_name'];
	$schl_year = $_POST['schl_year'];
	$yr_level = $_POST['yr_level'];
	$subj_name = $_POST['subj_name'];
	$subj_level = $_POST['subj_level'];
	$subj_type = $_POST['subj_type'];
	$fin_grade = $_POST['fin_grade'];
	$unit = $_POST['unit'];
	$comment = $_POST['comment'];

	$insertothersubj = "INSERT INTO `pcnhsdb`.`othersubjects` (`stud_id`, `subj_name`, `subj_level`, `subj_type`, `schl_name`, `schl_year`, `yr_level`, `fin_grade`, `unit`, `comment`) VALUES ('$stud_id', '$subj_name', $subj_level, '$subj_type', '$schl_name', '$schl_year', $yr_level, $fin_grade, $unit, '$comment');";


	mysqli_query($conn, $insertothersubj);
	

	

	header("location: ../grades.php?stud_id=$stud_id");



?>