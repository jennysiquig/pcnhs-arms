<?php
	require_once "../../resources/config.php";

	$subj_id = $_POST['subj_id'];
	$subj_name = $_POST['subj_name'];
	$subj_level = $_POST['subj_level'];
	$curriculum = $_POST['curr_id'];


	$insertsubject = "INSERT INTO `pcnhsdb`.`subjects` (`subj_id`,`subj_name`, `subj_level`) VALUES ('$subj_id', '$subj_name', '$subj_level')";
	$insertcurriculum = "INSERT INTO `pcnhsdb`.`subjectcurriculum` (`subj_id`,`curr_id`) VALUES ('$subj_id', '$curriculum')";

	mysqli_query($conn, $insertsubject);
	mysqli_query($conn, $insertcurriculum);

	header("location: student_subjects.php");

	$conn->close();
?>