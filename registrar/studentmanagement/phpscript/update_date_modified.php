<?php
	require_once "../../../resources/config.php";
	$date_modified = $_GET['date_modified'];
	$stud_id = $_GET['stud_id'];
	$statement = "UPDATE `pcnhsdb`.`students` SET `date_modified`='$date_modified' WHERE `stud_id`='$stud_id';";

	DB::query($statement);



?>
