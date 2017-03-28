<?php
	require_once "../../../resources/config.php";

	$subj_id = $_POST['subj_id'];
	$subj_name = $_POST['subj_name'];
	$subj_level = $_POST['subj_level'];
	$curriculum = $_POST['curr_id'];
	$program = $_POST['prog_id'];
	$yr_level_needed = $_POST['yr_level_needed'];
	$credit_earned = $_POST['credit_earned'];


	$insertsubject = "INSERT INTO `pcnhsdb`.`subjects` (`subj_id`,`subj_name`, `subj_level`, `yr_level_needed`, `credit_earned`) VALUES ('$subj_id', '$subj_name', '$subj_level', '$yr_level_needed', '$credit_earned')";
	$insertcurriculum = "INSERT INTO `pcnhsdb`.`subjectcurriculum` (`subj_id`,`curr_id`) VALUES ('$subj_id', '$curriculum')";
	$insertprogram = "INSERT INTO `pcnhsdb`.`subjectprogram` (`subj_id`,`prog_id`) VALUES ('$subj_id', '$program')";

	mysqli_query($conn, $insertsubject);
	mysqli_query($conn, $insertcurriculum);
	mysqli_query($conn, $insertprogram);

	header("location: ../student_subjects.php");

	$conn->close();
?>