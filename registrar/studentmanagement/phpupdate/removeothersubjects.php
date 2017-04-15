<?php require_once "../../../resources/config.php"; ?>
<?php
	session_start();
	if(!$conn) {
		die();
	}	
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$yr_level = htmlspecialchars($_GET['yr_level'], ENT_QUOTES);

	$statement1 = "DELETE FROM `pcnhsdb`.`othersubjects` WHERE `stud_id`='$stud_id' and yr_level = '$yr_level';";
	
	
	mysqli_query($conn, $statement1);
	
	$_SESSION['user_activity'][] = "REMOVED OTHER SUBJECTS OF:<br> $stud_id";
	header("location: ../grades.php?stud_id=$stud_id");

?>