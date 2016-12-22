<?php
	require_once "../../../resources/config.php";

	$subj_id = $_POST['subj_id'];
	$subj_name = $_POST['subj_name'];
	$subj_level = $_POST['subj_level'];
	$curriculum = $_POST['curr_id'];
	$yr_level_needed = $_POST['yr_level_needed'];


	$insertsubject = "INSERT INTO `pcnhsdb`.`subjects` (`subj_id`,`subj_name`, `subj_level`, `yr_level_needed`) VALUES ('$subj_id', '$subj_name', '$subj_level', '$yr_level_needed')";
	$insertcurriculum = "INSERT INTO `pcnhsdb`.`subjectcurriculum` (`subj_id`,`curr_id`) VALUES ('$subj_id', '$curriculum')";

	mysqli_query($conn, $insertsubject);
	mysqli_query($conn, $insertcurriculum);

	header("location: ../student_subjects.php");

	$conn->close();
?>