<?php require_once "../../../resources/config.php"; ?>
<?php
	session_start();
	if(!$conn) {
		die();
	}	
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$yr_lvl = $_GET['yr_lvl'];


	$statement1 = "DELETE FROM `pcnhsdb`.`attendance` WHERE `stud_id`='$stud_id' and yr_lvl = '$yr_lvl';";
	
	
	mysqli_query($conn, $statement1);
	
	$_SESSION['user_activity'][] = "REMOVED ATTENDANCE OF: $stud_id";
	header("location: ../attendance.php?stud_id=$stud_id");

?>