<?php require_once "../../../resources/config.php"; ?>
<?php
	$stud_id = $_GET['stud_id'];
	$schl_year = $_GET['schl_year'];
	$yr_level = $_GET['yr_level'];
	$average_grade = $_GET['average_grade'];
	$total_credit = $_GET['total_credit'];

	$statement = "UPDATE `pcnhsdb`.`grades` SET `average_grade`='$average_grade', `total_credit`='$total_credit' WHERE `stud_id`='$stud_id' AND schl_year = '$schl_year' AND yr_level = '$yr_level';";


	DB::query($statement);
	header("location: ../student_info.php?stud_id=$stud_id");
?>
