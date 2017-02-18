<?php
	require_once "../../../resources/config.php";

	if(!$conn) {
		die();
	}
	$stud_id = $_POST['stud_id'];
	$schl_year = $_POST['schl_year'];
	$yr_level = $_POST['yr_level'];
	$average_grade = $_POST['average_grade'];
	$schl_name = $_POST['schl_name'];
	$total_unit = $_POST['total_unit'];
	$insertgrades = "";

	foreach ($_POST['subj_id'] as $key => $value) {
		$subj_id = $_POST['subj_id'][$key];
		$fin_grade = $_POST['fin_grade'][$key];
		$comment = $_POST['comment'][$key];

		$insertgrades .= "INSERT INTO `pcnhsdb`.`studentsubjects` (`stud_id`, `subj_id`, `schl_year`, `yr_level`, `fin_grade`, `comment`) VALUES ('$stud_id', '$subj_id', '$schl_year', '$yr_level', '$fin_grade', '$comment');";
	}
	$insertaverage = "INSERT INTO `pcnhsdb`.`grades` (`stud_id`, `schl_name`, `schl_year`, `yr_level`, `average_grade`, `total_unit`) VALUES ('$stud_id', '$schl_name', '$schl_year', '$yr_level', '$average_grade', '$total_unit');";

	
	mysqli_query($conn, $insertaverage);
	mysqli_multi_query($conn, $insertgrades);

	

	header("location: ../grades.php?stud_id=$stud_id");



?>