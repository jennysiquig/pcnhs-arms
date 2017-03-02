<?php require_once "../../resources/config.php"; ?>
<?php
	$stud_id = $_GET['stud_id']; 
	$req_id = $_GET['req_id'];
	if(!$conn) {
		die();
	}

 	$updatestm = "UPDATE `pcnhsdb`.`requests` SET `status`='r', `date_released`= current_date() WHERE `req_id`= '$req_id';";

 	mysqli_query($conn, $updatestm);

 	header("location: released.php");

?>