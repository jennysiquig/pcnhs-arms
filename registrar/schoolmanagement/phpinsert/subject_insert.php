<?php
	require_once "../../../resources/config.php";

	$subj_id = $_POST['subj_id'];
	$subj_name = $_POST['subj_name'];
	$subj_level = $_POST['subj_level'];
	$curriculum = $_POST['curr_id'];
	$program = $_POST['prog_id'];
	$yr_level_needed = $_POST['yr_level_needed'];

	$multipleinsert = "";
	//$insertprogram = "";
	$willInsert = true;
	if(is_null($curriculum)) {
		$willInsert = false;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}
	if(is_null($program)) {
		$willInsert = false;
		header("Location: ".$_SERVER['HTTP_REFERER']);
	}

	$insertsubject = "INSERT INTO `pcnhsdb`.`subjects` (`subj_id`,`subj_name`, `subj_level`, `yr_level_needed`) VALUES ('$subj_id', '$subj_name', '$subj_level', '$yr_level_needed');";


	foreach ($curriculum as $key => $value) {
		# code...
		$curr_id = $curriculum[$key];
		$multipleinsert .= "INSERT INTO `pcnhsdb`.`subjectcurriculum` (`subj_id`,`curr_id`) VALUES ('$subj_id', '$curr_id');";
	}
	
	foreach ($program as $key => $value) {
		# code...
		$prog_id = $program[$key];
		$multipleinsert .= "INSERT INTO `pcnhsdb`.`subjectprogram` (`subj_id`,`prog_id`) VALUES ('$subj_id', '$prog_id');";
	}
	if($willInsert) {
		mysqli_query($conn, $insertsubject);
		mysqli_multi_query($conn, $multipleinsert);
		//mysqli_multi_query($conn, $insertprogram);
		header("location: ../student_subjects.php");
	}
	

	$conn->close();
?>