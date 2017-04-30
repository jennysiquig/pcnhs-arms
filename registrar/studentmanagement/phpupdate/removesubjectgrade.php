<?php require_once "../../../resources/config.php"; ?>
<?php
	session_start();
	if(!$conn) {
		die();
	}	
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$studsubj_id = htmlspecialchars($_GET['studsubj_id'], ENT_QUOTES);
	$yr_level = htmlspecialchars($_GET['yr_level'], ENT_QUOTES);

	$statement1 = "DELETE FROM `pcnhsdb`.`studentsubjects` WHERE `stud_id`='$stud_id' AND `studsubj_id`='$studsubj_id';";
	
	
	mysqli_query($conn, $statement1);
	echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
		echo "<br>";
	$_SESSION['user_activity'][] = "REMOVED SUBJECTS OF:<br> $stud_id";
	header("location: ../subject_grades.php?stud_id=$stud_id&yr_level=$yr_level");




?>