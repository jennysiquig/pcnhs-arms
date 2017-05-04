<?php require_once "../../../resources/config.php"; ?>
<?php
	session_start();
	$stud_id = htmlspecialchars($_GET['stud_id'], ENT_QUOTES);
	$yr_lvl = $_GET['yr_lvl'];


	$statement1 = "DELETE FROM `pcnhsdb`.`attendance` WHERE `stud_id`='$stud_id' and yr_lvl = '$yr_lvl';";


	DB::query($statement1);

	echo "<p>Fatal error occured, please logout.</p><a href='../../../logout.php'> Logout</a>";
	echo "<br>";
	$_SESSION['user_activity'][] = "REMOVED ATTENDANCE OF: $stud_id";
	header("location: ../student_info.php?stud_id=$stud_id");

?>
